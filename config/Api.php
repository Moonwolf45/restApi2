<?php

abstract class Api {

    public $apiName = '';
    protected $method = '';
    public $requestUri = [];
    public $requestParams = [];

    protected $action = '';

    public function __construct() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        if (stristr(trim($_SERVER['REQUEST_URI'],'/'), '?', true) !== FALSE) {
            $url = stristr(trim($_SERVER['REQUEST_URI'],'/'), '?', true);
        } else {
            $url = trim($_SERVER['REQUEST_URI'],'/');
        }
        $this->requestUri = explode('/', $url);
        $this->requestParams = $_REQUEST;

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function run() {
        if (array_shift($this->requestUri) !== 'api' || array_shift($this->requestUri) !== $this->apiName) {
            throw new RuntimeException('API Not Found', 404);
        }
        $this->action = $this->getAction();

        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }

    protected function response($data, $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            201 => 'Created',
            400 => 'Bad Request',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            423 => 'Locked',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ? $status[$code] : $status[500];
    }

    protected function getAction() {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                if ($this->requestUri[0] == 'view') {
                    return 'viewAction';
                } elseif ($this->requestUri[0] != 'create' || $this->requestUri[0]  != 'update' || $this->requestUri[0]  != 'delete') {
                    return 'indexAction';
                }
            break;
            case 'PUT':
            case 'POST':
            case 'DELETE':
                return array_shift($this->requestUri) . 'Action';
            break;
            default:
                return null;
        }
    }

    abstract protected function indexAction();
    abstract protected function viewAction();
    abstract protected function createAction();
    abstract protected function updateAction();
    abstract protected function deleteAction();
}

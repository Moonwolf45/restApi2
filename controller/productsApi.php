<?php

require_once 'config/Api.php';
require_once 'config/Database.php';
require_once 'model/Product.php';

class productsApi extends Api {
    public $apiName = 'products';

    /**
     * @return false|string
     */
    public function indexAction() {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        switch ($this->requestUri[0]) {
            case 'id':
                $id = $this->requestParams['param'];
                $stmt = $product->getProductById($id);
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    return $this->response($row, 200);
                }
                return $this->response('Product not found', 404);
            break;
            case 'name':
                $name = $this->requestParams['param'];
                $stmt = $product->getProductByName($name);
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    return $this->response($row, 200);
                }
                return $this->response('Product not found', 404);
            break;
            case 'brand':
                $brand = $this->requestParams['param'];
                $stmt = $product->getProductByManufacturer($brand);
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $product_items = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $product_items[] = $row;
                    }
                    return $this->response($product_items, 200);
                }
                return $this->response('Product not found', 404);
            break;
            case 'category':
                $category = $this->requestParams['param'];
                $stmt = $product->getProductByCategory($category);
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $product_items = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $product_items[] = $row;
                    }
                    return $this->response($product_items, 200);
                }
                return $this->response('Product not found', 404);
            break;
            case 'all_category':
                $categories = $this->requestParams['param'];
                $stmt = $product->getProductByCategories($categories);
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $product_items = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $product_items[] = $row;
                    }
                    return $this->response($product_items, 200);
                }
                return $this->response('Product not found', 404);
            break;
            default:
                $stmt = $product->getAllProduct();
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $product_items = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $product_items[] = $row;
                    }
                    return $this->response($product_items, 200);
                }
                return $this->response('Product not found', 404);
        }
    }

    /**
     * @return false|string
     */
    public function createAction() {
        return $this->response('Method locked', 423);
    }

    public function viewAction() {
        return $this->response('Method locked', 423);
    }

    public function updateAction() {
        return $this->response('Method locked', 423);
    }

    public function deleteAction() {
        return $this->response('Method locked', 423);
    }
}

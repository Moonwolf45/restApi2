<?php

require_once 'controller/productsApi.php';

try {
    $api = new productsApi();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}


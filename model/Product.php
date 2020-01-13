<?php

class Product {

    private $conn;
    private $table_name = "products";

    public $id;
    public $title;
    public $availability;
    public $manufacturer;
    public $category;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProductById($id) {
        $query = "SELECT p.id, p.title AS product_name, c.title AS category_name, p.availability, p.manufacturer, 
            p.price, b.title AS brand FROM " . $this->table_name . " p LEFT JOIN brands b ON p.manufacturer = b.id 
            LEFT JOIN category_product cp ON cp.product_id = p.id LEFT JOIN category c ON c.id = cp.category_id 
            WHERE p.id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => (int)$id]);

        return $stmt;
    }

    public function getProductByName($name) {
        $name = htmlspecialchars(strip_tags($name));
        $query = "SELECT p.id, p.title AS product_name, c.title AS category_name, p.availability, p.manufacturer, 
            p.price, b.title AS brand FROM " . $this->table_name . " p LEFT JOIN brands b ON p.manufacturer = b.id 
            LEFT JOIN category_product cp ON cp.product_id = p.id LEFT JOIN category c ON c.id = cp.category_id 
            WHERE p.title LIKE '%" . $name . "%'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProductByManufacturer($brand) {
        $brands = explode(',', $brand);
        $str_brand = '';
        for ($b = 0; $b < count($brands); $b++) {
            if ($b == 0) {
                $str_brand = 'p.manufacturer=' . (int)$brands[$b];
            }
            $str_brand .= ' OR p.manufacturer=' . (int)$brands[$b];
        }
        $query = "SELECT p.id, p.title AS product_name, c.title AS category_name, p.availability, p.manufacturer, 
            p.price, b.id AS brand_id, b.title AS brand_name FROM " . $this->table_name . " p LEFT JOIN brands b 
            ON p.manufacturer = b.id LEFT JOIN category_product cp ON cp.product_id = p.id LEFT JOIN category c 
            ON c.id = cp.category_id WHERE " . $str_brand;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProductByCategory($category) {
        $query = "SELECT p.id, p.title AS product_name, c.title AS category_name, p.availability, p.manufacturer, 
            p.price, b.id AS brand_id, b.title AS brand_name FROM " . $this->table_name . " p LEFT JOIN brands b 
            ON p.manufacturer = b.id LEFT JOIN category_product cp ON cp.product_id = p.id LEFT JOIN category c 
            ON c.id = cp.category_id WHERE c.id=:category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['category' => (int)$category]);

        return $stmt;
    }

    public function getProductByCategories($category) {
        $categories = self::listCategoriesAsTree($category);
        array_push($categories, $category);

        $str_category = '';
        for ($b = 0; $b < count($categories); $b++) {
            if ($b == 0) {
                $str_category = 'c.id=' . (int)$categories[$b];
            }
            $str_category .= ' OR c.id=' . (int)$categories[$b];
        }
        $query = "SELECT p.id, p.title AS product_name, c.title AS category_name, p.availability, p.manufacturer,
            p.price, b.id AS brand_id, b.title AS brand_name FROM " . $this->table_name . " p LEFT JOIN brands b
            ON p.manufacturer = b.id LEFT JOIN category_product cp ON cp.product_id = p.id LEFT JOIN category c
            ON c.id = cp.category_id WHERE " . $str_category;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function listCategoriesAsTree($uid = 0) {
        static $items;

        $query = "SELECT id FROM category WHERE parent_id=:categoryId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['categoryId' => $uid]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row['id'];
            self::listCategoriesAsTree($row['id']);
        }

        return (array)$items;
    }

    public function getAllProduct() {
        $query = "SELECT p.id, p.title AS product_name, c.title AS category_name, p.availability, p.manufacturer, 
            p.price, b.title AS brand FROM " . $this->table_name . " p LEFT JOIN brands b ON p.manufacturer = b.id 
            LEFT JOIN category_product cp ON cp.product_id = p.id LEFT JOIN category c ON c.id = cp.category_id 
            ORDER BY p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

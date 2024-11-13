<?php
    require_once "../config/config.php";

    require_once "controllers/CategoryController.php";

    require_once "models/Category.php";
    require_once "models/CategoryQuery.php";

    require_once "models/Product.php";
    require_once "models/ProductQuery.php";
    require_once "controllers/ProductController.php";
    

    $act = $_GET["act"] ?? "";
    $id = $_GET["id"] ?? "";

    match($act){
        '' => include "views/components/home.php",
        'list-category' => (new CategoryController())->list(),
        'add-category' => (new CategoryController())->add(),
        'delete-cate' => (new CategoryController())->delete($id),
        'update-cate' => (new CategoryController())->update($id),

        'list-product' => (new ProductController())->list(),
        'add-product' => (new ProductController())->add(),
        'delete-product' => (new ProductController())->delete($id),
        'update-product' => (new ProductController())->update($id),
    };
?>

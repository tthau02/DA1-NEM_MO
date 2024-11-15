<?php
    require_once "../config/config.php";

    require_once "controllers/CategoryController.php";

    require_once "models/Category.php";
    require_once "models/CategoryQuery.php";

    $act = $_GET["act"] ?? "";
    $id = $_GET["id"] ?? "";

    match($act){
        '' => include "views/components/home.php",
        'list-category' => (new CategoryController())->list(),
        'add-category' => (new CategoryController())->add(),
        'delete-cate' => (new CategoryController())->delete($id),
        'update-cate' => (new CategoryController())->update($id),
    };
?>

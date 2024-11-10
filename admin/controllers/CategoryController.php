<?php

class CategoryController {

    public $categoryQuery;

    public function __construct() {
        $this->categoryQuery = new CategoryQuery();
    }

    public function list() {
        $categoryList = $this->categoryQuery->getAllCategory();
        include 'views/category/categoryList.php';
    }

    public function add() {
        if (isset($_POST["submitFormAddCategory"])) {
            $category = new Category();
            $category->categorie_name = trim($_POST["categoryName"]);
            $category->description = trim($_POST["categoryDesc"]);
            $category->categorie_image = "";
    
            if (isset($_FILES["categorie_image"]) && $_FILES["categorie_image"]["error"] == 0) {
                $img = $_FILES["categorie_image"]["tmp_name"];
                $imageName = basename($_FILES["categorie_image"]["name"]);
                $uploadDir = "../assets/images/category/";
                $location = $uploadDir . $imageName;
    
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                if (move_uploaded_file($img, $location)) {
                    $category->categorie_image = $imageName;
                }
            }
    
            $result = $this->categoryQuery->addCategory($category);
            if ($result == "ok") {
                $successMessage = "Cập nhật danh mục thành công!";
            } else {
                $errorMessage = "Cập nhật danh mục thất bại. Mời nhập lại.";
            }
        }
    
        $categoryListNew = $this->categoryQuery->getAllCategory();
        include 'views/category/categoryAdd.php';
    }
    

    public function delete($id){
        if($id !== ""){
            $result = $this->categoryQuery->deleteCategory($id);
            if($result === "ok"){
                header("location: ?act=list-category");
            }else{
                echo "Xoa that bai";
            }
        }
    }

    public function update($id) {
        $category = $this->categoryQuery->find($id);
    
        if (isset($_POST["submitFormUpdateCategory"])) {
            $category->categorie_id = $id;
            $category->categorie_name = trim($_POST["categoryName"]);
            $category->description = trim($_POST["categoryDesc"]);
            
            $category->categorie_image = $category->categorie_image;
            if (isset($_FILES["categorie_image"]) && $_FILES["categorie_image"]["error"] == 0) {
                $img = $_FILES["categorie_image"]["tmp_name"];
                $imageName = basename($_FILES["categorie_image"]["name"]);
                $uploadDir = "../assets/images/category/";
                $location = $uploadDir . $imageName;
    
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                if (move_uploaded_file($img, $location)) {
                    $category->categorie_image = $imageName;
                }
            }
            $result = $this->categoryQuery->updateCategory($category);
    
            if ($result == "ok") {
                $successMessage = "Cập nhật danh mục thành công!";
            } else {
                $errorMessage = "Cập nhật danh mục thất bại. Mời nhập lại.";
            }
        }
    
        $categoryListNew = $this->categoryQuery->getAllCategory();
        include 'views/category/categoryUpdate.php';
    }
}

?>

<?php 
    class ProductController {
        public $ProductQuery;
        public $CategoryQuery;
        public function __construct()
        {
            $this->ProductQuery = new ProductQuery();
            $this->CategoryQuery = new CategoryQuery();
        }

        public function list() {
            $productList = $this->ProductQuery->getAllproduct();
            include 'views/product/productList.php';
        }
    
        public function add() {
            if (isset($_POST["submitFormAddProduct"])) {
                var_dump($_POST);
                $product = new product();
                $product->product_name = trim($_POST["productName"]);
                $product->product_image = "";
                $product->product_price=$_POST["product_price"];
                $product->product_description = trim($_POST["productDesc"]);
                
                $product->product_id=$_POST["product_id"];
                
        
                if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == 0) {
                    $img = $_FILES["productImage"]["tmp_name"];
                    $imageName = basename($_FILES["productImage"]["name"]);
                    $uploadDir = "../assets/images/product/";
                    $location = $uploadDir . $imageName;
        
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
        
                    if (move_uploaded_file($img, $location)) {
                        $product->product_image = $imageName;
                    }
                }
        
                $result = $this->ProductQuery->addproduct($product);
                if ($result == "ok") {
                    $successMessage = "Thêm sản phẩm thành công!";
                } else {
                    $errorMessage = "Thêm sản phẩm thất bại. Mời nhập lại.";
                }
            }
        
            $productList = $this->ProductQuery->getAllproduct();
            $categoryList = $this->CategoryQuery->getAllCategory();
            include 'views/product/productAdd.php';
        }
        
    
        public function delete($id){
            if($id !== ""){
                $result = $this->ProductQuery->deleteProduct($id);
                if($result === "ok"){
                    header("location: ?act=list-product");
                }else{
                    echo "Xoa that bai";
                }
            }
        }
    
        public function update($id) {
            $product = $this->ProductQuery->find($id);
        
            if (isset($_POST["submitFormUpdateProduct"])) {
                $product->product_id = $id;
                $product->product_name = trim($_POST["productName"]);
                $product->product_description = trim($_POST["productDesc"]);
                $product->product_price=$_POST["product_price"];
                
                $product->product_image = $product->product_image;
                if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == 0) {
                    $img = $_FILES["productImage"]["tmp_name"];
                    $imageName = basename($_FILES["productImage"]["name"]);
                    $uploadDir = "../assets/images/product/";
                    $location = $uploadDir . $imageName;
        
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
        
                    if (move_uploaded_file($img, $location)) {
                        $product->product_image = $imageName;
                    }
                }
                $result = $this->ProductQuery->updateproduct($product);
        
                if ($result == "ok") {
                    $successMessage = "Cập nhật sản phẩm thành công!";
                } else {
                    $errorMessage = "Cập nhật sản phẩm thất bại. Mời nhập lại.";
                }
            }
        
            $productList = $this->ProductQuery->getAllproduct();
            $categoryList = $this->CategoryQuery->getAllCategory();
            include 'views/product/productUpdate.php';
        }
    }

?>
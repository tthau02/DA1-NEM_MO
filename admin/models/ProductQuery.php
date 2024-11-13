<?php 
    class ProductQuery{
        public $pdo;
        public function __construct()
        {
            $this->pdo = connect_DB();
        }

        public function getAllProduct() {
            try {
                $sql = "SELECT * FROM products";
                $data = $this->pdo->query($sql)->fetchAll();
    
                $listProduct = [];
                foreach($data as $row) {
                    $product = new Product();
                    $product->product_id = $row["product_id"];
                    $product->product_name = $row["product_name"];
                    $product->product_image = $row["product_image"];
                    $product->product_price = $row["product_price"];
                    
                    $product->product_description = $row["product_description"];
                    $product->categorie_id = $row["categorie_id"];
                    
                    $listProduct[] = $product; // Thêm product vào listproduct
                }
    
                return $listProduct; // Trả về danh sách cuối cùng
    
            } catch(Exception $e) {
                echo "error..." . $e->getMessage();
            }
        }
    
        public function addProduct(Product $product){
            try {
                // Ép kiểu product_price thành số thực
                $product_price = (float) $product->product_price;
        
                $sql = "INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_price`, `product_description`,`categorie_id`) 
                        VALUES (NULL, '$product->product_name', '$product->product_image', '$product_price', '$product->product_description',$product->categorie_id)";
                        
                $data = $this->pdo->exec($sql);
                
                if($data == 1){
                    return "ok";
                } else {
                    return $data;
                }
            } catch(Exception $e) {
                echo "error..." . $e->getMessage();
            }
        }
        
    
        public function deleteProduct($id){
            try{
                $sql = "DELETE FROM products WHERE product_id  = $id";
                $data = $this->pdo->exec($sql);
                if($data === 1){
                    return "ok";
                }
            }catch (Exception $e) { 
                echo "Lỗi..." . $e->getMessage();
            }
        }
    
        public function updateProduct(Product $object){
            try{
                $sql = "UPDATE `products` SET `product_name` = '$object->product_name', `product_description` = '$object->product_description', `product_image` = '$object->product_image',`product_price` = $object->product_price, `categorie_id`= '$object->categorie_id'  WHERE `products`.`product_id` = $object->product_id;";
        
                $data = $this->pdo->exec($sql);
                
                if($data == 1){
                    return "ok";
                }
            } catch (Exception $e) { 
                echo "Lỗi... " . $e->getMessage();
            }
        }
        
    
        public function find($id){
            try{
                $sql = "SELECT * FROM products WHERE product_id = $id";
                $data = $this->pdo->query($sql)->fetch();
                if ($data) {
                    $product = new Product();
                    $product->product_id = $data["product_id"];
                    $product->product_name = $data["product_name"];
                    $product->product_image = $data["product_image"];
                    $product->product_price = $data["product_price"];
                    $product->product_description = $data["product_description"];
                    $product->categorie_id = $data["categorie_id"];
                    return $product;
                } else {
                    return null;
                }
            }catch (Exception $e) { 
                echo "Lỗi..." . $e->getMessage();
            }
        }
    }

?>
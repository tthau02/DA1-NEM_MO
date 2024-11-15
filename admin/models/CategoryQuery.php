<?php 

class CategoryQuery {

    public $pdo;

    public function __construct() {
        $this->pdo = connect_DB();
    }

    public function getAllCategory() {
        try {
            $sql = "SELECT * FROM categories";
            $data = $this->pdo->query($sql)->fetchAll();

            $listCategory = [];
            foreach($data as $row) {
                $category = new Category();
                $category->categorie_id = $row["categorie_id"];
                $category->categorie_name = $row["categorie_name"];
                $category->description = $row["description"];
                $category->categorie_image = $row["categorie_image"];
                $listCategory[] = $category; // Thêm category vào listCategory
            }

            return $listCategory; // Trả về danh sách cuối cùng

        } catch(Exception $e) {
            echo "error..." . $e->getMessage();
        }
    }

    public function addCategory(Category $category){
        try{

            $sql = "INSERT INTO `categories` (`categorie_id`, `categorie_name`, `description`, `categorie_image`) 
            VALUES (NULL, '$category->categorie_name', '$category->description', '$category->categorie_image');";
            $data = $this->pdo->exec($sql);
            
            if($data == 1){
                return "ok";
            }else {
                return $data;
            }

        }catch(Exception $e){
            echo "error..." . $e->getMessage();
        }
    }

    public function deleteCategory($id){
        try{
            $sql = "DELETE FROM categories WHERE categorie_id  = $id";
            $data = $this->pdo->exec($sql);
            if($data === 1){
                return "ok";
            }
        }catch (Exception $e) { 
            echo "Lỗi..." . $e->getMessage();
        }
    }

    public function updateCategory(Category $object){
        try{
            $sql = "UPDATE `categories` SET `categorie_name` = '$object->categorie_name', `description` = '$object->description', `categorie_image` = '$object->categorie_image' WHERE `categories`.`categorie_id` = $object->categorie_id;";
    
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
            $sql = "SELECT * FROM categories WHERE categorie_id = $id";
            $data = $this->pdo->query($sql)->fetch();
            if ($data) {
                $category = new Category();
                $category->categorie_id = $data["categorie_id"];
                $category->categorie_name = $data["categorie_name"];
                $category->description = $data["description"];
                $category->categorie_image = $data["categorie_image"];
                return $category;
            } else {
                return null;
            }
        }catch (Exception $e) { 
            echo "Lỗi..." . $e->getMessage();
        }
    }
}

?>

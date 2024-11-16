<?php

define('IMAGE_PATH_CATE', 'assets/images/category/');

?>

<?php
function connect_DB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "du_an-1";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
        
    } catch (PDOException $e) {
        echo "Lỗi kết nối: " . $e->getMessage();
        return null;
    }
}
$conn = connect_DB();
?>

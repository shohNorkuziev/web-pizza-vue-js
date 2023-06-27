<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DB_PIZZA";

try {
    $conn = new PDO("mysql:host=$servername;port=3307;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM products";
    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($data, JSON_NUMERIC_CHECK);
} catch(PDOException $e) {
    echo "Нету подключения к базе данных: " . $e->getMessage();
}
$conn = null;
?>

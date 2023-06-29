<?php

include './connect.php';
try {
    
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type");
    echo json_encode($data, JSON_NUMERIC_CHECK);
} catch(Exception $e) {
    echo "Ошибка при выполнении запроса: " . $e->getMessage();
}
mysqli_close($conn);
?>

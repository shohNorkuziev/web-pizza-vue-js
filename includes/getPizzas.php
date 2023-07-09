<?php
require_once './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Получение списка пицц из базы данных
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

$pizzas = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $pizzas[] = $row;
  }
}

$response = [
  'success' => true,
  'pizzas' => $pizzas
];

header("Content-Type: application/json");
echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

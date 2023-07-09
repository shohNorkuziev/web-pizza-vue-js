<?php
require_once './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents('php://input'), true);
$pizzaId = $data['id'];

// Удаление пиццы из базы данных
$sql = "DELETE FROM products WHERE id='$pizzaId'";
if (mysqli_query($conn, $sql)) {
  $response = [
    'success' => true,
    'message' => 'Пицца успешно удалена'
  ];
} else {
  $response = [
    'success' => false,
    'message' => 'Ошибка при удалении пиццы'
  ];
}

header("Content-Type: application/json");
echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

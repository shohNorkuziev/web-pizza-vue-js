<?php 
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include './connect.php';
// Получаем данные пиццы из POST-запроса
$pizza = json_decode(file_get_contents('php://input'), true);
// Подготовленный запрос для добавления пиццы в таблицу
$stmt = $conn->prepare("INSERT INTO products (title, description, size, price, images, id_categories) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssi", $pizza['title'], $pizza['description'], $pizza['size'], $pizza['price'], $pizza['images'], $pizza['id_categories']);

$response = array();

if ($stmt->execute()) {
  $response['success'] = true;
  $response['message'] = 'Пицца успешно добавлена';
} else {
  $response['success'] = false;
  $response['message'] = 'Ошибка при добавлении пиццы: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
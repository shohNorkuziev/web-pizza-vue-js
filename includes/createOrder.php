<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Получение данных заказа из тела запроса
$data = json_decode(file_get_contents('php://input'), true);

include './connect.php';
// Подготовка и выполнение запроса на вставку заказа
$sql = "INSERT INTO orders (diameter, dough, quantity, title, status, all_price, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Error in statement preparation: ' . $conn->error);
}

foreach ($data['items'] as $item) {
    $stmt->bind_param('ssisssi', $item['diameter'], $item['dough'], $item['quantity'], $item['title'], $item['status'], $item['all_price'], $item['id_user']);
    $stmt->execute();
}

$stmt->close();
$conn->close();

// Отправка успешного ответа
$response = array('success' => true, 'message' => 'Order created successfully');
echo json_encode($response);
?>
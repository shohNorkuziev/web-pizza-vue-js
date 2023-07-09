<?php 
include './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Получение данных пиццы из запроса

$data = json_decode(file_get_contents("php://input"), true);
$pizzaId = $data['id'];

// Получение опциональных данных из запроса
$pizzaName = isset($data['name']) ? $data['name'] : null;
$pizzaCategory = isset($data['id_categories']) ? $data['id_categories'] : null;
$pizzaPrice = $data['price'];

// Подготовка и выполнение запроса на обновление данных пиццы
$stmt = $conn->prepare("UPDATE products SET title = IFNULL(?, title), id_categories = IFNULL(?, id_categories), price = ? WHERE id = ?");
$stmt->bind_param("ssdi", $pizzaName, $pizzaCategory, $pizzaPrice, $pizzaId);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Данные пиццы успешно обновлены";
} else {
    $response['success'] = false;
    $response['message'] = "Ошибка при обновлении данных пиццы: " . $stmt->error;
}

// Закрытие соединения с базой данных и освобождение ресурсов
$stmt->close();
$conn->close();

// Отправка ответа в формате JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
?>
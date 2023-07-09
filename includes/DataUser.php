<?php
include './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Получение данных из POST-запроса
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData);

$name = $data->name;
$surname = $data->surname;
$email = $data->email;

// Обновление данных пользователя в базе данных
$sql = "UPDATE users SET name='$name', surname='$surname' WHERE email='$email'";
if (mysqli_query($conn, $sql)) {
  $response = [
    'success' => true,
    'message' => 'Данные пользователя успешно обновлены'
  ];
} else {
  $response = [
    'success' => false,
    'message' => 'Ошибка при обновлении данных пользователя'
  ];
}

header("Content-Type: application/json");
echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

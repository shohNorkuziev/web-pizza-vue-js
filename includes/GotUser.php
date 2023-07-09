<?php
include './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Получение данных всех пользователей из базы данных
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
  $users[] = $row;
}

$response = [
  'success' => true,
  'message' => 'Данные пользователей успешно получены',
  'users' => $users
];

header("Content-Type: application/json");
echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

<?php
include './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Получение списка ролей пользователей из таблицы role
$sql = "SELECT * FROM role";
$result = mysqli_query($conn, $sql);
$roles = [];

while ($row = mysqli_fetch_assoc($result)) {
  $roles[] = $row;
}

$response = [
  'success' => true,
  'message' => 'Список ролей успешно получен',
  'roles' => $roles
];

header("Content-Type: application/json");
echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

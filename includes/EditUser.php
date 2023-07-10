<?php
require_once './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$name = $data['name'];
$surname = $data['surname'];
$email = $data['email'];
$role = $data['role'];

// Обновление данных пользователя в базе данных
$sql = "UPDATE users SET name='$name', surname='$surname', email='$email' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
  // Обновление роли пользователя в таблице authorrole
  $roleSql = "UPDATE authorrole SET roleid='$role' WHERE usersid='$id'";
  mysqli_query($conn, $roleSql);

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

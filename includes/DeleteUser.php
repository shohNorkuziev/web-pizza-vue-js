<?php
include './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$data = json_decode(key($_POST), true);
$id = $data['id'];

// Удаление пользователя из базы данных
$sql = "DELETE FROM users WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
  // Удаление связанных данных в таблице authorrole
  $roleSql = "DELETE FROM authorrole WHERE usersid='$id'";
  mysqli_query($conn, $roleSql);

  $response = [
    'success' => true,
    'message' => 'Пользователь успешно удален'
  ];
} else {
  $response = [
    'success' => false,
    'message' => 'Ошибка при удалении пользователя'
  ];
}

header("Content-Type: application/json");
echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

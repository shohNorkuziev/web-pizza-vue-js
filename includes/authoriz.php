<?php
include './connect.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$email = $_POST['email'];
$password = $_POST['password'];
$hash_password= md5($password);
// Логика авторизации
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hash_password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
  
  $response = [
    'success' => true,
    'message' => 'Авторизация прошла успешно'
  ];
} else {

  $response = [
    'success' => false,
    'message' => 'Неверная почта или пароль'
  ];
}


header("Content-Type: application/json");
echo json_encode($response);
?>

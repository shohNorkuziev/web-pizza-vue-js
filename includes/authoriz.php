<?php
include './connect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData);

$email = $data->email;
$password = $data->password;
$hash_password = md5($password);

// Логика авторизации
$sql = "SELECT u.id, u.surname, u.name, u.email, u.password, ar.roleid 
        FROM users u
        JOIN authorrole ar ON u.id = ar.usersid
        WHERE u.email = '$email' AND u.password = '$hash_password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
  
  $response = [
    'success' => true,
    'message' => 'Авторизация прошла успешно',
    'id' => $row['id'],
    'surname' => $row['surname'],
    'name' => $row['name'],
    'email' => $row['email'],
    'role' => $row['roleid']
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

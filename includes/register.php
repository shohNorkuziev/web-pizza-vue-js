<?php
// Подключение к базе данных
require_once('./connect.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Получение данных из POST-запроса
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordTwo = $_POST['passwordTwo'];

// Проверка совпадения паролей
if ($password !== $passwordTwo) {
  $response = [
    'success' => false,
    'message' => 'Пароль не совпадает'
  ];

  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}

// Проверка существования пользователя с указанным email в базе данных
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  $response = [
    'success' => false,
    'message' => 'Пользователь с таким email уже существует'
  ];

  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}

// Хеширование пароля
$hashedPassword = md5($password);

// Вставка нового пользователя в таблицу users
$sql = "INSERT INTO users (name, surname, email, password) VALUES ('$name', '$surname', '$email', '$hashedPassword')";
if (mysqli_query($conn, $sql)) {
  // Получение ID только что добавленного пользователя
  $userId = mysqli_insert_id($conn);

  // Получение ID роли "Администратор сайта"
  $roleId = "Пользователь";

  // Вставка роли "Администратор сайта" для пользователя в таблицу authorrole
  $sql = "INSERT INTO authorrole (usersid, roleid) VALUES ('$userId', '$roleId')";
  if (mysqli_query($conn, $sql)) {
    $response = [
      'success' => true,
      'message' => 'Регистрация прошла успешно',
      'role' => $roleId
    ];
  } else {
    $response = [
      'success' => false,
      'message' => 'Ошибка при добавлении роли пользователя'
    ];
  }
} else {
  $response = [
    'success' => false,
    'message' => 'Ошибка при выполнении запроса'
  ];
}

header("Content-Type: application/json");

echo json_encode($response);

// Закрытие соединения с базой данных
mysqli_close($conn);
?>

<?php
// Функция для выполнения SQL-запроса и получения результатов
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "DB_PIZZA";
  $port = 3307;

  $conn = mysqli_connect($servername, $username, $password, $dbname,$port );
  mysqli_set_charset($conn, "utf8mb4");

?>

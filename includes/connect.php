<?php
// Функция для выполнения SQL-запроса и получения результатов
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "DB_PIZZA";
  $port = 3307;

  $conn = mysqli_connect($servername, $username, $password, $dbname,$port );
  mysqli_set_charset($conn, "utf8mb4");

  try{
    $pdo=new PDO('mysql:host=localhost;port=3307;dbname=DB_PIZZA','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
  }
  catch(PDOException $e){
    
      exit();
  }
?>

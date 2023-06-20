<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DB_PIZZA";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    mysqli_set_charset($conn, "utf8mb4");
    $sql = "select * from products";

    $result = mysqli_query($conn,$sql);
    

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($data, JSON_NUMERIC_CHECK);
    mysqli_close($conn);
?>
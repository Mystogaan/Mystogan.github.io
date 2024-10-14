<?php 
    $server = 'localhost:3307';
    $username = 'root';
    $password = '';
    $db_name = 'db_user';

    $conn = mysqli_connect($server, $username, $password, $db_name);

    if(!$conn) {
        die("Gagal terhubung ke database: " . mysqli_connect_error());
    }
?>
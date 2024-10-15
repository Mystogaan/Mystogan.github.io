<?php
session_start();
require 'koneksi.php';

// Cek jika tombol login diklik
if (isset($_POST['login'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Simpan password tanpa escaping

    // Query untuk mencari pengguna berdasarkan email
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) === 1) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);
        // Pengecekan nama
        if ($name === $user['username']) {
            // Verifikasi password
            if ($password === $user['password']) {
                // Password benar, login berhasil
                $_SESSION['name'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                echo "<script>alert('Login berhasil!'); window.location.href='home.php';</script>";
            } else {
                // Password salah
                echo "<script>alert('Data salah!');</script>";
            }
        } else {
            // Name salah
            echo "<script>alert('Data salah!');</script>";
        }
    } else {
        // Email tidak ditemukan
        echo "<script>alert('Email tidak terdaftar!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="container-login" id="container">
        <div class="box-left">
            <div class="toggle">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
            </div>
        </div>
        <div class="box-right" id="box-right">
            <div class="content-right">
                <form id="loginForm" action="index.php" method="POST">
                    <h1>Sign In</h1>
                    <span>Use your email and password</span>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <button type="submit" name="login" id="Login">Log In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

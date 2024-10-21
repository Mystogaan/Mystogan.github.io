<?php
require 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkQuery = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "
        <script>
        alert('Email already exists!')
        document.location.href = 'register.php';
        </script>";
    } else {
        $query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "
            <script>
            alert('Register success!')
            document.location.href = 'index.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Register failed!')
            document.location.href = 'register.php';
            </script>";
        }
    }
    mysqli_stmt_close($stmt);
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <div class="container-login" id="container">
        <div class="box-left">
            <div class="toggle">
                <h1>Hi Users!</h1>
                <p>Enter your personal details to use all of site features</p>
            </div>
        </div>
        <div class="box-right" id="box-right">
            <div class="content-right">
                <form id="loginForm" action="register.php" method="POST">
                    <h1>Register</h1>
                    <span>Create your email and password</span>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <button type="submit" name="submit" id="submit">Register</button>
                    <p>Already have an account? <a href="index.php" class="sign-up" id="sign-up">Log in</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
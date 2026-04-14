<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";
    $result = $koneksi->execute_query($sql, [$username]);
    $row = $result->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {

        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];     

        if ($row['role'] === 'admin') {
            header("Location: admin.php");
        } elseif ($row['role'] === 'petugas') {
            header("Location: petugas.php");
        }
        exit;
    } else {
        echo "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="" class="login-form">
            <label>Username</label><br>
            <input type="text" name="username" required><br><br>

            <label>Password</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

    </div>
</body>
</html>
<?php
session_start();
require 'koneksi.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // if (!in_array($role, ['admin', 'petugas'], true)) {
    //     $errors[] = 'Role tidak valid.';
    // }

    if (empty($errors)) {
        $stmt = $koneksi->prepare('INSERT INTO user (username, password, role) VALUES (?, ?, ?)');
        if ($stmt) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $username, $passwordHash, $role);
            if ($stmt->execute()) {
                header('Location: login.php');
                exit;
            }
            $stmt->close();
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Register</title>
</head>

<body>
    <div class="login-container">
        <h2>register</h2>
    <form method="post" action="" class="login-form">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Role</label><br>
        <select name="role">
            <option value="admin" <?= (($_POST['role'] ?? '') === 'admin') ? 'selected' : '' ?>>admin</option>
            <option value="petugas" <?= (($_POST['role'] ?? '') === 'petugas') ? 'selected' : '' ?>>petugas</option>
        </select><br><br>

        <button type="submit" name="login" class="btn-login">Regis</button>
    </form>

    <p>apakah ingin kembali? <a href="users.php">balik</a></p>
</body>

</html>
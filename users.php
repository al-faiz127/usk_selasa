<?php
session_start();
require 'koneksi.php';

$sql = "SELECT * FROM user";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testing2</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="manage-user">
        <h2>daftar user</h2>
        <div class="table-wrapper">
        <thead>
            <table>
            <tr>
                <th>No</th>
                <th>username</th>
                <th>password</th>
                <th>role</th>
            </tr>
        
        </thead>
        <tbody id="table-body">
            <?php $no = 0; foreach ($rows as $item) : ?>

            <tr>
                <td><?= ++$no ?></td>
                <td><?= $item['username'] ?></td>
                <td><?= $item['password'] ?></td>
                <td><?= $item['role'] ?></td>
            </tr>

            <?php endforeach ?>
        </tbody>
    </table>
    </div>
    <div class="manage-actions">
        <a href="register.php" class="btn-login">tambah</a>
        <a href="admin.php" class="btn-login">kembali</a>
    </div>
    </div>
</body>
</html>
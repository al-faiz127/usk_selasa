<?php
require 'koneksi.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (nama, harga, stok) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sii", $nama, $harga, $stok);
    if ($stmt->execute()) {
        header('Location: barang.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Tambah Barang</title>
</head>
<body>
    <div class="manage-user">
        <h2>Tambah Barang</h2>
        <form method="post" action="">
            <label>Nama Barang</label><br>
            <input type="text" name="nama" required><br><br>

            <label>Harga</label><br>
            <input type="number" name="harga" required><br><br>

            <label>Stok</label><br>
            <input type="number" name="stok" required><br><br>

            <button type="submit" name="submit" class="btn-login">Tambah</button>
        </form>
        <p>apakah ingin kembali? <a href="barang.php">balik</a></p>
    </div>
</body>
</html>
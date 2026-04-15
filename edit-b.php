<?php 

require 'koneksi.php';

if(isset($_GET['id_barang'])) {
    $id = $_GET['id_barang'];
    $sql = "SELECT * FROM barang WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
}
else if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "UPDATE barang SET nama = ?, harga = ?, stok = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("siii", $nama, $harga, $stok, $id);
    if($stmt->execute()) {
        header("Location: barang.php");
        exit();
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testing2</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="manage-user">
        <h2>Edit Barang</h2>
        <form action="edit-b.php" method="POST">
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?= $result['nama'] ?>" required><br><br>
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?= $result['harga'] ?>" required><br><br>
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?= $result['stok'] ?>" required><br><br>
            <button type="submit" class="btn-login">Update</button>
        </form>
        <div class="manage-actions">
            <a href="barang.php" class="btn-login">Kembali</a>
        </div>
    </div>
</body>
</html>
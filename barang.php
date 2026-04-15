<?php
session_start();
require 'koneksi.php';

$sql = "SELECT * FROM barang";
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
        <h2>daftar barang </h2>
        <div class="table-wrapper">
            <thead>
                <table>
                    <tr>
                        <th>No</th>
                        <th>nama</th>
                        <th>harga</th>
                        <th>stok</th>
                        <th>aksi</th>
                    </tr>

            </thead>
            <tbody id="table-body">
                <?php $no = 0;
                foreach ($rows as $item) : ?>

                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['harga'] ?></td>
                        <td><?= $item['stok'] ?></td>
                        <td>
                            <a href="edit-b.php?id_barang=<?= $item['id'] ?>" class="btn-login">Edit</a>
                            <a href="hapus-b.php?id_barang=<?= $id ?>" class="btn-login">Hapus</a>

                        </td>
                    </tr>

                <?php endforeach ?>
            </tbody>
            </table>
        </div>
        <div class="manage-actions">
            <a href="tambah-b.php" class="btn-login">tambah</a>
            <a href="javascript:history.back()" class="btn-login">kembali</a>
        </div>
    </div>
</body>

</html>
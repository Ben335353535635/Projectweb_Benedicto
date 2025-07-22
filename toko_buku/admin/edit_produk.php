<?php
include '../koneksi/konfigurasi.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../gambar/" . $gambar);
    } else {
        $gambar = $produk['gambar'];
    }

    $query = "UPDATE produk SET judul='$judul', penulis='$penulis', harga='$harga',
              gambar='$gambar', stok='$stok', deskripsi='$deskripsi'
              WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul:</label>
        <input type="text" name="judul" value="<?= $produk['judul']; ?>" required>

        <label>Penulis:</label>
        <input type="text" name="penulis" value="<?= $produk['penulis']; ?>" required>

        <label>Harga:</label>
        <input type="number" name="harga" value="<?= $produk['harga']; ?>" required>

        <label>Gambar:</label>
        <input type="file" name="gambar">
        <p>Gambar saat ini: <?= $produk['gambar']; ?></p>

        <label>Stok:</label>
        <input type="number" name="stok" value="<?= $produk['stok']; ?>" required>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" required><?= $produk['deskripsi']; ?></textarea>

        <button type="submit">Update</button>
    </form>
</body>
</html>
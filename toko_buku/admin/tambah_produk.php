<?php
include '../koneksi/konfigurasi.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Proses tambah data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $folder = "../gambar/";
    move_uploaded_file($tmp, $folder . $gambar);

    $query = "INSERT INTO produk (judul, penulis, harga, gambar, stok, deskripsi)
              VALUES ('$judul', '$penulis', '$harga', '$gambar', '$stok', '$deskripsi')";
    mysqli_query($conn, $query);
    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Tambah Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul:</label>
        <input type="text" name="judul" required>

        <label>Penulis:</label>
        <input type="text" name="penulis" required>

        <label>Harga:</label>
        <input type="number" name="harga" required>

        <label>Gambar:</label>
        <input type="file" name="gambar" required>

        <label>Stok:</label>
        <input type="number" name="stok" required>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
<?php
session_start();
$id_produk = $_POST['produk_id'];
$jumlah = $_POST['jumlah'];

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += $jumlah;
} else {
    $_SESSION['keranjang'][$id_produk] = $jumlah;
}

$_SESSION['pesan'] = "Produk berhasil ditambahkan ke keranjang!";
header("Location: ../index.php");
exit;
?>

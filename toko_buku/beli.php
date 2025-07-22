<?php
session_start();

// Cek apakah id produk dikirim via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID produk tidak valid!";
    exit;
}

$id_produk = (int) $_GET['id'];

// Cek apakah jumlah dikirim via POST
$jumlah = isset($_POST['jumlah']) ? (int) $_POST['jumlah'] : 1;
if ($jumlah < 1) {
    echo "Jumlah tidak valid!";
    exit;
}

// Jika belum ada keranjang, buat array baru
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Jika produk sudah ada di keranjang, tambahkan jumlahnya
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += $jumlah;
} else {
    $_SESSION['keranjang'][$id_produk] = $jumlah;
}

// Redirect kembali ke halaman keranjang
header("Location: keranjang.php");
exit;
?>

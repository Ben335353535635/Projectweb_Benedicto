<?php
session_start();

// Pastikan parameter ID produk tersedia
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Hapus produk dari session keranjang jika ada
    if (isset($_SESSION['keranjang'][$id_produk])) {
        unset($_SESSION['keranjang'][$id_produk]);
    }

    // Kembali ke halaman keranjang
    header('Location: ../keranjang.php');
    exit;
} else {
    // Jika tidak ada ID, kembali ke index
    header('Location: ../index.php');
    exit;
}

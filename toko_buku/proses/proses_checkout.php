<?php
session_start();
include 'koneksi/konfigurasi.php';

// Cek login
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'user') {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='../login.php';</script>";
    exit;
}

// Cek keranjang
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang kosong!'); window.location='../keranjang.php';</script>";
    exit;
}

$pelanggan_id = $_SESSION['user']['id'];
$keranjang = $_SESSION['keranjang'];
$tanggal = date('Y-m-d H:i:s');

// Validasi stok
foreach ($keranjang as $id_produk => $jumlah) {
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id_produk'");
    if (!$query) {
        die("Query error: " . mysqli_error($conn));
    }

    $produk = mysqli_fetch_assoc($query);
    if (!$produk) {
        echo "<script>alert('Produk dengan ID $id_produk tidak ditemukan!'); window.location='../keranjang.php';</script>";
        exit;
    }

    if ($produk['stok'] < $jumlah) {
        echo "<script>alert('Stok tidak cukup untuk produk: {$produk['judul']}'); window.location='../keranjang.php';</script>";
        exit;
    }
}

// Hitung total harga
$total = 0;
foreach ($keranjang as $id_produk => $jumlah) {
    $q = mysqli_query($conn, "SELECT harga FROM produk WHERE id = '$id_produk'");
    $p = mysqli_fetch_assoc($q);
    $subtotal = $p['harga'] * $jumlah;
    $total += $subtotal;
}

// Simpan transaksi
$simpan = mysqli_query($conn, "INSERT INTO transaksi (user_id, tanggal, total) VALUES ('$pelanggan_id', '$tanggal', '$total')");
if (!$simpan) {
    die("Gagal menyimpan transaksi: " . mysqli_error($conn));
}

$transaksi_id = mysqli_insert_id($conn);

// Simpan detail transaksi dan update stok
foreach ($keranjang as $id_produk => $jumlah) {
    $q = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id_produk'");
    $p = mysqli_fetch_assoc($q);
    $subtotal = $p['harga'] * $jumlah;

    $simpan_detail = mysqli_query($conn, "INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, subtotal) 
                                          VALUES ('$transaksi_id', '$id_produk', '$jumlah', '$subtotal')");
    if (!$simpan_detail) {
        die("Gagal simpan detail: " . mysqli_error($conn));
    }

    $update_stok = mysqli_query($conn, "UPDATE produk SET stok = stok - $jumlah WHERE id = '$id_produk'");
    if (!$update_stok) {
        die("Gagal update stok: " . mysqli_error($conn));
    }
}

// Kosongkan keranjang
unset($_SESSION['keranjang']);

// Redirect
echo "<script>alert('Checkout berhasil!'); window.location='../index.php';</script>";
?>

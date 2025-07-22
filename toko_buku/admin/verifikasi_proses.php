<?php
session_start();
include '../koneksi/konfigurasi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    $cek = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_pesanan = '$id_pesanan'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE pembayaran SET status = 'Dibayar' WHERE id_pesanan = '$id_pesanan'");
        echo "<script>alert('Pembayaran telah diverifikasi.'); window.location='verifikasi.php';</script>";
    } else {
        echo "<script>alert('Data pembayaran tidak ditemukan.'); window.location='verifikasi.php';</script>";
    }
} else {
    echo "<script>alert('ID pesanan tidak valid.'); window.location='verifikasi.php';</script>";
}
?>
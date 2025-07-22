<?php
include '../koneksi/konfigurasi.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM produk WHERE id = $id");

header("Location: produk.php");
exit;
?>
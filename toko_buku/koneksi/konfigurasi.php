<?php
// Pengaturan koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "toko_buku";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

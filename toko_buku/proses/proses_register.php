<?php
include '../koneksi/konfigurasi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO users (nama, email, password) VALUES 
    ('$nama', '$email', '$password')");

echo "<script>alert('Registrasi berhasil'); location.href='../login.php';</script>";
?>

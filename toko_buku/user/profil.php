<?php
session_start();
include 'koneksi/konfigurasi.php';

// Cek login
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'user') {
    echo "<script>alert('Silakan login terlebih dahulu'); window.location='login.php';</script>";
    exit;
}

// Ambil info user
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>👤 Profil Pelanggan</h1>

<table style="width: 50%; margin: auto;">
    <tr>
        <th style="text-align:left;">Nama</th>
        <td><?= htmlspecialchars($user['nama']); ?></td>
    </tr>
    <tr>
        <th style="text-align:left;">Email</th>
        <td><?= htmlspecialchars($user['email']); ?></td>
    </tr>
    <tr>
        <th style="text-align:left;">Level</th>
        <td><?= $user['level']; ?></td>
    </tr>
</table>

<div style="text-align:center; margin-top: 20px;">
    <a href="index.php" class="btn-tambah">← Kembali ke Beranda</a>
</div>

</body>
</html>

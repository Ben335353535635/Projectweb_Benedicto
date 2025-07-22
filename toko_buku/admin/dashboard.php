<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <h2><i class="fas fa-book"></i>BukuHepi</h2>
        <div class="menu-kanan">
            <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="produk.php"><i class="fas fa-book"></i> Produk</a>
            <a href="verifikasi.php"><i class="fas fa-check-circle"></i> Verifikasi</a>
            <a href="../logout.php" onclick="return confirm('Yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <h1>Selamat Datang, Admin!</h1>
    <p class="admin-header">Gunakan menu di atas untuk mengelola data produk dan verifikasi pembayaran.</p>
</body>
</html>

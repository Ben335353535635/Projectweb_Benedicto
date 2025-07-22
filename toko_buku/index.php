<?php
session_start();
include 'koneksi/konfigurasi.php';

// Jalankan query dan cek apakah berhasil
$produk = mysqli_query($conn, "SELECT * FROM produk");
if (!$produk) {
    die("Query Error: " . mysqli_error($conn));
}

// Hitung total item keranjang
$total_item = 0;
if (isset($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $jumlah) {
        $total_item += $jumlah;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Buku</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <h2><i class="fas fa-book"></i> Toko Buku</h2>
    <nav>
        <a href="index.php"><i class="fas fa-home"></i> Beranda</a>
        <a href="keranjang.php"><i class="fas fa-shopping-cart"></i> Keranjang (<?= $total_item ?>)</a>
        <a href="riwayat.php"><i class="fas fa-receipt"></i> Riwayat</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <h3>Daftar Buku</h3>

    <div class="produk-list">
    <?php while($row = mysqli_fetch_assoc($produk)) : ?>
        <div class="produk">
            <img src="gambar/<?= htmlspecialchars($row['gambar']); ?>" alt="cover">
            <h3><?= htmlspecialchars($row['judul']); ?></h3>
            <p class="harga">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
            <form method="post" action="beli.php?id=<?= $row['id']; ?>">
                <input type="number" name="jumlah" value="1" min="1">
                <button type="submit"><i class="fas fa-cart-plus"></i> Beli</button>
            </form>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>

<?php
include '../koneksi/konfigurasi.php';
session_start();

// Cek login admin
if (!isset($_SESSION['users']) || $_SESSION['users']['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil data produk
$query = mysqli_query($conn, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Produk</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- Navbar Admin -->
    <div class="navbar">
        <h2><i class="fas fa-book"></i> BukuHepi</h2>
        <div class="menu-kanan">
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="produk.php"><i class="fas fa-box"></i> Produk</a>
            <a href="verifikasi.php"><i class="fas fa-check-circle"></i> Verifikasi</a>
            <a href="../logout.php" onclick="return confirm('Yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="container">
        <a class="btn-tambah" href="tambah_produk.php"><i class="fas fa-plus"></i> Tambah Produk</a>
        <br><br>

        <table class="tabel-produk">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['judul']); ?></td>
                <td><?= htmlspecialchars($row['penulis']); ?></td>
                <td>Rp<?= number_format($row['harga']); ?></td>
                <td><img src="../gambar/<?= $row['gambar']; ?>" width="60"></td>
                <td><?= $row['stok']; ?></td>
                <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                <td>
                    <a class="btn-edit" href="edit_produk.php?id=<?= $row['id']; ?>"><i class="fas fa-edit"></i> Ubah</a>
                    <a class="btn-hapus" href="hapus_produk.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

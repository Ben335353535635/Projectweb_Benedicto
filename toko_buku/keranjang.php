<?php
session_start();
include 'koneksi/konfigurasi.php';

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<h1><i class="fas fa-shopping-cart"></i> Keranjang Belanja Anda</h1>

<?php if (empty($_SESSION['keranjang'])): ?>
    <p style="text-align:center;">
        <i class="fas fa-info-circle" style="color:gray;"></i> Keranjang kamu masih kosong.
    </p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th><i class="fas fa-book"></i> Judul Buku</th>
                <th><i class="fas fa-tag"></i> Harga</th>
                <th><i class="fas fa-sort-numeric-up-alt"></i> Jumlah</th>
                <th><i class="fas fa-money-bill-wave"></i> Subtotal</th>
                <th><i class="fas fa-cogs"></i> Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($_SESSION['keranjang'] as $produk_id => $jumlah):
                $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$produk_id'");
                $produk = mysqli_fetch_assoc($query);
                $subtotal = $produk['harga'] * $jumlah;
                $total += $subtotal;
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($produk['judul']); ?></td>
                <td>Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                <td><?= $jumlah; ?></td>
                <td>Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
                <td>
                    <a href="proses/hapus_keranjang.php?id=<?= $produk_id; ?>" 
                       onclick="return confirm('Hapus produk ini dari keranjang?')" 
                       class="btn-hapus">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:right;">Total:</th>
                <th colspan="2">Rp<?= number_format($total, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>

    <div style="text-align:center; margin-top: 20px;">
        <a href="index.php" class="btn-tambah">
            <i class="fas fa-arrow-left"></i> Lanjut Belanja
        </a>
        <a href="checkout.php" class="btn-tambah" style="background-color:#e67e22;">
            <i class="fas fa-receipt"></i> Checkout
        </a>
    </div>
<?php endif; ?>

</body>
</html>
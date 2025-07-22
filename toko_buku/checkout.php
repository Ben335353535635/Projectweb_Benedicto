<?php
session_start();
include 'koneksi/konfigurasi.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu'); location='login.php';</script>";
    exit;
}

// Ambil isi keranjang dari session
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Checkout</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $no = 1;
        foreach ($keranjang as $id_produk => $jumlah) {
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk"));
            $subtotal = $data['harga'] * $jumlah;
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['judul'] ?></td>
            <td>Rp<?= number_format($data['harga']) ?></td>
            <td><?= $jumlah ?></td>
            <td>Rp<?= number_format($subtotal) ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="4" align="right"><strong>Total</strong></td>
            <td><strong>Rp<?= number_format($total) ?></strong></td>
        </tr>
    </table>

    <h3>Pilih Metode Pembayaran</h3>
    <form action="proses/proses_checkout.php" method="post">
        <input type="hidden" name="total" value="<?= $total ?>">
        <select name="metode" required>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="COD">Bayar di Tempat (COD)</option>
        </select><br><br>
        <button type="submit" name="checkout">Checkout Sekarang</button>
    </form>
</body>
</html>
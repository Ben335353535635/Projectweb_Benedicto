<?php
session_start();
include 'koneksi/konfigurasi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$id_user = $_SESSION['user']['id'];
$result = mysqli_query($conn, "SELECT pesanan.id, pesanan.tanggal, pesanan.total, pembayaran.status, pembayaran.bukti 
    FROM pesanan 
    LEFT JOIN pembayaran ON pesanan.id = pembayaran.id_pesanan
    WHERE pesanan.id_user = '$id_user' 
    ORDER BY pesanan.tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Riwayat Pesanan</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status Pembayaran</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td>Rp<?= number_format($row['total'],0,',','.'); ?></td>
            <td><?= $row['status'] ? $row['status'] : 'Belum Dikirim'; ?></td>
            <td>
                <?php if ($row['bukti']) : ?>
                    <a href="../gambar/<?= $row['bukti']; ?>" target="_blank">Lihat</a>
                <?php else : ?>
                    -
                <?php endif; ?>
            </td>
            <td>
                <?php if (!$row['bukti']) : ?>
                    <a href="konfirmasi.php?id=<?= $row['id']; ?>">Konfirmasi</a>
                <?php else : ?>
                    ✔️
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

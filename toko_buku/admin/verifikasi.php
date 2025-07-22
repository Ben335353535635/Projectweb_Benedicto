<?php
session_start();
include '../koneksi/konfigurasi.php';

// Cek login admin
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Khusus Admin'); window.location='../login.php';</script>";
    exit;
}

// Query perbaikan: Ubah 'user' menjadi 'users' dan pastikan kolom cocok
$query = "SELECT pesanan.id, pesanan.tanggal, users.nama AS username, pesanan.total, pembayaran.status, pembayaran.bukti 
          FROM pesanan
          JOIN users ON pesanan.id_user = users.id
          LEFT JOIN pembayaran ON pesanan.id = pembayaran.id_pesanan
          ORDER BY pesanan.tanggal DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Pembayaran</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Verifikasi Pembayaran</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Username</th>
            <th>Total</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td><?= $row['username']; ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
            <td><?= $row['status'] ? $row['status'] : 'Belum Dikirim'; ?></td>
            <td>
                <?php if ($row['bukti']) : ?>
                    <a href="../gambar/<?= $row['bukti']; ?>" target="_blank">Lihat</a>
                <?php else : ?>
                    -
                <?php endif; ?>
            </td>
            <td>
                <?php if ($row['bukti'] && $row['status'] != 'Dibayar') : ?>
                    <a href="verifikasi_proses.php?id=<?= $row['id']; ?>">Verifikasi</a>
                <?php elseif ($row['status'] == 'Dibayar') : ?>
                    ✔️ Sudah Diverifikasi
                <?php else : ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
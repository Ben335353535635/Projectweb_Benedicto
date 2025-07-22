<?php
include 'koneksi/konfigurasi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Simpan sebagai user biasa (level user)
    $query = mysqli_query($conn, "INSERT INTO users (nama, email, password, level) 
                                  VALUES ('$nama', '$email', '$password', 'user')");

    if ($query) {
        echo "<script>alert('Registrasi berhasil! Silakan login'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal! Email mungkin sudah digunakan'); window.location='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<form action="" method="POST">
    <h2>Registrasi</h2>

    <input type="text" name="nama" placeholder="Nama Lengkap" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Daftar</button>

    <a href="login.php">Sudah punya akun? Login di sini</a>
</form>

</body>
</html>

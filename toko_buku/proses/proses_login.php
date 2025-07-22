<?php
session_start();
include '../koneksi/konfigurasi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $data  = mysqli_fetch_assoc($query);

    if ($data && $password == $data['password']) {
        $_SESSION['user'] = [
            'id'    => $data['id'],
            'nama'  => $data['nama'],
            'email' => $data['email'],
            'level' => $data['level']
        ];

        // Redirect sesuai level
        if ($data['level'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($data['level'] == 'user') {
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Level tidak dikenali!'); window.location='../login.php';</script>";
        }
        exit;
    } else {
        echo "<script>alert('Login gagal! Email atau password salah'); window.location='../login.php';</script>";
    }
} else {
    echo "<script>window.location='../login.php';</script>";
}

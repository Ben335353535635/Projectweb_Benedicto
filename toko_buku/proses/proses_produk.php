<?php
include '../koneksi/konfigurasi.php';

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../gambar/" . $gambar);

    mysqli_query($conn, "INSERT INTO produk (judul, penulis, harga,  gambar, deskripsi) 
        VALUES ('$judul', '$penulis', '$harga', '$stok', '$gambar', '$deskripsi')");
    header("Location: ../admin/produk.php");
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../gambar/" . $gambar);
        $gambar_sql = ", gambar='$gambar'";
    } else {
        $gambar_sql = "";
    }

    mysqli_query($conn, "UPDATE produk SET 
        judul='$judul', penulis='$penulis', harga='$harga', deskripsi='$deskripsi' $gambar_sql 
        WHERE id=$id");

    header("Location: ../admin/produk.php");
}
?>
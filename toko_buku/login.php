<?php
session_start();
if (isset($_SESSION['user'])) {
    // Redirect jika sudah login
    if ($_SESSION['user']['level'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<form action="proses/proses_login.php" method="post">
    <h2>Login</h2>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="login">Masuk</button>

    <a href="register.php">Belum punya akun? Daftar di sini</a>
</form>

</body>
</html>
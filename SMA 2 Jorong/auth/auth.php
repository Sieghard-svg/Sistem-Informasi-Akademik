<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil, simpan session
        $_SESSION['username'] = $username;
        header("Location: ../app/home.php?page=dashboard");
        exit;
    } else {
        // Jika gagal, redirect ke index.php dengan pesan error
        header("Location: ../index.php?error=1");
        exit();
    }
}
?>
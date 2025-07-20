<?php
include '../auth/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM tb_admin WHERE id = '$id'");

header("Location:home.php");

?>
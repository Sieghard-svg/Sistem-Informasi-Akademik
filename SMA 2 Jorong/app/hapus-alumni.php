<?php
include '../auth/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM tb_data_alumni WHERE id = '$id'");

header("Location:home.php?page=data-alumni");
?>
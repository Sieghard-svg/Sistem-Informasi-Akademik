<?php
include '../auth/koneksi.php';
$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "DELETE FROM tb_data_pegawai WHERE id = '$id'");
header("Location:home.php?page=data-pegawai");
exit;
?>
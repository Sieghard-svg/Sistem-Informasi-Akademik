<?php
include '../auth/koneksi.php';
$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "DELETE FROM tb_surat_keluar WHERE id_surat_keluar = '$id'");
header("Location:home.php?page=data-surat-keluar");
exit;
?>
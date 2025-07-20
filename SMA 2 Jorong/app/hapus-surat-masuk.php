<?php
include '../auth/koneksi.php';
$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "DELETE FROM tb_surat_masuk WHERE id_surat_masuk = '$id'");
header("Location:home.php?page=data-surat-masuk");
exit;
?>
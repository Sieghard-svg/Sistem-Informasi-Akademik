<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_sma2jorong";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else

?>
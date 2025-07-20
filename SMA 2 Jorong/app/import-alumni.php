<?php
include '../auth/cek-login.php';
include '../auth/koneksi.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$sukses = 0;
$gagal = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_excel'])) {
    $file = $_FILES['file_excel']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    foreach ($sheet->getRowIterator(2) as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getFormattedValue();
        }
        if (count($data) < 10) {
            $gagal++;
            continue;
        }
        $tahun_lulus = mysqli_real_escape_string($koneksi, $data[0]);
        $nama = mysqli_real_escape_string($koneksi, $data[1]);
        $tempat = mysqli_real_escape_string($koneksi, $data[2]);
        $tanggal_lahir = mysqli_real_escape_string($koneksi, $data[3]);
        $nama_orang_tua = mysqli_real_escape_string($koneksi, $data[4]);
        $no_induk_siswa = mysqli_real_escape_string($koneksi, $data[5]);
        $no_induk_siswa_nasional = mysqli_real_escape_string($koneksi, $data[6]);
        $no_ujian_nasional = mysqli_real_escape_string($koneksi, $data[7]);
        $no_ijazah = mysqli_real_escape_string($koneksi, $data[8]);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $data[9]);
        $query = mysqli_query($koneksi, "INSERT INTO tb_data_alumni (tahun_lulus, nama, tempat, tanggal_lahir, nama_orang_tua, no_induk_siswa, no_induk_siswa_nasional, no_ujian_nasional, no_ijazah, jenis_kelamin) VALUES ('$tahun_lulus', '$nama', '$tempat', '$tanggal_lahir', '$nama_orang_tua', '$no_induk_siswa', '$no_induk_siswa_nasional', '$no_ujian_nasional', '$no_ijazah', '$jenis_kelamin')");
        if ($query) {
            $sukses++;
        } else {
            $gagal++;
        }
    }
    echo "<div class='alert alert-info'>Import selesai. Sukses: $sukses, Gagal: $gagal</div>";
    echo "<meta http-equiv='refresh' content='2;url=home.php?page=data-alumni'>";
    exit;
}
?>
<h2>Import Data Alumni (Excel .xlsx)</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xlsx" required>
    <button type="submit">Import</button>
</form>
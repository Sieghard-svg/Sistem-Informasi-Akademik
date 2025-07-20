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
    foreach ($sheet->getRowIterator(2) as $row) { // Mulai dari baris ke-2 (lewati header)
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getFormattedValue(); // Gunakan formattedValue agar data tidak terpotong
        }
        if (count($data) < 13) { $gagal++; continue; }
        $nama = mysqli_real_escape_string($koneksi, $data[0]);
        $nip = mysqli_real_escape_string($koneksi, $data[1]);
        $pangkat_golongan = mysqli_real_escape_string($koneksi, $data[2]);
        $jabatan = mysqli_real_escape_string($koneksi, $data[3]);
        $pendidikan = mysqli_real_escape_string($koneksi, $data[4]);
        $sertifikasi = mysqli_real_escape_string($koneksi, $data[5]);
        $tempat = mysqli_real_escape_string($koneksi, $data[6]);
        $tanggal_lahir = mysqli_real_escape_string($koneksi, $data[7]);
        $nik = mysqli_real_escape_string($koneksi, $data[8]);
        $tmt_kerja = mysqli_real_escape_string($koneksi, $data[9]);
        $no_bpjs = mysqli_real_escape_string($koneksi, $data[10]);
        $no_hp_wa = mysqli_real_escape_string($koneksi, $data[11]);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $data[12]);
        $query = mysqli_query($koneksi, "INSERT INTO tb_data_pegawai (nama, nip, pangkat_golongan, jabatan, pendidikan, sertifikasi, tempat, tanggal_lahir, nik, tmt_kerja, no_bpjs, no_hp_wa, jenis_kelamin) VALUES ('$nama', '$nip', '$pangkat_golongan', '$jabatan', '$pendidikan', '$sertifikasi', '$tempat', '$tanggal_lahir', '$nik', '$tmt_kerja', '$no_bpjs', '$no_hp_wa', '$jenis_kelamin')");
        if ($query) {
            $sukses++;
        } else {
            $gagal++;
        }
    }
    echo "<div class='alert alert-info'>Import selesai. Sukses: $sukses, Gagal: $gagal</div>";
    echo "<meta http-equiv='refresh' content='2;url=home.php?page=data-pegawai'>";
    exit;
}
?>
<h2>Import Data Pegawai (Excel .xlsx)</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xlsx" required>
    <button type="submit">Import</button>
</form>
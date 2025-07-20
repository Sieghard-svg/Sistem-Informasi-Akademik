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
        if (count($data) < 13) { $gagal++; continue; }
        $jenis_surat = mysqli_real_escape_string($koneksi, $data[0]);
        $nomor_surat = mysqli_real_escape_string($koneksi, $data[1]);
        $tanggal_surat = mysqli_real_escape_string($koneksi, $data[2]);
        $pengirim = mysqli_real_escape_string($koneksi, $data[3]);
        $perihal = mysqli_real_escape_string($koneksi, $data[4]);
        $nama = mysqli_real_escape_string($koneksi, $data[5]);
        $nip = mysqli_real_escape_string($koneksi, $data[6]);
        $pangkat_golongan = mysqli_real_escape_string($koneksi, $data[7]);
        $jabatan = mysqli_real_escape_string($koneksi, $data[8]);
        $untuk_kegiatan = mysqli_real_escape_string($koneksi, $data[9]);
        $tanggal_kegiatan = mysqli_real_escape_string($koneksi, $data[10]);
        $tempat_kegiatan = mysqli_real_escape_string($koneksi, $data[11]);
        $keterangan = mysqli_real_escape_string($koneksi, $data[12]);
        $query = mysqli_query($koneksi, "INSERT INTO tb_surat_masuk (jenis_surat, nomor_surat, tanggal_surat, pengirim, perihal, nama, nip, pangkat_golongan, jabatan, untuk_kegiatan, tanggal_kegiatan, tempat_kegiatan, keterangan) VALUES ('$jenis_surat', '$nomor_surat', '$tanggal_surat', '$pengirim', '$perihal', '$nama', '$nip', '$pangkat_golongan', '$jabatan', '$untuk_kegiatan', '$tanggal_kegiatan', '$tempat_kegiatan', '$keterangan')");
        if ($query) {
            $sukses++;
        } else {
            $gagal++;
        }
    }
    echo "<div class='alert alert-info'>Import selesai. Sukses: $sukses, Gagal: $gagal</div>";
    echo "<meta http-equiv='refresh' content='2;url=home.php?page=data-surat-masuk'>";
    exit;
}
?>
<h2>Import Data Surat Masuk (Excel .xlsx)</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xlsx" required>
    <button type="submit">Import</button>
</form>
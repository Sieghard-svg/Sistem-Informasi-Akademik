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
        if (count($data) < 29) { $gagal++; continue; }
        $nama_lengkap = mysqli_real_escape_string($koneksi, $data[0]);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $data[1]);
        $nomor_induk_siswa = mysqli_real_escape_string($koneksi, $data[2]);
        $nomor_induk_siswa_nasional = mysqli_real_escape_string($koneksi, $data[3]);
        $nik = mysqli_real_escape_string($koneksi, $data[4]);
        $tempat_lahir = mysqli_real_escape_string($koneksi, $data[5]);
        $tanggal_lahir = mysqli_real_escape_string($koneksi, $data[6]);
        $sekolah_asal = mysqli_real_escape_string($koneksi, $data[7]);
        $no_ijazah_sebelumnya = mysqli_real_escape_string($koneksi, $data[8]);
        $no_skhun_sebelumnya = mysqli_real_escape_string($koneksi, $data[9]);
        $tanggal_masuk = mysqli_real_escape_string($koneksi, $data[10]);
        $status_siswa = mysqli_real_escape_string($koneksi, $data[11]);
        $kelas = mysqli_real_escape_string($koneksi, $data[12]);
        $agama = mysqli_real_escape_string($koneksi, $data[13]);
        $kebutuhan_khusus = mysqli_real_escape_string($koneksi, $data[14]);
        $alamat = mysqli_real_escape_string($koneksi, $data[15]);
        $no_hp = mysqli_real_escape_string($koneksi, $data[16]);
        $email = mysqli_real_escape_string($koneksi, $data[17]);
        $status_keluarga = mysqli_real_escape_string($koneksi, $data[18]);
        $nama_ayah = mysqli_real_escape_string($koneksi, $data[19]);
        $nik_ayah = mysqli_real_escape_string($koneksi, $data[20]);
        $pendidikan_ayah = mysqli_real_escape_string($koneksi, $data[21]);
        $pekerjaan_ayah = mysqli_real_escape_string($koneksi, $data[22]);
        $nama_ibu = mysqli_real_escape_string($koneksi, $data[23]);
        $nik_ibu = mysqli_real_escape_string($koneksi, $data[24]);
        $pendidikan_ibu = mysqli_real_escape_string($koneksi, $data[25]);
        $pekerjaan_ibu = mysqli_real_escape_string($koneksi, $data[26]);
        $no_kip_kks_kis = mysqli_real_escape_string($koneksi, $data[27]);
        $query = mysqli_query($koneksi, "INSERT INTO tb_data_siswa (nama_lengkap, jenis_kelamin, nomor_induk_siswa, nomor_induk_siswa_nasional, nik, tempat_lahir, tanggal_lahir, sekolah_asal, no_ijazah_sebelumnya, no_skhun_sebelumnya, tanggal_masuk, status_siswa, kelas, agama, kebutuhan_khusus, alamat, no_hp, email, status_keluarga, nama_ayah, nik_ayah, pendidikan_ayah, pekerjaan_ayah, nama_ibu, nik_ibu, pendidikan_ibu, pekerjaan_ibu, no_kip_kks_kis) VALUES ('$nama_lengkap', '$jenis_kelamin', '$nomor_induk_siswa', '$nomor_induk_siswa_nasional', '$nik', '$tempat_lahir', '$tanggal_lahir', '$sekolah_asal', '$no_ijazah_sebelumnya', '$no_skhun_sebelumnya', '$tanggal_masuk', '$status_siswa', '$kelas', '$agama', '$kebutuhan_khusus', '$alamat', '$no_hp', '$email', '$status_keluarga', '$nama_ayah', '$nik_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$nama_ibu', '$nik_ibu', '$pendidikan_ibu', '$pekerjaan_ibu', '$no_kip_kks_kis')");
        if ($query) {
            $sukses++;
        } else {
            $gagal++;
        }
    }
    echo "<div class='alert alert-info'>Import selesai. Sukses: $sukses, Gagal: $gagal</div>";
    echo "<meta http-equiv='refresh' content='2;url=home.php?page=data-siswa'>";
    exit;
}
?>
<h2>Import Data Siswa (Excel .xlsx)</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xlsx" required>
    <button type="submit">Import</button>
</form>

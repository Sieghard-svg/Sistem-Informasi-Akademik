<?php
include '../auth/cek-login.php';
include '../auth/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom lengkap sesuai tb_data_siswa
$headers = ['Nama Lengkap', 'Jenis Kelamin', 'NIS', 'NISN', 'NIK', 'Tempat Lahir', 'Tanggal Lahir', 'Sekolah Asal', 'No Ijazah Sebelumnya', 'No SKHUN Sebelumnya', 'Tanggal Masuk', 'Status Siswa', 'Kelas', 'Agama', 'Kebutuhan Khusus', 'Alamat', 'No HP', 'Email', 'Status Keluarga', 'Nama Ayah', 'NIK Ayah', 'Pendidikan Ayah', 'Pekerjaan Ayah', 'Nama Ibu', 'NIK Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu', 'No KIP/KKS/KIS'];
$sheet->fromArray($headers, NULL, 'A1');

$query = mysqli_query($koneksi, "SELECT nama_lengkap, jenis_kelamin, nomor_induk_siswa, nomor_induk_siswa_nasional, nik, tempat_lahir, tanggal_lahir, sekolah_asal, no_ijazah_sebelumnya, no_skhun_sebelumnya, tanggal_masuk, status_siswa, kelas, agama, kebutuhan_khusus, alamat, no_hp, email, status_keluarga, nama_ayah, nik_ayah, pendidikan_ayah, pekerjaan_ayah, nama_ibu, nik_ibu, pendidikan_ibu, pekerjaan_ibu, no_kip_kks_kis FROM tb_data_siswa");
$rowNum = 2;
while ($row = mysqli_fetch_assoc($query)) {
    $data = [
        (string)$row['nama_lengkap'],
        (string)$row['jenis_kelamin'],
        (string)$row['nomor_induk_siswa'],
        (string)$row['nomor_induk_siswa_nasional'],
        (string)$row['nik'],
        (string)$row['tempat_lahir'],
        (string)$row['tanggal_lahir'],
        (string)$row['sekolah_asal'],
        (string)$row['no_ijazah_sebelumnya'],
        (string)$row['no_skhun_sebelumnya'],
        (string)$row['tanggal_masuk'],
        (string)$row['status_siswa'],
        (string)$row['kelas'],
        (string)$row['agama'],
        (string)$row['kebutuhan_khusus'],
        (string)$row['alamat'],
        (string)$row['no_hp'],
        (string)$row['email'],
        (string)$row['status_keluarga'],
        (string)$row['nama_ayah'],
        (string)$row['nik_ayah'],
        (string)$row['pendidikan_ayah'],
        (string)$row['pekerjaan_ayah'],
        (string)$row['nama_ibu'],
        (string)$row['nik_ibu'],
        (string)$row['pendidikan_ibu'],
        (string)$row['pekerjaan_ibu'],
        (string)$row['no_kip_kks_kis'],
        
    ];
    $sheet->fromArray($data, NULL, 'A'.$rowNum++);
}

$writer = new Xlsx($spreadsheet);
$filename = 'data_siswa_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit;
?>

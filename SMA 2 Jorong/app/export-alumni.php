<?php
include '../auth/cek-login.php';
include '../auth/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom sesuai tb_data_alumni
$headers = ['Tahun Lulus', 'Nama', 'Tempat', 'Tanggal Lahir', 'Nama Orang Tua', 'No Induk Siswa', 'No Induk Siswa Nasional', 'No Ujian Nasional', 'No Ijazah', 'Jenis Kelamin'];
$sheet->fromArray($headers, NULL, 'A1');

$query = mysqli_query($koneksi, "SELECT tahun_lulus, nama, tempat, tanggal_lahir, nama_orang_tua, no_induk_siswa, no_induk_siswa_nasional, no_ujian_nasional, no_ijazah, jenis_kelamin FROM tb_data_alumni");
$rowNum = 2;
while ($row = mysqli_fetch_assoc($query)) {
    $data = [
        (string) $row['tahun_lulus'],
        (string) $row['nama'],
        (string) $row['tempat'],
        (string) $row['tanggal_lahir'],
        (string) $row['nama_orang_tua'],
        (string) $row['no_induk_siswa'],
        (string) $row['no_induk_siswa_nasional'],
        (string) $row['no_ujian_nasional'],
        (string) $row['no_ijazah'],
        (string) $row['jenis_kelamin']
    ];
    $sheet->fromArray($data, NULL, 'A' . $rowNum++);
}

$writer = new Xlsx($spreadsheet);
$filename = 'data_alumni_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit;
?>
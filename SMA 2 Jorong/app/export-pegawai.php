<?php
include '../auth/cek-login.php';
include '../auth/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$headers = ['Nama', 'NIP', 'Pangkat/Golongan', 'Jabatan', 'Pendidikan', 'Sertifikasi', 'Tempat Lahir', 'Tanggal Lahir', 'NIK', 'TMT Kerja', 'No BPJS', 'No HP/WA', 'Jenis Kelamin'];
$sheet->fromArray($headers, NULL, 'A1');

$query = mysqli_query($koneksi, "SELECT nama, nip, pangkat_golongan, jabatan, pendidikan, sertifikasi, tempat, tanggal_lahir, nik, tmt_kerja, no_bpjs, no_hp_wa, jenis_kelamin FROM tb_data_pegawai");
$rowNum = 2;
while ($row = mysqli_fetch_assoc($query)) {
    // Pastikan semua data diekspor sebagai string agar tidak terpotong
    $data = [
        (string)$row['nama'],
        (string)$row['nip'],
        (string)$row['pangkat_golongan'],
        (string)$row['jabatan'],
        (string)$row['pendidikan'],
        (string)$row['sertifikasi'],
        (string)$row['tempat'],
        (string)$row['tanggal_lahir'],
        (string)$row['nik'],
        (string)$row['tmt_kerja'],
        (string)$row['no_bpjs'],
        (string)$row['no_hp_wa'],
        (string)$row['jenis_kelamin']
    ];
    $sheet->fromArray($data, NULL, 'A'.$rowNum++);
}

$writer = new Xlsx($spreadsheet);
$filename = 'data_pegawai_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit;
?>
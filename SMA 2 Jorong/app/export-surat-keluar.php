<?php
include '../auth/cek-login.php';
include '../auth/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom sesuai tb_surat_keluar
$headers = ['Jenis Surat', 'Nomor Surat', 'Tanggal Keluar', 'Perihal', 'Nama', 'NIP', 'Pangkat/Golongan', 'Jabatan', 'Untuk Kegiatan', 'Tanggal Kegiatan', 'Tempat Kegiatan', 'Tujuan Surat', 'Dasar Surat', 'Dasar Nomor Surat', 'Tanggal Dasar Surat', 'Keterangan'];
$sheet->fromArray($headers, NULL, 'A1');

$query = mysqli_query($koneksi, "SELECT jenis_surat, nomor_surat, tanggal_keluar, perihal, nama, nip, pangkat_golongan, jabatan, untuk_kegiatan, tanggal_kegiatan, tempat_kegiatan, tujuan_surat, dasar_surat, dasar_nomor_surat, tanggal_dasar_surat, keterangan FROM tb_surat_keluar");
$rowNum = 2;
while ($row = mysqli_fetch_assoc($query)) {
    $data = [
        (string)$row['jenis_surat'],
        (string)$row['nomor_surat'],
        (string)$row['tanggal_keluar'],
        (string)$row['perihal'],
        (string)$row['nama'],
        (string)$row['nip'],
        (string)$row['pangkat_golongan'],
        (string)$row['jabatan'],
        (string)$row['untuk_kegiatan'],
        (string)$row['tanggal_kegiatan'],
        (string)$row['tempat_kegiatan'],
        (string)$row['tujuan_surat'],
        (string)$row['dasar_surat'],
        (string)$row['dasar_nomor_surat'],
        (string)$row['tanggal_dasar_surat'],
        (string)$row['keterangan']
    ];
    $sheet->fromArray($data, NULL, 'A'.$rowNum++);
}

$writer = new Xlsx($spreadsheet);
$filename = 'data_surat_keluar_' . date('Y-m-d_H-i-s') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$writer->save('php://output');
exit;
?>
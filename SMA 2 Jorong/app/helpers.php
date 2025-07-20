<?php
function upload_foto($file, $nama, $folder)
{
    $nama_bersih = preg_replace('/[^A-Za-z0-9_]/', '_', $nama);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $nama_file_baru = $nama_bersih . '_' . time() . '.' . $ext;
    $folder_tujuan = __DIR__ . '/../img/' . $folder . '/';
    if (!is_dir($folder_tujuan)) {
        mkdir($folder_tujuan, 0777, true);
    }
    if (move_uploaded_file($file['tmp_name'], $folder_tujuan . $nama_file_baru)) {
        return $folder . '/' . $nama_file_baru;
    } else {
        return false;
    }
}

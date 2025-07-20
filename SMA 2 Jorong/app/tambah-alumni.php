<?php
include '../auth/koneksi.php';
include 'helpers.php';

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset(
    $_POST['nama'],
    $_POST['tahun_lulus'],
    $_POST['tempat'],
    $_POST['tanggal_lahir'],
    $_POST['nama_orang_tua'],
    $_POST['no_induk_siswa'],
    $_POST['no_induk_siswa_nasional'],
    $_POST['no_ujian_nasional'],
    $_POST['no_ijazah'],
    $_POST['jenis_kelamin']
)
) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tahun_lulus = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus']);
    $tempat = mysqli_real_escape_string($koneksi, $_POST['tempat']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $nama_orang_tua = mysqli_real_escape_string($koneksi, $_POST['nama_orang_tua']);
    $no_induk_siswa = mysqli_real_escape_string($koneksi, $_POST['no_induk_siswa']);
    $no_induk_siswa_nasional = mysqli_real_escape_string($koneksi, $_POST['no_induk_siswa_nasional']);
    $no_ujian_nasional = mysqli_real_escape_string($koneksi, $_POST['no_ujian_nasional']);
    $no_ijazah = mysqli_real_escape_string($koneksi, $_POST['no_ijazah']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $tahun = date('Y');
        $nama_bersih = preg_replace('/[^A-Za-z0-9_]/', '_', $nama);
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $nama_file_baru = $nama_bersih . '_' . $tahun . '.' . $ext;
        $folder_tujuan = __DIR__ . '/../img/alumni/';
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            $foto = 'alumni/' . $nama_file_baru;
        } else {
            $foto = '';
        }
    }
    $query = mysqli_query($koneksi, "INSERT INTO tb_data_alumni (tahun_lulus, nama, tempat, tanggal_lahir, nama_orang_tua, no_induk_siswa, no_induk_siswa_nasional, no_ujian_nasional, no_ijazah, jenis_kelamin, foto) VALUES ('$tahun_lulus', '$nama', '$tempat', '$tanggal_lahir', '$nama_orang_tua', '$no_induk_siswa', '$no_induk_siswa_nasional', '$no_ujian_nasional', '$no_ijazah', '$jenis_kelamin', '$foto')");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data alumni berhasil ditambahkan.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-alumni">';
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menambah alumni. Silakan coba lagi.</div>';
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Tambah Data Alumni</h2>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tahun Lulus</label>
                <input type="text" class="form-control" name="tahun_lulus" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Orang Tua</label>
                <input type="text" class="form-control" name="nama_orang_tua" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No Induk Siswa</label>
                <input type="text" class="form-control" name="no_induk_siswa" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No Induk Siswa Nasional</label>
                <input type="text" class="form-control" name="no_induk_siswa_nasional" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No Ujian Nasional</label>
                <input type="text" class="form-control" name="no_ujian_nasional" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No Ijazah</label>
                <input type="text" class="form-control" name="no_ijazah" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" accept="image/*">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
<?php
include '../auth/koneksi.php';
include 'helpers.php';

function get_tahun() {
    return date('Y');
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' && isset(
        $_POST['nama_lengkap'],
        $_POST['nomor_induk_siswa'],
        $_POST['nomor_induk_siswa_nasional'],
        $_POST['nik'],
        $_POST['tempat_lahir'],
        $_POST['tanggal_lahir'],
        $_POST['sekolah_asal'],
        $_POST['no_ijazah_sebelumnya'],
        $_POST['no_skhun_sebelumnya'],
        $_POST['tanggal_masuk'],
        $_POST['status_siswa'],
        $_POST['kelas'],
        $_POST['agama'],
        $_POST['kebutuhan_khusus'],
        $_POST['alamat'],
        $_POST['no_hp'],
        $_POST['email'],
        $_POST['status_keluarga'],
        $_POST['nama_ayah'],
        $_POST['nik_ayah'],
        $_POST['pendidikan_ayah'],
        $_POST['pekerjaan_ayah'],
        $_POST['nama_ibu'],
        $_POST['nik_ibu'],
        $_POST['pendidikan_ibu'],
        $_POST['pekerjaan_ibu'],
        $_POST['no_kip_kks_kis'],
        $_POST['jenis_kelamin']
    )
) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nomor_induk_siswa = mysqli_real_escape_string($koneksi, $_POST['nomor_induk_siswa']);
    $nomor_induk_siswa_nasional = mysqli_real_escape_string($koneksi, $_POST['nomor_induk_siswa_nasional']);
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $sekolah_asal = mysqli_real_escape_string($koneksi, $_POST['sekolah_asal']);
    $no_ijazah_sebelumnya = mysqli_real_escape_string($koneksi, $_POST['no_ijazah_sebelumnya']);
    $no_skhun_sebelumnya = mysqli_real_escape_string($koneksi, $_POST['no_skhun_sebelumnya']);
    $tanggal_masuk = mysqli_real_escape_string($koneksi, $_POST['tanggal_masuk']);
    $status_siswa = mysqli_real_escape_string($koneksi, $_POST['status_siswa']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
    $kebutuhan_khusus = mysqli_real_escape_string($koneksi, $_POST['kebutuhan_khusus']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $status_keluarga = mysqli_real_escape_string($koneksi, $_POST['status_keluarga']);
    $nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $nik_ayah = mysqli_real_escape_string($koneksi, $_POST['nik_ayah']);
    $pendidikan_ayah = mysqli_real_escape_string($koneksi, $_POST['pendidikan_ayah']);
    $pekerjaan_ayah = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
    $nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $nik_ibu = mysqli_real_escape_string($koneksi, $_POST['nik_ibu']);
    $pendidikan_ibu = mysqli_real_escape_string($koneksi, $_POST['pendidikan_ibu']);
    $pekerjaan_ibu = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
    $no_kip_kks_kis = mysqli_real_escape_string($koneksi, $_POST['no_kip_kks_kis']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $tahun = date('Y');
        $nama_bersih = preg_replace('/[^A-Za-z0-9_]/', '_', $nama_lengkap);
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $nama_file_baru = $nama_bersih . '_' . $tahun . '.' . $ext;
        $folder_tujuan = __DIR__ . '/../img/siswa/';
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            $foto = 'siswa/' . $nama_file_baru;
        } else {
            $foto = '';
        }
    }
    $query = mysqli_query($koneksi, "INSERT INTO tb_data_siswa (nama_lengkap, jenis_kelamin, nomor_induk_siswa, nomor_induk_siswa_nasional, nik, tempat_lahir, tanggal_lahir, sekolah_asal, no_ijazah_sebelumnya, no_skhun_sebelumnya, tanggal_masuk, status_siswa, kelas, agama, kebutuhan_khusus, alamat, no_hp, email, status_keluarga, nama_ayah, nik_ayah, pendidikan_ayah, pekerjaan_ayah, nama_ibu, nik_ibu, pendidikan_ibu, pekerjaan_ibu, no_kip_kks_kis, foto) VALUES ('$nama_lengkap', '$jenis_kelamin', '$nomor_induk_siswa', '$nomor_induk_siswa_nasional', '$nik', '$tempat_lahir', '$tanggal_lahir', '$sekolah_asal', '$no_ijazah_sebelumnya', '$no_skhun_sebelumnya', '$tanggal_masuk', '$status_siswa', '$kelas', '$agama', '$kebutuhan_khusus', '$alamat', '$no_hp', '$email', '$status_keluarga', '$nama_ayah', '$nik_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$nama_ibu', '$nik_ibu', '$pendidikan_ibu', '$pekerjaan_ibu', '$no_kip_kks_kis', '$foto')");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data siswa berhasil ditambahkan.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-siswa">';
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menambah siswa. Silakan coba lagi.</div>';
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Tambah Data Siswa</h2>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIS</label>
                <input type="text" class="form-control" name="nomor_induk_siswa" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NISN</label>
                <input type="text" class="form-control" name="nomor_induk_siswa_nasional" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sekolah Asal</label>
                <input type="text" class="form-control" name="sekolah_asal">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No Ijazah Sebelumnya</label>
                <input type="text" class="form-control" name="no_ijazah_sebelumnya">
            </div>
            <div class="col-md-6">
                <label class="form-label">No SKHUN Sebelumnya</label>
                <input type="text" class="form-control" name="no_skhun_sebelumnya">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal_masuk">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status Siswa</label>
                <input type="text" class="form-control" name="status_siswa">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Kelas</label>
                <input type="text" class="form-control" name="kelas">
            </div>
            <div class="col-md-6">
                <label class="form-label">Agama</label>
                <input type="text" class="form-control" name="agama">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Kebutuhan Khusus</label>
                <input type="text" class="form-control" name="kebutuhan_khusus">
            </div>
            <div class="col-md-6">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No HP</label>
                <input type="text" class="form-control" name="no_hp">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Status Keluarga</label>
                <input type="text" class="form-control" name="status_keluarga">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" name="nama_ayah">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIK Ayah</label>
                <input type="text" class="form-control" name="nik_ayah">
            </div>
            <div class="col-md-6">
                <label class="form-label">Pendidikan Ayah</label>
                <input type="text" class="form-control" name="pendidikan_ayah">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Pekerjaan Ayah</label>
                <input type="text" class="form-control" name="pekerjaan_ayah">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" name="nama_ibu">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIK Ibu</label>
                <input type="text" class="form-control" name="nik_ibu">
            </div>
            <div class="col-md-6">
                <label class="form-label">Pendidikan Ibu</label>
                <input type="text" class="form-control" name="pendidikan_ibu">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Pekerjaan Ibu</label>
                <input type="text" class="form-control" name="pekerjaan_ibu">
            </div>
            <div class="col-md-6">
                <label class="form-label">No KIP/KKS/KIS</label>
                <input type="text" class="form-control" name="no_kip_kks_kis">
            </div>
        </div>
        <div class="row mb-3">
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

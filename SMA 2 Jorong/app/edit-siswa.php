
<?php
include '../auth/koneksi.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM tb_data_siswa WHERE id = $id");
    $siswa = mysqli_fetch_assoc($query);
    if (!$siswa) {
        echo '<div class="alert alert-danger mt-3">Data siswa tidak ditemukan.</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger mt-3">ID siswa tidak ditemukan.</div>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
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
    $foto = $siswa['foto'];
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
        }
    }
    $query = mysqli_query($koneksi, "UPDATE tb_data_siswa SET nama_lengkap='$nama_lengkap', jenis_kelamin='$jenis_kelamin', nomor_induk_siswa='$nomor_induk_siswa', nomor_induk_siswa_nasional='$nomor_induk_siswa_nasional', nik='$nik', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', sekolah_asal='$sekolah_asal', no_ijazah_sebelumnya='$no_ijazah_sebelumnya', no_skhun_sebelumnya='$no_skhun_sebelumnya', tanggal_masuk='$tanggal_masuk', status_siswa='$status_siswa', kelas='$kelas', agama='$agama', kebutuhan_khusus='$kebutuhan_khusus', alamat='$alamat', no_hp='$no_hp', email='$email', status_keluarga='$status_keluarga', nama_ayah='$nama_ayah', nik_ayah='$nik_ayah', pendidikan_ayah='$pendidikan_ayah', pekerjaan_ayah='$pekerjaan_ayah', nama_ibu='$nama_ibu', nik_ibu='$nik_ibu', pendidikan_ibu='$pendidikan_ibu', pekerjaan_ibu='$pekerjaan_ibu', no_kip_kks_kis='$no_kip_kks_kis', foto='$foto' WHERE id=$id");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data siswa berhasil diupdate.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-siswa">';
        exit;
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal mengupdate siswa. Silakan coba lagi.</div>';
    }
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Edit Data Siswa</h2>
<div class="container">
            <form method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?php echo htmlspecialchars($siswa['nama_lengkap']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jenis_kelamin" value="<?php echo htmlspecialchars($siswa['jenis_kelamin']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" name="nomor_induk_siswa" value="<?php echo htmlspecialchars($siswa['nomor_induk_siswa']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NISN</label>
                        <input type="text" class="form-control" name="nomor_induk_siswa_nasional" value="<?php echo htmlspecialchars($siswa['nomor_induk_siswa_nasional']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" value="<?php echo htmlspecialchars($siswa['nik']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" value="<?php echo htmlspecialchars($siswa['tempat_lahir']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo htmlspecialchars($siswa['tanggal_lahir']); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sekolah Asal</label>
                        <input type="text" class="form-control" name="sekolah_asal" value="<?php echo htmlspecialchars($siswa['sekolah_asal']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">No Ijazah Sebelumnya</label>
                        <input type="text" class="form-control" name="no_ijazah_sebelumnya" value="<?php echo htmlspecialchars($siswa['no_ijazah_sebelumnya']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">No SKHUN Sebelumnya</label>
                        <input type="text" class="form-control" name="no_skhun_sebelumnya" value="<?php echo htmlspecialchars($siswa['no_skhun_sebelumnya']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo htmlspecialchars($siswa['tanggal_masuk']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status Siswa</label>
                        <input type="text" class="form-control" name="status_siswa" value="<?php echo htmlspecialchars($siswa['status_siswa']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="<?php echo htmlspecialchars($siswa['kelas']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Agama</label>
                        <input type="text" class="form-control" name="agama" value="<?php echo htmlspecialchars($siswa['agama']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kebutuhan Khusus</label>
                        <input type="text" class="form-control" name="kebutuhan_khusus" value="<?php echo htmlspecialchars($siswa['kebutuhan_khusus']); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($siswa['alamat']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">No HP</label>
                        <input type="text" class="form-control" name="no_hp" value="<?php echo htmlspecialchars($siswa['no_hp']); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($siswa['email']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status Keluarga</label>
                        <input type="text" class="form-control" name="status_keluarga" value="<?php echo htmlspecialchars($siswa['status_keluarga']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control" name="nama_ayah" value="<?php echo htmlspecialchars($siswa['nama_ayah']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIK Ayah</label>
                        <input type="text" class="form-control" name="nik_ayah" value="<?php echo htmlspecialchars($siswa['nik_ayah']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pendidikan Ayah</label>
                        <input type="text" class="form-control" name="pendidikan_ayah" value="<?php echo htmlspecialchars($siswa['pendidikan_ayah']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" name="pekerjaan_ayah" value="<?php echo htmlspecialchars($siswa['pekerjaan_ayah']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu" value="<?php echo htmlspecialchars($siswa['nama_ibu']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">NIK Ibu</label>
                        <input type="text" class="form-control" name="nik_ibu" value="<?php echo htmlspecialchars($siswa['nik_ibu']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pendidikan Ibu</label>
                        <input type="text" class="form-control" name="pendidikan_ibu" value="<?php echo htmlspecialchars($siswa['pendidikan_ibu']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" name="pekerjaan_ibu" value="<?php echo htmlspecialchars($siswa['pekerjaan_ibu']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">No KIP/KKS/KIS</label>
                        <input type="text" class="form-control" name="no_kip_kks_kis" value="<?php echo htmlspecialchars($siswa['no_kip_kks_kis']); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <?php if (!empty($siswa['foto'])) echo '<img src="../img/' . htmlspecialchars($siswa['foto']) . '" width="80" class="mt-2">'; ?>
                    </div>
                </div>
                <div class="mt-4 text-start">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="home.php?page=data-siswa" class="btn btn-secondary me-2">Kembali</a>
                </div>
                </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
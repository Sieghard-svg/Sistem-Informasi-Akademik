<?php
include '../auth/koneksi.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM tb_data_pegawai WHERE id = $id");
    $pegawai = mysqli_fetch_assoc($query);
    if (!$pegawai) {
        echo '<div class="alert alert-danger mt-3">Data pegawai tidak ditemukan.</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger mt-3">ID pegawai tidak ditemukan.</div>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $pangkat_golongan = mysqli_real_escape_string($koneksi, $_POST['pangkat_golongan']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $pendidikan = mysqli_real_escape_string($koneksi, $_POST['pendidikan']);
    $sertifikasi = mysqli_real_escape_string($koneksi, $_POST['sertifikasi']);
    $tempat = mysqli_real_escape_string($koneksi, $_POST['tempat']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $tmt_kerja = mysqli_real_escape_string($koneksi, $_POST['tmt_kerja']);
    $no_bpjs = mysqli_real_escape_string($koneksi, $_POST['no_bpjs']);
    $no_hp_wa = mysqli_real_escape_string($koneksi, $_POST['no_hp_wa']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $foto = $pegawai['foto'];
    $foto = $pegawai['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $tahun = date('Y');
        $nama_bersih = preg_replace('/[^A-Za-z0-9_]/', '_', $nama);
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $nama_file_baru = $nama_bersih . '_' . $tahun . '.' . $ext;
        $folder_tujuan = __DIR__ . '/../img/pegawai/';
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            $foto = 'pegawai/' . $nama_file_baru;
        }
        $folder_tujuan = __DIR__ . '/../img/pegawai/';
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            $foto = 'pegawai/' . $nama_file_baru;
        }
    }
    $query = mysqli_query($koneksi, "UPDATE tb_data_pegawai SET nama='$nama', nip='$nip', pangkat_golongan='$pangkat_golongan', jabatan='$jabatan', pendidikan='$pendidikan', sertifikasi='$sertifikasi', tempat='$tempat', tanggal_lahir='$tanggal_lahir', nik='$nik', tmt_kerja='$tmt_kerja', no_bpjs='$no_bpjs', no_hp_wa='$no_hp_wa', jenis_kelamin='$jenis_kelamin', foto='$foto' WHERE id=$id");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data pegawai berhasil diupdate.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-pegawai">';
        exit;
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal mengupdate pegawai. Silakan coba lagi.</div>';
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Edit Data Pegawai</h2>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama"
                    value="<?php echo htmlspecialchars($pegawai['nama']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip"
                    value="<?php echo htmlspecialchars($pegawai['nip']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Pangkat/Golongan</label>
                <input type="text" class="form-control" name="pangkat_golongan"
                    value="<?php echo htmlspecialchars($pegawai['pangkat_golongan']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan"
                    value="<?php echo htmlspecialchars($pegawai['jabatan']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Pendidikan</label>
                <input type="text" class="form-control" name="pendidikan"
                    value="<?php echo htmlspecialchars($pegawai['pendidikan']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sertifikasi</label>
                <input type="text" class="form-control" name="sertifikasi"
                    value="<?php echo htmlspecialchars($pegawai['sertifikasi']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat"
                    value="<?php echo htmlspecialchars($pegawai['tempat']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir"
                    value="<?php echo htmlspecialchars($pegawai['tanggal_lahir']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik"
                    value="<?php echo htmlspecialchars($pegawai['nik']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">TMT Kerja</label>
                <input type="date" class="form-control" name="tmt_kerja"
                    value="<?php echo htmlspecialchars($pegawai['tmt_kerja']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No BPJS</label>
                <input type="text" class="form-control" name="no_bpjs"
                    value="<?php echo htmlspecialchars($pegawai['no_bpjs']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No HP/WA</label>
                <input type="text" class="form-control" name="no_hp_wa"
                    value="<?php echo htmlspecialchars($pegawai['no_hp_wa']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki" <?php if ($pegawai['jenis_kelamin'] == 'Laki-laki')
                        echo 'selected'; ?>>
                        Laki-laki</option>
                    <option value="Perempuan" <?php if ($pegawai['jenis_kelamin'] == 'Perempuan')
                        echo 'selected'; ?>>
                        Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" accept="image/*">
                <?php if ($pegawai['foto'])
                    echo '<img src="../img/' . htmlspecialchars($pegawai['foto']) . '" width="80" class="mt-2">'; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="home.php?page=data-pegawai" class="btn btn-secondary" style="margin-left:10px;">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
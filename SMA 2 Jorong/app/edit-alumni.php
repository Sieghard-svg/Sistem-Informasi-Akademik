<?php
include '../auth/koneksi.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM tb_data_alumni WHERE id = $id");
    $alumni = mysqli_fetch_assoc($query);
    if (!$alumni) {
        echo '<div class="alert alert-danger mt-3">Data alumni tidak ditemukan.</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger mt-3">ID alumni tidak ditemukan.</div>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $foto = $alumni['foto'];
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
        }
    }
    $query = mysqli_query($koneksi, "UPDATE tb_data_alumni SET tahun_lulus='$tahun_lulus', nama='$nama', tempat='$tempat', tanggal_lahir='$tanggal_lahir', nama_orang_tua='$nama_orang_tua', no_induk_siswa='$no_induk_siswa', no_induk_siswa_nasional='$no_induk_siswa_nasional', no_ujian_nasional='$no_ujian_nasional', no_ijazah='$no_ijazah', jenis_kelamin='$jenis_kelamin', foto='$foto' WHERE id=$id");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data alumni berhasil diupdate.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-alumni">';
        exit;
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal mengupdate alumni. Silakan coba lagi.</div>';
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Edit Data Alumni</h2>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama"
                    value="<?php echo htmlspecialchars($alumni['nama']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tahun Lulus</label>
                <input type="text" class="form-control" name="tahun_lulus"
                    value="<?php echo htmlspecialchars($alumni['tahun_lulus']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat"
                    value="<?php echo htmlspecialchars($alumni['tempat']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir"
                    value="<?php echo htmlspecialchars($alumni['tanggal_lahir']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Orang Tua</label>
                <input type="text" class="form-control" name="nama_orang_tua"
                    value="<?php echo htmlspecialchars($alumni['nama_orang_tua']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No Induk Siswa</label>
                <input type="text" class="form-control" name="no_induk_siswa"
                    value="<?php echo htmlspecialchars($alumni['no_induk_siswa']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No Induk Siswa Nasional</label>
                <input type="text" class="form-control" name="no_induk_siswa_nasional"
                    value="<?php echo htmlspecialchars($alumni['no_induk_siswa_nasional']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No Ujian Nasional</label>
                <input type="text" class="form-control" name="no_ujian_nasional"
                    value="<?php echo htmlspecialchars($alumni['no_ujian_nasional']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">No Ijazah</label>
                <input type="text" class="form-control" name="no_ijazah"
                    value="<?php echo htmlspecialchars($alumni['no_ijazah']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki" <?php if ($alumni['jenis_kelamin'] == 'Laki-laki')
                        echo 'selected'; ?>>
                        Laki-laki</option>
                    <option value="Perempuan" <?php if ($alumni['jenis_kelamin'] == 'Perempuan')
                        echo 'selected'; ?>>
                        Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" accept="image/*">
                <?php if ($alumni['foto'])
                    echo '<img src="../img/' . htmlspecialchars($alumni['foto']) . '" width="80" class="mt-2">'; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="home.php?page=data-alumni" class="btn btn-secondary" style="margin-left:10px;">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
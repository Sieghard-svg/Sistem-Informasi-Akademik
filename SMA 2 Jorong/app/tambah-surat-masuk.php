<?php
include '../auth/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_surat = mysqli_real_escape_string($koneksi, $_POST['jenis_surat']);
    $nomor_surat = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
    $tanggal_surat = mysqli_real_escape_string($koneksi, $_POST['tanggal_surat']);
    $pengirim = mysqli_real_escape_string($koneksi, $_POST['pengirim']);
    $perihal = mysqli_real_escape_string($koneksi, $_POST['perihal']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $pangkat_golongan = mysqli_real_escape_string($koneksi, $_POST['pangkat_golongan']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $untuk_kegiatan = mysqli_real_escape_string($koneksi, $_POST['untuk_kegiatan']);
    $tanggal_kegiatan = mysqli_real_escape_string($koneksi, $_POST['tanggal_kegiatan']);
    $tempat_kegiatan = mysqli_real_escape_string($koneksi, $_POST['tempat_kegiatan']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $file_surat = '';
    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
        $tahun = date('Y');
        $perihal_bersih = preg_replace('/[^A-Za-z0-9_]/', '_', $perihal);
        $ext = strtolower(pathinfo($_FILES['file_surat']['name'], PATHINFO_EXTENSION));
        $nama_file_baru = $perihal_bersih . '_' . $tahun . '.' . $ext;
        $folder_tujuan = __DIR__ . '/../img/surat masuk/';
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        if (move_uploaded_file($_FILES['file_surat']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            $file_surat = 'surat masuk/' . $nama_file_baru;
        } else {
            $file_surat = '';
        }
    }
    $query = mysqli_query($koneksi, "INSERT INTO tb_surat_masuk (jenis_surat, nomor_surat, tanggal_surat, pengirim, perihal, nama, nip, pangkat_golongan, jabatan, untuk_kegiatan, tanggal_kegiatan, tempat_kegiatan, keterangan, file_surat) VALUES ('$jenis_surat', '$nomor_surat', '$tanggal_surat', '$pengirim', '$perihal', '$nama', '$nip', '$pangkat_golongan', '$jabatan', '$untuk_kegiatan', '$tanggal_kegiatan', '$tempat_kegiatan', '$keterangan', '$file_surat')");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data surat masuk berhasil ditambahkan.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-surat-masuk">';
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menambah surat masuk. Silakan coba lagi.</div>';
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Tambah Data Surat Masuk</h2>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jenis Surat</label>
                <input type="text" class="form-control" name="jenis_surat" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Surat</label>
                <input type="text" class="form-control" name="nomor_surat" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" name="tanggal_surat" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pengirim</label>
                <input type="text" class="form-control" name="pengirim" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Perihal</label>
                <input type="text" class="form-control" name="perihal" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pangkat/Golongan</label>
                <input type="text" class="form-control" name="pangkat_golongan" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Untuk Kegiatan</label>
                <input type="text" class="form-control" name="untuk_kegiatan" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Kegiatan</label>
                <input type="date" class="form-control" name="tanggal_kegiatan" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat Kegiatan</label>
                <input type="text" class="form-control" name="tempat_kegiatan" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" required></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">Upload File Surat (PDF/DOC/DOCX)</label>
                <input type="file" class="form-control" name="file_surat" accept=".pdf,.doc,.docx">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
<?php
// Form edit surat masuk
include '../auth/koneksi.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM tb_surat_masuk WHERE id_surat_masuk = $id");
    $data = mysqli_fetch_assoc($query);
    if (!$data) {
        echo '<div class="alert alert-danger mt-3">Data surat masuk tidak ditemukan.</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger mt-3">ID surat masuk tidak ditemukan.</div>';
    exit;
}
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
    $file_surat = $data['file_surat'];
    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
        $tahun = date('Y');
        $nama_bersih = preg_replace('/[^A-Za-z0-9_]/', '_', $nomor_surat);
        $ext = strtolower(pathinfo($_FILES['file_surat']['name'], PATHINFO_EXTENSION));
        $nama_file_baru = $nama_bersih . '_' . $tahun . '.' . $ext;
        $folder_tujuan = __DIR__ . '/../img/surat masuk/';
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        if (move_uploaded_file($_FILES['file_surat']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            $file_surat = 'surat masuk/' . $nama_file_baru;
        }
    }
    $query = mysqli_query($koneksi, "UPDATE tb_surat_masuk SET jenis_surat='$jenis_surat', nomor_surat='$nomor_surat', tanggal_surat='$tanggal_surat', pengirim='$pengirim', perihal='$perihal', nama='$nama', nip='$nip', pangkat_golongan='$pangkat_golongan', jabatan='$jabatan', untuk_kegiatan='$untuk_kegiatan', tanggal_kegiatan='$tanggal_kegiatan', tempat_kegiatan='$tempat_kegiatan', keterangan='$keterangan', file_surat='$file_surat' WHERE id_surat_masuk=$id");
    if ($query) {
        echo '<div class="alert alert-success mt-3">Data surat masuk berhasil diupdate.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-surat-masuk">';
        exit;
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal mengupdate surat masuk. Silakan coba lagi.</div>';
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<h2 class="text-center my-4">Edit Data Surat Masuk</h2>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jenis Surat</label>
                <input type="text" class="form-control" name="jenis_surat"
                    value="<?php echo htmlspecialchars($data['jenis_surat']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Surat</label>
                <input type="text" class="form-control" name="nomor_surat"
                    value="<?php echo htmlspecialchars($data['nomor_surat']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" name="tanggal_surat"
                    value="<?php echo htmlspecialchars($data['tanggal_surat']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pengirim</label>
                <input type="text" class="form-control" name="pengirim"
                    value="<?php echo htmlspecialchars($data['pengirim']); ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Perihal</label>
                <input type="text" class="form-control" name="perihal"
                    value="<?php echo htmlspecialchars($data['perihal']); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama"
                    value="<?php echo htmlspecialchars($data['nama']); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip"
                    value="<?php echo htmlspecialchars($data['nip']); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Pangkat/Golongan</label>
                <input type="text" class="form-control" name="pangkat_golongan"
                    value="<?php echo htmlspecialchars($data['pangkat_golongan']); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan"
                    value="<?php echo htmlspecialchars($data['jabatan']); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Untuk Kegiatan</label>
                <input type="text" class="form-control" name="untuk_kegiatan"
                    value="<?php echo htmlspecialchars($data['untuk_kegiatan']); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Kegiatan</label>
                <input type="date" class="form-control" name="tanggal_kegiatan"
                    value="<?php echo htmlspecialchars($data['tanggal_kegiatan']); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat Kegiatan</label>
                <input type="text" class="form-control" name="tempat_kegiatan"
                    value="<?php echo htmlspecialchars($data['tempat_kegiatan']); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control"
                    name="keterangan"><?php echo htmlspecialchars($data['keterangan']); ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">Upload File Surat (PDF/DOC/DOCX)</label>
                <?php if (!empty($data['file_surat'])): ?>
                    <div class="mb-2">
                        <a href="../file/surat-masuk/<?php echo htmlspecialchars($data['file_surat']); ?>" target="_blank"
                            class="btn btn-sm btn-success">Lihat File Lama</a>
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" name="file_surat" accept=".pdf,.doc,.docx">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="home.php?page=data-surat-masuk" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
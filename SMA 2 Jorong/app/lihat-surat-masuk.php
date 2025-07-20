<?php
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
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Detail Surat Masuk</h2>
    <div class="card mx-auto" style="max-width: 700px;">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Jenis Surat</th>
                    <td><?php echo htmlspecialchars($data['jenis_surat']); ?></td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td><?php echo htmlspecialchars($data['nomor_surat']); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Surat</th>
                    <td><?php echo htmlspecialchars($data['tanggal_surat']); ?></td>
                </tr>
                <tr>
                    <th>Pengirim</th>
                    <td><?php echo htmlspecialchars($data['pengirim']); ?></td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td><?php echo htmlspecialchars($data['perihal']); ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td><?php echo htmlspecialchars($data['nip']); ?></td>
                </tr>
                <tr>
                    <th>Pangkat/Golongan</th>
                    <td><?php echo htmlspecialchars($data['pangkat_golongan']); ?></td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td><?php echo htmlspecialchars($data['jabatan']); ?></td>
                </tr>
                <tr>
                    <th>Untuk Kegiatan</th>
                    <td><?php echo htmlspecialchars($data['untuk_kegiatan']); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Kegiatan</th>
                    <td><?php echo htmlspecialchars($data['tanggal_kegiatan']); ?></td>
                </tr>
                <tr>
                    <th>Tempat Kegiatan</th>
                    <td><?php echo htmlspecialchars($data['tempat_kegiatan']); ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td><?php echo htmlspecialchars($data['keterangan']); ?></td>
                </tr>
                <tr>
                    <th>File Surat</th>
                    <td>
                        <?php if (!empty($data['file_surat'])): ?>
                            <a href="../file/surat-masuk/<?php echo htmlspecialchars($data['file_surat']); ?>"
                                target="_blank" class="btn btn-sm btn-success">Lihat File</a>
                        <?php else: ?>
                            <span class="text-danger">Tidak ada file</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <div class="text-center mt-3">
                <a href="home.php?page=data-surat-masuk" class="btn btn-secondary">Kembali ke Data Surat Masuk</a>
            </div>
        </div>
    </div>
</div>
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
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Detail Siswa</h2>
    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <table class="table table-bordered mb-0">
                        <tr><th>Nama Lengkap</th><td><?php echo htmlspecialchars($siswa['nama_lengkap']); ?></td></tr>
                        <tr><th>Jenis Kelamin</th><td><?php echo htmlspecialchars($siswa['jenis_kelamin']); ?></td></tr>
                        <tr><th>NIS</th><td><?php echo htmlspecialchars($siswa['nomor_induk_siswa']); ?></td></tr>
                        <tr><th>NISN</th><td><?php echo htmlspecialchars($siswa['nomor_induk_siswa_nasional']); ?></td></tr>
                        <tr><th>NIK</th><td><?php echo htmlspecialchars($siswa['nik']); ?></td></tr>
                        <tr><th>Tempat Lahir</th><td><?php echo htmlspecialchars($siswa['tempat_lahir']); ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td><?php echo htmlspecialchars($siswa['tanggal_lahir']); ?></td></tr>
                        <tr><th>Sekolah Asal</th><td><?php echo htmlspecialchars($siswa['sekolah_asal']); ?></td></tr>
                        <tr><th>No Ijazah Sebelumnya</th><td><?php echo htmlspecialchars($siswa['no_ijazah_sebelumnya']); ?></td></tr>
                        <tr><th>No SKHUN Sebelumnya</th><td><?php echo htmlspecialchars($siswa['no_skhun_sebelumnya']); ?></td></tr>
                        <tr><th>Tanggal Masuk</th><td><?php echo htmlspecialchars($siswa['tanggal_masuk']); ?></td></tr>
                        <tr><th>Status Siswa</th><td><?php echo htmlspecialchars($siswa['status_siswa']); ?></td></tr>
                        <tr><th>Kelas</th><td><?php echo htmlspecialchars($siswa['kelas']); ?></td></tr>
                        <tr><th>Agama</th><td><?php echo htmlspecialchars($siswa['agama']); ?></td></tr>
                        <tr><th>Kebutuhan Khusus</th><td><?php echo htmlspecialchars($siswa['kebutuhan_khusus']); ?></td></tr>
                        <tr><th>Alamat</th><td><?php echo htmlspecialchars($siswa['alamat']); ?></td></tr>
                        <tr><th>No HP</th><td><?php echo htmlspecialchars($siswa['no_hp']); ?></td></tr>
                        <tr><th>Email</th><td><?php echo htmlspecialchars($siswa['email']); ?></td></tr>
                        <tr><th>Status Keluarga</th><td><?php echo htmlspecialchars($siswa['status_keluarga']); ?></td></tr>
                        <tr><th>Nama Ayah</th><td><?php echo htmlspecialchars($siswa['nama_ayah']); ?></td></tr>
                        <tr><th>NIK Ayah</th><td><?php echo htmlspecialchars($siswa['nik_ayah']); ?></td></tr>
                        <tr><th>Pendidikan Ayah</th><td><?php echo htmlspecialchars($siswa['pendidikan_ayah']); ?></td></tr>
                        <tr><th>Pekerjaan Ayah</th><td><?php echo htmlspecialchars($siswa['pekerjaan_ayah']); ?></td></tr>
                        <tr><th>Nama Ibu</th><td><?php echo htmlspecialchars($siswa['nama_ibu']); ?></td></tr>
                        <tr><th>NIK Ibu</th><td><?php echo htmlspecialchars($siswa['nik_ibu']); ?></td></tr>
                        <tr><th>Pendidikan Ibu</th><td><?php echo htmlspecialchars($siswa['pendidikan_ibu']); ?></td></tr>
                        <tr><th>Pekerjaan Ibu</th><td><?php echo htmlspecialchars($siswa['pekerjaan_ibu']); ?></td></tr>
                        <tr><th>No KIP/KKS/KIS</th><td><?php echo htmlspecialchars($siswa['no_kip_kks_kis']); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <?php if (!empty($siswa['foto'])): ?>
                        <img src="../img/<?php echo htmlspecialchars($siswa['foto']); ?>" class="img-thumbnail mb-2" style="max-width:150px;">
                    <?php else: ?>
                        <span class="text-muted">Tidak ada foto</span>
                    <?php endif; ?>
                </div>
            </div>
            <a href="home.php?page=data-siswa" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

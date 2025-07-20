<?php
include '../auth/koneksi.php';

// Pagination setup
$per_page = 10;
$page = isset($_GET['hal']) ? (int) $_GET['hal'] : 1;
$start = ($page - 1) * $per_page;

// Proses pencarian
$where = '';
if (isset($_GET['cari']) && $_GET['cari'] != '') {
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $where = "WHERE nomor_surat LIKE '%$cari%' OR tujuan_surat LIKE '%$cari%' OR perihal LIKE '%$cari%'";
}
// Hitung total data
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_surat_keluar $where");
$total_row = mysqli_fetch_assoc($total_query);
$total_data = $total_row['total'];
$total_page = ceil($total_data / $per_page);

// Query data dengan limit
$query = mysqli_query($koneksi, "SELECT * FROM tb_surat_keluar $where LIMIT $start, $per_page");
$data_surat_keluar = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<center>
    <h2>Data Surat Keluar</h2>
</center>
<a href="home.php?page=tambah-surat-keluar" class="btn btn-success mb-3"
    style="margin-bottom: 15px; display: inline-block;">Tambah Data</a>
<form method="get" action="home.php" class="mb-3" style="display: flex; gap: 8px;">
    <input type="hidden" name="page" value="data-surat-keluar">
    <input type="text" name="cari" class="form-control" placeholder="Cari nomor surat, tujuan, perihal..."
        value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
    <button type="submit" class="btn btn-info">Cari</button>
    <a href="home.php?page=data-surat-keluar" class="btn btn-secondary">Reset</a>
    <a href="export-surat-keluar.php" class="btn btn-success">Export Excel</a>
    <a href="home.php?page=import-surat-keluar" class="btn btn-warning">Import Excel</a>
</form>
<div class="table-responsive">
    <table class="table table-bordered" width="100%" style="border-collapse: collapse;">
        <thead class="bg-info text-black text-center">
            <tr>
                <th>No</th>
                <th>Jenis Surat</th>
                <th>Nomor Surat</th>
                <th>Tanggal Keluar</th>
                <th>Perihal</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Pangkat/Golongan</th>
                <th>Jabatan</th>
                <th>Untuk Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Tempat Kegiatan</th>
                <th>Tujuan Surat</th>
                <th>Dasar Surat</th>
                <th>Dasar Nomor Surat</th>
                <th>Tanggal Dasar Surat</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = $start + 1;
            foreach ($data_surat_keluar as $result):
                ?>
                <tr style="text-align: center;">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $result['jenis_surat']; ?></td>
                    <td><?php echo $result['nomor_surat']; ?></td>
                    <td><?php echo $result['tanggal_keluar']; ?></td>
                    <td><?php echo $result['perihal']; ?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['nip']; ?></td>
                    <td><?php echo $result['pangkat_golongan']; ?></td>
                    <td><?php echo $result['jabatan']; ?></td>
                    <td><?php echo $result['untuk_kegiatan']; ?></td>
                    <td><?php echo $result['tanggal_kegiatan']; ?></td>
                    <td><?php echo $result['tempat_kegiatan']; ?></td>
                    <td><?php echo $result['tujuan_surat']; ?></td>
                    <td><?php echo $result['dasar_surat']; ?></td>
                    <td><?php echo $result['dasar_nomor_surat']; ?></td>
                    <td><?php echo $result['tanggal_dasar_surat']; ?></td>
                    <td><?php echo $result['keterangan']; ?></td>
                    <td>
                        <a href="home.php?page=lihat-surat-keluar&id=<?php echo $result['id_surat_keluar']; ?>"
                            class="btn btn-sm btn-info">Lihat</a>
                        <a href="home.php?page=edit-surat-keluar&id=<?php echo $result['id_surat_keluar']; ?>"
                            class="btn btn-sm btn-primary">Edit</a>
                        <a href="home.php?page=hapus-surat-keluar&id=<?php echo $result['id_surat_keluar']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item"><a class="page-link"
                    href="home.php?page=data-surat-keluar&hal=<?php echo $page - 1; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>">&laquo;
                    Prev</a></li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php if ($i == $page)
                echo 'active'; ?>">
                <a class="page-link"
                    href="home.php?page=data-surat-keluar&hal=<?php echo $i; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($page < $total_page): ?>
            <li class="page-item"><a class="page-link"
                    href="home.php?page=data-surat-keluar&hal=<?php echo $page + 1; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>">Next
                    &raquo;</a></li>
        <?php endif; ?>
    </ul>
</nav>
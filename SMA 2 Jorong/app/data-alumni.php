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
    $where = "WHERE nama LIKE '%$cari%' OR tahun_lulus LIKE '%$cari%' OR no_induk_siswa LIKE '%$cari%'";
}
// Hitung total data
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_data_alumni $where");
$total_row = mysqli_fetch_assoc($total_query);
$total_data = $total_row['total'];
$total_page = ceil($total_data / $per_page);

// Query data dengan limit
$query = mysqli_query($koneksi, "SELECT * FROM tb_data_alumni $where LIMIT $start, $per_page");
$data_alumni = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<center>
    <h2>Data Alumni</h2>
</center>
<a href="home.php?page=tambah-alumni" class="btn btn-success mb-3"
    style="margin-bottom: 15px; display: inline-block;">Tambah
    Data</a>
<form method="get" action="home.php" class="mb-3" style="display: flex; gap: 8px;">
    <input type="hidden" name="page" value="data-alumni">
    <input type="text" name="cari" class="form-control" placeholder="Cari nama, tahun lulus, NIS..."
        value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
    <button type="submit" class="btn btn-info">Cari</button>
    <a href="home.php?page=data-alumni" class="btn btn-secondary">Reset</a>
    <a href="export-alumni.php" class="btn btn-success">Export Excel</a>
    <a href="home.php?page=import-alumni" class="btn btn-warning">Import Excel</a>
</form>
<div class="table-responsive">
    <table class="table table-bordered" width="100%" style="border-collapse: collapse;">
        <thead class="bg-info text-black text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tahun Lulus</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Nama Orang Tua</th>
                <th>No Induk Siswa</th>
                <th>No Induk Siswa Nasional</th>
                <th>No Ujian Nasional</th>
                <th>No Ijazah</th>
                <th>Jenis Kelamin</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = $start + 1;
            foreach ($data_alumni as $result):
                ?>
                <tr style="text-align: center;">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['tahun_lulus']; ?></td>
                    <td><?php echo $result['tempat']; ?></td>
                    <td><?php echo $result['tanggal_lahir']; ?></td>
                    <td><?php echo $result['nama_orang_tua']; ?></td>
                    <td><?php echo $result['no_induk_siswa']; ?></td>
                    <td><?php echo $result['no_induk_siswa_nasional']; ?></td>
                    <td><?php echo $result['no_ujian_nasional']; ?></td>
                    <td><?php echo $result['no_ijazah']; ?></td>
                    <td><?php echo !empty($result['jenis_kelamin']) ? htmlspecialchars($result['jenis_kelamin']) : '<span class="text-danger">(Belum diisi)</span>'; ?>
                    </td>
                    <td>
                        <?php
                        $foto = $result['foto'];
                        $foto_path = "../img/" . htmlspecialchars($foto);
                        if ($foto && file_exists($foto_path)) {
                            echo '<img src="' . $foto_path . '" width="60">';
                        } else {
                            echo '<img src="../img/default.png" width="60" title="Foto tidak tersedia">';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="home.php?page=lihat-alumni&id=<?php echo $result['id']; ?>"
                            class="btn btn-sm btn-info">Lihat</a>
                        <a href="home.php?page=edit-alumni&id=<?php echo $result['id']; ?>"
                            class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus-alumni.php?id=<?php echo $result['id']; ?>" class="btn btn-sm btn-danger"
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
                    href="home.php?page=data-alumni&hal=<?php echo $page - 1; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>">&laquo;
                    Prev</a></li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php if ($i == $page)
                echo 'active'; ?>">
                <a class="page-link"
                    href="home.php?page=data-alumni&hal=<?php echo $i; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($page < $total_page): ?>
            <li class="page-item"><a class="page-link"
                    href="home.php?page=data-alumni&hal=<?php echo $page + 1; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>">Next
                    &raquo;</a></li>
        <?php endif; ?>
    </ul>
</nav>
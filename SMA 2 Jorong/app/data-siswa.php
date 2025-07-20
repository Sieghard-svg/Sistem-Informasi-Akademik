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
    $where = "WHERE nama_lengkap LIKE '%$cari%' OR nomor_induk_siswa_nasional LIKE '%$cari%' OR kelas LIKE '%$cari%' OR status_siswa LIKE '%$cari%'";
}
// Hitung total data
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_data_siswa $where");
$total_row = mysqli_fetch_assoc($total_query);
$total_data = $total_row['total'];
$total_page = ceil($total_data / $per_page);

// Query data dengan limit
$query = mysqli_query($koneksi, "SELECT `id`, `nama_lengkap`, `jenis_kelamin`, `nomor_induk_siswa`, `nomor_induk_siswa_nasional`, `nik`, `tempat_lahir`, `tanggal_lahir`, `sekolah_asal`, `no_ijazah_sebelumnya`, `no_skhun_sebelumnya`, `tanggal_masuk`, `status_siswa`, `kelas`, `agama`, `kebutuhan_khusus`, `alamat`, `no_hp`, `email`, `status_keluarga`, `nama_ayah`, `nik_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `nama_ibu`, `nik_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `no_kip_kks_kis`, `foto` FROM `tb_data_siswa` $where LIMIT $start, $per_page");
$data_siswa = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<center>
    <h2>Data Siswa</h2>
</center>
<a href="home.php?page=tambah-siswa" class="btn btn-success mb-3"
    style="margin-bottom: 15px; display: inline-block;">Tambah Data</a>
<form method="get" action="home.php" class="mb-3" style="display: flex; gap: 8px;">
    <input type="hidden" name="page" value="data-siswa">
    <input type="text" name="cari" class="form-control" placeholder="Cari nama, NISN, kelas..."
        value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
    <button type="submit" class="btn btn-info">Cari</button>
    <a href="home.php?page=data-siswa" class="btn btn-secondary">Reset</a>
    <a href="export-siswa.php" class="btn btn-success">Export Excel</a>
    <a href="home.php?page=import-siswa" class="btn btn-warning">Import Excel</a>
</form>
<div class="table-responsive">
    <table class="table table-bordered" width="100%" style="border-collapse: collapse;">
        <thead class="bg-info text-black text-center">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Sekolah Asal</th>
                <th>No Ijazah Sebelumnya</th>
                <th>No SKHUN Sebelumnya</th>
                <th>Tanggal Masuk</th>
                <th>Status Siswa</th>
                <th>Kelas</th>
                <th>Agama</th>
                <th>Kebutuhan Khusus</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Status Keluarga</th>
                <th>Nama Ayah</th>
                <th>NIK Ayah</th>
                <th>Pendidikan Ayah</th>
                <th>Pekerjaan Ayah</th>
                <th>Nama Ibu</th>
                <th>NIK Ibu</th>
                <th>Pendidikan Ibu</th>
                <th>Pekerjaan Ibu</th>
                <th>No KIP/KKS/KIS</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = $start + 1;
            foreach ($data_siswa as $result):
                ?>
                <tr style="text-align: center;">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($result['nama_lengkap']); ?></td>
                    <td><?php echo htmlspecialchars($result['jenis_kelamin']); ?></td>
                    <td><?php echo htmlspecialchars($result['nomor_induk_siswa']); ?></td>
                    <td><?php echo htmlspecialchars($result['nomor_induk_siswa_nasional']); ?></td>
                    <td><?php echo htmlspecialchars($result['nik']); ?></td>
                    <td><?php echo htmlspecialchars($result['tempat_lahir']); ?></td>
                    <td><?php echo htmlspecialchars($result['tanggal_lahir']); ?></td>
                    <td><?php echo htmlspecialchars($result['sekolah_asal']); ?></td>
                    <td><?php echo htmlspecialchars($result['no_ijazah_sebelumnya']); ?></td>
                    <td><?php echo htmlspecialchars($result['no_skhun_sebelumnya']); ?></td>
                    <td><?php echo htmlspecialchars($result['tanggal_masuk']); ?></td>
                    <td><?php echo htmlspecialchars($result['status_siswa']); ?></td>
                    <td><?php echo htmlspecialchars($result['kelas']); ?></td>
                    <td><?php echo htmlspecialchars($result['agama']); ?></td>
                    <td><?php echo htmlspecialchars($result['kebutuhan_khusus']); ?></td>
                    <td><?php echo htmlspecialchars($result['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($result['no_hp']); ?></td>
                    <td><?php echo htmlspecialchars($result['email']); ?></td>
                    <td><?php echo htmlspecialchars($result['status_keluarga']); ?></td>
                    <td><?php echo htmlspecialchars($result['nama_ayah']); ?></td>
                    <td><?php echo htmlspecialchars($result['nik_ayah']); ?></td>
                    <td><?php echo htmlspecialchars($result['pendidikan_ayah']); ?></td>
                    <td><?php echo htmlspecialchars($result['pekerjaan_ayah']); ?></td>
                    <td><?php echo htmlspecialchars($result['nama_ibu']); ?></td>
                    <td><?php echo htmlspecialchars($result['nik_ibu']); ?></td>
                    <td><?php echo htmlspecialchars($result['pendidikan_ibu']); ?></td>
                    <td><?php echo htmlspecialchars($result['pekerjaan_ibu']); ?></td>
                    <td><?php echo htmlspecialchars($result['no_kip_kks_kis']); ?></td>
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
                        <a href="home.php?page=lihat-siswa&id=<?php echo $result['id']; ?>"
                            class="btn btn-sm btn-info">Lihat</a>
                        <a href="home.php?page=edit-siswa&id=<?php echo $result['id']; ?>"
                            class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus-siswa.php?id=<?php echo $result['id']; ?>" class="btn btn-sm btn-danger"
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
                    href="home.php?page=data-siswa&hal=<?php echo $page - 1; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>">&laquo;
                    Prev</a></li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php if ($i == $page)
                echo 'active'; ?>">
                <a class="page-link"
                    href="home.php?page=data-siswa&hal=<?php echo $i; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($page < $total_page): ?>
            <li class="page-item"><a class="page-link"
                    href="home.php?page=data-siswa&hal=<?php echo $page + 1; ?><?php echo isset($_GET['cari']) ? '&cari=' . urlencode($_GET['cari']) : ''; ?>">Next
                    &raquo;</a></li>
        <?php endif; ?>
    </ul>
</nav>
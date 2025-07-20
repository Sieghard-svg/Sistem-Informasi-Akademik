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
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Detail Alumni</h2>
    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo htmlspecialchars($alumni['nama']); ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Lulus</th>
                            <td><?php echo htmlspecialchars($alumni['tahun_lulus']); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td><?php echo htmlspecialchars($alumni['tempat']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?php echo htmlspecialchars($alumni['tanggal_lahir']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Orang Tua</th>
                            <td><?php echo htmlspecialchars($alumni['nama_orang_tua']); ?></td>
                        </tr>
                        <tr>
                            <th>No Induk Siswa</th>
                            <td><?php echo htmlspecialchars($alumni['no_induk_siswa']); ?></td>
                        </tr>
                        <tr>
                            <th>No Induk Siswa Nasional</th>
                            <td><?php echo htmlspecialchars($alumni['no_induk_siswa_nasional']); ?></td>
                        </tr>
                        <tr>
                            <th>No Ujian Nasional</th>
                            <td><?php echo htmlspecialchars($alumni['no_ujian_nasional']); ?></td>
                        </tr>
                        <tr>
                            <th>No Ijazah</th>
                            <td><?php echo htmlspecialchars($alumni['no_ijazah']); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?php echo htmlspecialchars($alumni['jenis_kelamin']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <?php
                    $foto = $alumni['foto'];
                    $foto_path = "../img/" . htmlspecialchars($foto);
                    if ($foto && file_exists($foto_path)) {
                        echo '<img src="' . $foto_path . '" width="400" class="rounded mb-2 img-fluid">';
                    } else {
                        echo '<img src="../img/default.png" width="400" class="rounded mb-2 img-fluid" title="Foto tidak tersedia">';
                    }
                    ?>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="home.php?page=data-alumni" class="btn btn-secondary">Kembali ke Data Alumni</a>
            </div>
        </div>
    </div>
</div>
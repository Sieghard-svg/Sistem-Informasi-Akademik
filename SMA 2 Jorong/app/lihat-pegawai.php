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
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />
<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Detail Pegawai</h2>
    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo htmlspecialchars($pegawai['nama']); ?></td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td><?php echo htmlspecialchars($pegawai['nip']); ?></td>
                        </tr>
                        <tr>
                            <th>Pangkat/Golongan</th>
                            <td><?php echo htmlspecialchars($pegawai['pangkat_golongan']); ?></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><?php echo htmlspecialchars($pegawai['jabatan']); ?></td>
                        </tr>
                        <tr>
                            <th>Pendidikan</th>
                            <td><?php echo htmlspecialchars($pegawai['pendidikan']); ?></td>
                        </tr>
                        <tr>
                            <th>Sertifikasi</th>
                            <td><?php echo htmlspecialchars($pegawai['sertifikasi']); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td><?php echo htmlspecialchars($pegawai['tempat']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?php echo htmlspecialchars($pegawai['tanggal_lahir']); ?></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td><?php echo htmlspecialchars($pegawai['nik']); ?></td>
                        </tr>
                        <tr>
                            <th>TMT Kerja</th>
                            <td><?php echo htmlspecialchars($pegawai['tmt_kerja']); ?></td>
                        </tr>
                        <tr>
                            <th>No BPJS</th>
                            <td><?php echo htmlspecialchars($pegawai['no_bpjs']); ?></td>
                        </tr>
                        <tr>
                            <th>No HP/WA</th>
                            <td><?php echo htmlspecialchars($pegawai['no_hp_wa']); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?php echo htmlspecialchars($pegawai['jenis_kelamin']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <?php
                    $foto = $pegawai['foto'];
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
                <a href="home.php?page=data-pegawai" class="btn btn-secondary">Kembali ke Data Pegawai</a>
            </div>
        </div>
    </div>
</div>
<?php
include '../auth/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM tb_admin");
$data_admin = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<center>
    <h2>Data Admin</h2>
</center>
<a href="home.php?page=tambah" class="btn btn-success mb-3" style="margin-bottom: 15px; display: inline-block;">Tambah
    Data</a>
<div class="table-responsive">
    <table class="table table-bordered" width="100%" style="border-collapse: collapse;">
        <thead class="bg-info text-black text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_admin as $result):
                ?>
                <tr style="text-align: center;">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td>
                        <a href="home.php?page=edit&id=<?php echo $result['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus-admin.php?id=<?php echo $result['id']; ?>&page=edit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
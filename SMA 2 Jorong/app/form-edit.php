<?php
include '../auth/koneksi.php';

// Ambil data admin berdasarkan id dari parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id = $id");
    $admin = mysqli_fetch_assoc($result);
}

// Proses update data admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'], $_POST['username'], $_POST['email'])) {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = !empty($_POST['password']) ? mysqli_real_escape_string($koneksi, $_POST['password']) : null;

    if ($password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($koneksi, "UPDATE tb_admin SET nama='$nama', username='$username', email='$email', password='$hashed_password' WHERE id=$id");
    } else {
        $query = mysqli_query($koneksi, "UPDATE tb_admin SET nama='$nama', username='$username', email='$email' WHERE id=$id");
    }

    if ($query) {
        echo '<div class="alert alert-success mt-3">Data admin berhasil diupdate.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php">';
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal mengupdate admin. Silakan coba lagi.</div>';
    }
}
?>

<!-- Bootstrap 4 & 5 CSS (choose one, not both for consistency) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />

<h2 class="text-center my-4">Edit Data Admin</h2>

<div class="container">
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($admin['id']) ? $admin['id'] : ''; ?>">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nama</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nama" name="nama"
                    value="<?php echo isset($admin['nama']) ? htmlspecialchars($admin['nama']) : ''; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Username</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Username" name="username"
                    value="<?php echo isset($admin['username']) ? htmlspecialchars($admin['username']) : ''; ?>"
                    required>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputAddress" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputAddress" placeholder="Email" name="email"
                value="<?php echo isset($admin['email']) ? htmlspecialchars($admin['email']) : ''; ?>" required>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" class="form-control" id="inputCity" placeholder="Password" name="password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="home.php?page=data-admin" class="btn btn-secondary" style="margin-left:10px;">Kembali</a>
    </form>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
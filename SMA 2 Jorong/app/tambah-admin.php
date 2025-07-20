<?php
include '../auth/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'], $_POST['username'], $_POST['email'], $_POST['password'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = mysqli_query($koneksi, "INSERT INTO tb_admin (nama, username, email, password) VALUES ('$nama', '$username', '$email', '$hashed_password')");

    if ($query) {
        echo '<div class="alert alert-success mt-3">Data admin berhasil ditambahkan.</div>';
        echo '<meta http-equiv="refresh" content="1;url=home.php?page=data-admin">';
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menambah admin. Silakan coba lagi.</div>';
    }
}
?>

<!-- Bootstrap 4 & 5 CSS (choose one, not both for consistency) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link href="../app/css/styles.css" rel="stylesheet" />

<h2 class="text-center my-4">Tambah Data Admin</h2>

<div class="container">
    <form action="" method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nama</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nama" name="nama" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Username</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Username" name="username"
                    required>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputAddress" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputAddress" placeholder="Email" name="email" required>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputCity" placeholder="Password" name="password"
                    required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../app/js/scripts.js"></script>
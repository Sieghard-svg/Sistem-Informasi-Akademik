<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../img/SMA 2 Jorong.png">
    <title>Data Admin</title>
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="../app/css/styles.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper" style="position:relative; min-height:100vh;">
            <div class="sidebar-heading border-bottom bg-light text-center" style="font-weight: bold;">
                <img src="../img/SMA 2 Jorong.png" alt="Logo" width="80" class="img-fluid mb-2 d-block mx-auto">
                <div>SMA Negeri 2 Jorong</div>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=dashboard">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=data-pegawai">Data Pegawai</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=data-siswa">Data Siswa</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=data-alumni">Data Alumni</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=data-surat-keluar">Surat Keluar</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=data-surat-masuk">Surat Masuk</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="home.php?page=data-admin">Data Admin</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="../index.php">Logout</a>
            </div>
            <div class="text-center sidebar-copyright"
                style="position:absolute; left:0; bottom:0; width:100%; font-size:0.9em; color:#888; padding-bottom:10px;">
                &copy; <?php echo date('Y'); ?> Sulton Fatah
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Page content-->
            <div class="container-fluid">
                <?php
                if (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
                    include "dashboard.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'data-pegawai') {
                    include "data-pegawai.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'data-siswa') {
                    include "data-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'tambah-siswa') {
                    include "tambah-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'edit-siswa') {
                    include "edit-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'hapus-siswa') {
                    include "hapus-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'import-siswa') {
                    include "import-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'lihat-siswa') {
                    include "lihat-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'export-siswa') {
                    include "export-siswa.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'data-alumni') {
                    include "data-alumni.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'tambah-alumni') {
                    include "tambah-alumni.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'edit-alumni') {
                    include "edit-alumni.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'hapus-alumni') {
                    include "hapus-alumni.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'data-surat-masuk') {
                    include "data-surat-masuk.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'data-surat-keluar') {
                    include "data-surat-keluar.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'tambah-pegawai') {
                    include "tambah-pegawai.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'tambah-surat-masuk') {
                    include "tambah-surat-masuk.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'tambah-surat-keluar') {
                    include "tambah-surat-keluar.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'edit') {
                    include "form-edit.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'tambah') {
                    include "tambah-admin.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'hapus-pegawai') {
                    include "hapus-pegawai.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'edit-surat-keluar') {
                    include "edit-surat-keluar.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'hapus-surat-keluar') {
                    include "hapus-surat-keluar.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'edit-surat-masuk') {
                    include "edit-surat-masuk.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'hapus-surat-masuk') {
                    include "hapus-surat-masuk.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'import-alumni') {
                    include "import-alumni.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'import-pegawai') {
                    include "import-pegawai.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'import-surat-masuk') {
                    include "import-surat-masuk.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'import-surat-keluar') {
                    include "import-surat-keluar.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'edit-pegawai') {
                    include "edit-pegawai.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'lihat-pegawai') {
                    include "lihat-pegawai.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'lihat-alumni') {
                    include "lihat-alumni.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'lihat-surat-masuk') {
                    include "lihat-surat-masuk.php";
                } elseif (isset($_GET['page']) && $_GET['page'] == 'lihat-surat-keluar') {
                    include "lihat-surat-keluar.php";
                } else {
                    include "data-admin.php";
                }
                ?>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../app/js/scripts.js"></script>
</body>

</html>
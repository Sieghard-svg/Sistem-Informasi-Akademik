<?php
// dashboard.php di folder app/
if (isset($_GET['username']) || isset($_GET['password'])) {
    header('Location: home.php?page=dashboard');
    exit;
}
include '../auth/koneksi.php';
// Jumlah data
// Jumlah data siswa
$jumlah_siswa = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_data_siswa"))[0];
$jumlah_pegawai = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_data_pegawai"))[0];
$jumlah_alumni = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_data_alumni"))[0];
$jumlah_suratmasuk = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_surat_masuk"))[0];
$jumlah_suratkeluar = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_surat_keluar"))[0];
// Data chart sederhana (jumlah pegawai per tahun masuk, alumni per tahun lulus, surat masuk/keluar per bulan)
$chart_pegawai = mysqli_query($koneksi, "SELECT YEAR(tmt_kerja) as tahun, COUNT(*) as jumlah FROM tb_data_pegawai GROUP BY tahun ORDER BY tahun DESC LIMIT 6");
// Chart siswa: jumlah siswa per tahun masuk
$chart_siswa = mysqli_query($koneksi, "SELECT YEAR(tanggal_masuk) as tahun, COUNT(*) as jumlah FROM tb_data_siswa GROUP BY tahun ORDER BY tahun DESC LIMIT 6");
$siswa_labels = [];
$siswa_data = [];
while ($row = mysqli_fetch_assoc($chart_siswa)) {
    $siswa_labels[] = $row['tahun'];
    $siswa_data[] = $row['jumlah'];
}
$pegawai_labels = [];
$pegawai_data = [];
while ($row = mysqli_fetch_assoc($chart_pegawai)) {
    $pegawai_labels[] = $row['tahun'];
    $pegawai_data[] = $row['jumlah'];
}
$chart_alumni = mysqli_query($koneksi, "SELECT tahun_lulus as tahun, COUNT(*) as jumlah FROM tb_data_alumni GROUP BY tahun ORDER BY tahun DESC LIMIT 6");
$alumni_labels = [];
$alumni_data = [];
while ($row = mysqli_fetch_assoc($chart_alumni)) {
    $alumni_labels[] = $row['tahun'];
    $alumni_data[] = $row['jumlah'];
}
$chart_suratmasuk = mysqli_query($koneksi, "SELECT DATE_FORMAT(tanggal_surat, '%Y-%m') as bulan, COUNT(*) as jumlah FROM tb_surat_masuk GROUP BY bulan ORDER BY bulan DESC LIMIT 6");
$suratmasuk_labels = [];
$suratmasuk_data = [];
while ($row = mysqli_fetch_assoc($chart_suratmasuk)) {
    $suratmasuk_labels[] = $row['bulan'];
    $suratmasuk_data[] = $row['jumlah'];
}
$chart_suratkeluar = mysqli_query($koneksi, "SELECT DATE_FORMAT(tanggal_keluar, '%Y-%m') as bulan, COUNT(*) as jumlah FROM tb_surat_keluar GROUP BY bulan ORDER BY bulan DESC LIMIT 6");
$suratkeluar_labels = [];
$suratkeluar_data = [];
while ($row = mysqli_fetch_assoc($chart_suratkeluar)) {
    $suratkeluar_labels[] = $row['bulan'];
    $suratkeluar_data[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard</title>
    <link href="../app/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <!-- Navbar kanan atas dihapus -->
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card bg-primary text-white mb-3 card-dashboard" data-type="pegawai" style="cursor:pointer;">
                    <div class="card-body">
                        Data Pegawai
                        <div class="h3 mt-2" id="jumlah-pegawai"><?php echo $jumlah_pegawai; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-info text-white mb-3 card-dashboard" data-type="siswa" style="cursor:pointer;">
                    <div class="card-body">
                        Data Siswa
                        <div class="h3 mt-2" id="jumlah-siswa"><?php echo $jumlah_siswa; ?></div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card bg-warning text-white mb-3 card-dashboard" data-type="alumni" style="cursor:pointer;">
                    <div class="card-body">
                        Data Alumni
                        <div class="h3 mt-2" id="jumlah-alumni"><?php echo $jumlah_alumni; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white mb-3 card-dashboard" data-type="suratkeluar"
                    style="cursor:pointer;">
                    <div class="card-body">
                        Data Surat Keluar
                        <div class="h3 mt-2" id="jumlah-suratkeluar"><?php echo $jumlah_suratkeluar; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white mb-3 card-dashboard" data-type="suratmasuk"
                    style="cursor:pointer;">
                    <div class="card-body">
                        Data Surat Masuk
                        <div class="h3 mt-2" id="jumlah-suratmasuk"><?php echo $jumlah_suratmasuk; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header" id="chart-title">Area Chart Data Pegawai</div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header" id="table-title">Tabel Data Pegawai</div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0" id="data-table">
                            <thead>
                                <tr id="table-head">
                                    <th>Nama</th>
                                    <th>Posisi</th>
                                    <th>Umur</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- Data tabel akan diisi via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data dashboard dari PHP
        const dashboardData = {
            siswa: {
                jumlah: <?php echo $jumlah_siswa; ?>,
                chart: {
                    labels: <?php echo json_encode(array_reverse($siswa_labels)); ?>,
                    data: <?php echo json_encode(array_reverse($siswa_data)); ?>,
                    label: 'Siswa Masuk per Tahun'
                },
                tableHead: ['Nama Lengkap', 'Tahun Masuk', 'NIS'],
                tableBody: [
                    <?php
                    $q = mysqli_query($koneksi, "SELECT nama_lengkap, YEAR(tanggal_masuk) as tahun_masuk, nomor_induk_siswa FROM tb_data_siswa ORDER BY id DESC LIMIT 5");
                    while ($r = mysqli_fetch_assoc($q)) {
                        echo json_encode(array_values($r)) . ",";
                    }
                    ?>
                ]
            },
            pegawai: {
                jumlah: <?php echo $jumlah_pegawai; ?>,
                chart: {
                    labels: <?php echo json_encode(array_reverse($pegawai_labels)); ?>,
                    data: <?php echo json_encode(array_reverse($pegawai_data)); ?>,
                    label: 'Pegawai Masuk per Tahun'
                },
                tableHead: ['Nama', 'Jabatan', 'Pangkat/Golongan'],
                tableBody: [
                    <?php
                    $q = mysqli_query($koneksi, "SELECT nama, jabatan, pangkat_golongan FROM tb_data_pegawai ORDER BY id DESC LIMIT 5");
                    while ($r = mysqli_fetch_assoc($q)) {
                        echo json_encode(array_values($r)) . ",";
                    }
                    ?>
                ]
            },
            alumni: {
                jumlah: <?php echo $jumlah_alumni; ?>,
                chart: {
                    labels: <?php echo json_encode(array_reverse($alumni_labels)); ?>,
                    data: <?php echo json_encode(array_reverse($alumni_data)); ?>,
                    label: 'Alumni per Tahun Lulus'
                },
                tableHead: ['Nama', 'Tahun Lulus', 'No Induk Siswa'],
                tableBody: [
                    <?php
                    $q = mysqli_query($koneksi, "SELECT nama, tahun_lulus, no_induk_siswa FROM tb_data_alumni ORDER BY id DESC LIMIT 5");
                    while ($r = mysqli_fetch_assoc($q)) {
                        echo json_encode(array_values($r)) . ",";
                    }
                    ?>
                ]
            },
            suratkeluar: {
                jumlah: <?php echo $jumlah_suratkeluar; ?>,
                chart: {
                    labels: <?php echo json_encode(array_reverse($suratkeluar_labels)); ?>,
                    data: <?php echo json_encode(array_reverse($suratkeluar_data)); ?>,
                    label: 'Surat Keluar per Bulan'
                },
                tableHead: ['Nomor Surat', 'Tanggal', 'Tujuan'],
                tableBody: [
                    <?php
                    $q = mysqli_query($koneksi, "SELECT nomor_surat, tanggal_keluar, tujuan_surat FROM tb_surat_keluar ORDER BY id_surat_keluar DESC LIMIT 5");
                    while ($r = mysqli_fetch_assoc($q)) {
                        echo json_encode(array_values($r)) . ",";
                    }
                    ?>
                ]
            },
            suratmasuk: {
                jumlah: <?php echo $jumlah_suratmasuk; ?>,
                chart: {
                    labels: <?php echo json_encode(array_reverse($suratmasuk_labels)); ?>,
                    data: <?php echo json_encode(array_reverse($suratmasuk_data)); ?>,
                    label: 'Surat Masuk per Bulan'
                },
                tableHead: ['Nomor Surat', 'Tanggal', 'Pengirim'],
                tableBody: [
                    <?php
                    $q = mysqli_query($koneksi, "SELECT nomor_surat, tanggal_surat, pengirim FROM tb_surat_masuk ORDER BY id_surat_masuk DESC LIMIT 5");
                    while ($r = mysqli_fetch_assoc($q)) {
                        echo json_encode(array_values($r)) . ",";
                    }
                    ?>
                ]
            }
        };

        // Area Chart Example
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dashboardData.pegawai.chart.labels,
                datasets: [{
                    label: dashboardData.pegawai.chart.label,
                    data: dashboardData.pegawai.chart.data,
                    backgroundColor: 'rgba(78, 115, 223, 0.2)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                legend: { display: false }
            }
        });

        // Fungsi update chart dan tabel
        function updateDashboard(type) {
            // Update chart
            myAreaChart.data.labels = dashboardData[type].chart.labels;
            myAreaChart.data.datasets[0].label = dashboardData[type].chart.label;
            myAreaChart.data.datasets[0].data = dashboardData[type].chart.data;
            myAreaChart.update();
            // Format judul dengan spasi
            let titleMap = {
                siswa: 'Siswa',
                pegawai: 'Pegawai',
                alumni: 'Alumni',
                suratkeluar: 'Surat Keluar',
                suratmasuk: 'Surat Masuk'
            };
            document.getElementById('chart-title').innerText = 'Area Chart ' + titleMap[type];
            // Update tabel
            const head = dashboardData[type].tableHead;
            const body = dashboardData[type].tableBody;
            let headHtml = '<tr>' + head.map(h => `<th>${h}</th>`).join('') + '</tr>';
            let bodyHtml = body.map(row => '<tr>' + row.map(col => `<td>${col}</td>`).join('') + '</tr>').join('');
            document.getElementById('table-head').innerHTML = headHtml;
            document.getElementById('table-body').innerHTML = bodyHtml;
            document.getElementById('table-title').innerText = 'Tabel ' + titleMap[type];
        }

        // Event listener untuk card
        document.querySelectorAll('.card-dashboard').forEach(function (card) {
            card.addEventListener('click', function () {
                updateDashboard(this.getAttribute('data-type'));
            });
        });
    </script>
</body>

</html>
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 04:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sma2jorong`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `email`, `password`) VALUES
(10, 'admin', 'admin', 'admin@gmail.com', '$2y$10$Bldp0b8MxMPOqFGS9cMdrOxxBZ368X0KaM3Sqp8OIjLysCUAoJZj2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_alumni`
--

CREATE TABLE `tb_data_alumni` (
  `id` int(11) NOT NULL,
  `tahun_lulus` int(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_orang_tua` varchar(255) NOT NULL,
  `no_induk_siswa` varchar(30) NOT NULL,
  `no_induk_siswa_nasional` varchar(30) NOT NULL,
  `no_ujian_nasional` varchar(30) NOT NULL,
  `no_ijazah` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_pegawai`
--

CREATE TABLE `tb_data_pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `pangkat_golongan` varchar(30) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `pendidikan` varchar(128) NOT NULL,
  `sertifikasi` varchar(128) NOT NULL,
  `tempat` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nik` varchar(30) NOT NULL,
  `tmt_kerja` date NOT NULL,
  `no_bpjs` varchar(30) NOT NULL,
  `no_hp_wa` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_siswa`
--

CREATE TABLE `tb_data_siswa` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `nomor_induk_siswa` varchar(20) DEFAULT NULL,
  `nomor_induk_siswa_nasional` varchar(20) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `sekolah_asal` varchar(100) DEFAULT NULL,
  `no_ijazah_sebelumnya` varchar(50) DEFAULT NULL,
  `no_skhun_sebelumnya` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `status_siswa` varchar(20) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `kebutuhan_khusus` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_keluarga` varchar(20) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nik_ayah` varchar(20) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nik_ibu` varchar(20) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `no_kip_kks_kis` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

CREATE TABLE `tb_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `jenis_surat` varchar(50) DEFAULT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `pangkat_golongan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `untuk_kegiatan` varchar(150) DEFAULT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `tempat_kegiatan` varchar(100) DEFAULT NULL,
  `tujuan_surat` text DEFAULT NULL,
  `dasar_surat` text DEFAULT NULL,
  `dasar_nomor_surat` varchar(50) DEFAULT NULL,
  `tanggal_dasar_surat` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `file_surat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

CREATE TABLE `tb_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `jenis_surat` varchar(50) DEFAULT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `pangkat_golongan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `untuk_kegiatan` varchar(150) DEFAULT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `tempat_kegiatan` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `file_surat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_alumni`
--
ALTER TABLE `tb_data_alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_pegawai`
--
ALTER TABLE `tb_data_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indexes for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_data_alumni`
--
ALTER TABLE `tb_data_alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_data_pegawai`
--
ALTER TABLE `tb_data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

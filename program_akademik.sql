-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 07:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `program_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `siswa` varchar(100) NOT NULL,
  `matpel` varchar(11) NOT NULL,
  `kehadiran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `kode_kelas`, `siswa`, `matpel`, `kehadiran`) VALUES
(1, 'KD001', 'KS001', 'KM001', '1'),
(3, 'KD001', 'KS003', 'KM001', '1'),
(4, 'KD002', 'KS006', 'KM003', '1');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` char(4) NOT NULL,
  `adminNAMA` varchar(50) NOT NULL,
  `adminEMAIL` varchar(50) NOT NULL,
  `adminPASSWORD` varchar(50) NOT NULL,
  `adminROLE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminNAMA`, `adminEMAIL`, `adminPASSWORD`, `adminROLE`) VALUES
('0001', 'Albert', 'albert@gmail.com', 'albert', 'admin'),
('0002', 'Budy', 'budy@gmail.com', '00dfc53ee86af02e742515cdcf075ed3', 'siswa'),
('0003', 'Tjia', 'tjia@gmail.com', '836e57a975d9de357240c0e45c27dc12', 'kepsek'),
('0004', 'Alex', 'alex@gmail.com', '534b44a19bf18d20b71ecc4eb77c572f', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `atribut`
--

CREATE TABLE `atribut` (
  `kode_atribut` varchar(100) NOT NULL,
  `nama_atribut` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atribut`
--

INSERT INTO `atribut` (`kode_atribut`, `nama_atribut`) VALUES
('KA001', 'Benefit'),
('KA002', 'Cost');

-- --------------------------------------------------------

--
-- Table structure for table `bobotnilai`
--

CREATE TABLE `bobotnilai` (
  `kode_bobotnilai` varchar(100) NOT NULL,
  `bobot` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobotnilai`
--

INSERT INTO `bobotnilai` (`kode_bobotnilai`, `bobot`, `nilai`) VALUES
('KBN001', 'Sangat Rendah', '1'),
('KBN002', 'Rendah', '2'),
('KBN003', 'Cukup', '3'),
('KBN004', 'Tinggi', '4'),
('KBN005', 'Sangat Tinggi', '5');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `kode_guru` varchar(10) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `notelp_guru` varchar(20) NOT NULL,
  `alamat_guru` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kode_guru`, `nama_guru`, `notelp_guru`, `alamat_guru`) VALUES
('KG001', 'Alexander', '081932132020', 'Jl. Pluit Indah'),
('KG002', 'Suky Noto', '08124567982', 'Jl. Teluk Intan Blok32'),
('KG003', 'Susi Susanti', '081295678423', 'Jl. MH Thamrin Pusat Blok.32 No.12'),
('KG004', 'Wiardi', '081245397421', 'Jl. Kota Tua'),
('KG005', 'Lusiana', '081944679912', 'Jl. Kapuk Muara');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `kode_kelas` varchar(15) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `matpel` varchar(100) NOT NULL,
  `kode_matpel` varchar(10) NOT NULL,
  `kode_guru` varchar(10) NOT NULL,
  `guru` varchar(100) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `jammulai` varchar(100) NOT NULL,
  `jamselesai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `kelas`, `kode_kelas`, `semester`, `tahun`, `matpel`, `kode_matpel`, `kode_guru`, `guru`, `hari`, `jammulai`, `jamselesai`) VALUES
(2, 'X IPA B', 'KD002', 'Genap', 2018, 'Matematika', 'KM003', 'KG002', 'Suky Noto', 'Jumat', '14:30', '00:30'),
(3, 'X IPS A', 'KD003', 'Ganjil', 2019, 'Biologi', 'KM004', 'KG004', 'Wiardi', 'Kamis', '23:35', '00:35'),
(4, 'X IPS B', 'KD004', 'Genap', 2020, 'Matematika', 'KM003', 'KG001', 'Alexander', 'Selasa', '06:30', '09:30'),
(6, 'XI IPS A', 'KD007', 'Ganjil', 2020, 'Sejarah', 'KM002', 'KG003', 'Susi Susanti', 'Jumat', '09:09', '10:10'),
(7, 'X IPS A', 'KD003', 'Ganjil', 2021, 'Indonesia', 'KM005', 'KG005', 'Lusiana', 'Jumat', '14:41', '15:41');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `kode_jurusan` varchar(100) NOT NULL,
  `jurusan_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kode_jurusan`, `jurusan_kelas`) VALUES
('KJ001', 'IPA'),
('KJ002', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(100) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nomor_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`, `jurusan`, `nomor_kelas`) VALUES
('KD001', 'X', 'IPA', 'A'),
('KD002', 'X', 'IPA', 'B'),
('KD003', 'X', 'IPS', 'A'),
('KD004', 'X', 'IPS', 'B'),
('KD005', 'XI', 'IPA', 'A'),
('KD006', 'XI', 'IPA', 'B'),
('KD007', 'XI', 'IPS', 'A'),
('KD008', 'XI', 'IPS', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `kelasdetail`
--

CREATE TABLE `kelasdetail` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(100) NOT NULL,
  `kode_siswa` varchar(100) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelasdetail`
--

INSERT INTO `kelasdetail` (`id`, `kode_kelas`, `kode_siswa`, `nama_siswa`) VALUES
(1, 'KD001', 'KS001', 'James'),
(2, 'KD001', 'KS002', 'Agung'),
(3, 'KD001', 'KS003', 'Budi'),
(4, 'KD001', 'KS004', 'Gunawan'),
(5, 'KD002', 'KS005', 'Richard'),
(6, 'KD002', 'KS006', 'Sandisk');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(100) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot_kriteria` int(100) NOT NULL,
  `atribut_kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot_kriteria`, `atribut_kriteria`) VALUES
('KK001', 'Pendapatan Orang Tua', 4, 'Cost'),
('KK002', 'Jumlah Tanggungan Orang Tua', 4, 'Benefit'),
('KK003', 'Nilai Rata-Rata', 5, 'Benefit'),
('KK004', 'Prestasi', 5, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `id` int(11) NOT NULL,
  `kode_matpel` varchar(20) NOT NULL,
  `nama_matpel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`id`, `kode_matpel`, `nama_matpel`) VALUES
(1, 'KM001', 'Bahasa Inggris'),
(2, 'KM002', 'Sejarah'),
(3, 'KM003', 'Matematika'),
(4, 'KM004', 'Biologi'),
(5, 'KM005', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `siswa` varchar(100) NOT NULL,
  `kodematpel` varchar(15) NOT NULL,
  `matpel` varchar(100) NOT NULL,
  `tugas` int(100) NOT NULL,
  `uts` int(100) NOT NULL,
  `uas` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `kelas`, `siswa`, `kodematpel`, `matpel`, `tugas`, `uts`, `uas`) VALUES
(1, 'KD001', 'KS002', 'KM002', 'Sejarah', 50, 60, 100),
(2, 'KD001', 'KS004', 'KM003', 'Matematika', 50, 60, 70),
(3, 'KD001', 'KS004', 'KM004', 'Biologi', 10, 20, 30),
(4, 'KD001', 'KS003', 'KM003', 'Matematika', 50, 60, 90),
(5, 'KD001', 'KS001', 'KM003', 'Matematika', 50, 20, 30),
(6, 'KD001', 'KS001', 'KM001', 'Bahasa Inggris', 10, 60, 30),
(7, 'KD001', 'KS003', 'KM001', 'Bahasa Inggris', 50, 50, 50),
(8, 'KD001', 'KS002', 'KM001', 'Bahasa Inggris', 50, 50, 50),
(9, 'KD001', 'KS004', 'KM001', 'Bahasa Inggris', 50, 12, 44),
(10, 'KD002', 'KS005', 'KM003', 'Matematika', 50, 50, 50),
(11, 'KD002', 'KS006', 'KM003', 'Matematika', 50, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `nama_kriteria` varchar(100) NOT NULL,
  `min` int(100) NOT NULL,
  `max` int(100) NOT NULL,
  `bobot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`nama_kriteria`, `min`, `max`, `bobot`) VALUES
('Jumlah Tanggungan Orang Tua', 1, 2, 'Tinggi'),
('Nilai Rata-Rata', 25, 50, 'Sangat Rendah'),
('Prestasi', 11, 22, 'Sangat Tinggi');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `kode_pengumuman` varchar(100) NOT NULL,
  `judul_pengumuman` varchar(100) NOT NULL,
  `tanggal_pengumuman` date NOT NULL,
  `isi_pengumuman` varchar(500) NOT NULL,
  `filePdf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `kode_pengumuman`, `judul_pengumuman`, `tanggal_pengumuman`, `isi_pengumuman`, `filePdf`) VALUES
(1, 'KP002', 'pembayaran SPP', '2021-10-21', 'bagi semua murid yang belum membayarkan spp. harap membayarkan spp. terima kasihhh', 'test.pdf'),
(2, 'KP001', 'pembayaran BPP UNTAR', '2021-11-11', 'abcdefghijklmnopqrstuvwxyz', '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `kode_siswa` varchar(10) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `notelp_siswa` varchar(20) NOT NULL,
  `alamat_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `kode_siswa`, `nama_siswa`, `notelp_siswa`, `alamat_siswa`) VALUES
(1, 'KS001', 'James', '081226642000', 'Jl. Bandengan Utara'),
(2, 'KS002', 'Agung', '081245678912', 'Jl. Bandengan Selatan'),
(3, 'KS003', 'Budi', '081924567891', 'Jl. Bandengan Timur'),
(4, 'KS004', 'Gunawan', '087945617891', 'Jl. Thamrin'),
(5, 'KS005', 'Richard', '087145682314', 'Jl. Senayan'),
(6, 'KS006', 'Sandisk', '045789451346', 'Jl. Bundaran Pusat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `kelasdetail`
--
ALTER TABLE `kelasdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelasdetail`
--
ALTER TABLE `kelasdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 09:27 AM
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
  `id` int(11) NOT NULL,
  `kode_admin` char(4) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `password_admin` varchar(50) NOT NULL,
  `role_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `kode_admin`, `nama_admin`, `email_admin`, `password_admin`, `role_admin`) VALUES
(1, '0001', 'Albert', 'albert@gmail.com', 'albert', 'admin'),
(2, '0002', 'Budy', 'budy@gmail.com', '00dfc53ee86af02e742515cdcf075ed3', 'siswa'),
(3, '0003', 'Tjia', 'tjia@gmail.com', '836e57a975d9de357240c0e45c27dc12', 'kepsek'),
(4, '0004', 'Alex', 'alex@gmail.com', '534b44a19bf18d20b71ecc4eb77c572f', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `akun_user`
--

CREATE TABLE `akun_user` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(10) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `role_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_user`
--

INSERT INTO `akun_user` (`id`, `kode_user`, `nama_user`, `email_user`, `password_user`, `role_user`) VALUES
(1, '001', 'Alberts', 'albert@gmail.com', 'aea5d036b62f6c1d77ef9dad9ae226d4', 'admin'),
(3, '003', 'James', 'jamess@gmail.com', 'b4cc344d25a2efe540adbf2678e2304c', 'siswa'),
(4, '004', 'Alexander', 'alexandesr@gmail.com', '202cb962ac59075b964b07152d234b70', 'guru'),
(6, '002', 'Kepala Sekolah', 'kepsek@gmail.com', '202cb962ac59075b964b07152d234b70', 'kepsek'),
(7, '005', 'Suky Noto', 'sukynoto@gmail.com', '202cb962ac59075b964b07152d234b70', 'guru'),
(8, '006', 'Susi Susanti', 'susi@gmail.com', '202cb962ac59075b964b07152d234b70', 'guru');

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
-- Table structure for table `bobot_spk`
--

CREATE TABLE `bobot_spk` (
  `id` int(11) NOT NULL,
  `kode_siswa` varchar(255) NOT NULL,
  `c1` int(11) NOT NULL,
  `c2` int(11) NOT NULL,
  `c3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot_spk`
--

INSERT INTO `bobot_spk` (`id`, `kode_siswa`, `c1`, `c2`, `c3`) VALUES
(1, 'KS001', 5, 2, 4),
(3, 'KS002', 5, 1, 1),
(5, 'KS007', 5, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `kode_guru` varchar(10) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `notelp_guru` varchar(20) NOT NULL,
  `alamat_guru` varchar(100) NOT NULL,
  `email_guru` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `kode_guru`, `nama_guru`, `notelp_guru`, `alamat_guru`, `email_guru`) VALUES
(1, 'KG001', 'Alexander', '081932132020', 'Jl. Pluit Indah', 'alexandesr@gmail.com'),
(2, 'KG002', 'Suky Noto', '08124567982', 'Jl. Teluk Intan Blok32', 'sukynoto@gmail.com'),
(3, 'KG003', 'Susi Susanti', '081295678423', 'Jl. MH Thamrin Pusat Blok.32 No.12', 'susi@gmail.com'),
(4, 'KG004', 'Wiardi', '081245397421', 'Jl. Kota Tua', 'wiardi@gmail.com'),
(5, 'KG005', 'Lusiana', '081944679912', 'Jl. Kapuk Muara', 'lusiana@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
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

INSERT INTO `jadwal` (`id`, `nama_kelas`, `kode_kelas`, `semester`, `tahun`, `matpel`, `kode_matpel`, `kode_guru`, `guru`, `hari`, `jammulai`, `jamselesai`) VALUES
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
  `kode_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelasdetail`
--

INSERT INTO `kelasdetail` (`id`, `kode_kelas`, `kode_siswa`) VALUES
(1, 'KD001', 'KS001'),
(2, 'KD001', 'KS002'),
(3, 'KD001', 'KS003'),
(4, 'KD001', 'KS004'),
(5, 'KD002', 'KS005'),
(8, 'KD002', 'KS006'),
(9, 'KD002', 'KS007');

-- --------------------------------------------------------

--
-- Table structure for table `kepsek`
--

CREATE TABLE `kepsek` (
  `id` int(11) NOT NULL,
  `kode_kepsek` varchar(100) NOT NULL,
  `nama_kepsek` varchar(100) NOT NULL,
  `email_kepsek` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kepsek`
--

INSERT INTO `kepsek` (`id`, `kode_kepsek`, `nama_kepsek`, `email_kepsek`) VALUES
(1, 'KKS01', 'Kepala Sekolah', 'kepsek@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `ID` int(11) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot_kriteria` int(100) NOT NULL,
  `atribut_kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`ID`, `kode_kriteria`, `nama_kriteria`, `bobot_kriteria`, `atribut_kriteria`) VALUES
(1, 'KK001', 'Pendapatan Orang Tua', 5, 'Cost'),
(2, 'KK002', 'Tanggungan Orang Tua', 3, 'Benefit'),
(3, 'KK003', 'Nilai Rata-Rata', 2, 'Benefit');

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
  `kode_kelas` varchar(100) NOT NULL,
  `kode_siswa` varchar(100) NOT NULL,
  `kodematpel` varchar(15) NOT NULL,
  `matpel` varchar(100) NOT NULL,
  `tugas` int(100) NOT NULL,
  `uts` int(100) NOT NULL,
  `uas` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `kode_kelas`, `kode_siswa`, `kodematpel`, `matpel`, `tugas`, `uts`, `uas`) VALUES
(1, 'KD001', 'KS002', 'KM002', 'Sejarah', 50, 60, 100),
(2, 'KD001', 'KS004', 'KM003', 'Matematika', 50, 60, 70),
(3, 'KD001', 'KS004', 'KM004', 'Biologi', 10, 20, 30),
(4, 'KD001', 'KS003', 'KM003', 'Matematika', 50, 60, 90),
(5, 'KD001', 'KS001', 'KM003', 'Matematika', 50, 20, 30),
(6, 'KD001', 'KS001', 'KM001', 'Bahasa Inggris', 10, 60, 30),
(7, 'KD001', 'KS003', 'KM001', 'Bahasa Inggris', 50, 50, 50),
(8, 'KD001', 'KS002', 'KM001', 'Bahasa Inggris', 50, 50, 50),
(9, 'KD001', 'KS004', 'KM001', 'Bahasa Inggris', 50, 12, 44),
(11, 'KD002', 'KS006', 'KM003', 'Matematika', 50, 50, 50),
(12, 'KD002', 'KS005', 'KM003', 'Matematika', 50, 50, 50),
(13, 'KD002', 'KS007', 'KM003', 'Matematika', 50, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `min` int(100) NOT NULL,
  `max` int(100) NOT NULL,
  `bobot` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id`, `kode_kriteria`, `min`, `max`, `bobot`) VALUES
(1, 'KK001', 0, 2000000, 1),
(2, 'KK001', 2000000, 4000000, 2),
(3, 'KK001', 4000000, 6000000, 3),
(4, 'KK001', 6000000, 8000000, 4),
(5, 'KK001', 8000000, 10000000, 5),
(6, 'KK002', 1, 1, 1),
(7, 'KK002', 2, 2, 2),
(8, 'KK002', 3, 3, 3),
(9, 'KK002', 4, 4, 4),
(10, 'KK002', 5, 5, 5),
(11, 'KK003', 0, 20, 1),
(12, 'KK003', 21, 40, 2),
(13, 'KK003', 41, 60, 3),
(14, 'KK003', 61, 80, 4),
(15, 'KK003', 81, 100, 5);

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
(1, 'KP002', 'pembayaran SPP', '2021-10-21', 'bagi semua murid yang belum membayarkan spp. harap membayarkan spp. terima kasihhh', 'test.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `kode_siswa` varchar(10) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `notelp_siswa` varchar(20) NOT NULL,
  `alamat_siswa` varchar(100) NOT NULL,
  `email_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `kode_siswa`, `nama_siswa`, `notelp_siswa`, `alamat_siswa`, `email_siswa`) VALUES
(1, 'KS001', 'James', '081226642000', 'Jl. Bandengan Utara', 'jamess@gmail.com'),
(2, 'KS002', 'Agung', '081245678912', 'Jl. Bandengan Selatan', 'agung@gmail.com'),
(3, 'KS003', 'Budi', '081924567891', 'Jl. Bandengan Timur', 'budi@gmail.com'),
(4, 'KS004', 'Gunawan', '087945617891', 'Jl. Thamrin', 'gunawan@gmail.com'),
(5, 'KS005', 'Richard', '087145682314', 'Jl. Senayan', 'richard@gmail.com'),
(6, 'KS006', 'Sandisk', '045789451346', 'Jl. Bundaran Pusat', 'sandisk@gmail.com'),
(7, 'KS007', 'Testudin Surudin', '08123123123', 'Jalan Pantai Uye', 'testudin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE `spk` (
  `id` int(11) NOT NULL,
  `kode_siswa` varchar(100) NOT NULL,
  `c1` int(100) NOT NULL,
  `c2` int(100) NOT NULL,
  `c3` int(100) NOT NULL,
  `hasil_spk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spk`
--

INSERT INTO `spk` (`id`, `kode_siswa`, `c1`, `c2`, `c3`, `hasil_spk`) VALUES
(1, 'KS001', 50000000, 2, 66, '8.5'),
(2, 'KS002', 10000, 1, 10, '6.25'),
(4, 'KS007', 10000000, 4, 80, '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_user`
--
ALTER TABLE `akun_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bobot_spk`
--
ALTER TABLE `bobot_spk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
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
-- Indexes for table `kepsek`
--
ALTER TABLE `kepsek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
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
-- Indexes for table `spk`
--
ALTER TABLE `spk`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `akun_user`
--
ALTER TABLE `akun_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bobot_spk`
--
ALTER TABLE `bobot_spk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kepsek`
--
ALTER TABLE `kepsek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `spk`
--
ALTER TABLE `spk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

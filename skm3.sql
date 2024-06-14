-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2024 at 05:04 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skm3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 14, 2024 at 03:28 AM
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `foto`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '50082216.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--
-- Creation: Jun 10, 2024 at 03:11 PM
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(2) NOT NULL,
  `bulan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `bulan`) VALUES
('01', 'Januari'),
('02', 'Februari'),
('03', 'Maret'),
('04', 'April'),
('05', 'Mei'),
('06', 'Juni'),
('07', 'Juli'),
('08', 'Agustus'),
('09', 'September'),
('10', 'Oktober'),
('11', 'November'),
('12', 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--
-- Creation: Jun 10, 2024 at 03:11 PM
--

CREATE TABLE `faq` (
  `id` int NOT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `pertanyaan`, `jawaban`, `created_date`) VALUES
(11, 'Apakah data responden aman jika mengisi kuesiner ini?', 'Ya. Tentu saja. Data responden hanya akan digunakan oleh intern instansi dan tidak akan diberikan ke pihak lain.', '2022-04-04 09:57:54'),
(12, 'Apa manfaat kuesiner ini?', 'Hasil kuesiner menjadi umpan balik bagi instansi untuk meningkatkan layanan kepada konsumen atau masyarakat.', '2022-04-04 09:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 14, 2024 at 03:28 AM
--

CREATE TABLE `jawaban` (
  `id_jawaban` int NOT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `id_pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `published` enum('1','2','') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_responden`, `id_pertanyaan`, `jawaban`, `created_date`, `published`) VALUES
(50, '7', 'U2', 'd', '2024-06-10 22:13:11', '2'),
(51, '7', 'U3', 'd', '2024-06-10 22:13:15', '2'),
(52, '7', 'U4', 'd', '2024-06-10 22:13:17', '2'),
(53, '7', 'U5', 'd', '2024-06-10 22:13:20', '2'),
(54, '7', 'U6', 'd', '2024-06-10 22:13:22', '2'),
(55, '7', 'U7', 'd', '2024-06-10 22:13:24', '2'),
(56, '7', 'U8', 'd', '2024-06-10 22:13:27', '2'),
(64, '8', 'U2', 'c', '2024-06-11 07:11:10', '2'),
(65, '8', 'U3', 'd', '2024-06-11 07:11:12', '2'),
(66, '8', 'U4', 'd', '2024-06-11 07:11:13', '2'),
(67, '8', 'U5', 'd', '2024-06-11 07:11:15', '2'),
(68, '8', 'U6', 'd', '2024-06-11 07:11:16', '2'),
(69, '8', 'U7', 'd', '2024-06-11 07:11:18', '2'),
(70, '8', 'U8', 'd', '2024-06-11 07:11:19', '2'),
(78, '9', 'U2', 'd', '2024-06-11 09:10:15', '2'),
(79, '9', 'U3', 'd', '2024-06-11 09:10:18', '2'),
(80, '9', 'U4', 'c', '2024-06-11 09:10:20', '2'),
(81, '9', 'U5', 'c', '2024-06-11 09:10:22', '2'),
(82, '9', 'U6', 'c', '2024-06-11 09:10:23', '2'),
(83, '9', 'U7', 'd', '2024-06-11 09:10:25', '2'),
(84, '9', 'U8', 'd', '2024-06-11 09:10:26', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_sementara`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 11, 2024 at 02:10 AM
--

CREATE TABLE `jawaban_sementara` (
  `id_jawaban` int NOT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `id_pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `published` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 14, 2024 at 03:27 AM
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `konten` text,
  `img` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--
-- Creation: Jun 10, 2024 at 03:11 PM
--

CREATE TABLE `pekerjaan` (
  `id` int NOT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `pekerjaan`) VALUES
(1, 'PNS/TNI/POLRI'),
(2, 'Pegawai Swasta'),
(3, 'Wiraswasta'),
(4, 'Pelajar/Mahasiswa'),
(5, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 11, 2024 at 12:04 AM
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` int NOT NULL,
  `id_unit` int DEFAULT NULL,
  `nama_pelayanan` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `id_unit`, `nama_pelayanan`, `created_date`) VALUES
(1, 2, 'Pelayanan KTP', '2022-04-02 17:09:02'),
(3, 3, 'Pelayanan Izin Praktek Kesehatan', '2022-04-02 17:44:01'),
(4, 2, 'Pelayanan Kartu Keluarga', '2024-06-11 07:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--
-- Creation: Jun 10, 2024 at 03:11 PM
--

CREATE TABLE `pendidikan` (
  `id` varchar(255) NOT NULL,
  `pendidikan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `pendidikan`) VALUES
('1', 'SD Kebawah'),
('2', 'SMP'),
('3', 'SMA'),
('4', 'S1'),
('5', 'S2 Keatas');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--
-- Creation: Jun 10, 2024 at 03:11 PM
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` varchar(12) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `soal` text,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `kategori`, `soal`, `a`, `b`, `c`, `d`) VALUES
('U2', 'Prosedur Pelayanan', 'Bagaimana pemahaman saudara tentang kemudahan prosedur pelayanan di unit ini', 'Tidak Mudah ', 'Kurang Mudah ', 'Mudah', 'Sangat Mudah'),
('U3', 'Waktu Pelayanan', 'Bagaimana pendapat saudara tentang kecepatan pelayanan di unit ini', 'Tidak Tepat Waktu', 'Kadang Tepat Waktu', 'Banyak Tepat Waktu', 'Selalu Tepat Waktu'),
('U4', 'Biaya/tarif pelayanan', 'Bagaimana pendapat saudara tentang kesesuaian antara biaya yang dibayarkan dengan biaya yang telah ditetapkan', 'Selalu Tidak Sesuai', 'Kadang Sesuai', 'Banyak Sesuainya', 'Selalu Sesuai'),
('U5', 'Produk Spesifikasi Jenis Pelayanan ', 'Bagaimana pendapat saudara tentang kesesuaian hasil pelayanan yang diberikan dan diterima dengan waktu yang ditetapkan', 'Tidak Sesuai', 'Kadang Sesuai', 'Sesuai', 'Sangat Sesuai'),
('U6', 'Kompetensi Pelaksana Pelayanan', 'Bagaimana pendapat saudara tentang kemampuan petugas dalam memberi pelayanan', 'Tidak Mampu', 'Kurang Mampu', 'Mampu', 'Sangat Mampu'),
('U7', 'Perilaku Pelaksana Pelayanan', 'Bagaimana pendapat saudara tentang penanganan pengaduan,saran dan masukan pelayanan yang diberikan ', 'Tidak Baik', 'Kurang Baik', 'Baik', 'Sangat Baik'),
('U8', 'Maklumat Pelayanan', 'Bagaiman pendapat saudara tentang sarana dan prasarana yang digunakan dalam pelayanan', 'Tidak Sesuai', 'Kurang Sesuai', 'Sesuai ', 'Sangat Sesuai');

-- --------------------------------------------------------

--
-- Table structure for table `profil_aplikasi`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 14, 2024 at 03:27 AM
--

CREATE TABLE `profil_aplikasi` (
  `id_profilaplikasi` int NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `alamat_instansi` varchar(100) NOT NULL,
  `notelp_instansi` varchar(100) NOT NULL,
  `email_instansi` varchar(100) NOT NULL,
  `logo_instansi` varchar(100) NOT NULL,
  `nama_aplikasi` varchar(100) NOT NULL,
  `logo_aplikasi` varchar(100) NOT NULL,
  `favicon_aplikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_aplikasi`
--

INSERT INTO `profil_aplikasi` (`id_profilaplikasi`, `nama_instansi`, `alamat_instansi`, `notelp_instansi`, `email_instansi`, `logo_instansi`, `nama_aplikasi`, `logo_aplikasi`, `favicon_aplikasi`) VALUES
(1, 'Pemerintah Kabupaten Aceh barat', 'Jalan Gajah Mada no 1 Kecamatan Johan Pahlawan Kabupaten Aceh Barat', '06557552788', 'Halo@acehbaratkab.go.id', '7421405logo_aceh_barat6.png', 'Survey Kepuasan Masyarakat', '41835230logo_aceh_barat6.png', '30270145logo_aceh_barat6.png');

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 11, 2024 at 02:10 AM
--

CREATE TABLE `responden` (
  `id_responden` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `umur` int DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT 'Laki-laki',
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` enum('1','2') DEFAULT '1',
  `id_unit` int DEFAULT NULL,
  `id_pelayanan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `responden`
--

INSERT INTO `responden` (`id_responden`, `email`, `nama`, `umur`, `jk`, `pendidikan`, `pekerjaan`, `created_date`, `status`, `id_unit`, `id_pelayanan`) VALUES
(1, 'cnahmad59@gmail.com', 'maysarah', 34, 'Laki-laki', 'SMA', 'PNS/TNI/POLRI', '2024-06-10 22:55:09', '1', 2, 1),
(2, 'dedhy2001@yahoo.com', 'Noor Dedhy', 41, 'Laki-laki', 'S1', 'Wiraswasta', '2022-04-04 04:15:22', '1', 3, 3),
(3, 'sasa@yahoo.com', 'Sasa Marisa Cantika', 21, 'Perempuan', 'SMA', 'Pelajar/Mahasiswa', '2022-04-04 07:59:08', '1', 2, 1),
(4, 'andi12@gmail.com', 'Ananda Nikola', 15, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2022-04-04 10:17:53', '1', 3, 3),
(5, 'munir@yahoo.com', 'Ibu Mun', 28, 'Perempuan', 'SMA', 'Lainnya', '2022-04-05 01:35:29', '1', 3, 3),
(6, 'aan@gmail.com', 'xx', 22, 'Laki-laki', 'SMA', 'Pelajar/Mahasiswa', '2022-04-05 12:55:02', '1', 3, 3),
(7, 'cnahmad59@gmail.com', 'maysarah', 23, 'Laki-laki', 'SMA', 'PNS/TNI/POLRI', '2024-06-10 22:12:54', '1', 2, 1),
(8, 'halo@agus.com', 'Agus', 32, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2024-06-11 07:10:48', '1', 2, 1),
(9, 'zxcxvz@reza.com', 'AHD MUHAJIR', 24, 'Laki-laki', 'S1', 'PNS/TNI/POLRI', '2024-06-11 09:09:54', '1', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `saran`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 11, 2024 at 02:10 AM
--

CREATE TABLE `saran` (
  `id_saran` int NOT NULL,
  `id_responden` varchar(255) DEFAULT NULL,
  `saran` longtext,
  `created_date` datetime DEFAULT NULL,
  `status` enum('1','2') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `saran`
--

INSERT INTO `saran` (`id_saran`, `id_responden`, `saran`, `created_date`, `status`) VALUES
(23, '1', 'oke \n', '2020-11-17 20:35:39', '2'),
(32, '2', 'ok sekali', '2022-04-04 04:48:37', '2'),
(41, '3', 'nice', '2022-04-04 08:00:41', '1'),
(43, '5', 'sudah baik. tingkatkan lagi.', '2022-04-05 02:36:13', '1'),
(44, '7', 'sudah baik', '2024-06-10 22:13:37', '2'),
(45, '1', 'oke', '2024-06-10 22:55:55', '1'),
(46, '8', 'sangat baik', '2024-06-11 07:11:27', '1'),
(47, '9', 'sudah baik', '2024-06-11 09:10:33', '1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tahun`
-- (See below for the actual view)
--
CREATE TABLE `tahun` (
`tahun` int
);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--
-- Creation: Jun 10, 2024 at 03:11 PM
-- Last update: Jun 11, 2024 at 12:03 AM
--

CREATE TABLE `unit` (
  `id_unit` int NOT NULL,
  `nama_unit` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama_unit`, `created_date`) VALUES
(2, 'Dinas Kependudukan dan Pencatatan Sipil', '2022-04-02 11:54:46'),
(3, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP)', '2022-04-02 17:34:12');

-- --------------------------------------------------------

--
-- Structure for view `tahun` exported as a table
--
DROP TABLE IF EXISTS `tahun`;
CREATE TABLE`tahun`(
    `tahun` int DEFAULT NULL
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`) USING BTREE;

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`) USING BTREE;

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`) USING BTREE;

--
-- Indexes for table `jawaban_sementara`
--
ALTER TABLE `jawaban_sementara`
  ADD PRIMARY KEY (`id_jawaban`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`) USING BTREE;

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`) USING BTREE;

--
-- Indexes for table `profil_aplikasi`
--
ALTER TABLE `profil_aplikasi`
  ADD PRIMARY KEY (`id_profilaplikasi`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id_responden`) USING BTREE;

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`) USING BTREE;

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `jawaban_sementara`
--
ALTER TABLE `jawaban_sementara`
  MODIFY `id_jawaban` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

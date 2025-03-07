-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql311.infinityfree.com
-- Generation Time: Mar 07, 2025 at 10:25 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38125527_kuliah`
--
CREATE DATABASE IF NOT EXISTS `if0_38125527_kuliah` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `if0_38125527_kuliah`;

-- --------------------------------------------------------

--
-- Table structure for table `dumb`
--

DROP TABLE IF EXISTS `dumb`;
CREATE TABLE IF NOT EXISTS `dumb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(225) DEFAULT NULL,
  `deskripsi` varchar(4000) DEFAULT NULL,
  `tanggal_buat` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dumb`
--

INSERT INTO `dumb` (`id`, `judul`, `deskripsi`, `tanggal_buat`, `id_user`) VALUES
(11, 'halo geng', 'ada apa nih', '2025-01-12', 2),
(12, 'dumbper', 'aku gatau aku harus gimana dan aku juga gapaham yakan kenapa bisa jadi seperti ini karena aku juga ga espek ', '2025-01-14', 2),
(13, 'hi', 'nganu', '2025-01-14', 2),
(25, 'tugas kelompok RPL', 'analisis -> kebutuhan fungsional, kebutuhan non fungsional (costumer)\r\ndesigner -> db, uml (usecase, activity)\r\nprogrammer -> bahasa pemrograman\r\nuji coba -> performa, usebility (kuisioner, ometer)\r\n', '2025-02-23', 35),
(28, 'Eksplorasi TKI', 'macam macam ir system\r\n(pelajari)', '2025-02-25', 35),
(31, 'TKI info', 'search engine adalah contoh penerapan dari ir system\r\nweb spider dan web roller sama.\r\nboolean search\r\ntf idf materi\r\norganic search?', '2025-02-25', 35),
(33, 'strategi algoritma ', 'kerjakan proses merge sort dan analisis', '2025-03-07', 35),
(34, 'IoT', 'Tugas Dari Pak Dwi', '2025-03-07', 35);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
CREATE TABLE IF NOT EXISTS `materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minggu` int(11) DEFAULT NULL,
  `judul` varchar(300) DEFAULT NULL,
  `tujuan` varchar(2000) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_materi_matkul` (`id_matkul`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `minggu`, `judul`, `tujuan`, `id_matkul`) VALUES
(7, 1, 'Data Understanding', 'untuk memahami struktur, karakteristik, dan kualitas data, mendeteksi masalah seperti data yang hilang atau outlier, menggali pola awal, memastikan relevansi data dengan tujuan analisis, mempersiapkan data untuk tahap selanjutnya, serta menghubungkannya dengan tujuan bisnis untuk menghasilkan insight yang akurat dan bermanfaat.', 13),
(8, 2, 'Data Quality ', 'Memahami dan meningkatkan kualitas data dengan mengidentifikasi, memperbaiki, dan menangani data yang hilang, tidak konsisten, atau outlier untuk memastikan data siap dianalisis.', 13),
(9, 1, 'Social Issues', 'Memahami dampak sosial dari analisis data, seperti privasi, bias, dan etika penggunaan data dalam pengambilan keputusan.', 13),
(10, 2, 'Data Reduction and Feature Enhancement', 'Mengurangi dimensi data secara efisien sambil mempertahankan informasi penting serta meningkatkan kualitas fitur untuk analisis yang lebih akurat.', 13),
(11, 2, 'Clustering:', 'Memahami cara mengelompokkan data berdasarkan kesamaan untuk menemukan pola atau segmentasi tanpa pengawasan (unsupervised learning).', 13),
(12, 1, 'Association Analysis', 'Mempelajari hubungan antarvariabel untuk menemukan aturan atau pola yang sering muncul bersama dalam dataset.', 13),
(13, 2, 'Regression', 'Memahami dan menggunakan metode regresi untuk memprediksi nilai numerik berdasarkan hubungan antarvariabel.', 13),
(14, 3, 'Classification', 'Belajar mengklasifikasikan data ke dalam kategori tertentu dengan menggunakan algoritma supervised learning.', 13),
(15, 2, 'Model Selection and Validation', 'Memahami cara memilih model terbaik dan memvalidasi performa model untuk memastikan akurasi dan generalisasi.', 13),
(16, 2, 'Systems Analysis & Design Philosophies and Approaches', 'Memahami pendekatan dan filosofi dalam analisis dan desain sistem perangkat lunak.', 14),
(17, 1, 'Artificial Neural Network', 'Memahami dasar Ai', 15),
(18, 2, 'Convoluetional Neural Network', '-', 15),
(19, 1, 'BAB1 - Review Desain Database dan Normalisasi', 'mempelajari cara design database dengan benar', 16),
(20, 1, 'BAB 2 -  Perancangan Database yang Efisien', 'paham ERD, ngerti relasi database, penggunaan indeks untuk meningkatkan kinerja query', 16),
(21, 2, 'BAB 3 - Advanced SQL - Subquery dan Join', 'paham tentang join join dan pengertian dan pengguanaan nya.', 16),
(22, 1, 'BAB4 - Advanced SQL - View dan Index', 'manfaat indexing dan penggunaan query', 16),
(23, 1, 'BAB5 - Konsep Trigger dalam Database', 'paham tentang \r\nBEFORE, AFTER, INSERT, UPDATE, DELETE', 16),
(24, 1, 'BAB 6 - Implementasi Trigger dalam MySQL/PostgreSQL-', 'Paham penggunaan dan implementasi triger nya', 16),
(25, 1, 'BAB7- Stored Procedure - Konsep dan Keuntungan', 'tau tentang stored procedure dan query biasa, manfaat dan keperluan nya', 16),
(26, 1, ' Bab 8: Implementasi Stored Procedure', 'paham tentang  MySQL/PostgreSQL. dan parameter `IN`, `OUT`, `INOUT` yang udah di implementasikan!', 16),
(27, 1, ' Bab 9: Stored Function - Konsep dan Implementasi', 'bisa membedakan  Stored Function dan Stored Procedure.dan implementasi Stored Function dalam kalkulasi dan validasi data.', 16),
(28, 2, 'Bab 10: Studi Kasus - Kombinasi Trigger, Stored Procedure, dan Stored Function', 'bisa Mengintegrasikan Trigger, Stored Procedure, dan Stored Function dalam sistem yang kompleks.', 16),
(29, 1, ' Bab 11: Optimasi dan Keamanan Basis Data', 'paham\r\n- Teknik optimasi database menggunakan Indexing, Partitioning, dan Caching.\r\n- Keamanan database: User Privileges, Role-Based Access Control (RBAC).\r\n- Pencegahan SQL Injection dan Data Leakage.', 16),
(30, 16, ' Bab 12: Presentasi Proyek Akhir dan Evaluas', '  - Desain database yang baik.\r\n  - Trigger, Stored Procedure, dan Stored Function.\r\n  - Advanced SQL untuk query kompleks.\r\n- Evaluasi oleh dosen dan mahasiswa lain.', 16),
(31, 1, ' variabel', 'memahami variabel dan fungsi nya', 44);

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

DROP TABLE IF EXISTS `matkul`;
CREATE TABLE IF NOT EXISTS `matkul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(255) DEFAULT NULL,
  `status` enum('wajib','pilihan') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `dosen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matkul_ibfk_1` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `nama_matkul`, `status`, `id_user`, `dosen`) VALUES
(13, 'Penambangan Data', 'wajib', 35, 'FIKA HASTARITA RACHMAN, ST., M.Eng'),
(14, 'Rekayasa Perangkat Lunak', 'wajib', 35, 'FIFIN AYU MUFARROHA S.Kom, M.Kom'),
(15, 'Kecerdasan Komputasional', 'wajib', 35, 'EKA MALA SARI ROCHMAN, S.Kom.M.Kom'),
(16, 'Basis Data II', 'wajib', 35, 'Dr.ARIF MUNTASA, S.Si., MT.'),
(20, 'Penambahan data', 'wajib', 2, NULL),
(28, 'rekaysa perangkat lunak', 'wajib', 2, NULL),
(37, 'Rekayasa Perangkat Lunak', 'wajib', 2, NULL),
(38, 'Internet Of Things', 'pilihan', 35, 'DWI KUSWANTO, S.Pd.,MT'),
(39, 'Interaksi Manusia Dan Komputer', 'pilihan', 35, 'Ir. Andharini Dwi Cahyani, S.Kom, M.Kom, PhD'),
(40, 'Strategi Algoritma', 'pilihan', 35, 'SIGIT SUSANTO PUTRO, S.Kom., M.Kom.'),
(41, 'Temu Kembali Informasi', 'pilihan', 35, 'FIRDAUS SOLIHIN, S.Kom., M.Kom'),
(44, 'alpro', 'wajib', 35, 'bu indah');

-- --------------------------------------------------------

--
-- Table structure for table `submateri`
--

DROP TABLE IF EXISTS `submateri`;
CREATE TABLE IF NOT EXISTS `submateri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(400) DEFAULT NULL,
  `catatan` varchar(2000) DEFAULT NULL,
  `progres` enum('bisa','hampir','belum bisa') DEFAULT NULL,
  `referensi` varchar(500) DEFAULT NULL,
  `praktek` varchar(300) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submateri_ibfk_1` (`id_materi`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submateri`
--

INSERT INTO `submateri` (`id`, `judul`, `catatan`, `progres`, `referensi`, `praktek`, `id_materi`, `target`) VALUES
(18, 'Pengumpulan Data [DATA COLLECTION]', 'mengumpulkan data dari sumber yang relevan api, database dan file', 'bisa', 'https://algorit.ma/blog/data-collection-2022/', 'Mulailah dengan memahami tujuan penelitian dan pilih metode pengumpulan data yang sesuai.', 7, 3),
(19, 'Data Description', 'Memahami struktur data, tipe data (numerik, kategorikal), serta distribusi awal dataset.', 'belum bisa', 'https://dqlab.id/pelajari-jenis-jenis-data-statistik-dan-metode-pengolahan-data-yang-digunakan', 'menghafal', 7, 2),
(20, 'Data Exploration', 'Melakukan eksplorasi awal, seperti distribusi data, pola umum, outlier, dan statistik deskriptif.', 'belum bisa', 'https://info.populix.co/articles/eksplorasi-data-adalah/', 'Gunakan visualisasi sederhana (histogram, scatter plot) untuk eksplorasi pola.', 7, 3),
(21, 'Data Quality Assessment', 'Komponen dasar iNaturalist adalah observasi yang dapat diverifikasi . Observasi yang dapat diverifikasi adalah observasi yang:\r\n-memiliki tanggal\r\n-memiliki georeferensi (yaitu memiliki koordinat lintang/bujur)\r\n-memiliki foto atau suara\r\n-bukan dari organisme yang ditawan atau dibudidayakan', 'belum bisa', 'https://help.inaturalist.org/en/support/solutions/articles/151000169936-what-is-the-data-quality-assessment-and-how-do-observations-qualify-to-become-research-grade-', 'print(data.isnull().sum())', 7, 2),
(22, 'konsep normalisasi', '1NF (First Normal Form): Menghilangkan grup data berulang dan memastikan semua atribut memiliki nilai atom.\r\n2NF (Second Normal Form): Menghilangkan ketergantungan parsial; semua atribut non-kunci harus bergantung sepenuhnya pada kunci utama.\r\n3NF (Third Normal Form): Menghilangkan ketergantungan transitif; semua atribut non-kunci harus bergantung hanya pada kunci utama.\r\nBCNF (Boyce-Codd Normal Form): Memperkuat 3NF dengan mengatasi beberapa kasus ketergantungan yang masih mungkin terjadi.', 'hampir', '', '', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'felysh', 'sultan', '123', 'admin'),
(2, 'ari winatas', 'aziz', '123', 'user'),
(35, 'Sultan Felycade', 'fely', '123', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dumb`
--
ALTER TABLE `dumb`
  ADD CONSTRAINT `dumb_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_materi_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submateri`
--
ALTER TABLE `submateri`
  ADD CONSTRAINT `submateri_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

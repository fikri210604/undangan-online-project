-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2025 at 12:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_akhir_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(2, 'ppp', 'mantap banget', 'galeri_1750280843.jpg'),
(3, 'Pacaran 2025', 'mantapp', 'galeri_1750281050.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `status` enum('hadir','tidak','belum konfirmasi') DEFAULT 'belum konfirmasi',
  `waktu_konfirmasi` datetime DEFAULT NULL,
  `nomor_kursi` int DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `kode_unik` varchar(13) NOT NULL,
  `whishes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id`, `user_id`, `status`, `waktu_konfirmasi`, `nomor_kursi`, `qr_code_path`, `pdf_path`, `kode_unik`, `whishes`) VALUES
(5, 16, 'hadir', '2025-06-12 19:06:13', 198, '../public/qr-code/198.png', '../public/undangan_pdf/undangan_kursi_198.pdf', 'TAMU-FAN-6053', 'Selamat nikah'),
(6, 4, 'hadir', '2025-06-12 20:13:19', 290, '../public/qr-code/290.png', '../public/undangan_pdf/undangan_kursi_290.pdf', 'TAMU-AHM-7655', 'selamat bangggg'),
(7, 28, 'hadir', '2025-06-18 23:51:26', 84, '../public/qr-code/84.png', '../public/undangan_pdf/undangan_kursi_84.pdf', 'TAMU-B80EAC', 'Selamat nikah');

-- --------------------------------------------------------

--
-- Table structure for table `ucapan`
--

CREATE TABLE `ucapan` (
  `id` int NOT NULL,
  `konfirmasi_id` int DEFAULT NULL,
  `ucapan` text,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=geostd8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','tamu') DEFAULT NULL,
  `kode_unik` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `kode_unik`, `alamat`) VALUES
(4, 'Ahmad Fikri Hanif', 'afh.fikri2106@gmail.com', '$2y$10$SbVGSShbTVCffvC3rzRUq.rZa1Nv.jxFTI8NgwdBQK2kfZ25Szw56', 'tamu', 'TAMU-AHM-7655', 'Kedaton'),
(5, 'admin', 'admin@example.com', '$2y$10$bLU8cJoofVfUMwzkQiPkb.nzpvAEtgeWxdbvFsbTmrw58M2ZoX/b.', 'admin', NULL, NULL),
(8, 'Intan Nur Laila', 'intan@gmail.com', '$2y$10$1njxFXCQMCPXprlntaahqeAT3KsMuP4ueyBAB3AGiY/5OEZelEwmK', 'tamu', 'TAMU-INT-6135', 'Pahoman'),
(9, 'Muhammad Alvin', 'alvin@gmail.com', '$2y$10$7pQFNYO/3kWO56ubaHIgvO0eVlQJOMQnfR6dqvE2yrVN3GUOlph6W', 'tamu', 'TAMU-MUH-6396', 'Kemiling'),
(10, 'Rahayu Indah Lestari', 'rahayu@gmail.com', '$2y$10$a.DlqB5HrrwXSZtrxuIui.oq5uziUz2M1YrzX40JpKt.qe5sZ7Y5G', 'tamu', 'TAMU-RAH-7499', 'Kemiling'),
(11, 'Anindita Tri Mulya', 'anindita@gmail.com', '$2y$10$NBrv6XuV0i3R/nCsToBqsuhSHqlfP9ExyAgx6/gkbDVByOThLTZYS', 'tamu', 'TAMU-ANI-6429', 'Tegineneng'),
(12, 'Syauqi Rahmat', 'sukiimat@gmail.com', '$2y$10$hktjoRl22KjScVtRXUx5Gu.UNebAcy4GxtGDQ5sOE12gIpxzXGP2m', 'tamu', 'TAMU-SYA-1608', 'Sukarame'),
(13, 'Rizky Kurnia Antasari', 'rizkur@gmail.com', '$2y$10$7VxwTX6iO8tpc74Ca2xPiOAJ.VnCD./C0UuYMgpwTrQFcgdD1vP4C', 'tamu', 'TAMU-RIZ-2303', 'Kedaton'),
(14, 'Samuel Ananta Sinulingga', 'samuel@gmail.com', '$2y$10$2SYOeluiYEu/6kYW/L2EXOL7w7Lk3mgfGmvNtkoWBiDvDyVouyv96', 'tamu', 'TAMU-SAM-7196', 'Way Halim'),
(15, 'M. Riski P', 'riskip@gmail.com', '$2y$10$hXL0v5i02keJO97ZPv/JuuikXCbl5pBWalkxyeoUZFVqPeqYbKrXK', 'tamu', 'TAMU-M. -3048', 'Pahoman'),
(16, 'Fandri Albara', 'fandri@gmail.com', '$2y$10$e5bbbPBoIHxYBZed2MUuIufvjOwSlpzEDYG4ffZwvGh9XzMrGVJke', 'tamu', 'TAMU-FAN-6053', 'Rajabasa'),
(17, 'Ghiyo Co', 'giyo@gmail.com', '$2y$10$3h4fiN76mEGZ6Pw2xrNeHucy8Wys4y2WuDLjixwj1VfftS6D7XUhO', 'tamu', 'TAMU-GHI-1898', 'Kedaton'),
(18, 'Edi Suratno', 'edisuratmin@gmail.com', '$2y$10$4g9jBd9T1vyKj0RhNSXYGedAqwddcbTlEGlUusc/smGyRquEdHHEa', 'tamu', 'TAMU-EDI-7113', 'Kedaton'),
(20, 'Eka Sukamto', 'ekaeer@gmail.com', '$2y$10$hJIWo4NPrHXaRxSt0RCmoOIsm4.2ZLkiMgaXUO84c7mWNH3OXdmK2', 'tamu', 'TAMU-EKA-4754', 'Rajabasa'),
(24, 'Erika Carlina', 'erii@gmail.com', NULL, 'tamu', 'TAMU-Erika Carlina-9979', 'Rajabasa'),
(27, 'Edi Sukamto', 'edisuratminn@gmail.com', '$2y$10$ux3SFGJJkMihpaN2Ha5yRu6JBngBkhbKKx3u/HPJ9TDi02CyI/bFm', 'tamu', 'TAMU-EEE051', 'Kedaton'),
(28, 'Ahmad Hanif', '2317051061@students.unila.ac.id', '$2y$10$.vXatEnGrdVt9Bb/uV/24eLma7zKpbvVZ3gj9DkwfqqgfCWhqCBY2', 'tamu', 'TAMU-B80EAC', 'Kedaton');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_kursi` (`nomor_kursi`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ucapan`
--
ALTER TABLE `ucapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konfirmasi_id` (`konfirmasi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ucapan`
--
ALTER TABLE `ucapan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `konfirmasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ucapan`
--
ALTER TABLE `ucapan`
  ADD CONSTRAINT `ucapan_ibfk_1` FOREIGN KEY (`konfirmasi_id`) REFERENCES `konfirmasi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

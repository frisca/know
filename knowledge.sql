-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Apr 2020 pada 09.13
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowledge`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id_comment` bigint(20) NOT NULL,
  `id_project` bigint(20) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` bigint(20) NOT NULL,
  `nama_product` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `nama_product`, `created_date`, `updated_date`, `description`) VALUES
(1, 'Hotel', '2020-03-27', '0000-00-00', 'Product ini mengenai tempat hotel yang disediakan oleh sistem.'),
(2, 'Tiket Pesawat', '2020-03-28', '0000-00-00', 'Product ini mengenai pembuatan untuk sistem website atau aplikasi penjualan tiket pesawat.'),
(3, 'Hotel1', '2020-04-26', '0000-00-00', 'testing'),
(4, 'Hotel3', '2020-04-26', '0000-00-00', 'testing'),
(5, 'Hotel4', '2020-04-26', '0000-00-00', 'Hotel4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id_project` bigint(20) NOT NULL,
  `nama_project` varchar(200) NOT NULL,
  `description` varchar(60000) NOT NULL,
  `id_product` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `release` varchar(10) DEFAULT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `team` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `team`, `position`, `role`, `created_date`, `updated_date`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin1', 'admin@gmail.com', 'IT', 'Admin', 1, '2020-01-26', '2020-02-20'),
(3, 'staff', 'e10adc3949ba59abbe56e057f20f883e', 'stafff', 'staff@gmail.com', 'IT', 'Non Supervisor', 3, '2020-02-27', '2020-04-29'),
(4, 'supervisor', '827ccb0eea8a706c4c34a16891f84e7b', 'supervisor', 'supervisor@gmail.com', 'IT', 'Supervisor', 2, '2020-03-23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id_project` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

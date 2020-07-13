-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 Jul 2020 pada 12.11
-- Versi Server: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keretatry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(50) DEFAULT NULL,
  `password_admin` varchar(200) DEFAULT NULL,
  `token_admin` varchar(200) DEFAULT NULL,
  `token_expired_admin` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `token_admin`, `token_expired_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$PJNOmdtcvJMImRH9CHcKUOqS7sf7NVRK1co4aiqnrYcODJITkRI3u', '118dbfdcf0044c8403abbc610b16ab05', '2020-07-20', '2019-12-09 17:57:51', '2020-07-13 04:07:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_transaksi`
--

CREATE TABLE `item_transaksi` (
  `id_item_transaksi` int(11) NOT NULL,
  `id_kereta` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `total_item_transaksi` int(11) DEFAULT NULL,
  `harga_item_transaksi` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_transaksi`
--

INSERT INTO `item_transaksi` (`id_item_transaksi`, `id_kereta`, `id_pelanggan`, `id_transaksi`, `total_item_transaksi`, `harga_item_transaksi`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 1, 150000, '2019-12-11 15:40:44', '2019-12-11 15:40:44'),
(2, 1, 6, 1, 2, 150000, '2019-12-11 15:40:44', '2019-12-11 15:40:44'),
(3, 3, 6, 2, 1, 210000, '2019-12-11 15:41:32', '2019-12-12 04:51:04'),
(4, 2, 5, 3, 1, 230000, '2019-12-12 04:28:25', '2019-12-12 04:50:54'),
(5, 1, 10, 4, 1, 150000, '2019-12-12 04:29:22', '2019-12-12 04:51:11'),
(6, 1, 11, 5, 150000, 0, '2019-12-12 05:05:04', '2019-12-12 05:05:04'),
(7, 11, 7, 6, 880000, 0, '2020-07-09 03:33:01', '2020-07-09 03:33:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kereta`
--

CREATE TABLE `kereta` (
  `id_kereta` int(11) NOT NULL,
  `nama_kereta` varchar(150) DEFAULT NULL,
  `kelas` varchar(200) DEFAULT NULL,
  `gerbong` int(11) DEFAULT NULL,
  `tgl_berangkat` date DEFAULT NULL,
  `asal` varchar(200) DEFAULT NULL,
  `tujuan` varchar(200) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kereta`
--

INSERT INTO `kereta` (`id_kereta`, `nama_kereta`, `kelas`, `gerbong`, `tgl_berangkat`, `asal`, `tujuan`, `harga`, `create_at`, `update_at`) VALUES
(1, 'Kahuripan', 'Ekonomi AC ', 11, '2019-11-11', 'Banyuwangi', 'Bandung', 150000, '2019-11-17 07:33:05', '2019-11-25 07:42:06'),
(2, 'Sancaka', 'Eksekutif', 9, '2019-12-19', 'Surabaya', 'Yogyakarta', 230000, '2019-11-17 07:40:40', '2019-11-17 07:40:40'),
(3, 'Lodaya', 'Eksekutif', 11, '2019-11-19', 'Solo', 'Surabaya', 210000, '2019-11-17 14:01:23', '2019-11-19 07:29:24'),
(9, 'Senja Utama', 'Eksekutif', 7, '2019-12-28', 'Jakarta', 'Yogyakarta', 350000, '2019-11-25 19:09:40', '2019-12-10 07:21:25'),
(11, 'Argo Bromo Anggrek Luxury', 'Bisnis', 12, '2020-10-10', 'Gambir', 'Surabaya Gubeng', 880000, '2020-07-09 02:02:13', '2020-07-09 03:32:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(200) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_tlpn` char(13) DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jk`, `alamat`, `no_tlpn`, `gambar`, `create_at`, `update_at`) VALUES
(5, 'Kloop', 'Laki-laki', 'Yogyakarta', '0812387621', '60a82ab0a285ef4f599f1e0077572c53.jpg', '2019-11-25 19:22:00', '2019-12-11 16:03:43'),
(6, 'Juergen', 'Laki-laki', 'Berbah', '0821327651', '3102bae966f68df83b76b196cf997abf.jpg', '2019-11-25 19:32:29', '2019-12-11 16:03:50'),
(7, 'Prabowowati', 'Perempuan', 'Bali', '089123882371', 'fbc5189e77006332062ffac703b48e6f.jpg', '2019-11-25 19:34:02', '2019-12-10 08:26:30'),
(8, 'Prabowo', 'Laki-laki', 'Bantul', '0891238823', '8826b0267a5e7ebcec48fed275aebcd2.jpg', '2019-11-25 20:32:01', '2019-12-10 08:27:08'),
(10, 'Jhon', 'Laki-laki', 'Solo', '0813423381', '5b6526da9704d8b71d3f4950d9dc5a2a.jpg', '2019-12-08 15:58:00', '2019-12-11 16:03:57'),
(11, 'Tabita', 'Perempuan', 'Berbah', '08132137675', '8f9021c984d2b27ce55bdfbe8c457d32.jpg', '2019-12-09 14:15:05', '2019-12-10 08:25:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_transaksi` varchar(200) DEFAULT NULL,
  `nomor` int(4) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `nomor`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
(1, 'TRX/2019/12/0001', 1, '2019-12-11', '2019-12-11 15:40:44', '2019-12-11 15:40:44'),
(2, 'TRX/2019/12/0002', 2, '2019-12-11', '2019-12-11 15:41:32', '2019-12-11 15:41:32'),
(3, 'TRX/2019/12/0003', 3, '2019-12-12', '2019-12-12 04:28:24', '2019-12-12 04:28:24'),
(4, 'TRX/2019/12/0004', 4, '2019-12-12', '2019-12-12 04:29:22', '2019-12-12 04:29:22'),
(5, 'TRX/2019/12/0005', 5, '2019-12-12', '2019-12-12 05:05:04', '2019-12-12 05:05:04'),
(6, 'TRX/2020/07/0001', 1, '2020-07-09', '2020-07-09 03:33:01', '2020-07-09 03:33:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username_user` varchar(100) NOT NULL,
  `password_user` varchar(100) NOT NULL,
  `token_user` varchar(100) DEFAULT NULL,
  `token_expired_user` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username_user`, `password_user`, `token_user`, `token_expired_user`, `create_at`, `update_at`) VALUES
(1, 'admin', '$2y$10$ArLZSTGjgsw6fGS/Xks9Zu48UgOzX8Y/KIGJuHn45ufBPMFrwgvEa', 'c3e42d256f0540b91ac40b2d8dd934f1', '2019-12-18', '2019-11-17 07:23:14', '2019-12-11 15:13:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD PRIMARY KEY (`id_item_transaksi`),
  ADD KEY `id_kereta` (`id_kereta`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`id_kereta`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  MODIFY `id_item_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kereta`
--
ALTER TABLE `kereta`
  MODIFY `id_kereta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD CONSTRAINT `item_transaksi_ibfk_1` FOREIGN KEY (`id_kereta`) REFERENCES `kereta` (`id_kereta`),
  ADD CONSTRAINT `item_transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `item_transaksi_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

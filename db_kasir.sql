-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2023 pada 10.15
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `tgl_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`idlaporan`, `invoice`, `kode_produk`, `nama_produk`, `harga`, `qty`, `subtotal`, `bayar`, `kembalian`, `tgl_input`) VALUES
(1, 'AD21123185458', 'brg-002', 'Mentega', 8000, 1, 8000, 20000, 5000, '2023-01-21 18:54:03'),
(2, 'AD21123185458', 'brg-006', 'Tepung tapioka', 7000, 1, 7000, 20000, 5000, '2023-01-21 18:54:10'),
(3, 'AD21123185558', 'brg-002', 'Mentega', 8000, 1, 8000, 20000, 5000, '2023-01-21 18:55:17'),
(4, 'AD21123185558', 'brg-008', 'Susu Kaleng', 7000, 1, 7000, 20000, 5000, '2023-01-21 18:55:24'),
(5, 'AD21123190358', 'brg-002', 'Mentega', 8000, 3, 24000, 25000, 1000, '2023-01-21 19:03:53'),
(6, 'AD21123190958', 'brg-003', 'Garam', 1500, 1, 1500, 0, 0, '2023-01-21 19:09:09'),
(7, 'AD2812323802', 'brg-002', 'Mentega', 8000, 1, 8000, 20000, 2000, '2023-01-28 02:38:12'),
(8, 'AD2812323802', 'nasi-grg1', 'nasi goreng level 1', 10000, 1, 10000, 20000, 2000, '2023-01-28 02:38:20'),
(9, 'AD28123151601', 'jus-alpukat', 'jus alpukat', 10000, 1, 10000, 20000, 10000, '2023-01-28 15:16:32'),
(10, 'AD21123192758', 'brg-002', 'Mentega', 8000, 1, 8000, 10000, 2000, '2023-01-21 19:27:42'),
(11, 'AD21123193458', 'brg-002', 'Mentega', 8000, 1, 8000, 20000, 10000, '2023-01-21 19:34:26'),
(12, 'AD21123193458', 'brg-009', 'Telur', 2000, 1, 2000, 20000, 10000, '2023-01-21 19:34:33'),
(14, 'AD2812331814', 'brg-002', 'Mentega', 8000, 1, 8000, 20000, 12000, '2023-01-28 03:18:52'),
(15, 'AD2812331919', 'brg-001', 'Kecap', 5000, 1, 5000, 20000, 15000, '2023-01-28 03:19:09'),
(16, 'AD22123200501', 'brg-003', 'Garam', 1500, 1, 1500, 20000, 8500, '2023-01-22 20:05:55'),
(17, 'AD22123200501', 'brg-007', 'Saos tomat', 5000, 2, 10000, 20000, 8500, '2023-01-22 20:06:11'),
(18, 'AD2812332020', 'brg-002', 'Mentega', 8000, 1, 8000, 20000, 12000, '2023-01-28 03:20:27'),
(19, 'AD2812332021', 'nasi-grg1', 'nasi goreng level 1', 10000, 1, 10000, 20000, 10000, '2023-01-28 03:20:53'),
(20, 'AD2812332121', 'brg-002', 'Mentega', 8000, 1, 8000, 50000, 27000, '2023-01-28 03:21:07'),
(21, 'AD2812332121', 'brg-001', 'Kecap', 5000, 1, 5000, 50000, 27000, '2023-01-28 03:21:13'),
(22, 'AD2812332121', 'nasi-grg1', 'nasi goreng level 1', 10000, 1, 10000, 50000, 27000, '2023-01-28 03:21:20'),
(33, 'AD21123182258', 'brg-002', 'Mentega', 8000, 1, 8000, 10000, 2000, '2023-01-21 18:22:35'),
(34, 'AD28123152201', 'esteh', 'es teh', 5000, 1, 5000, 10000, 5000, '2023-01-28 15:22:24'),
(35, 'AD28123152301', 'jus-mangga', 'jus mangga', 10000, 1, 10000, 20000, 10000, '2023-01-28 15:23:45'),
(36, 'AD28123152401', 'c-coklat', 'corndog coklat', 5000, 1, 5000, 50000, 10000, '2023-01-28 15:24:34'),
(37, 'AD28123152401', 'esteh', 'es teh', 5000, 1, 5000, 50000, 10000, '2023-01-28 15:24:40'),
(38, 'AD28123152401', 'nasi-grg3', 'nasi goreng spesial', 15000, 2, 30000, 50000, 10000, '2023-01-28 15:24:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `toko` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`userid`, `username`, `password`, `toko`, `alamat`, `telepon`, `logo`) VALUES
(1, 'Zilfi', '$2y$10$WBzuunQMiAMnmkJSkFydK./8rabJcXj6ieOVhUPL6TgupRkefHyIK', 'SimPay', 'Gowa - Sulawesi Selatan', '082261198158', 'admin.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `kode_produk`, `nama_produk`, `harga_jual`, `tgl_input`) VALUES
(1, 'nasi-grg1', 'nasi goreng level 1', 12000, '2023-01-27 19:34:01'),
(2, 'nasi-grg2', 'nasi goreng level 2', 12000, '2023-01-27 19:34:13'),
(3, 'nasi-grg3', 'nasi goreng spesial', 15000, '2023-01-27 19:34:58'),
(4, 'esteh', 'es teh', 5000, '2023-01-27 19:35:46'),
(5, 'jus-alpukat', 'jus alpukat', 10000, '2023-01-27 19:38:37'),
(6, 'jus-mangga', 'jus mangga', 10000, '2023-01-27 19:37:58'),
(7, 'jus-apel', 'jus apel', 10000, '2023-01-27 19:38:31'),
(8, 'milk-tea', 'milk tea', 10000, '2023-01-27 19:42:43'),
(9, 'c-coklat', 'corndog coklat', 5000, '2023-01-27 19:44:46'),
(10, 'c-tiramisu', 'corndog tiramisu', 5000, '2023-01-27 19:44:41'),
(11, 'c-greentea', 'corndog greentea', 5000, '2023-01-27 19:45:09'),
(12, 'c-ori', 'corndog original', 5000, '2023-01-27 19:45:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

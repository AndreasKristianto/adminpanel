-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2024 pada 00.18
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `counter`
--

CREATE TABLE `counter` (
  `id` int(8) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `counter` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `counter`
--

INSERT INTO `counter` (`id`, `bulan`, `tahun`, `counter`) VALUES
(1, 4, 2024, '1'),
(2, 4, 2024, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_customer`
--

CREATE TABLE `ms_customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_customer`
--

INSERT INTO `ms_customer` (`id_customer`, `nama`, `alamat`, `phone`) VALUES
(1, 'Customer A', 'Searang', '123456732156'),
(2, 'Customer B', 'Surabaya', '21454375355');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_d`
--

CREATE TABLE `transaksi_d` (
  `id` int(10) NOT NULL,
  `id_transaksi_h` int(10) NOT NULL,
  `kd_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `subtotal` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_h`
--

CREATE TABLE `transaksi_h` (
  `id` int(10) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `nomer_transaksi` varchar(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_h`
--

INSERT INTO `transaksi_h` (`id`, `id_customer`, `nomer_transaksi`, `tanggal_transaksi`, `total_transaksi`) VALUES
(1, 1, 'SO/2024-04/0001', '2024-04-01', 300000),
(2, 2, 'SO/2024-04/0002', '2024-04-01', 200000),
(3, 4, 'SO/2024-08/0001', '2024-08-06', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_customer`
--
ALTER TABLE `ms_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `transaksi_d`
--
ALTER TABLE `transaksi_d`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_h`
--
ALTER TABLE `transaksi_h`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ms_customer`
--
ALTER TABLE `ms_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_d`
--
ALTER TABLE `transaksi_d`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_h`
--
ALTER TABLE `transaksi_h`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

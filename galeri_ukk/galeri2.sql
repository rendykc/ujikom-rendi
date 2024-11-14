-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Nov 2024 pada 07.45
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `username`, `email`, `password`) VALUES
(1, 'hakii', 'bobi@gamil.com', '$2y$10$7noFLJg0O3k1KaIUdywQj.50EzLjeKNAPzf016ggyBWhkWFumReLm'),
(2, 'hakiki', 'dodo.@yahoo.com', '$2y$10$FTpyCY.Y7b/Rrfz4Y/0tPehqzYMqIieO0S1fUPWFo4Ut3xdEl5Kly'),
(3, 'mursidil', 'dodo.@yahoo.com', '$2y$10$IkZPQi9IZru/1qEX9x/CNu8m0CRcw5D8WuQ4zXFeTD0OSm2c47BvG'),
(4, 'admin', 'admin@gmail.com', 'admin'),
(5, 'rendy', 'rendy@gmail.com', '$2y$10$xQXWG2b0E0EZPp/aLVedfOsj4EMUBrPLROqAfWhkvJ/OjGcOwV2Va'),
(6, 'wapahyupu', 'wahyu@gmail.com', '$2y$10$n6yus/jFgu.PInoi2aCAeurCGXoPUvikwuBrm.hGyOxbzfLQAhxZ2'),
(7, 'rehan', 'dfsgd@gmail.com', '$2y$10$/uU38nwtdaXBeTVVqXvtGuwhqTAUDRcGk5O5ve93IEinhOvIbDUKK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `albumfoto`
--

CREATE TABLE `albumfoto` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `albumfoto`
--

INSERT INTO `albumfoto` (`id`, `foto`, `judul`, `deskripsi`) VALUES
(14, 'voly.jpeg', 'bermain volly', 'tO'),
(16, '67298ae1d668c.jpg', 'rubah', 'hahahahh                    '),
(17, '6729cb1457308.jpg', 'THE REAL GOAT', 'THE REAL GOAT Antony, Mudrk, Marmut Uruguay'),
(18, '672acdc87e688.jpg', 'TRIO BARCA', 'TRIO CECENET TRIO PALING BAPUK!!!!!!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_foto` int(11) DEFAULT NULL,
  `komentar` text,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `id_foto`, `komentar`, `tanggal`) VALUES
(6, 14, 'anjay', '2024-11-06 00:48:40'),
(19, 14, 'keren', '2024-11-06 01:36:57'),
(20, 14, 'keren', '2024-11-06 01:42:38'),
(21, 16, 'imut', '2024-11-06 01:59:33'),
(22, 16, 'imut', '2024-11-06 01:59:42'),
(23, 17, 'god', '2024-11-06 05:12:23'),
(24, 17, 'god', '2024-11-06 06:19:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `like`
--

CREATE TABLE `like` (
  `fotoid` int(255) DEFAULT NULL,
  `userid` int(255) DEFAULT NULL,
  `tanggallike` date NOT NULL,
  `likeid` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albumfoto`
--
ALTER TABLE `albumfoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_foto` (`id_foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `albumfoto`
--
ALTER TABLE `albumfoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_foto`) REFERENCES `albumfoto` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

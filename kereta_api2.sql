-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2023 pada 11.10
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kereta_api2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gerbong`
--

CREATE TABLE `gerbong` (
  `id_gerbong` char(10) NOT NULL,
  `kelas_gerbong` enum('EKSEKUTIF','BISNIS','EKONOMI') NOT NULL,
  `kode_gerbong` varchar(5) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `id_kereta` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gerbong`
--

INSERT INTO `gerbong` (`id_gerbong`, `kelas_gerbong`, `kode_gerbong`, `kapasitas`, `id_kereta`) VALUES
('GB00010', 'EKSEKUTIF', 'A1', 30, 'KAI0001'),
('GB00011', 'BISNIS', 'B1', 40, 'KAI0001'),
('GB00012', 'EKONOMI', 'Q1', 100, 'KAI0001'),
('GB00020', 'EKSEKUTIF', 'A1', 20, 'KAI0002'),
('GB00022', 'EKSEKUTIF', 'A2', 40, 'KAI0002'),
('GB00023', 'EKSEKUTIF', 'AC', 50, 'KAI0002'),
('GB0081', 'EKSEKUTIF', 'A', 40, 'KAI0008'),
('GB0082', 'EKONOMI', 'QA', 80, 'KAI0008'),
('GB0083', 'EKONOMI', 'QB', 80, 'KAI0008');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_gerbong` char(10) NOT NULL,
  `stasiun_awal` varchar(30) NOT NULL,
  `stasiun_tujuan` varchar(30) NOT NULL,
  `kedatangan` char(5) NOT NULL,
  `keberangkatan` char(5) NOT NULL,
  `harga_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_gerbong`, `stasiun_awal`, `stasiun_tujuan`, `kedatangan`, `keberangkatan`, `harga_tiket`) VALUES
(1, 'GB0081', 'Manggarai', 'Cirebon', '03:00', '04:00', 45000),
(2, 'GB0082', 'Manggarai', 'Semarang', '04:00', '07:00', 345000),
(3, 'GB0081', 'Cirebon', 'Semarang', '08:00', '10:00', 124000),
(4, 'GB0081', 'Manggarai', 'Cirebon', '03:00', '04:00', 60000),
(5, 'GB0082', 'Manggarai', 'Cirebon', '03:00', '04:00', 45000),
(25, 'GB00010', 'Manggarai', 'Semarang', '17:00', '08:00', 565000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kereta`
--

CREATE TABLE `kereta` (
  `id_kereta` char(10) NOT NULL,
  `nama_kereta` varchar(30) NOT NULL,
  `gerbong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kereta`
--

INSERT INTO `kereta` (`id_kereta`, `nama_kereta`, `gerbong`) VALUES
('KAI0001', 'Mountain Smasher', 3),
('KAI0002', 'Isengard Ryokugyu', 3),
('KAI0008', 'HarjaMukti', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penumpang`
--

CREATE TABLE `penumpang` (
  `id_penumpang` char(10) NOT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `gender` char(10) NOT NULL,
  `no_tlp` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `nama_penumpang`, `email`, `alamat`, `gender`, `no_tlp`) VALUES
('111', 'iman', '20200810094@uniku.ac.id', 'Cengal', 'MR', '085220332889'),
('123', 'Iman Nurohman', '20200810024@uniku.ac.id', 'Cengal', 'MR', '085220332889'),
('USER0001', 'iman', '', 'cengal', 'L', '09876533'),
('USER0003', 'rangga', '', 'salareuma', 'L', '7865'),
('USER0004', 'sarutobi sasuke', '', 'desa daun tersembunyi, di dekat rumah kasuga', 'L', '09876543');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi2`
--

CREATE TABLE `reservasi2` (
  `id_reservasi` varchar(20) NOT NULL,
  `id_penumpang` varchar(20) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tgl_berangkat` date DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `status_bayar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reservasi2`
--

INSERT INTO `reservasi2` (`id_reservasi`, `id_penumpang`, `id_jadwal`, `tgl_berangkat`, `tgl_pesan`, `status_bayar`) VALUES
('dwdsdsw', '111', 1, '2022-08-24', '2022-08-24', 'sudah'),
('RSV09209', '123', 1, '2022-08-25', '2022-08-25', 'sudah'),
('RSV6a4a6', '123', 1, '2022-09-26', '2022-09-26', 'sudah'),
('RSV6b216', '111', 1, '2022-08-25', '2022-08-25', 'sudah'),
('RSV74220', '123', 4, '0000-00-00', '0000-00-00', 'belum'),
('RSV854b1', '123', 1, '2022-08-25', '2022-08-25', 'sudah'),
('RSV86926', '111', 1, '2022-08-25', '2022-08-25', 'sudah'),
('RSV96182', '123', 1, '0000-00-00', '0000-00-00', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stasiun`
--

CREATE TABLE `stasiun` (
  `id_stasiun` char(10) NOT NULL,
  `nama_stasiun` varchar(30) NOT NULL,
  `Kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stasiun`
--

INSERT INTO `stasiun` (`id_stasiun`, `nama_stasiun`, `Kota`) VALUES
('ST0001', 'Manggarai', 'Jakarta'),
('ST0002', 'Sedayu', 'Podomoro'),
('ST0003', 'Cirebon', 'crb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` char(10) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_reservasi` char(10) NOT NULL,
  `no_kursi` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_jadwal`, `id_reservasi`, `no_kursi`) VALUES
('TKT01', 1, 'RSV74220', 'EKS1:A10'),
('TKT10280', 1, 'RSV09209', 'EKS2 : A2'),
('TKT13478', 1, 'RSV854b1', 'EKS2 : A2'),
('TKT4b440', 1, 'RSV6a4a6', 'EKS2 : A2'),
('TKTab593', 1, 'RSV6b216', 'EKS2 : A2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_reservasi` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_bayar`, `jumlah`, `total_bayar`, `id_reservasi`) VALUES
('TRX18a57', '2022-08-25', 1, 45000, 'RSV09209'),
('TRX330ba', '2022-08-25', 1, 45000, 'RSV86926'),
('TRX535b4', '2022-09-26', 1, 45000, 'RSV6a4a6'),
('TRX717b2', '2022-08-25', 1, 45000, 'RSV6b216'),
('TRX75686', '2022-08-25', 1, 45000, 'RSV854b1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('USER','ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'iman', '111', 'USER'),
(2, 'ran-chan', '123', 'ADMIN'),
(3, 'sasuke', '111', 'USER'),
(897, 'iman', '123', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gerbong`
--
ALTER TABLE `gerbong`
  ADD PRIMARY KEY (`id_gerbong`),
  ADD KEY `fk kert` (`id_kereta`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_gerbong` (`id_gerbong`);

--
-- Indeks untuk tabel `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`id_kereta`);

--
-- Indeks untuk tabel `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id_penumpang`);

--
-- Indeks untuk tabel `reservasi2`
--
ALTER TABLE `reservasi2`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `fk c` (`id_penumpang`),
  ADD KEY `fk su` (`id_jadwal`);

--
-- Indeks untuk tabel `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`id_stasiun`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`) USING BTREE,
  ADD KEY `fk reserver` (`id_reservasi`),
  ADD KEY `fk jadual` (`id_jadwal`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk rsv` (`id_reservasi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=899;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gerbong`
--
ALTER TABLE `gerbong`
  ADD CONSTRAINT `fk kert` FOREIGN KEY (`id_kereta`) REFERENCES `kereta` (`id_kereta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_gerbong` FOREIGN KEY (`id_gerbong`) REFERENCES `gerbong` (`id_gerbong`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservasi2`
--
ALTER TABLE `reservasi2`
  ADD CONSTRAINT `fk c` FOREIGN KEY (`id_penumpang`) REFERENCES `penumpang` (`id_penumpang`),
  ADD CONSTRAINT `fk su` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`);

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `fk jadual` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`),
  ADD CONSTRAINT `fk reserver` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi2` (`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk rsv` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi2` (`id_reservasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Agu 2024 pada 11.13
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfo_service`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('CS','Teknisi','Sparepart','Manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`, `hak_akses`) VALUES
(1, 'Abdul Malik', 'malik', '6c34fd5b51dcdd56ad9204c67209d6b5', '855297219_355188d1566f53e93170278340635b6f.jpg', 'Manager'),
(2, 'M. Khanifan', 'cs', '95cc64dd2825f9df13ec4ad683ecf339', NULL, 'CS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_reparasi`
--

CREATE TABLE `detail_reparasi` (
  `id_detailreparasi` int(11) NOT NULL,
  `reparasi` varchar(25) NOT NULL,
  `barang` text NOT NULL,
  `kerusakan` text NOT NULL,
  `kelengkapan` text NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `detail_reparasi`
--

INSERT INTO `detail_reparasi` (`id_detailreparasi`, `reparasi`, `barang`, `kerusakan`, `kelengkapan`, `qty`) VALUES
(18, 'SV202408001', 'tv led 32\" polytron', 'layar mati', 'unit saja', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(255) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jasa`
--

INSERT INTO `jasa` (`id_jasa`, `nama_jasa`, `harga_jasa`, `jenis`) VALUES
(1, 'Service Ringan', 100000, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `kategori`, `nama_jenis`) VALUES
(2, 2, 'Led TV'),
(3, 2, 'Smart TV'),
(4, 3, 'Home Theater'),
(5, 3, 'Soundbar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Televisi (Display Panel)'),
(3, 'Home Audio');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_pelanggan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hp_pelanggan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_pelanggan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password_pelanggan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email_pelanggan`, `hp_pelanggan`, `alamat_pelanggan`, `password_pelanggan`) VALUES
(1, 'Malik Abdul', 'malik@gmail.com', '081222333444', 'Kaliwungu Kota Kudus', '6c34fd5b51dcdd56ad9204c67209d6b5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reparasi`
--

CREATE TABLE `reparasi` (
  `id_reparasi` varchar(25) NOT NULL,
  `tgl_reparasi` date NOT NULL,
  `pelanggan` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `status` enum('Diproses','Selesai','Batal','Dibayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `reparasi`
--

INSERT INTO `reparasi` (`id_reparasi`, `tgl_reparasi`, `pelanggan`, `admin`, `status`) VALUES
('SV202408001', '2024-08-08', 1, 1, 'Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepart`
--

CREATE TABLE `sparepart` (
  `id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `harga_sparepart` int(11) NOT NULL,
  `jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `sparepart`
--

INSERT INTO `sparepart` (`id_sparepart`, `nama_sparepart`, `harga_sparepart`, `jenis`) VALUES
(1, 'BACKLIGHT TV LED POLYTRON 24 INCH PLD 24D900-PLD24D123-PLD24D810-PLD24D800-PLD24D123E-PLD24D1852-PLD24D9500', 50000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(25) NOT NULL,
  `id_reparasi` varchar(25) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `pelanggan` varchar(255) NOT NULL,
  `jumlah_total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `ket` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_reparasi`, `tgl_bayar`, `pelanggan`, `jumlah_total`, `bayar`, `kembalian`, `admin_id`, `ket`) VALUES
('TR202408001', 'SV202408001', '2024-08-08', 'Malik Abdul', 150000, 200000, 50000, 1, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_jasa`
--

CREATE TABLE `transaksi_jasa` (
  `id_transaksi` varchar(25) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(255) NOT NULL,
  `id_reparasi` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi_jasa`
--

INSERT INTO `transaksi_jasa` (`id_transaksi`, `id_jasa`, `nama_jasa`, `id_reparasi`, `harga`, `qty`, `sub_total`) VALUES
('TR202408001', 1, 'Service Ringan', 'SV202408001', 100000, 1, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sparepart`
--

CREATE TABLE `transaksi_sparepart` (
  `id_transaksi` varchar(25) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `id_reparasi` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi_sparepart`
--

INSERT INTO `transaksi_sparepart` (`id_transaksi`, `id_sparepart`, `nama_sparepart`, `id_reparasi`, `harga`, `qty`, `sub_total`) VALUES
('TR202408001', 1, 'BACKLIGHT TV LED POLYTRON 24 INCH PLD 24D900-PLD24D123-PLD24D810-PLD24D800-PLD24D123E-PLD24D1852-PLD24D9500', 'SV202408001', 50000, 1, 50000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `detail_reparasi`
--
ALTER TABLE `detail_reparasi`
  ADD PRIMARY KEY (`id_detailreparasi`);

--
-- Indeks untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`),
  ADD KEY `jenis` (`jenis`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `reparasi`
--
ALTER TABLE `reparasi`
  ADD PRIMARY KEY (`id_reparasi`),
  ADD KEY `pelanggan` (`pelanggan`),
  ADD KEY `admin` (`admin`);

--
-- Indeks untuk tabel `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`id_sparepart`),
  ADD KEY `jenis` (`jenis`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_admin` (`admin_id`),
  ADD KEY `id_servis` (`id_reparasi`);

--
-- Indeks untuk tabel `transaksi_jasa`
--
ALTER TABLE `transaksi_jasa`
  ADD KEY `id_jasa` (`id_jasa`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_reparasi` (`id_reparasi`);

--
-- Indeks untuk tabel `transaksi_sparepart`
--
ALTER TABLE `transaksi_sparepart`
  ADD KEY `id_sparepart` (`id_sparepart`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_reparasi` (`id_reparasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_reparasi`
--
ALTER TABLE `detail_reparasi`
  MODIFY `id_detailreparasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sparepart`
--
ALTER TABLE `sparepart`
  MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD CONSTRAINT `jasa_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD CONSTRAINT `jenis_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reparasi`
--
ALTER TABLE `reparasi`
  ADD CONSTRAINT `reparasi_ibfk_1` FOREIGN KEY (`pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reparasi_ibfk_2` FOREIGN KEY (`admin`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sparepart`
--
ALTER TABLE `sparepart`
  ADD CONSTRAINT `sparepart_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_reparasi`) REFERENCES `reparasi` (`id_reparasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_jasa`
--
ALTER TABLE `transaksi_jasa`
  ADD CONSTRAINT `transaksi_jasa_ibfk_1` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id_jasa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_jasa_ibfk_2` FOREIGN KEY (`id_reparasi`) REFERENCES `reparasi` (`id_reparasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_jasa_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_sparepart`
--
ALTER TABLE `transaksi_sparepart`
  ADD CONSTRAINT `transaksi_sparepart_ibfk_1` FOREIGN KEY (`id_reparasi`) REFERENCES `reparasi` (`id_reparasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_sparepart_ibfk_2` FOREIGN KEY (`id_sparepart`) REFERENCES `sparepart` (`id_sparepart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_sparepart_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

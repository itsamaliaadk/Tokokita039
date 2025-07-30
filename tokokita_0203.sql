-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 05:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokokita_0203`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `idAdmin` int(2) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`idAdmin`, `userName`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `idDetailOrder` int(10) NOT NULL,
  `idOrder` int(5) DEFAULT NULL,
  `idProduk` int(5) DEFAULT NULL,
  `jumlah` int(5) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`idDetailOrder`, `idOrder`, `idProduk`, `jumlah`, `harga`) VALUES
(1, 25, 1, 1, 23500),
(2, 33, 8, 1, 500000),
(3, 34, 10, 1, 51000),
(4, 35, 9, 1, 15000000),
(5, 36, 10, 1, 51000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `idkat` int(5) NOT NULL,
  `namaKat` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`idkat`, `namaKat`) VALUES
(1, 'Baju Pria'),
(3, 'Baju Wanita'),
(4, 'Jaket Kulit'),
(5, 'Merchandise'),
(6, 'Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `idKonsumen` int(5) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `namaKonsumen` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `idKota` int(4) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tlpn` int(20) DEFAULT NULL,
  `statusAktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`idKonsumen`, `username`, `password`, `namaKonsumen`, `alamat`, `idKota`, `email`, `tlpn`, `statusAktif`) VALUES
(1, 'member 1', 'member 1', NULL, 'Yogyakarta', 31591, 'member@gmail.com', 1234567, 'Y'),
(2, 'member', 'member', 'Test', 'Jogja', 31591, 'test@gmail.com', 1234, 'Y'),
(6, 'test', 'test', 'test', 'test', 31591, 'test@test.com', 123, 'Y'),
(7, 'memberjakarta', '12345', 'Member dari Jakarta', '12345', 31591, 'jakarta@member.id', 123456, 'Y'),
(8, 'memberjogja', '12345', 'Member dari Jogja', '12345', 31591, 'jogja@member.id', 123456, 'Y'),
(9, 'memberbaru', 'memberbaru', 'Member Baru', 'memberbaru', 31591, 'memberbaru', 12313123, 'Y'),
(10, 'member56', '5656', 'member56', 'Sleman', 31517, 'member56@member.com', 5656, 'Y'),
(13, 'blinkeu', '5353', 'Blinkeu', 'Jl. Asia Afrika No. 8, Senayan, Kecamatan Tanah Abang, Jakarta Pusat, DKI Jakarta 10270', 17596, 'blink@gmail.com', 2147483647, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ongkir`
--

CREATE TABLE `tbl_ongkir` (
  `idOngkir` int(5) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `kurir` varchar(25) NOT NULL,
  `ongkos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ongkir`
--

INSERT INTO `tbl_ongkir` (`idOngkir`, `tujuan`, `kurir`, `ongkos`) VALUES
(2, 'Jogja', 'TIKI', 5000),
(3, 'Bandung', 'TIKI', 10000),
(6, 'Klaten', 'JNE', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `idOrder` int(5) NOT NULL,
  `idKonsumen` int(5) DEFAULT NULL,
  `idToko` int(10) NOT NULL,
  `tglOrder` date DEFAULT NULL,
  `statusOrder` enum('Belum Bayar','Dikemas','Dikirim','Diterima','Selesai','Dibatalkan') DEFAULT NULL,
  `kurir` varchar(50) NOT NULL,
  `ongkir` int(10) NOT NULL,
  `diskon` int(11) DEFAULT 0,
  `grand_total` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`idOrder`, `idKonsumen`, `idToko`, `tglOrder`, `statusOrder`, `kurir`, `ongkir`, `diskon`, `grand_total`) VALUES
(20, 10, 2, '2025-07-26', 'Belum Bayar', 'JNE OKE', 0, 0, 20000),
(21, 10, 2, '2025-07-26', 'Belum Bayar', 'JNE OKE', 6000, 3500, 22500),
(22, 10, 2, '2025-07-26', 'Belum Bayar', 'JNE OKE', 0, 0, 20000),
(23, 10, 2, '2025-07-26', 'Belum Bayar', 'JNE OKE', 0, 0, 20000),
(24, 10, 2, '2025-07-26', 'Belum Bayar', 'JNE OKE', 0, 0, 20000),
(25, 10, 2, '2025-07-27', 'Dikemas', 'JNE OKE', 7000, 3500, 23500),
(26, 13, 2, '2025-07-28', 'Dikemas', 'JNE OKE', 16000, 3500, 52500),
(27, 10, 6, '2025-07-28', 'Belum Bayar', 'JNE OKE', 18000, 3500, 514500),
(28, 10, 6, '2025-07-28', 'Dikemas', 'JNE OKE', 18000, 3500, 514500),
(29, 10, 6, '2025-07-30', 'Belum Bayar', 'JNE OKE', 18000, 8000, 510000),
(30, 10, 6, '2025-07-30', 'Belum Bayar', 'JNE OKE', 0, 0, 500000),
(31, 10, 6, '2025-07-30', 'Dikemas', 'JNE OKE', 18000, 8000, 510000),
(32, 13, 7, '2025-07-30', 'Dikemas', 'JNE OKE', 16000, 8000, 15008000),
(33, 10, 6, '2025-07-30', 'Dikemas', 'JNE OKE', 18000, 8000, 510000),
(34, 13, 7, '2025-07-30', 'Dikemas', 'JNE OKE', 16000, 8000, 59000),
(35, 13, 7, '2025-07-30', 'Dikemas', 'JNE OKE', 16000, 8000, 15008000),
(36, 13, 7, '2025-07-30', 'Dikemas', 'JNE OKE', 16000, 8000, 59000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `idProduk` int(5) NOT NULL,
  `idKat` int(5) DEFAULT NULL,
  `idToko` int(5) DEFAULT NULL,
  `namaProduk` varchar(200) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `berat` int(5) DEFAULT NULL,
  `deskripsiProduk` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`idProduk`, `idKat`, `idToko`, `namaProduk`, `foto`, `harga`, `stok`, `berat`, `deskripsiProduk`) VALUES
(1, 3, 2, 'Baju Wanita', 'cat-21.jpg', 20000, 3, 200, 'Produk Wanita'),
(5, 1, 2, 'Baju Pria', 'cat-11.jpg', 40000, 4, 2, 'Baju Pria'),
(6, 1, 4, 'Baju Anak', 'cat-3.jpg', 40000, 2, 200, 'Baju Anak'),
(7, 3, 5, 'Sepatu', 'cat-6.jpg', 40000, 2, 200, 'Sepatu'),
(8, 5, 6, 'BLACKPINK OFFICIAL LIGHTSTICK VER 2', 'ls_bp.jpg', 500000, 2, 650, 'Jual lighstick blackpink v2'),
(9, 6, 7, 'HP SAMSUNG S25', 'hp_s25.png', 15000000, 2, 162, 'SAMSUNG GALAXY S25\r\n-----------------\r\nPerforma\r\n- Prosesor : Snapdragon 8 Elite for Galaxy (3nm)\r\n- RAM: 12GB\r\n- Storage: 512GB\r\n- Network: 5G Ready\r\n\r\nDisplay\r\n- Ukuran: 6,2 inch\r\n- Teknologi: Dynamic AMOLED 2X, 1-120Hz\r\n- Resolusi: FHD+\r\n\r\nKamera\r\n- Kamera Belakang: 50 MP + 12 MP + 10 MP\r\n- Auto Focus Kamera Utama: Ya\r\n- Kamera Belakang\r\n- OIS: Ya\r\n- Kamera Depan: 12 MP\r\n- Auto Focus Kamera Belakang: Ya\r\n- Resolusi Video: UHD 8K (7680 X 4320) l @24fps\r\n\r\nBaterai\r\n- Kapasitas: 4000mAh\r\n- Jenis Pengisian Daya: Super Fast Charging, Fast Wireless Charging 2.0, Wireless PowerShare\r\n\r\nKetangguhan:\r\n- Corning Gorilla Glass Victus2 & Armor Aluminum frame\r\n- IP68 Water and Dust Resistant'),
(10, 3, 7, 'Kemeja Linen Single Pocket', 'kmj.png', 51000, 5, 100, 'Material : Linen (adem dan cocok untuk cuaca di Indonesia)\r\nDetail produk : \r\nLingkar dada 115 cm\r\nPanjang 65-67 cm\r\nPanjang lengan 27cm ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_toko`
--

CREATE TABLE `tbl_toko` (
  `idToko` int(5) NOT NULL,
  `idKonsumen` int(5) DEFAULT NULL,
  `namaToko` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `statusAktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_toko`
--

INSERT INTO `tbl_toko` (`idToko`, `idKonsumen`, `namaToko`, `logo`, `deskripsi`, `statusAktif`) VALUES
(2, 2, 'Toko ABC', '4k-programming-java-script-logo-3hcns7bt28muj7ih2.jpg', 'Toko Lama', 'Y'),
(4, 2, 'Toko DEF', '4k-programming-127001-w1546vdzj8vyw5191.jpg', 'Toko Baru', 'Y'),
(5, 7, 'Toko Sepatu', 'cat-5.jpg', 'Toko Baju', 'Y'),
(6, 13, 'Blinkeu.id', 'Screenshot_2025-07-28_113235.png', 'Menjual semua merch tentang BLACPINK.\r\n\r\n-WE LOVE BLACKPINK-', 'Y'),
(7, 10, '56Jual Apa Saja', 'logo_toko_hp.jpg', 'Menjual semua barang original dan berkualitas.', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher`
--

CREATE TABLE `tbl_voucher` (
  `id_voucher` int(11) NOT NULL,
  `kode_voucher` varchar(10) NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `nominal_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_voucher`
--

INSERT INTO `tbl_voucher` (`id_voucher`, `kode_voucher`, `tgl_berakhir`, `nominal_discount`) VALUES
(2, 'C1V0UP', '2025-07-10', 10000),
(5, 'ASYT2E', '2025-07-11', 2000),
(6, 'ZSYT1E', '2025-07-10', 1000),
(7, '13SMOA', '2025-07-29', 3500),
(8, 'Y8WYE8', '2025-08-08', 8000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`idDetailOrder`),
  ADD KEY `idProduk` (`idProduk`),
  ADD KEY `idOrder` (`idOrder`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`idkat`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`idKonsumen`);

--
-- Indexes for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  ADD PRIMARY KEY (`idOngkir`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idKonsumen` (`idKonsumen`),
  ADD KEY `idToko` (`idToko`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`idProduk`),
  ADD KEY `idKat` (`idKat`),
  ADD KEY `idToko` (`idToko`);

--
-- Indexes for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD PRIMARY KEY (`idToko`),
  ADD KEY `idKonsumen` (`idKonsumen`);

--
-- Indexes for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `idAdmin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `idDetailOrder` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `idkat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `idKonsumen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  MODIFY `idOngkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `idOrder` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `idProduk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
  MODIFY `idToko` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `tbl_detail_order_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `tbl_order` (`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_order_ibfk_2` FOREIGN KEY (`idProduk`) REFERENCES `tbl_produk` (`idProduk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`idKonsumen`) REFERENCES `tbl_member` (`idKonsumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`idToko`) REFERENCES `tbl_toko` (`idToko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`idToko`) REFERENCES `tbl_toko` (`idToko`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_produk_ibfk_3` FOREIGN KEY (`idKat`) REFERENCES `tbl_kategori` (`idkat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD CONSTRAINT `tbl_toko_ibfk_1` FOREIGN KEY (`idKonsumen`) REFERENCES `tbl_member` (`idKonsumen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_inventaris_smk.detail_pinjam
CREATE TABLE IF NOT EXISTS `detail_pinjam` (
  `id_detail_pinjam` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) unsigned DEFAULT NULL,
  `id_inventaris` int(11) unsigned DEFAULT NULL,
  `jumlah` int(11) DEFAULT '0',
  `jumlah_kembali` int(11) DEFAULT '0',
  PRIMARY KEY (`id_detail_pinjam`),
  KEY `id_inventaris` (`id_inventaris`),
  KEY `id_peminjaman` (`id_peminjaman`),
  CONSTRAINT `FK_detail_pinjam_inventaris` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`),
  CONSTRAINT `FK_detail_pinjam_peminjaman` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.detail_pinjam: ~5 rows (approximately)
/*!40000 ALTER TABLE `detail_pinjam` DISABLE KEYS */;
INSERT INTO `detail_pinjam` (`id_detail_pinjam`, `id_peminjaman`, `id_inventaris`, `jumlah`, `jumlah_kembali`) VALUES
	(1, 1, 1, 0, 20),
	(2, 1, 2, 0, 34),
	(3, 1, 3, 0, 23),
	(4, 2, 6, 20, 0),
	(5, 2, 8, 24, 0),
	(6, 2, 7, 35, 0);
/*!40000 ALTER TABLE `detail_pinjam` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.history_pengembalian
CREATE TABLE IF NOT EXISTS `history_pengembalian` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_inventaris` int(11) DEFAULT NULL,
  `id_detail_pinjam` int(11) DEFAULT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `jumlah_kembali` int(11) DEFAULT '0',
  `tanggal_kembali` date DEFAULT NULL,
  PRIMARY KEY (`id_history`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.history_pengembalian: ~6 rows (approximately)
/*!40000 ALTER TABLE `history_pengembalian` DISABLE KEYS */;
INSERT INTO `history_pengembalian` (`id_history`, `id_inventaris`, `id_detail_pinjam`, `id_peminjaman`, `jumlah_kembali`, `tanggal_kembali`) VALUES
	(1, 1, 1, 1, 2, '2019-04-04'),
	(2, 2, 2, 1, 5, '2019-04-04'),
	(3, 3, 3, 1, 7, '2019-04-04'),
	(4, 1, 1, 1, 18, '2019-04-04'),
	(5, 2, 2, 1, 29, '2019-04-04'),
	(6, 3, 3, 1, 16, '2019-04-04');
/*!40000 ALTER TABLE `history_pengembalian` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.inventaris
CREATE TABLE IF NOT EXISTS `inventaris` (
  `id_inventaris` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(11) DEFAULT '0',
  `current` int(11) DEFAULT '0',
  `id_jenis` int(11) unsigned DEFAULT NULL,
  `tanggal_register` date DEFAULT NULL,
  `id_ruang` int(11) unsigned DEFAULT NULL,
  `kode_inventaris` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_petugas` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_inventaris`),
  KEY `id_jenis` (`id_jenis`),
  KEY `id_ruang` (`id_ruang`),
  KEY `id_petugas` (`id_petugas`),
  CONSTRAINT `FK_inventaris_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`),
  CONSTRAINT `FK_inventaris_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  CONSTRAINT `FK_inventaris_ruang` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.inventaris: ~8 rows (approximately)
/*!40000 ALTER TABLE `inventaris` DISABLE KEYS */;
INSERT INTO `inventaris` (`id_inventaris`, `nama`, `kondisi`, `keterangan`, `jumlah`, `current`, `id_jenis`, `tanggal_register`, `id_ruang`, `kode_inventaris`, `id_petugas`) VALUES
	(1, 'Monitor LED LG 24MK600M-B 75Hz', 'bagus', 'Monitor LED LG 24MK600M-B 75Hz masih bagus', 120, 0, 1, '2019-04-04', 1, 'JK001-RL001-IK001', 1),
	(2, 'Meja Kayu Double', 'bagus', 'dengan menggunakan kayu Jati', 300, 0, 2, '2019-04-02', 2, 'JM002-RG002-IM002', 1),
	(3, 'Meja Komputer', 'kurang bagus', 'sangat ideal untuk menempatkan komputer & CPU', 140, 0, 2, '2019-04-04', 1, 'JM002-RG002-IT003', 1),
	(4, 'Cpu komputer core i5', 'bagus', 'cpu komputer core i5 sangat bagus untuk ngoding', 56, 0, 3, '2019-04-03', 1, 'JM002-RG002-IW007', 1),
	(5, 'CPU komputer gaming', 'bagus', 'CPU komputer gaming core i5 haswell desain pasti bagus', 20, 0, 1, '2019-04-04', 4, 'JK001-RL004-IC005', 1),
	(6, 'BENQ Projector', 'bagus', 'BENQ Projector [MS506P] dengan spek SVGA (800 x 600), 3200 Lumens ANSI, 1.8Kg, DLP Technology', 325, 20, 5, '2019-04-04', 3, 'JA005-RL003-IB006', 1),
	(7, 'EPSON Projector [EB-S300]', 'bagus', 'dengan spek  : SVGA (800×600), 3000 Lumens ANSi, 3LCD Technology', 199, 35, 5, '2019-04-04', 3, 'JA005-RL003-IE007', 1),
	(8, 'INFOCUS Projector [IN112X]', 'bagus', 'dengan spek  : 3200 Ansi, SVGA (800 x 600), VGA &HDMI OUTPUT', 0, 24, 5, '2019-04-04', 4, 'JA005-RL004-II008', 1);
/*!40000 ALTER TABLE `inventaris` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_jenis` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.jenis: ~6 rows (approximately)
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`, `keterangan`) VALUES
	(1, 'Komputer', 'JK001', 'Peralatan elektronik'),
	(2, 'Meja', 'JM002', 'meja kayu jati'),
	(3, 'Buku', 'JB003', 'keterangan buku'),
	(4, 'Kursi', 'JK004', 'Sarana tempat duduk'),
	(5, 'Aksesoris Komputer', 'JA005', 'alat tambahan untuk komputer'),
	(6, 'Kamera Digital', 'JK006', 'untuk memoto');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.level
CREATE TABLE IF NOT EXISTS `level` (
  `id_level` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.level: ~3 rows (approximately)
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` (`id_level`, `nama_level`) VALUES
	(1, 'Administrator'),
	(2, 'Operator'),
	(3, 'Peminjam');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2013_04_09_062329_create_revisions_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pegawai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.pegawai: ~7 rows (approximately)
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `alamat`) VALUES
	(1, 'Hartanti Dwi Jayadi', '9312775974', 'Br Ketapian Kaja, Denpasar'),
	(2, 'Dian Widya Cahyadi', '3934830390', 'Jl Nusa Indah'),
	(3, 'Hamdani Sukarno Setiawan', '3411829799', 'Jl WR Supratman, Denpasar'),
	(4, 'Mega Cahya Salim', '3938008505', 'Jl By Pass Ngurah Rai Suwung'),
	(5, 'Kusuma Yuda Widjaja', '7573237022', 'Jlt I Ged Kandatel Puputan Renon'),
	(6, 'Wulan Ratu Kartawijaya', '3789324507', 'Jl WR Supratman 343,Dangin Puri Kangin'),
	(7, 'Yuliani Dewi Sugiarto', '8266282265', 'Jl Veteran Kompl Psr Burung, Denpasar');
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_peminjaman` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'dipinjam',
  `id_pegawai` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_pegawai` (`id_pegawai`),
  CONSTRAINT `FK_peminjaman_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.peminjaman: ~2 rows (approximately)
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `status_peminjaman`, `id_pegawai`) VALUES
	(1, '2019-04-04', '2019-04-04', 'dikembalikan', 1),
	(2, '2019-04-04', NULL, 'dipinjam', 2);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.petugas
CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_petugas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_level` int(11) unsigned DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `FK_petugas_level` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.petugas: ~6 rows (approximately)
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `show_password`, `nama_petugas`, `image`, `id_level`, `remember_token`) VALUES
	(1, 'gungcahyadi', '$2y$10$kUImrf44JR6ldbZjKMho4urdoodZOZyuwWGDpBkzZDePS3rSFHDbO', '123456789', 'Gung Cahyadi Putra', '1903311750.jpeg', 1, 'zh5G6DdyRwFwZP47nyRGsuPAjjbO9bVZGpG4Tq3taMwM6DYVF4ZtggLtYziE'),
	(2, 'operator', '$2y$10$kUImrf44JR6ldbZjKMho4urdoodZOZyuwWGDpBkzZDePS3rSFHDbO', '123456789', 'Wahyu Artha', '1904040215.jpeg', 2, 'HIwuHsgLPQ6dFhxR2fNPgVozGJAMD6qEAAqD3eSflwOBaewWthZ3nukzPLhN'),
	(4, 'anom', '$2y$10$TY89x8vKFUbDjRiUyeEbRudsaG7pnAkg/twBPmw.2cfTLuwmqNLMm', 'anom123', 'yana', '1904040216.jpeg', 3, '1g28zQj83q48pjDkapgIqPh5edQNFZWEZeoxnGpfQASzlyXpxUQcf1NCkpFw'),
	(5, 'hermanto', '$2y$10$4BmxOiMHPqakInjXfeveVOL0gSyNbS7/VwrWS/.Yq4/pm0xdTY5Iy', 'hermanto12345', 'Tirto Ridwan Hermanto', NULL, 3, NULL),
	(6, 'jayawan', '$2y$10$a1QnlPcFkvoEevZr26dl2u/tPt8BqkmgKMQPZmf5N1McvuqBOhP6O', 'jayawan', 'Jayawan Fu', NULL, 2, NULL),
	(7, 'yuliawulan', '$2y$10$jybzmX/22xTxFdkTeRJVxO7OQz8mBkLV/Av7K0N3eJGvvrbDAVTka', 'yuliawulan', 'Wulan Yulia Tedja', NULL, 2, NULL);
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.revisions
CREATE TABLE IF NOT EXISTS `revisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.revisions: ~7 rows (approximately)
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
INSERT INTO `revisions` (`id`, `revisionable_type`, `revisionable_id`, `user_id`, `key`, `old_value`, `new_value`, `created_at`, `updated_at`) VALUES
	(44, 'App\\Peminjaman', 4, 1, 'created_at', NULL, NULL, '2019-04-03 09:09:41', '2019-04-03 09:09:41'),
	(45, 'App\\DetailPinjam', 7, 1, 'created_at', NULL, NULL, '2019-04-03 09:09:41', '2019-04-03 09:09:41'),
	(46, 'App\\DetailPinjam', 8, 1, 'created_at', NULL, NULL, '2019-04-03 09:09:41', '2019-04-03 09:09:41'),
	(47, 'App\\DetailPinjam', 7, 1, 'jumlah', '3', '2', '2019-04-03 09:10:54', '2019-04-03 09:10:54'),
	(48, 'App\\DetailPinjam', 7, 1, 'jumlah_kembali', '0', '1', '2019-04-03 09:10:54', '2019-04-03 09:10:54'),
	(49, 'App\\DetailPinjam', 8, 1, 'jumlah', '3', '2', '2019-04-03 09:10:54', '2019-04-03 09:10:54'),
	(50, 'App\\DetailPinjam', 8, 1, 'jumlah_kembali', '0', '1', '2019-04-03 09:10:54', '2019-04-03 09:10:54');
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;

-- Dumping structure for table db_inventaris_smk.ruang
CREATE TABLE IF NOT EXISTS `ruang` (
  `id_ruang` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_ruang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_ruang` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_ruang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_inventaris_smk.ruang: ~5 rows (approximately)
/*!40000 ALTER TABLE `ruang` DISABLE KEYS */;
INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`, `keterangan`) VALUES
	(1, 'Lab RPL', 'RL001', 'ruangan lab untuk praktek komputer'),
	(2, 'Gudang', 'RG002', 'tempat menyimpan barang'),
	(3, 'Lab TKJ', 'RL003', 'ruangan laporatorium kelas TKJ'),
	(4, 'Lab MM', 'RL004', 'ruangan laboratorium MM'),
	(5, 'Perpustakaan', 'RP005', 'Sarana Siswa untuk meminjam buku & membaca buku');
/*!40000 ALTER TABLE `ruang` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

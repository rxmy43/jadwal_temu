/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `karyawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'karyawan',
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `petugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'petugas',
  `shift` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reservasi_tamu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_tamu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawan_id` int DEFAULT NULL,
  `keperluan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` time NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_orang` int NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_reservasi` enum('janji_temu','buku_tamu') COLLATE utf8mb4_unicode_ci DEFAULT 'janji_temu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_pemohon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_penolakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `reservasi_tamu_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nama_admin`, `nip`, `nomor_telepon`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(1, 'admin.pln1', '$2y$10$oqe7AxLY2k6UpZhQM3tb3.CnLPgfrozWwr1oNlr0TABN3QB5/n0NC', 'admin.pln1@gmail.com', 'Admin PLN 1', '01248384038134181312', '08121129292', 'admin', '668913a6d68220.87863000 1720259494', '2024-07-06 16:51:34', '2024-07-06 23:15:27');
INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nama_admin`, `nip`, `nomor_telepon`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(2, 'admin.pln2', '$2y$10$ewHwKUYe3zUts.LxKBDpreBPNkfXeFuHe8Xn784ts1ZcDpcognL0W', 'admin.pln2@gmail.com', 'Admin PLN 2', '49302184023784027498', '0821231124342', 'admin', '66896d502851c0.16515300 1720282448', '2024-07-06 23:14:08', '2024-07-06 23:15:27');


INSERT INTO `karyawan` (`id`, `username`, `password`, `email`, `nama_karyawan`, `nip`, `nomor_telepon`, `jabatan`, `alamat`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(1, 'antonjr123', '$2y$10$WzB/lWJ7eUXKWv8ypKKk0OhJ/nnbS8RFbZwXcFcGrTnN6CA3C46dO', 'antonjr@gmail.com', 'Anton Junior', '09218409184091', '082132131313213', 'IT Staff', 'Jl Pahlawan No 123', 'karyawan', '668a98c2384e00.23062800 1720359106', '2024-07-07 20:31:46', '2024-07-07 20:31:46');




INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `alasan_penolakan`) VALUES
(2, 'Joko', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '09:58:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/6693063c4e7d31720911420.3215.jpg', 'buku_tamu', '2024-07-14 05:57:00', '2024-07-14 12:53:02', 'owner@email.com', NULL);
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `alasan_penolakan`) VALUES
(3, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '06:43:00', '2024-07-16', 1, 'Awadwadada', 'php/uploads/66931032347f21720913970.215.jpg', 'buku_tamu', '2024-07-14 06:39:30', '2024-07-14 13:25:11', 'nurul@gmail.com', NULL);
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `alasan_penolakan`) VALUES
(4, 'Aheng', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '06:46:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/6693115f4ba631720914271.3099.jpg', 'janji_temu', '2024-07-14 06:44:31', '2024-07-14 06:44:31', 'nurul@gmail.com', NULL);
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `alasan_penolakan`) VALUES
(5, 'Jado', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '09:47:00', '2024-08-08', 1, 'Awadwadada', 'php/uploads/66931211765e91720914449.4848.jpg', 'buku_tamu', '2024-07-14 06:47:29', '2024-07-14 06:47:29', 'owner@email.com', NULL),
(6, 'Asep Sumiati', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:23:00', '2024-07-16', 1, 'Awadwadada', 'php/uploads/66937c1cc148a1720941596.7917.jpg', 'janji_temu', '2024-07-14 14:19:56', '2024-07-14 14:19:56', 'bintantramy@gmail.com', NULL),
(7, 'Wawuh', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:25:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/66937cf2d67641720941810.8784.jpg', 'janji_temu', '2024-07-14 14:23:30', '2024-07-14 14:23:30', 'bintantramy@gmail.com', NULL),
(8, 'Ahik', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '12:26:00', '2024-07-23', 1, 'Awadwadada', 'php/uploads/66937db6acd5b1720942006.7079.jpg', 'janji_temu', '2024-07-14 14:26:46', '2024-07-14 14:26:46', 'bintantramy@gmail.com', NULL),
(9, 'Antek', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:54:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/669383a82d7d41720943528.1863.jpg', 'janji_temu', '2024-07-14 14:52:08', '2024-07-14 14:52:08', 'bintantramy@gmail.com', NULL),
(10, 'Hihay', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:00:00', '2024-07-18', 1, 'Awadwadada', 'php/uploads/669384cb4041f1720943819.2632.jpg', 'janji_temu', '2024-07-14 14:56:59', '2024-07-14 14:56:59', 'bintantramy@gmail.com', NULL),
(11, 'Ukam', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '19:02:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/669386162a6c01720944150.1738.jpg', 'janji_temu', '2024-07-14 15:02:30', '2024-07-14 15:02:30', 'bintantramy@gmail.com', NULL),
(12, 'Ashek', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:30:00', '2024-08-03', 1, 'Awadwadada', 'php/uploads/66938815ca5f01720944661.8292.jpg', 'janji_temu', '2024-07-14 15:11:01', '2024-07-14 15:11:01', 'bintantramy@gmail.com', NULL),
(13, 'Hehak', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:27:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/66938b15a1b981720945429.6624.jpg', 'janji_temu', '2024-07-14 15:23:49', '2024-07-14 15:23:49', 'bintantramy@gmail.com', NULL),
(14, 'Hehem', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:42:00', '2024-08-08', 1, 'Awadwadada', 'php/uploads/66938e0015aae1720946176.0888.jpg', 'janji_temu', '2024-07-14 15:36:16', '2024-07-14 15:36:16', 'bintantramy@gmail.com', NULL),
(15, 'Ahem', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:59:00', '2024-07-26', 1, 'Awadwadada', 'php/uploads/669392be2d1421720947390.1846.jpg', 'janji_temu', '2024-07-14 15:56:30', '2024-07-14 15:56:30', 'bintantramy@gmail.com', NULL),
(16, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:03:00', '2024-08-02', 1, 'Awadwadada', 'php/uploads/669393802a2ce1720947584.1728.jpg', 'janji_temu', '2024-07-14 15:59:44', '2024-07-14 15:59:44', 'ramyabyyu43@gmail.com', NULL),
(17, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:15:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/669396449d5341720948292.6444.jpg', 'janji_temu', '2024-07-14 16:11:32', '2024-07-14 16:11:32', 'ramyabyyu43@gmail.com', NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
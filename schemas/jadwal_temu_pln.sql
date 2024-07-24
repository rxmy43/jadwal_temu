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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `petugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'petugas',
  `shift` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reservasi_tamu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_tamu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `karyawan_id` int DEFAULT NULL,
  `keperluan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_janji` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_orang` int NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_reservasi` enum('janji_temu','buku_tamu') COLLATE utf8mb4_unicode_ci DEFAULT 'janji_temu',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_pemohon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `reservasi_tamu_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nama_admin`, `nip`, `nomor_telepon`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(1, 'admin.pln1', '$2y$10$oqe7AxLY2k6UpZhQM3tb3.CnLPgfrozWwr1oNlr0TABN3QB5/n0NC', 'admin.pln1@gmail.com', 'Admin PLN 1', '01248384038134181312', '08121129292', 'admin', '668913a6d68220.87863000 1720259494', '2024-07-06 16:51:34', '2024-07-06 23:15:27');
INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nama_admin`, `nip`, `nomor_telepon`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(2, 'admin.pln2', '$2y$10$ewHwKUYe3zUts.LxKBDpreBPNkfXeFuHe8Xn784ts1ZcDpcognL0W', 'admin.pln2@gmail.com', 'Admin PLN 2', '49302184023784027498', '0821231124342', 'admin', '66896d502851c0.16515300 1720282448', '2024-07-06 23:14:08', '2024-07-06 23:15:27');
INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nama_admin`, `nip`, `nomor_telepon`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(3, 'admin.pln3', '$2y$10$6Du5ELy9ZZqXC82Ub30qTeEDX/GAcamAyLgZUQGGXnOw9n/Q6WS1C', 'admin.pln3@gmail.com', 'Admin PLN 3', '0124838905493581312', '081212543543', 'admin', '66a1124d1e6d50.12463400 1721832013', '2024-07-24 21:40:13', '2024-07-24 21:40:13');
INSERT INTO `admin` (`id`, `username`, `password`, `email`, `nama_admin`, `nip`, `nomor_telepon`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(4, 'admin.pln4', '$2y$10$t6/krTiXdHD7pgC7RNLX/OX/d3t1rCbInXACVimXQG.YN3cxLjM.6', 'admin.pln4@gmail.com', 'Admin PLN 4', '0124838543534534543', '08121129435353454', 'admin', '66a11c088930d0.56193800 1721834504', '2024-07-24 22:21:44', '2024-07-24 22:21:44'),
(5, 'admin.pln5', '$2y$10$.7Jq1O.UjYzhYh5n0mnTvOyJgHOb2Fnv94MVBlYm1oIBDZ3O7Sh9S', 'admin.pln5@gmail.com', 'Admin PLN 5', '49302184053409854308', '0812115435', 'admin', '66a11cba2b7b90.17810900 1721834682', '2024-07-24 22:24:42', '2024-07-24 22:24:42'),
(7, 'admin.pln7', '$2y$10$tdkcYFCDOpOV.40MwSjxdu./hx4B.uwnXWgzagXs1hxnXaqIYpHS2', 'admin.pln7@gmail.com', 'Admin PLN 7', '01248534543512', '08121654645', 'admin', '66a11d92adba00.71158900 1721834898', '2024-07-24 22:28:18', '2024-07-24 22:28:18'),
(8, 'admin.pln8', '$2y$10$Y8Knhz8bEKFBadk8dY3OBetZzW15byCaePRvl6T/aCBSmwHkOfeuC', 'admin.pln8@gmail.com', 'Admin PLN 8', '01248389065481312', '6465445645', 'admin', '66a11ddaa15e60.66097200 1721834970', '2024-07-24 22:29:30', '2024-07-24 22:29:30'),
(9, 'admin.pln9', '$2y$10$ZakBl.KWmVlWIvfkc25BqOtkk4ebRf0SOE/ORDRyeQYv3m7N6T6D6', 'admin.pln9@gmail.com', 'Admin PLN 9', '493021854353498', '08165464543', 'admin', '66a11edbbab400.76474000 1721835227', '2024-07-24 22:33:47', '2024-07-24 22:33:47');

INSERT INTO `karyawan` (`id`, `username`, `password`, `email`, `nama_karyawan`, `nip`, `nomor_telepon`, `jabatan`, `alamat`, `role`, `unique_id`, `created_at`, `updated_at`) VALUES
(1, 'antonjr123', '$2y$10$WzB/lWJ7eUXKWv8ypKKk0OhJ/nnbS8RFbZwXcFcGrTnN6CA3C46dO', 'antonjr@gmail.com', 'Anton Junior Kurniawan', '09218409184091', '082121273909', 'IT Staff', 'Jl Pahlawan No 123', 'karyawan', '668a98c2384e00.23062800 1720359106', '2024-07-07 20:31:46', '2024-07-24 19:12:01');




INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam_janji`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `jam_masuk`) VALUES
(2, 'Joko Widodo', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '09:58:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/669d02e90f9901721565929.0639.jpg', 'buku_tamu', '2024-07-14 05:57:00', '2024-07-22 23:23:30', 'owner@email.com', '09:57:00');
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam_janji`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `jam_masuk`) VALUES
(4, 'Aheng', 'Jl Pahlawan No 123', 'l', '082121273909', 1, 'Memberikan Kiriman', '06:46:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/6693115f4ba631720914271.3099.jpg', 'buku_tamu', '2024-07-14 06:44:31', '2024-07-21 23:04:48', 'bintantramy@gmail.com', NULL);
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam_janji`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `jam_masuk`) VALUES
(7, 'Wawuhaaaay', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:25:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/66937cf2d67641720941810.8784.jpg', 'buku_tamu', '2024-07-14 14:23:30', '2024-07-21 20:57:38', 'bintantramy@gmail.com', NULL);
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam_janji`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`, `jam_masuk`) VALUES
(9, 'Antekaaaa', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:54:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/669383a82d7d41720943528.1863.jpg', 'buku_tamu', '2024-07-14 14:52:08', '2024-07-21 20:58:43', 'bintantramy@gmail.com', NULL),
(10, 'Hihay', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:00:00', '2024-07-18', 1, 'Awadwadada', 'php/uploads/669384cb4041f1720943819.2632.jpg', 'buku_tamu', '2024-07-14 14:56:59', '2024-07-15 18:34:40', 'bintantramy@gmail.com', NULL),
(11, 'Ukam', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '19:02:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/669386162a6c01720944150.1738.jpg', 'buku_tamu', '2024-07-14 15:02:30', '2024-07-15 18:36:08', 'bintantramy@gmail.com', NULL),
(13, 'Hehak', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:27:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/66938b15a1b981720945429.6624.jpg', 'buku_tamu', '2024-07-14 15:23:49', '2024-07-15 18:44:32', 'bintantramy@gmail.com', NULL),
(15, 'Ahem', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:59:00', '2024-07-26', 1, 'Awadwadada', 'php/uploads/669392be2d1421720947390.1846.jpg', 'buku_tamu', '2024-07-14 15:56:30', '2024-07-15 18:42:14', 'bintantramy@gmail.com', NULL),
(16, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:03:00', '2024-08-02', 1, 'Awadwadada', 'php/uploads/669393802a2ce1720947584.1728.jpg', 'buku_tamu', '2024-07-14 15:59:44', '2024-07-22 23:10:28', 'ramyabyyu43@gmail.com', NULL),
(17, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:15:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/669396449d5341720948292.6444.jpg', 'buku_tamu', '2024-07-14 16:11:32', '2024-07-22 23:13:05', 'ramyabyyu43@gmail.com', NULL),
(19, 'Rudiaaaa', 'Jlaaaa', 'l', '082132131313213', 1, 'Makan', '15:12:00', '2024-08-01', 1, 'hehe', 'php/uploads/6694d9dde603b1721031133.9421.png', 'buku_tamu', '2024-07-15 15:12:13', '2024-07-24 19:18:06', 'ramyabyyu43@gmail.com', NULL),
(21, 'Hahuy', 'Jl', 'l', '082132131313213', 1, 'Makan', '15:26:00', '2024-07-26', 1, 'hehe', 'php/uploads/6694dd2f50d361721031983.3311.png', 'buku_tamu', '2024-07-15 15:26:23', '2024-07-24 19:50:15', 'ramyabyyu43@gmail.com', NULL),
(23, 'Haheum Uyah', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:37:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/6694edf0286e21721036272.1656.jpg', 'buku_tamu', '2024-07-15 16:37:52', '2024-07-24 20:13:09', 'bintantramy@gmail.com', NULL),
(24, 'Hoaaammss', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:40:00', '2024-07-17', 1, 'Awadwadada', 'php/uploads/6694eea6642fb1721036454.4104.jpg', 'buku_tamu', '2024-07-15 16:40:54', '2024-07-24 20:31:18', 'bintantramy@gmail.com', NULL),
(25, 'Aheeokk', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '17:08:00', '2024-07-25', 1, 'Awadwadada', 'php/uploads/6694f53c44c411721038140.2817.jpg', 'janji_temu', '2024-07-15 17:09:00', '2024-07-15 17:09:00', 'bintantramy@gmail.com', NULL),
(26, 'Huhey', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '17:22:00', '2024-07-17', 1, 'Awadwadada', 'php/uploads/6694f86e448341721038958.2806.jpg', 'janji_temu', '2024-07-15 17:22:38', '2024-07-15 17:22:38', 'ramyabyyu43@gmail.com', NULL),
(27, 'Hehahahaha', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '22:32:00', '2024-07-11', 1, 'Awadwadada', 'php/uploads/669692501853d1721143888.0996.jpg', 'buku_tamu', '2024-07-16 22:31:28', '2024-07-16 22:31:28', 'bintantramy@gmail.com', NULL),
(28, 'Huhayeah', 'Jl Pahlawan No 123', 'p', '082132131313213', 1, 'Memberikan Kiriman', '23:01:00', '2024-07-25', 1, 'Awadwadada', 'php/uploads/6696992d09b9a1721145645.0398.jpg', 'buku_tamu', '2024-07-16 23:00:45', '2024-07-16 23:00:45', 'bintantramy@gmail.com', NULL),
(29, 'Anwaradasdada', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '23:10:00', '2024-07-12', 1, 'Awadwadada', 'php/uploads/66969ac43dfca1721146052.2539.jpg', 'buku_tamu', '2024-07-16 23:07:32', '2024-07-16 23:07:32', 'bintantramy@gmail.com', NULL),
(30, 'Dims', 'Jl Pahlawan No 123', 'l', '+6285795715960', NULL, 'Bermain Futsal', '09:00:00', '2024-07-17', 1, 'Wadidaw', 'php/uploads/6696fedf53b191721171679.3428.jpg', 'buku_tamu', '2024-07-17 06:14:39', '2024-07-17 06:14:39', 'bintantramy@gmail.com', NULL),
(31, 'Kuy', 'Jl Pahlawan No 123', 'l', '+6285795715960', NULL, 'Bermain Futrsal', '19:21:00', '2024-07-17', 1, 'Awadwadada', 'php/uploads/669700a150bb01721172129.3307.jpg', 'buku_tamu', '2024-07-17 06:22:09', '2024-07-17 06:22:49', 'bintantramy@gmail.com', NULL),
(32, 'Yeahh', 'Jl Pahlawan No 123', 'l', '+6285795715960', NULL, 'Bermain Futrsal', '00:24:00', '2024-07-19', 1, '1', 'php/uploads/6697012ec2aad1721172270.7974.jpg', 'buku_tamu', '2024-07-17 06:24:30', '2024-07-17 06:25:01', 'bintantramy@gmail.com', NULL),
(33, 'Lah Siapa', 'Jl Pahlawan No 123', 'l', NULL, 1, 'Memberikan Kiriman', '20:46:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/669e62dc5470b1721656028.3459.jpg', 'janji_temu', '2024-07-22 20:47:08', '2024-07-22 20:47:08', 'bintantramy@gmail.com', NULL),
(34, 'Hihayyy', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '19:29:00', '2024-07-27', 1, 'Awadwadada', 'php/uploads/66a101b0d965d1721827760.8907.jpg', 'janji_temu', '2024-07-24 20:29:20', '2024-07-24 20:29:20', 'ramyabyyu43@gmail.com', NULL),
(35, 'Huhay', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', NULL, '2024-07-17', 1, 'Awadwadada', 'php/uploads/66a1020ea0d0b1721827854.6587.jpg', 'buku_tamu', '2024-07-24 20:30:54', '2024-07-24 20:30:54', 'ramyabyyu43@gmail.com', '19:22:00'),
(36, 'Anwaraaaaa', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', NULL, '2024-07-27', 1, 'Awadwadada', 'php/uploads/66a1037997c7c1721828217.6217.jpg', 'buku_tamu', '2024-07-24 20:36:57', '2024-07-24 20:36:57', 'ramyabyyu43@gmail.com', '20:36:00');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
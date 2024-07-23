/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `reservasi_tamu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_tamu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci,
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
  PRIMARY KEY (`id`),
  KEY `karyawan_id` (`karyawan_id`),
  CONSTRAINT `reservasi_tamu_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`) VALUES
(2, 'Joko', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '09:58:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/6693063c4e7d31720911420.3215.jpg', 'buku_tamu', '2024-07-14 05:57:00', '2024-07-14 12:53:02', 'owner@email.com');
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`) VALUES
(3, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '06:43:00', '2024-07-16', 1, 'Awadwadada', 'php/uploads/66931032347f21720913970.215.jpg', 'buku_tamu', '2024-07-14 06:39:30', '2024-07-14 13:25:11', 'nurul@gmail.com');
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`) VALUES
(4, 'Aheng', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '06:46:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/6693115f4ba631720914271.3099.jpg', 'janji_temu', '2024-07-14 06:44:31', '2024-07-14 06:44:31', 'nurul@gmail.com');
INSERT INTO `reservasi_tamu` (`id`, `nama_tamu`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `karyawan_id`, `keperluan`, `jam`, `tanggal`, `jumlah_orang`, `instansi`, `foto`, `jenis_reservasi`, `created_at`, `updated_at`, `email_pemohon`) VALUES
(5, 'Jado', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '09:47:00', '2024-08-08', 1, 'Awadwadada', 'php/uploads/66931211765e91720914449.4848.jpg', 'buku_tamu', '2024-07-14 06:47:29', '2024-07-14 06:47:29', 'owner@email.com'),
(6, 'Asep Sumiati', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:23:00', '2024-07-16', 1, 'Awadwadada', 'php/uploads/66937c1cc148a1720941596.7917.jpg', 'buku_tamu', '2024-07-14 14:19:56', '2024-07-15 18:10:50', 'bintantramy@gmail.com'),
(7, 'Wawuh', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:25:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/66937cf2d67641720941810.8784.jpg', 'buku_tamu', '2024-07-14 14:23:30', '2024-07-15 18:29:13', 'bintantramy@gmail.com'),
(8, 'Ahik', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '12:26:00', '2024-07-23', 1, 'Awadwadada', 'php/uploads/66937db6acd5b1720942006.7079.jpg', 'buku_tamu', '2024-07-14 14:26:46', '2024-07-15 18:30:15', 'bintantramy@gmail.com'),
(9, 'Antek', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:54:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/669383a82d7d41720943528.1863.jpg', 'buku_tamu', '2024-07-14 14:52:08', '2024-07-15 18:31:41', 'bintantramy@gmail.com'),
(10, 'Hihay', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '14:00:00', '2024-07-18', 1, 'Awadwadada', 'php/uploads/669384cb4041f1720943819.2632.jpg', 'buku_tamu', '2024-07-14 14:56:59', '2024-07-15 18:34:40', 'bintantramy@gmail.com'),
(11, 'Ukam', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '19:02:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/669386162a6c01720944150.1738.jpg', 'buku_tamu', '2024-07-14 15:02:30', '2024-07-15 18:36:08', 'bintantramy@gmail.com'),
(13, 'Hehak', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:27:00', '2024-08-01', 1, 'Awadwadada', 'php/uploads/66938b15a1b981720945429.6624.jpg', 'buku_tamu', '2024-07-14 15:23:49', '2024-07-15 18:44:32', 'bintantramy@gmail.com'),
(15, 'Ahem', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:59:00', '2024-07-26', 1, 'Awadwadada', 'php/uploads/669392be2d1421720947390.1846.jpg', 'buku_tamu', '2024-07-14 15:56:30', '2024-07-15 18:42:14', 'bintantramy@gmail.com'),
(16, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '15:03:00', '2024-08-02', 1, 'Awadwadada', 'php/uploads/669393802a2ce1720947584.1728.jpg', 'janji_temu', '2024-07-14 15:59:44', '2024-07-14 15:59:44', 'ramyabyyu43@gmail.com'),
(17, 'Anwar', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:15:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/669396449d5341720948292.6444.jpg', 'janji_temu', '2024-07-14 16:11:32', '2024-07-14 16:11:32', 'ramyabyyu43@gmail.com'),
(18, 'Rudi', 'Jl', 'l', '082132131313213', 1, 'Makan', '15:12:00', '2024-07-25', 1, 'hehe', 'php/uploads/6694d985e45b81721031045.9356.png', 'janji_temu', '2024-07-15 15:10:45', '2024-07-15 15:10:45', 'ramyabyyu43@gmail.com'),
(19, 'Rudiaaaa', 'Jlaaaa', 'l', '082132131313213', 1, 'Makan', '15:12:00', '2024-08-01', 1, 'hehe', 'php/uploads/6694d9dde603b1721031133.9421.png', 'janji_temu', '2024-07-15 15:12:13', '2024-07-15 15:12:13', 'ramyabyyu43@gmail.com'),
(20, 'Hehaha', 'Jl', 'l', '082132131313213', 1, 'Makan', '15:16:00', '2024-08-02', 1, 'hehe', 'php/uploads/6694da7f2e4cc1721031295.1897.png', 'janji_temu', '2024-07-15 15:14:55', '2024-07-15 15:14:55', 'ramyabyyu43@gmail.com'),
(21, 'Hahuy', 'Jl', 'l', '082132131313213', 1, 'Makan', '15:26:00', '2024-07-26', 1, 'hehe', 'php/uploads/6694dd2f50d361721031983.3311.png', 'janji_temu', '2024-07-15 15:26:23', '2024-07-15 15:26:23', 'ramyabyyu43@gmail.com'),
(23, 'Haheum Uyah', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:37:00', '2024-07-24', 1, 'Awadwadada', 'php/uploads/6694edf0286e21721036272.1656.jpg', 'janji_temu', '2024-07-15 16:37:52', '2024-07-15 16:37:52', 'bintantramy@gmail.com'),
(24, 'Hoaaammss', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '16:40:00', '2024-07-17', 1, 'Awadwadada', 'php/uploads/6694eea6642fb1721036454.4104.jpg', 'janji_temu', '2024-07-15 16:40:54', '2024-07-15 16:40:54', 'bintantramy@gmail.com'),
(25, 'Aheeokk', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '17:08:00', '2024-07-25', 1, 'Awadwadada', 'php/uploads/6694f53c44c411721038140.2817.jpg', 'janji_temu', '2024-07-15 17:09:00', '2024-07-15 17:09:00', 'bintantramy@gmail.com'),
(26, 'Huhey', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '17:22:00', '2024-07-17', 1, 'Awadwadada', 'php/uploads/6694f86e448341721038958.2806.jpg', 'janji_temu', '2024-07-15 17:22:38', '2024-07-15 17:22:38', 'ramyabyyu43@gmail.com'),
(27, 'Hehahahaha', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '22:32:00', '2024-07-11', 1, 'Awadwadada', 'php/uploads/669692501853d1721143888.0996.jpg', 'buku_tamu', '2024-07-16 22:31:28', '2024-07-16 22:31:28', 'bintantramy@gmail.com'),
(28, 'Huhayeah', 'Jl Pahlawan No 123', 'p', '082132131313213', 1, 'Memberikan Kiriman', '23:01:00', '2024-07-25', 1, 'Awadwadada', 'php/uploads/6696992d09b9a1721145645.0398.jpg', 'buku_tamu', '2024-07-16 23:00:45', '2024-07-16 23:00:45', 'bintantramy@gmail.com'),
(29, 'Anwaradasdada', 'Jl Pahlawan No 123', 'l', '082132131313213', 1, 'Memberikan Kiriman', '23:10:00', '2024-07-12', 1, 'Awadwadada', 'php/uploads/66969ac43dfca1721146052.2539.jpg', 'buku_tamu', '2024-07-16 23:07:32', '2024-07-16 23:07:32', 'bintantramy@gmail.com'),
(30, 'Dims', 'Jl Pahlawan No 123', 'l', '+6285795715960', 2, 'Bermain Futsal', '09:00:00', '2024-07-17', 1, 'Wadidaw', 'php/uploads/6696fedf53b191721171679.3428.jpg', 'buku_tamu', '2024-07-17 06:14:39', '2024-07-17 06:14:39', 'bintantramy@gmail.com'),
(31, 'Kuy', 'Jl Pahlawan No 123', 'l', '+6285795715960', 2, 'Bermain Futrsal', '19:21:00', '2024-07-17', 1, 'Awadwadada', 'php/uploads/669700a150bb01721172129.3307.jpg', 'buku_tamu', '2024-07-17 06:22:09', '2024-07-17 06:22:49', 'bintantramy@gmail.com'),
(32, 'Yeahh', 'Jl Pahlawan No 123', 'l', '+6285795715960', 2, 'Bermain Futrsal', '00:24:00', '2024-07-19', 1, '1', 'php/uploads/6697012ec2aad1721172270.7974.jpg', 'buku_tamu', '2024-07-17 06:24:30', '2024-07-17 06:25:01', 'bintantramy@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
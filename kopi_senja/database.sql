CREATE DATABASE IF NOT EXISTS `kedai_kopi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kedai_kopi`;

CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `passwod` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`nama`, `email`, `passwod`) VALUES
('Admin Kedai Kopi', 'admin@kedaikopi.com', '$2b$10$5xd8U7hVRRR/nFiJFTJjGePQUqPBOI3Oe67a6zGVVug8w7aC2Xx1a')
ON DUPLICATE KEY UPDATE `email` = `email`;

CREATE TABLE IF NOT EXISTS `menu` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_menu` VARCHAR(150) NOT NULL,
    `kategori` VARCHAR(50) NOT NULL DEFAULT 'Coffee',
    `harga` DECIMAL(10,2) NOT NULL DEFAULT 0,
    `deskripsi` TEXT NULL,
    `gambar` VARCHAR(255) NULL,
    `status` ENUM('tersedia','habis') NOT NULL DEFAULT 'tersedia',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menu` (`nama_menu`, `kategori`, `harga`, `deskripsi`, `status`) VALUES
('Espresso', 'Coffee', 18000, 'Espresso murni dari biji kopi robusta pilihan, pekat dan aromatik.', 'tersedia'),
('Cappuccino', 'Coffee', 25000, 'Perpaduan espresso, susu steamed, dan foam lembut di atasnya.', 'tersedia'),
('Kopi Susu Gula Aren', 'Coffee', 22000, 'Kopi susu khas nusantara dengan manis alami gula aren.', 'tersedia'),
('Cafe Latte', 'Coffee', 26000, 'Espresso lembut berpadu susu creamy, cocok untuk pemula.', 'tersedia'),
('Matcha Latte', 'Non-Coffee', 24000, 'Matcha premium Jepang dipadu susu segar.', 'tersedia'),
('Chocolate Milk', 'Non-Coffee', 22000, 'Cokelat premium yang creamy dan kaya rasa.', 'tersedia'),
('Roti Bakar Coklat Keju', 'Makanan', 18000, 'Roti bakar renyah dengan topping coklat dan keju melimpah.', 'tersedia'),
('Croissant Butter', 'Makanan', 20000, 'Croissant lembut berlapis dengan aroma butter yang khas.', 'tersedia');

CREATE TABLE IF NOT EXISTS `berita` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `judul` VARCHAR(255) NOT NULL,
    `konten` TEXT NOT NULL,
    `penulis` VARCHAR(100) NOT NULL,
    `tanggal_dibuat` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `tanggal_diperbarui` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `berita` (`judul`, `konten`, `penulis`) VALUES
('Kedai Kopi Buka Cabang Baru', 'Kami dengan senang hati mengumumkan pembukaan cabang baru yang lebih luas dan nyaman untuk menemani hari-hari ngopi Anda.', 'Admin Kedai Kopi'),
('Promo Buy 1 Get 1 Setiap Senin', 'Nikmati promo spesial setiap hari Senin untuk semua menu kopi susu. Berlaku dine-in saja, syarat dan ketentuan berlaku.', 'Admin Kedai Kopi'),
('Biji Kopi Lokal Pilihan', 'Kami hanya menggunakan biji kopi lokal terbaik dari petani nusantara yang telah melalui proses roasting berkualitas.', 'Admin Kedai Kopi');

CREATE TABLE `faq` (
  `id` AUTO_INCREMENT PRIMARY KEY,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `faq` (`id`, `pertanyaan`, `jawaban`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apakah Kopi Senja menerima pemesanan online?', 'Saat ini kami belum melayani pemesanan online.\nSilakan datang langsung ke kedai untuk menikmati menu kami.', 1, 'aktif', '2026-07-01 15:41:02', '2026-07-01 15:41:02'),
(2, 'Apakah tersedia Wi-Fi gratis?', 'Ya, kami menyediakan Wi-Fi gratis untuk semua pelanggan yang berkunjung.', 2, 'aktif', '2026-07-01 15:41:02', '2026-07-01 15:41:02'),
(3, 'Jam berapa kedai buka setiap hari?', 'Kedai kami buka setiap hari.\nSenin-Jumat pukul 08.00-22.00, Sabtu-Minggu pukul 09.00-23.00.', 3, 'aktif', '2026-07-01 15:41:02', '2026-07-01 15:41:02'),
(4, 'apakah tersedia parkiran mobil?', 'tersedia banget', 0, 'aktif', '2026-07-01 15:43:07', '2026-07-01 15:43:07');

CREATE TABLE `feedback` (
  `id` AUTO_INCREMENT PRIMARY KEY,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status` enum('baru','dibaca','ditutup') NOT NULL DEFAULT 'baru',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `feedback` (`id`, `nama`, `email`, `pesan`, `status`, `created_at`) VALUES
(1, 'bleeh', 'bleehimoets@gmail.com', 'enak banget', 'baru', '2026-07-01 15:53:25');

CREATE TABLE `menu` (
  `id` AUTO_INCREMENT PRIMARY KEY,
  `nama_menu` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL DEFAULT 'Coffee',
  `harga` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','habis') NOT NULL DEFAULT 'tersedia',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menu` (`id`, `nama_menu`, `kategori`, `harga`, `deskripsi`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Espresso', 'Coffee', 18000.00, 'Espresso murni dari biji kopi robusta pilihan, pekat dan aromatik.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 12:16:34'),
(2, 'Cappuccino', 'Coffee', 99999999.99, 'Perpaduan espresso, susu steamed, dan foam lembut di atasnya.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 13:07:13'),
(3, 'Kopi Susu Gula Aren', 'Coffee', 22000.00, 'Kopi susu khas nusantara dengan manis alami gula aren.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 12:16:34'),
(4, 'Cafe Latte', 'Coffee', 99999999.99, 'Espresso lembut berpadu susu creamy, cocok untuk pemula.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 13:07:05'),
(5, 'Matcha Latte', 'Non-Coffee', 2400000.00, 'Matcha premium Jepang dipadu susu segar.', 'menu_6a44bcb0cbd42.jpg', 'tersedia', '2026-07-01 12:16:34', '2026-07-01 14:07:28'),
(6, 'Chocolate Milk', 'Non-Coffee', 22000.00, 'Cokelat premium yang creamy dan kaya rasa.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 12:16:34'),
(7, 'Roti Bakar Coklat Keju', 'Makanan', 18000.00, 'Roti bakar renyah dengan topping coklat dan keju melimpah.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 12:16:34'),
(8, 'Croissant Butter', 'Makanan', 20000.00, 'Croissant lembut berlapis dengan aroma butter yang khas.', NULL, 'tersedia', '2026-07-01 12:16:34', '2026-07-01 12:16:34'),
(9, 'Red Velvet', 'Non-Coffee', 3000000.00, 'Stoberi', 'menu_6a44da69bcd4e.jpg', 'tersedia', '2026-07-01 12:56:55', '2026-07-01 16:14:17'),
(10, 'thai tea', 'Non-Coffee', 20000.00, '', NULL, 'tersedia', '2026-07-01 14:09:14', '2026-07-01 14:09:14');

CREATE TABLE `partners` (
  `id` AUTO_INCREMENT PRIMARY KEY,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `partners` (`id`, `nama`, `deskripsi`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gofood', 'aplikasi pengantar makanan', 'uploads/partners/1782897077_Gofood.jpg', 'aktif', '2026-07-01 16:11:17', '2026-07-01 16:11:17');

CREATE TABLE `reservasi` (
  `id` AUTO_INCREMENT PRIMARY KEY,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `jumlah_orang` int(11) NOT NULL DEFAULT 1,
  `catatan` text DEFAULT NULL,
  `status` enum('baru','dikonfirmasi','dibatalkan') NOT NULL DEFAULT 'baru',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservasi` (`id`, `nama_pelanggan`, `email`, `telepon`, `tanggal`, `jam`, `jumlah_orang`, `catatan`, `status`, `created_at`) VALUES
(1, 'bleeh love nano', 'bleehnanoforever@gmail.com', '08545423464', '2027-02-14', '12:00:00', 2, 'first date', 'baru', '2026-07-01 15:56:05');

CREATE TABLE `user` (
  `id` AUTO_INCREMENT PRIMARY KEY,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwod` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `nama`, `email`, `passwod`, `created_at`) VALUES
(1, 'Admin Kedai Kopi', 'admin@kedaikopi.com', '$2b$10$5xd8U7hVRRR/nFiJFTJjGePQUqPBOI3Oe67a6zGVVug8w7aC2Xx1a', '2026-07-01 12:16:34');
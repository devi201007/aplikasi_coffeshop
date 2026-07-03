DROP DATABASE IF EXISTS `kedai_kopi`;
CREATE DATABASE `kedai_kopi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kedai_kopi`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `passwod` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`nama`, `email`, `passwod`) VALUES
('Admin Kedai Kopi', 'admin@kedaikopi.com', '$2b$10$5xd8U7hVRRR/nFiJFTJjGePQUqPBOI3Oe67a6zGVVug8w7aC2Xx1a');

CREATE TABLE IF NOT EXISTS `menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_menu` VARCHAR(150) NOT NULL,
  `kategori` VARCHAR(50) NOT NULL DEFAULT 'Coffee',
  `harga` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `deskripsi` TEXT DEFAULT NULL,
  `gambar` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('tersedia','habis') NOT NULL DEFAULT 'tersedia',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menu` (`id`, `nama_menu`, `kategori`, `harga`, `deskripsi`, `gambar`, `status`) VALUES
(1, 'Espresso', 'Coffee', 19000.00, 'Espresso murni dari biji kopi robusta pilihan, pekat dan aromatik.', 'menu_6a4635fc061d9.jpg', 'tersedia'),
(2, 'Cappuccino', 'Coffee', 25000.00, 'Perpaduan espresso, susu steamed, dan foam lembut di atasnya.', 'menu_6a4635b9792b9.webp', 'tersedia'),
(3, 'Kopi Susu Gula Aren', 'Coffee', 22000.00, 'Kopi susu khas nusantara dengan manis alami gula aren.', 'menu_6a463593a1b4d.jpg', 'tersedia'),
(4, 'Cafe Latte', 'Coffee', 26000.00, 'Espresso lembut berpadu susu creamy, cocok untuk pemula.', 'menu_6a46352209921.webp', 'tersedia'),
(5, 'Matcha Latte', 'Non-Coffee', 24000.00, 'Matcha premium Jepang dipadu susu segar.', 'menu_6a4636ed3c308.jpg', 'tersedia'),
(6, 'Chocolate Milk', 'Non-Coffee', 22000.00, 'Cokelat premium yang creamy dan kaya rasa.', 'menu_6a4636c12e7b1.jpg', 'tersedia'),
(7, 'Thai Tea', 'Non-Coffee', 21000.00, 'Rasa teh khas Thailand yang legit.', 'menu_6a463748be1ed.webp', 'tersedia'),
(8, 'Taro Latte', 'Non-Coffee', 18000.00, 'Minuman creamy dengan cita rasa khas talas yang lembut.', 'menu_6a4638e5413c0.jpg', 'tersedia'),
(9, 'Roti Bakar Coklat Keju', 'Makanan', 18000.00, 'Roti bakar renyah dengan topping coklat dan keju melimpah.', 'menu_6a4636833b886.jpg', 'tersedia'),
(10, 'Croissant Butter', 'Makanan', 20000.00, 'Croissant lembut berlapis dengan aroma butter yang khas.', 'menu_6a46363676b0e.png', 'tersedia'),
(11, 'Cheesecake', 'Makanan', 22000.00, 'Hidangan penutup yang lembut dan creamy.', 'menu_6a4637da69cd9.jpg', 'tersedia'),
(12, 'Waffle', 'Makanan', 32000.00, 'Waffle renyah di luar dan lembut di dalam.','menu_6a4638bfcce85.jpg', 'tersedia'),
(13, 'Chicken Wings', 'Snack', 26000.00, 'Sayap ayam berbumbu yang gurih dan juicy.', 'menu_6a463911a05e9.jpg', 'tersedia'),
(14, 'French Fries', 'Snack', 18000.00, 'Kentang goreng renyah dengan tekstur lembut di dalam.', 'menu_6a463949dd9b7.jpg', 'tersedia');

CREATE TABLE IF NOT EXISTS `berita` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL,
  `konten` TEXT NOT NULL,
  `penulis` VARCHAR(100) NOT NULL,
  `tanggal_dibuat` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `tanggal_diperbarui` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `berita` (`judul`, `konten`, `penulis`) VALUES
('Kedai Kopi Buka Cabang Baru', 'Kami dengan senang hati mengumumkan pembukaan cabang baru yang lebih luas dan nyaman untuk menemani hari-hari ngopi Anda.', 'Admin Kedai Kopi'),
('Promo Buy 1 Get 1 Setiap Senin', 'Nikmati promo spesial setiap hari Senin untuk semua menu kopi susu. Berlaku dine-in saja, syarat dan ketentuan berlaku.', 'Admin Kedai Kopi'),
('Biji Kopi Lokal Pilihan', 'Kami hanya menggunakan biji kopi lokal terbaik dari petani nusantara yang telah melalui proses roasting berkualitas.', 'Admin Kedai Kopi');

CREATE TABLE IF NOT EXISTS `faq` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pertanyaan` VARCHAR(255) NOT NULL,
  `jawaban` TEXT NOT NULL,
  `urutan` INT NOT NULL DEFAULT 0,
  `status` ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `faq` (`pertanyaan`, `jawaban`, `urutan`, `status`) VALUES
('Apakah Kopi Senja menerima pemesanan online?', 'Saat ini kami belum melayani pemesanan online.\nSilakan datang langsung ke kedai untuk menikmati menu kami.', 1, 'aktif'),
('Apakah tersedia Wi-Fi gratis?', 'Ya, kami menyediakan Wi-Fi gratis untuk semua pelanggan yang berkunjung.', 2, 'aktif'),
('Jam berapa kedai buka setiap hari?', 'Kedai kami buka setiap hari.\nSenin-Jumat pukul 08.00-22.00, Sabtu-Minggu pukul 09.00-23.00.', 3, 'aktif'),
('apakah tersedia parkiran mobil?', 'tersedia banget', 0, 'aktif');

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `pesan` TEXT NOT NULL,
  `status` ENUM('baru','dibaca','ditutup') NOT NULL DEFAULT 'baru',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `feedback` (`nama`, `email`, `pesan`, `status`) VALUES
('bleeh', 'bleehimoets@gmail.com', 'enak banget', 'baru');

CREATE TABLE IF NOT EXISTS `partners` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `partners` (`nama`, `deskripsi`, `foto`, `status`) VALUES
('Gofood', 'aplikasi pengantar makanan', 'uploads/partners/1782897077_Gofood.jpg', 'aktif');

CREATE TABLE IF NOT EXISTS `reservasi` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `telepon` VARCHAR(20) DEFAULT NULL,
  `tanggal` DATE NOT NULL,
  `jam` TIME NOT NULL,
  `jumlah_orang` INT NOT NULL DEFAULT 1,
  `catatan` TEXT DEFAULT NULL,
  `status` ENUM('baru','dikonfirmasi','dibatalkan') NOT NULL DEFAULT 'baru',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservasi` (`nama_pelanggan`, `email`, `telepon`, `tanggal`, `jam`, `jumlah_orang`, `catatan`, `status`) VALUES
('bleeh love nano', 'bleehnanoforever@gmail.com', '08545423464', '2027-02-14', '12:00:00', 2, 'first date', 'baru');

DROP DATABASE IF EXISTS `kedai_kopi`;
CREATE DATABASE `kedai_kopi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kedai_kopi`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`nama`, `email`, `password`) VALUES
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


INSERT INTO `menu` (`nama_menu`, `kategori`, `harga`, `deskripsi`, `gambar`, `status`) VALUES
('Espresso', 'Coffee', 19000.00, 'Espresso murni dari biji kopi robusta pilihan, pekat dan aromatik.', 'menu_6a4792877138e.jpg', 'tersedia'),
('Cappuccino', 'Coffee', 25000.00, 'Perpaduan espresso, susu steamed, dan foam lembut di atasnya.', 'menu_6a4783739169b.webp', 'tersedia'),
('Kopi Susu Gula Aren', 'Coffee', 22000.00, 'Kopi susu khas nusantara dengan manis alami gula aren.', 'menu_6a478352d74c6.jpg', 'tersedia'),
('Cafe Latte', 'Coffee', 26000.00, 'Espresso lembut berpadu susu creamy, cocok untuk pemula.', 'menu_6a478303c1e14.webp', 'tersedia'),
('Matcha Latte', 'Non-Coffee', 24000.00, 'Matcha premium Jepang dipadu susu segar.', 'menu_6a478417e8b95.jpg', 'tersedia'),
('Chocolate Milk', 'Non-Coffee', 22000.00, 'Cokelat premium yang creamy dan kaya rasa.', 'menu_6a47840643b6e.jpg', 'tersedia'),
('Roti Bakar Coklat Keju', 'Makanan', 18000.00, 'Roti bakar renyah dengan topping coklat dan keju melimpah.', 'menu_6a4789999999.jpg', 'tersedia'),
('Croissant Butter', 'Makanan', 20000.00, 'Croissant lembut berlapis dengan aroma butter yang khas.', 'menu_6a4783c056fdd.png', 'tersedia'),
('Thai Tea', 'Non-Coffee', 21000.00, 'Rasa teh khas Thailand yang legit.', 'menu_6a4783f3ed202.webp', 'tersedia'),
('Cheesecake', 'Makanan', 22000.00, 'Hidangan penutup yang lembut dan creamy.', 'menu_6a4783b2e73c1.jpg', 'tersedia'),
('Waffle', 'Makanan', 32000.00, 'Waffle renyah di luar dan lembut di dalam.','menu_6a478395b5dfb.jpg', 'tersedia'),
('Taro Latte', 'Non-Coffee', 18000.00, 'Minuman creamy dengan cita rasa khas talas yang lembut.', 'menu_6a4783e545fee.jpg', 'tersedia'),
('Chicken Wings', 'Snack', 26000.00, 'Sayap ayam berbumbu yang gurih dan juicy.', 'menu_6a4783a222844.jpg', 'tersedia'),
('French Fries', 'Snack', 18000.00, 'Kentang goreng renyah dengan tekstur lembut di dalam.', 'menu_6a478425ba243.jpg', 'tersedia');


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
('apakah tersedia parkiran mobil?', 'tersedia banget', 0, 'aktif'),
('Bagaimana cara mendaftar membership?', 'Anda bisa mendaftar membership langsung di kasir saat berkunjung ke kedai kami.', 4, 'aktif'),
('Apakah tersedia area parkir?', 'Ya, kami menyediakan area parkir yang cukup luas untuk kendaraan roda dua maupun roda empat.', 5, 'aktif'),
('Apakah tersedia menu minuman non-kopi?', 'Tentu saja! Kami juga menyediakan berbagai pilihan minuman non-kopi seperti teh, cokelat panas, dan jus segar.', 6, 'aktif'),
('Apakah ada batasan waktu untuk duduk di kedai?', 'Tidak ada batasan waktu resmi.\nNamun, kami menghargai kenyamanan semua pelanggan, jadi mohon pertimbangkan jika kedai sedang ramai.', 7, 'aktif');


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

INSERT INTO `partners` (`nama`, `deskripsi`, `foto`, `status`) VALUES
('Nusantara Coffee Cooperative', 'Mitra penyedia biji kopi Arabika dan Robusta berkualitas dari berbagai daerah di Indonesia dengan praktik pengadaan yang berkelanjutan.', 'uploads/partners/1783070652_nusantara_coffee.jpg', 'aktif'),
('Fresh Dairy Co.', 'Pemasok susu segar dan produk dairy berkualitas tinggi untuk berbagai menu berbasis espresso.', 'uploads/partners/1783070643_pemasok_susu.jpg', 'aktif'),
('EcoCup Solutions', 'Penyedia cup, sedotan, dan kemasan ramah lingkungan untuk mendukung operasional yang lebih berkelanjutan.', 'uploads/partners/1783070633_cup.png', 'aktif'),
('Barista Equipment Indonesia', 'Mitra penyedia mesin espresso, grinder, dan perlengkapan brewing untuk operasional coffee shop.', 'uploads/partners/1783070624_mesin_kopi.jpg', 'aktif'),
('Java Roast Roastery', 'Spesialis roasting yang membantu menghasilkan profil sangrai konsisten untuk menjaga cita rasa kopi di setiap sajian.', 'uploads/partners/1783070615_roastery.jpg', 'aktif');


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

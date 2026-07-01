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

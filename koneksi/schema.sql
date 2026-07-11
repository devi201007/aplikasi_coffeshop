-- =====================================================================
-- Kedai Kopi Senja - Database Schema
-- Import file ini lewat phpMyAdmin / mysql CLI ke database `kedai_kopi`
-- (sesuai konfigurasi di koneksi/db_connection.php)
--
-- Cara pakai (phpMyAdmin):
-- 1. Buat database baru bernama `kedai_kopi`
-- 2. Buka database tsb -> tab "Import" -> pilih file ini -> Go
--
-- Cara pakai (CLI):
--   mysql -u root -p kedai_kopi < schema.sql
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `kedai_kopi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kedai_kopi`;

-- ---------------------------------------------------------------------
-- Tabel user (akun admin dashboard)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `passwod` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Akun admin default -> email: admin@kopisenja.co | password: admin123
-- (SEGERA ganti password ini setelah login pertama kali!)
INSERT INTO `user` (`nama`, `email`, `passwod`)
SELECT 'Admin Kopi Senja', 'admin@kopisenja.co', '$2b$12$ydshq8QuzbdB9HOhE86PvO3WH2sCISIT0k4OITSku6.z1K51I/trO'
WHERE NOT EXISTS (SELECT 1 FROM `user` WHERE `email` = 'admin@kopisenja.co');

-- ---------------------------------------------------------------------
-- Tabel menu
-- ---------------------------------------------------------------------
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

-- ---------------------------------------------------------------------
-- Tabel berita (artikel / promo)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `berita` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `judul` VARCHAR(255) NOT NULL,
    `konten` TEXT NOT NULL,
    `penulis` VARCHAR(100) NOT NULL,
    `status` ENUM('Draft','Publish') NOT NULL DEFAULT 'Draft',
    `tanggal_dibuat` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `tanggal_diperbarui` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------------
-- Tabel faq
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `faq` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `pertanyaan` VARCHAR(255) NOT NULL,
    `jawaban` TEXT NOT NULL,
    `urutan` INT NOT NULL DEFAULT 0,
    `status` ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

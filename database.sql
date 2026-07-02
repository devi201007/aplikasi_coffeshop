/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `kedai_kopi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `kedai_kopi`;
DROP TABLE IF EXISTS `berita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `berita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `tanggal_dibuat` datetime DEFAULT current_timestamp(),
  `tanggal_diperbarui` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `berita` WRITE;
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
INSERT INTO `berita` VALUES (1,'Kedai Kopi Buka Cabang Baru','Kami dengan senang hati mengumumkan pembukaan cabang baru yang lebih luas dan nyaman untuk menemani hari-hari ngopi Anda.','Admin Kedai Kopi','2026-07-02 16:43:15','2026-07-02 16:43:15'),(2,'Promo Buy 1 Get 1 Setiap Senin','Nikmati promo spesial setiap hari Senin untuk semua menu kopi susu. Berlaku dine-in saja, syarat dan ketentuan berlaku.','Admin Kedai Kopi','2026-07-02 16:43:15','2026-07-02 16:43:15'),(3,'Biji Kopi Lokal Pilihan','Kami hanya menggunakan biji kopi lokal terbaik dari petani nusantara yang telah melalui proses roasting berkualitas.','Admin Kedai Kopi','2026-07-02 16:43:15','2026-07-02 16:43:15');
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,'Apakah Kopi Senja menerima pemesanan online?','Saat ini kami belum melayani pemesanan online.\nSilakan datang langsung ke kedai untuk menikmati menu kami.',1,'aktif','2026-07-02 16:43:15','2026-07-02 16:43:15'),(2,'Apakah tersedia Wi-Fi gratis?','Ya, kami menyediakan Wi-Fi gratis untuk semua pelanggan yang berkunjung.',2,'aktif','2026-07-02 16:43:15','2026-07-02 16:43:15'),(3,'Jam berapa kedai buka setiap hari?','Kedai kami buka setiap hari.\nSenin-Jumat pukul 08.00-22.00, Sabtu-Minggu pukul 09.00-23.00.',3,'aktif','2026-07-02 16:43:15','2026-07-02 16:43:15'),(4,'apakah tersedia parkiran mobil?','tersedia banget',0,'aktif','2026-07-02 16:43:15','2026-07-02 16:43:15');
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status` enum('baru','dibaca','ditutup') NOT NULL DEFAULT 'baru',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL DEFAULT 'Coffee',
  `harga` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('tersedia','habis') NOT NULL DEFAULT 'tersedia',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Espresso','Coffee',19000.00,'Espresso murni dari biji kopi robusta pilihan, pekat dan aromatik.','menu_6a4635fc061d9.jpg','tersedia','2026-07-02 16:43:14','2026-07-02 16:57:16'),(2,'Cappuccino','Coffee',25000.00,'Perpaduan espresso, susu steamed, dan foam lembut di atasnya.','menu_6a4635b9792b9.webp','tersedia','2026-07-02 16:43:14','2026-07-02 16:56:09'),(3,'Kopi Susu Gula Aren','Coffee',22000.00,'Kopi susu khas nusantara dengan manis alami gula aren.','menu_6a463593a1b4d.jpg','tersedia','2026-07-02 16:43:14','2026-07-02 16:55:31'),(4,'Cafe Latte','Coffee',26000.00,'Espresso lembut berpadu susu creamy, cocok untuk pemula.','menu_6a46352209921.webp','tersedia','2026-07-02 16:43:14','2026-07-02 16:55:17'),(5,'Matcha Latte','Non-Coffee',24000.00,'Matcha premium Jepang dipadu susu segar.','menu_6a4636ed3c308.jpg','tersedia','2026-07-02 16:43:14','2026-07-02 17:01:17'),(6,'Chocolate Milk','Non-Coffee',22000.00,'Cokelat premium yang creamy dan kaya rasa.','menu_6a4636c12e7b1.jpg','tersedia','2026-07-02 16:43:14','2026-07-02 17:00:33'),(7,'Roti Bakar Coklat Keju','Makanan',18000.00,'Roti bakar renyah dengan topping coklat dan keju melimpah.','menu_6a4636833b886.jpg','tersedia','2026-07-02 16:43:14','2026-07-02 16:59:31'),(8,'Croissant Butter','Makanan',20000.00,'Croissant lembut berlapis dengan aroma butter yang khas.','menu_6a46363676b0e.png','tersedia','2026-07-02 16:43:14','2026-07-02 16:58:14'),(9,'Thai Tea','Non-Coffee',21000.00,'Rasa teh khas Thailand yang legit.','menu_6a463748be1ed.webp','tersedia','2026-07-02 17:02:48','2026-07-02 17:02:48'),(10,'Cheesecake','Makanan',22000.00,'Hidangan penutup yang lembut dan creamy.','menu_6a4637da69cd9.jpg','tersedia','2026-07-02 17:05:14','2026-07-02 17:05:14'),(11,'Waffle','Makanan',32000.00,'Waffle renyah di luar dan lembut di dalam.','menu_6a4638bfcce85.jpg','tersedia','2026-07-02 17:09:03','2026-07-02 17:09:03'),(12,'Taro Latte','Non-Coffee',18000.00,'Minuman creamy dengan cita rasa khas talas yang lembut.','menu_6a4638e5413c0.jpg','tersedia','2026-07-02 17:09:41','2026-07-02 17:09:41'),(13,'Chicken Wings','Snack',26000.00,'Sayap ayam berbumbu yang gurih dan juicy.','menu_6a463911a05e9.jpg','tersedia','2026-07-02 17:10:25','2026-07-02 17:10:25'),(15,'French Fries','Snack',18000.00,'Kentang goreng renyah dengan tekstur lembut di dalam.','menu_6a463949dd9b7.jpg','tersedia','2026-07-02 17:11:21','2026-07-02 17:11:21');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reservasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `jumlah_orang` int(11) NOT NULL DEFAULT 1,
  `catatan` text DEFAULT NULL,
  `status` enum('baru','dikonfirmasi','dibatalkan') NOT NULL DEFAULT 'baru',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reservasi` WRITE;
/*!40000 ALTER TABLE `reservasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservasi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwod` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin Kedai Kopi','admin@kedaikopi.com','$2b$10$5xd8U7hVRRR/nFiJFTJjGePQUqPBOI3Oe67a6zGVVug8w7aC2Xx1a','2026-07-02 16:43:14');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


# Kopi Senja — Website Coffee Shop + Panel Admin

Website profil coffee shop (informasi & menu saja, **tanpa fitur pemesanan/checkout**)
lengkap dengan panel admin, database, dan CRUD menu.

## Struktur Utama

- `index.php` — Halaman publik coffee shop (Home, Tentang, Menu, Promo, Lokasi). Menu diambil otomatis dari database.
- `dist/login/login.php` — Halaman login admin.
- `dist/login/dashboard.php` — Dashboard admin (routing semua halaman kelola).
- `dist/login/menu/` — CRUD Menu (create, list, edit, delete, setup tabel otomatis).
- `dist/login/berita/` — CRUD Artikel & Promo (sudah ada sebelumnya, tetap dipakai).
- `koneksi/db_connection.php` — Konfigurasi koneksi database (mysqli).
- `database.sql` — Skrip SQL lengkap (tabel `user`, `menu`, `berita` + data contoh).
- `uploads/menu/` — Folder penyimpanan foto menu yang diunggah dari panel admin.

## Cara Menjalankan (XAMPP / Laragon / server PHP lokal)

1. **Buat database**: import file `database.sql` ke MySQL (misalnya lewat phpMyAdmin), atau
   cukup jalankan aplikasinya lalu buka menu **Setup Database** di admin — tabel akan dibuat otomatis.
2. **Atur koneksi database** di `koneksi/db_connection.php` sesuai kredensial MySQL Anda:
   ```php
   $host = 'localhost';
   $nama_database = 'kedai_kopi';
   $user = 'root';
   $pass = 'root';
   ```
3. Pastikan folder `uploads/menu/` dapat ditulis (writable) oleh web server.
4. Jalankan project di server PHP (contoh XAMPP: taruh folder `AdminLTE` di `htdocs`, lalu akses
   `http://localhost/AdminLTE/index.php`).

## Login Admin (default)

- URL: `dist/login/login.php`
- Email: `admin@kedaikopi.com`
- Password: `admin123`

> Segera ganti password ini setelah login pertama kali (langsung update di tabel `user` melalui phpMyAdmin, gunakan `password_hash()` PHP untuk hash password baru).

## Fitur

- **Website publik**: profil kedai, daftar menu (dari database, dikelompokkan per kategori), promo/artikel terbaru, lokasi (Google Maps embed), kontak. **Tidak ada keranjang/checkout/pemesanan online.**
- **Panel admin**: login session-based, dashboard, CRUD Menu (dengan upload foto), CRUD Artikel & Promo.
- **Database**: MySQL (`user`, `menu`, `berita`) — lihat `database.sql`.
- **CRUD Menu**: tambah, lihat, edit (termasuk ganti/hapus foto), hapus menu — lengkap dengan validasi & konfirmasi hapus.

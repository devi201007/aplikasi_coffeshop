<?php
declare(strict_types=1);

require_once __DIR__ . '/koneksi/db_connection.php';

$menuByCategory = [];
$menuTableExists = false;

$checkTable = $conn->query("SHOW TABLES LIKE 'menu'");
if ($checkTable && $checkTable->num_rows > 0) {
    $menuTableExists = true;
    $result = $conn->query("SELECT * FROM `menu` WHERE `status` = 'tersedia' ORDER BY `kategori` ASC, `id` ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $menuByCategory[$row['kategori']][] = $row;
        }
    }
}

$beritaList = [];
$checkBerita = $conn->query("SHOW TABLES LIKE 'berita'");
if ($checkBerita && $checkBerita->num_rows > 0) {
    $result = $conn->query("SELECT * FROM `berita` ORDER BY `tanggal_dibuat` DESC LIMIT 3");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $beritaList[] = $row;
        }
    }
}

function formatHarga(float $harga): string
{
    return 'Rp ' . number_format($harga, 0, ',', '.');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kedai Kopi Senja — Ngopi Santai, Cerita Panjang</title>
    <meta
        name="description"
        content="Kedai Kopi Senja adalah kedai kopi nyaman dengan menu kopi nusantara pilihan, tempat bersantai dan berkumpul. Lihat menu dan lokasi kami di sini."
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />
    <style>
        :root {
            --kopi-dark: #2b1b12;
            --kopi-brown: #5c3a21;
            --kopi-accent: #c8823a;
            --kopi-cream: #f4ead9;
            --kopi-cream-2: #fbf6ee;
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--kopi-dark);
            background-color: var(--kopi-cream-2);
        }
        h1, h2, h3, .brand-font {
            font-family: 'Playfair Display', serif;
        }
        .navbar-kopi {
            background-color: var(--kopi-cream-2);
        }
        .navbar-kopi .nav-link {
            color: var(--kopi-dark);
            font-weight: 500;
        }
        .navbar-kopi .nav-link:hover {
            color: var(--kopi-accent);
        }
        .btn-kopi {
            background-color: var(--kopi-accent);
            border-color: var(--kopi-accent);
            color: #fff;
            font-weight: 600;
        }
        .btn-kopi:hover {
            background-color: #a86a2c;
            border-color: #a86a2c;
            color: #fff;
        }
        .btn-outline-kopi {
            border-color: var(--kopi-brown);
            color: var(--kopi-brown);
            font-weight: 600;
        }
        .btn-outline-kopi:hover {
            background-color: var(--kopi-brown);
            color: #fff;
        }
        .hero-kopi {
            background: linear-gradient(135deg, var(--kopi-dark) 0%, var(--kopi-brown) 100%);
            color: #fdf7ee;
            position: relative;
            overflow: hidden;
        }
        .hero-kopi::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 85% 20%, rgba(200,130,58,0.25), transparent 45%);
        }
        .badge-kopi {
            background-color: rgba(200,130,58,0.2);
            color: #f4c78f;
            border: 1px solid rgba(244,199,143,0.4);
        }
        .section-title {
            color: var(--kopi-brown);
        }
        .section-sub {
            color: #8a7462;
        }
        .menu-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            background: #fff;
            transition: transform .2s ease, box-shadow .2s ease;
            box-shadow: 0 2px 10px rgba(43,27,18,0.06);
        }
        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(43,27,18,0.12);
        }
        .menu-card .menu-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background-color: var(--kopi-cream);
        }
        .menu-img-placeholder {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--kopi-cream);
            color: var(--kopi-accent);
            font-size: 2.5rem;
        }
        .menu-price {
            color: var(--kopi-accent);
            font-weight: 700;
        }
        .category-pill {
            background-color: var(--kopi-brown);
            color: #fff;
        }
        .about-photo {
            border-radius: 1rem;
            overflow: hidden;
            background-color: var(--kopi-brown);
            min-height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 4rem;
        }
        .info-strip {
            background-color: var(--kopi-cream);
        }
        footer.footer-kopi {
            background-color: var(--kopi-dark);
            color: #d8c7b8;
        }
        footer.footer-kopi a {
            color: #f4c78f;
            text-decoration: none;
        }
        .section-py {
            padding-top: 4.5rem;
            padding-bottom: 4.5rem;
        }
        .map-wrap {
            border-radius: 1rem;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <!-- ===================== NAVBAR ===================== -->
    <nav class="navbar navbar-expand-lg navbar-kopi sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand brand-font fw-bold fs-4" href="#home">
                <i class="bi bi-cup-hot-fill me-2" style="color: var(--kopi-accent);"></i>Kopi Senja
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav"
                aria-controls="mainNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="dist/section/partners.php">Our Partners</a></li>
                    <li class="nav-item"><a class="nav-link" href="dist/section/feedback.php">Kritik &amp; Saran</a></li>
                    <li class="nav-item"><a class="nav-link" href="dist/section/reservasi.php">Reservasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="dist/section/faq.php">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#promo">Promo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#lokasi">Lokasi</a></li>
                </ul>
                <a class="btn btn-outline-kopi btn-sm" href="dist/login/login.php">
                    <i class="bi bi-person-circle me-1"></i>Login Admin
                </a>
            </div>
        </div>
    </nav>

    <!-- ===================== HERO ===================== -->
    <header id="home" class="hero-kopi py-5">
        <div class="container py-5 position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge badge-kopi rounded-pill px-3 py-2 mb-3">☕ Kedai Kopi Rumahan</span>
                    <h1 class="display-4 fw-bold mb-3">Ngopi Santai,<br>Cerita Panjang.</h1>
                    <p class="lead mb-4" style="color: #e6d7c5;">
                        Kopi Senja adalah tempat singgah untuk menikmati kopi nusantara pilihan,
                        ditemani suasana hangat dan nyaman. Cocok untuk kerja, kumpul, atau sekadar melepas penat.
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                    </div>
                    <p class="small mt-3" style="color: #cbb69e;">
                        <i class="bi bi-info-circle me-1"></i>Website ini hanya menampilkan info & menu kedai — pemesanan hanya melalui kunjungan langsung ke tempat kami.
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0 shadow-lg" style="background: rgba(255,255,255,0.06); backdrop-filter: blur(4px);">
                        <div class="card-body p-4 text-white">
                            <h2 class="h5 mb-4 brand-font">Jam Buka Kedai</h2>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between py-2 border-bottom border-secondary-subtle">
                                    <span>Senin – Jumat</span><span>08.00 – 22.00</span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom border-secondary-subtle">
                                    <span>Sabtu – Minggu</span><span>09.00 – 23.00</span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span>Hari Libur Nasional</span><span>10.00 – 21.00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="info-strip py-3 border-bottom">
        <div class="container">
            <div class="row text-center g-3">
                <div class="col-6 col-md-3">
                    <i class="bi bi-cup-straw fs-4" style="color: var(--kopi-accent);"></i>
                    <div class="small fw-semibold mt-1">Biji Kopi Lokal</div>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-wifi fs-4" style="color: var(--kopi-accent);"></i>
                    <div class="small fw-semibold mt-1">Free WiFi</div>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-house-heart fs-4" style="color: var(--kopi-accent);"></i>
                    <div class="small fw-semibold mt-1">Suasana Nyaman</div>
                </div>
                <div class="col-6 col-md-3">
                    <i class="bi bi-car-front fs-4" style="color: var(--kopi-accent);"></i>
                    <div class="small fw-semibold mt-1">Area Parkir Luas</div>
                </div>
            </div>
        </div>
    </div>

    <section id="tentang" class="section-py">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="about-photo">
                        <i class="bi bi-cup-hot-fill"></i>
                    </div>
                </div>
                <div class="col-lg-7">
                    <span class="text-uppercase small fw-semibold section-sub">Tentang Kami</span>
                    <h2 class="h3 fw-bold section-title mb-3 mt-2">Dari Biji Kopi Nusantara, Untuk Cerita Anda</h2>
                    <p class="text-secondary mb-3">
                        Kopi Senja lahir dari kecintaan pada kopi lokal dan keinginan menghadirkan ruang
                        santai bagi siapa saja yang ingin menikmati secangkir kopi berkualitas tanpa terburu-buru.
                        Setiap biji kopi kami pilih langsung dari petani nusantara dan diseduh dengan penuh perhatian.
                    </p>
                    <p class="text-secondary mb-4">
                        Kami bukan kedai untuk pemesanan online — kami mengundang Anda untuk datang, duduk,
                        dan menikmati momen di tempat kami.
                    </p>
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="fs-3 fw-bold section-title">50+</div>
                            <div class="text-secondary small">Varian Menu</div>
                        </div>
                        <div class="col-4">
                            <div class="fs-3 fw-bold section-title">4 Tahun</div>
                            <div class="text-secondary small">Melayani Pelanggan</div>
                        </div>
                        <div class="col-4">
                            <div class="fs-3 fw-bold section-title">100%</div>
                            <div class="text-secondary small">Kopi Lokal Nusantara</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="section-py" style="background-color: var(--kopi-cream);">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-uppercase small fw-semibold section-sub">Menu Pilihan</span>
                <h2 class="h3 fw-bold section-title mt-2">Daftar Menu Kedai</h2>
                <p class="text-secondary mx-auto" style="max-width: 560px;">
                    Menu di bawah hanya bersifat informasi. Untuk menikmatinya, silakan datang langsung ke kedai kami.
                </p>
            </div>

            <?php if (!$menuTableExists || count($menuByCategory) === 0): ?>
                <div class="alert alert-warning text-center mx-auto" style="max-width: 500px;">
                    <i class="bi bi-info-circle me-2"></i>Menu belum tersedia. Silakan setup data menu melalui panel admin.
                </div>
            <?php else: ?>
                <?php foreach ($menuByCategory as $kategori => $items): ?>
                    <div class="mb-5">
                        <span class="badge category-pill rounded-pill px-3 py-2 mb-3"><?= htmlspecialchars($kategori) ?></span>
                        <div class="row g-4">
                            <?php foreach ($items as $item): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card menu-card h-100">
                                        <?php if (!empty($item['gambar']) && file_exists(__DIR__ . '/uploads/menu/' . $item['gambar'])): ?>
                                            <img src="uploads/menu/<?= htmlspecialchars($item['gambar']) ?>" class="menu-img" alt="<?= htmlspecialchars($item['nama_menu']) ?>">
                                        <?php else: ?>
                                            <div class="menu-img-placeholder">
                                                <i class="bi bi-cup-hot-fill"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h3 class="h6 fw-bold mb-1"><?= htmlspecialchars($item['nama_menu']) ?></h3>
                                            <p class="text-secondary small mb-2" style="min-height: 40px;">
                                                <?= htmlspecialchars((string) $item['deskripsi']) ?>
                                            </p>
                                            <div class="menu-price"><?= formatHarga((float) $item['harga']) ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <?php if (count($beritaList) > 0): ?>
    <section id="promo" class="section-py">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-uppercase small fw-semibold section-sub">Info Terbaru</span>
                <h2 class="h3 fw-bold section-title mt-2">Promo &amp; Berita Kedai</h2>
            </div>
            <div class="row g-4">
                <?php foreach ($beritaList as $berita): ?>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-secondary small mb-2">
                                    <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime((string)$berita['tanggal_dibuat'])) ?>
                                </div>
                                <h3 class="h6 fw-bold mb-2"><?= htmlspecialchars($berita['judul']) ?></h3>
                                <p class="text-secondary small mb-0">
                                    <?= htmlspecialchars(mb_strimwidth(strip_tags((string)$berita['konten']), 0, 140, '...')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section id="lokasi" class="section-py" style="background-color: var(--kopi-cream);">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <span class="text-uppercase small fw-semibold section-sub">Kunjungi Kami</span>
                    <h2 class="h3 fw-bold section-title mt-2 mb-3">Lokasi &amp; Kontak</h2>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-3">
                            <i class="bi bi-geo-alt-fill fs-5 me-3" style="color: var(--kopi-accent);"></i>
                            <span class="text-secondary">Jl. Kenanga No. 12, Jakarta Selatan, Indonesia</span>
                        </li>
                        <li class="d-flex mb-3">
                            <i class="bi bi-telephone-fill fs-5 me-3" style="color: var(--kopi-accent);"></i>
                            <span class="text-secondary">+62 812-3456-7890</span>
                        </li>
                        <li class="d-flex mb-3">
                            <i class="bi bi-envelope-fill fs-5 me-3" style="color: var(--kopi-accent);"></i>
                            <span class="text-secondary">halo@kopisenja.co</span>
                        </li>
                        <li class="d-flex">
                            <i class="bi bi-clock-fill fs-5 me-3" style="color: var(--kopi-accent);"></i>
                            <span class="text-secondary">Setiap hari, 08.00 – 23.00 WIB</span>
                        </li>
                    </ul>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="btn btn-outline-kopi btn-sm rounded-circle" style="width:40px;height:40px;" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-kopi btn-sm rounded-circle" style="width:40px;height:40px;" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-kopi btn-sm rounded-circle" style="width:40px;height:40px;" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="map-wrap shadow-sm">
                        <iframe
                            src="https://www.google.com/maps?q=Jakarta%20Selatan&output=embed"
                            width="100%"
                            height="380"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Kedai Kopi Senja"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <footer class="footer-kopi py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-5">
                    <h3 class="brand-font h5 mb-3" style="color:#f4c78f;">
                        <i class="bi bi-cup-hot-fill me-2"></i>Kopi Senja
                    </h3>
                    <p class="small mb-0">
                        Kedai kopi nyaman dengan menu kopi nusantara pilihan.
                        Website ini bersifat informasional — untuk menikmati menu, silakan berkunjung langsung ke kedai kami.
                    </p>
                </div>
            </div>
            <hr class="border-secondary my-4" />
            <p class="small mb-0 text-center">&copy; <?= date('Y') ?> Kopi Senja. Seduh dengan hati.</p>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"
    ></script>
</body>
</html>

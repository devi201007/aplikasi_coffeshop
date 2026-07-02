<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/../../koneksi/db_connection.php';

// Proteksi login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Konstanta akses subfolder berita
define('DASHBOARD_ACCESS', true);

$userName = (string) ($_SESSION['user_nama'] ?? 'User');
$userEmail = (string) ($_SESSION['user_email'] ?? '-');

// Routing page switcher
$page = (string) ($_GET['page'] ?? 'home');
?>
<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Kedai Kopi | Dashboard Admin</title>
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
            body {
                background-color: #f4f6f9;
            }
            .nav-pills .nav-link.active {
                background-color: #0d6efd;
            }
            .navbar-brand-custom {
                font-weight: 700;
                font-size: 1.25rem;
                color: #212529;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <!-- Top Navbar Header -->
        <header class="bg-white border-bottom py-3 mb-4 shadow-sm">
            <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
                <a href="dashboard.php" class="navbar-brand-custom">
                    <i class="bi bi-cup-hot-fill me-2 text-primary"></i>Kedai Kopi Admin
                </a>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-secondary small">
                        <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($userName); ?>
                    </span>
                </div>
            </div>
        </header>

        <main class="container mb-5">
            <!-- Horizontal Navigation Menu di Atas -->
            <nav class="nav nav-pills p-2 bg-white shadow-sm rounded-3 mb-4 flex-nowrap overflow-x-auto" aria-label="Menu dashboard utama">
                <a class="nav-link <?= $page === 'home' ? 'active' : '' ?>" href="dashboard.php">
                    <i class="bi bi-house-door me-1"></i>Dashboard
                </a>
                <a class="nav-link <?= strpos($page, 'menu') === 0 ? 'active' : '' ?>" href="dashboard.php?page=menu">
                    <i class="bi bi-cup-hot-fill me-1"></i>Kelola Menu
                </a>
                <a class="nav-link <?= strpos($page, 'berita') === 0 ? 'active' : '' ?>" href="dashboard.php?page=berita">
                    <i class="bi bi-newspaper me-1"></i>Artikel &amp; Promo
                </a>
                <a class="nav-link <?= strpos($page, 'faq') === 0 ? 'active' : '' ?>" href="dashboard.php?page=faq">
                    <i class="bi bi-question-circle me-1"></i>FAQ
                </a>
                <a class="nav-link <?= strpos($page, 'reservasi') === 0 ? 'active' : '' ?>" href="dashboard.php?page=reservasi">
                    <i class="bi bi-calendar2-check me-1"></i>Reservasi
                </a>
                <a class="nav-link <?= strpos($page, 'partners') === 0 ? 'active' : '' ?>" href="dashboard.php?page=partners">
                    <i class="bi bi-people-fill me-1"></i>Our Partners
                </a>
                <a class="nav-link <?= strpos($page, 'feedback') === 0 ? 'active' : '' ?>" href="dashboard.php?page=feedback">
                    <i class="bi bi-chat-dots me-1"></i>Kritik &amp; Saran
                </a>
                <a class="nav-link text-nowrap" href="../../index.php" target="_blank">
                    <i class="bi bi-globe2 me-1"></i>Lihat Website
                </a>
                <a class="nav-link text-danger ms-md-auto text-nowrap" href="logout.php">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>
            </nav>

            <!-- Main Content Container di Bawah -->
            <section class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <?php
                    if ($page === 'home') {
                        // Welcome screen
                        ?>
                        <div class="py-2">
                            <h1 class="h3 mb-1 fw-bold">Selamat datang, <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>!</h1>
                            <p class="text-secondary mb-4">Login sebagai: <?= htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8'); ?></p>
                            
                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <div class="card border-0 bg-primary-subtle p-4 h-100">
                                        <h3 class="h5 text-primary-emphasis fw-bold mb-2"><i class="bi bi-cup-hot-fill me-1"></i>Kelola Menu</h3>
                                        <p class="text-secondary mb-4">Tambah, ubah, dan hapus menu kopi, non-kopi, dan makanan yang tampil di website kedai.</p>
                                        <a href="dashboard.php?page=menu" class="btn btn-primary align-self-start">Mulai Kelola</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light p-4 h-100">
                                        <h3 class="h5 fw-bold mb-2"><i class="bi bi-newspaper me-1"></i>Artikel &amp; Promo</h3>
                                        <p class="text-secondary">Tulis dan kelola informasi promo, event, atau berita seputar kedai kopi Anda.</p>
                                        <div class="d-flex gap-2 mt-2">
                                            <a class="btn btn-sm btn-outline-secondary" href="dashboard.php?page=berita">Kelola Artikel</a>
                                            <a class="btn btn-sm btn-outline-secondary" href="../../index.php" target="_blank">Lihat Website</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } elseif ($page === 'berita') {
                        include __DIR__ . '/berita/list.php';
                    } elseif ($page === 'berita_create') {
                        include __DIR__ . '/berita/create.php';
                    } elseif ($page === 'berita_edit') {
                        include __DIR__ . '/berita/edit.php';
                    } elseif ($page === 'berita_delete') {
                        include __DIR__ . '/berita/delete.php';
                    } elseif ($page === 'setup_db') {
                        include __DIR__ . '/berita/setup.php';
                    } elseif ($page === 'menu') {
                        include __DIR__ . '/menu/list.php';
                    } elseif ($page === 'menu_create') {
                        include __DIR__ . '/menu/create.php';
                    } elseif ($page === 'menu_edit') {
                        include __DIR__ . '/menu/edit.php';
                    } elseif ($page === 'menu_delete') {
                        include __DIR__ . '/menu/delete.php';
                    } elseif ($page === 'menu_setup') {
                        include __DIR__ . '/menu/setup.php';
                    } elseif ($page === 'faq') {
                        include __DIR__ . '/faq/list.php';
                    } elseif ($page === 'faq_create') {
                        include __DIR__ . '/faq/create.php';
                    } elseif ($page === 'faq_edit') {
                        include __DIR__ . '/faq/edit.php';
                    } elseif ($page === 'faq_delete') {
                        include __DIR__ . '/faq/delete.php';
                    } elseif ($page === 'faq_setup') {
                        include __DIR__ . '/faq/setup.php';
                    } elseif ($page === 'partners') {
                        include __DIR__ . '/partners/list.php';
                    } elseif ($page === 'partners_create') {
                        include __DIR__ . '/partners/create.php';
                    } elseif ($page === 'partners_edit') {
                        include __DIR__ . '/partners/edit.php';
                    } elseif ($page === 'partners_delete') {
                        include __DIR__ . '/partners/delete.php';
                    } elseif ($page === 'feedback') {
                        include __DIR__ . '/feedback/list.php';
                    } elseif ($page === 'feedback_update') {
                        include __DIR__ . '/feedback/update.php';
                    } elseif ($page === 'reservasi') {
                        include __DIR__ . '/reservasi/list.php';
                    } elseif ($page === 'reservasi_update') {
                        include __DIR__ . '/reservasi/update.php';
                    } else {
                        echo '<div class="alert alert-danger">Halaman tidak ditemukan.</div>';
                    }
                    ?>
                </div>
            </section>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

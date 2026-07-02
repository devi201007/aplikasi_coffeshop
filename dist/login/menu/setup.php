<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$statusMessages = [];
$error = false;

// 1. Cek / Buat tabel menu
$createTableQuery = "CREATE TABLE IF NOT EXISTS `menu` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_menu` VARCHAR(150) NOT NULL,
    `kategori` VARCHAR(50) NOT NULL DEFAULT 'Coffee',
    `harga` DECIMAL(10,2) NOT NULL DEFAULT 0,
    `deskripsi` TEXT NULL,
    `gambar` VARCHAR(255) NULL,
    `status` ENUM('tersedia','habis') NOT NULL DEFAULT 'tersedia',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if ($conn->query($createTableQuery)) {
    $statusMessages[] = [
        'type' => 'success',
        'text' => 'Tabel `menu` berhasil dibuat atau sudah ada.'
    ];
} else {
    $error = true;
    $statusMessages[] = [
        'type' => 'danger',
        'text' => 'Gagal membuat tabel `menu`: ' . $conn->error
    ];
}

// 2. Cek apakah tabel kosong. Jika ya, masukkan data sampel.
if (!$error) {
    $checkQuery = "SELECT COUNT(*) as total FROM `menu`";
    $result = $conn->query($checkQuery);
    $row = $result ? $result->fetch_assoc() : null;
    $total = $row ? (int)$row['total'] : 0;

    if ($total === 0) {
        $dummyMenu = [
            ['nama' => 'Espresso', 'kategori' => 'Coffee', 'harga' => 19000, 'deskripsi' => 'Espresso murni dari biji kopi robusta pilihan, pekat dan aromatik.'],
            ['nama' => 'Cappuccino', 'kategori' => 'Coffee', 'harga' => 25000, 'deskripsi' => 'Perpaduan espresso, susu steamed, dan foam lembut di atasnya.'],
            ['nama' => 'Kopi Susu Gula Aren', 'kategori' => 'Coffee', 'harga' => 22000, 'deskripsi' => 'Kopi susu khas nusantara dengan manis alami gula aren.'],
            ['nama' => 'Cafe Latte', 'kategori' => 'Coffee', 'harga' => 26000, 'deskripsi' => 'Espresso lembut berpadu susu creamy, cocok untuk pemula.'],
            ['nama' => 'Matcha Latte', 'kategori' => 'Non-Coffee', 'harga' => 24000, 'deskripsi' => 'Matcha premium Jepang dipadu susu segar.'],
            ['nama' => 'Chocolate Milk', 'kategori' => 'Non-Coffee', 'harga' => 22000, 'deskripsi' => 'Cokelat premium yang creamy dan kaya rasa.'],
            ['nama' => 'Thai Tea', 'kategori' => 'Non-Coffee', 'harga' => 21000, 'deskripsi' => 'Rasa teh khas Thailand yang legit.'],
            ['nama' => 'Taro Latte', 'kategori' => 'Non-Coffee', 'harga' => 18000, 'deskripsi' => 'Minuman creamy dengan cita rasa khas talas yang lembut.'],
            ['nama' => 'Roti Bakar Coklat Keju', 'kategori' => 'Makanan', 'harga' => 18000, 'deskripsi' => 'Roti bakar renyah dengan topping coklat dan keju melimpah.'],
            ['nama' => 'Croissant Butter', 'kategori' => 'Makanan', 'harga' => 20000, 'deskripsi' => 'Croissant lembut berlapis dengan aroma butter yang khas.'],
            ['nama' => 'Cheesecake', 'kategori' => 'Makanan', 'harga' => 22000, 'deskripsi' => 'Hidangan penutup yang lembut dan creamy.'],
            ['nama' => 'Waffle', 'kategori' => 'Makanan', 'harga' => 32000, 'deskripsi' => 'Waffle renyah di luar dan lembut di dalam.'],
            ['nama' => 'Chicken Wings', 'kategori' => 'Snack', 'harga' => 26000, 'deskripsi' => 'Sayap ayam berbumbu yang gurih dan juicy.'],
            ['nama' => 'French Fries', 'kategori' => 'Snack', 'harga' => 18000, 'deskripsi' => 'Kentang goreng renyah dengan tekstur lembut di dalam.']
        ];

        $stmt = $conn->prepare("INSERT INTO `menu` (`nama_menu`, `kategori`, `harga`, `deskripsi`) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            foreach ($dummyMenu as $item) {
                $stmt->bind_param('ssds', $item['nama'], $item['kategori'], $item['harga'], $item['deskripsi']);
                $stmt->execute();
            }
            $stmt->close();
            $statusMessages[] = [
                'type' => 'success',
                'text' => 'Berhasil memasukkan ' . count($dummyMenu) . ' data sampel menu ke dalam database.'
            ];
        } else {
            $statusMessages[] = [
                'type' => 'warning',
                'text' => 'Gagal menyiapkan query untuk data sampel: ' . $conn->error
            ];
        }
    } else {
        $statusMessages[] = [
            'type' => 'info',
            'text' => 'Tabel `menu` sudah terisi dengan ' . $total . ' data. Tidak ada data sampel baru yang dimasukkan.'
        ];
    }
}
?>

<div class="card border-0 shadow-sm bg-white p-4">
    <div class="text-center mb-4">
        <div class="display-5 text-primary mb-2">
            <i class="bi bi-database-fill-gear"></i>
        </div>
        <h3 class="h4 fw-bold">Database Migration</h3>
        <p class="text-secondary small">Setup tabel `menu` di database `<?= htmlspecialchars($nama_database) ?>`</p>
    </div>

    <div class="mb-4">
        <?php foreach ($statusMessages as $msg): ?>
            <div class="alert alert-<?= $msg['type'] ?> d-flex align-items-center mb-2" role="alert">
                <i class="bi <?php
                    if ($msg['type'] === 'success') echo 'bi-check-circle-fill';
                    elseif ($msg['type'] === 'danger') echo 'bi-x-circle-fill';
                    elseif ($msg['type'] === 'info') echo 'bi-info-circle-fill';
                    else echo 'bi-exclamation-triangle-fill';
                ?> me-2 fs-5"></i>
                <div><?= htmlspecialchars($msg['text']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-grid gap-2 col-md-6 mx-auto">
        <a href="dashboard.php?page=menu" class="btn btn-primary">
            <i class="bi bi-cup-hot-fill me-2"></i>Buka Kelola Menu
        </a>
    </div>
</div>

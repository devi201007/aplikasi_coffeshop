<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$statusMessages = [];
$error = false;

// 1. Cek / Buat tabel berita
$createTableQuery = "CREATE TABLE IF NOT EXISTS `berita` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `judul` VARCHAR(255) NOT NULL,
    `konten` TEXT NOT NULL,
    `penulis` VARCHAR(100) NOT NULL,
    `tanggal_dibuat` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `tanggal_diperbarui` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if ($conn->query($createTableQuery)) {
    $statusMessages[] = [
        'type' => 'success',
        'text' => 'Tabel `berita` berhasil dibuat atau sudah ada.'
    ];
} else {
    $error = true;
    $statusMessages[] = [
        'type' => 'danger',
        'text' => 'Gagal membuat tabel `berita`: ' . $conn->error
    ];
}

// 2. Cek apakah tabel kosong. Jika ya, masukkan data sampel.
if (!$error) {
    $checkQuery = "SELECT COUNT(*) as total FROM `berita`";
    $result = $conn->query($checkQuery);
    $row = $result ? $result->fetch_assoc() : null;
    $total = $row ? (int)$row['total'] : 0;

    if ($total === 0) {
        $dummyNews = [
            [
                'judul' => 'Arunika Digital Luncurkan Layanan Web Engineering Baru',
                'konten' => 'Arunika Digital secara resmi mengumumkan ekspansi layanan pengembangan web berskala enterprise menggunakan framework modern seperti Next.js dan backend tangguh. Langkah ini diambil untuk memenuhi permintaan pasar yang berkembang pesat dalam digitalisasi bisnis pasca-pandemi.',
                'penulis' => 'Admin Arunika'
            ],
            [
                'judul' => 'Pentingnya UI/UX Premium untuk Meningkatkan Konversi Bisnis',
                'konten' => 'Dalam dunia e-commerce, detik pertama kunjungan pengguna sangat menentukan. Desain premium yang rapi, transisi yang halus, serta tata letak yang intuitif terbukti dapat meningkatkan tingkat konversi (conversion rate) hingga 38%. Investasi pada UI/UX bukan lagi opsi, melainkan kebutuhan utama.',
                'penulis' => 'UI Engineer'
            ],
            [
                'judul' => 'Mengenal Tren Desain Glassmorphism di Tahun 2026',
                'konten' => 'Glassmorphism tetap menjadi salah satu gaya visual terpopuler di tahun 2026. Dengan karakteristik transparansi berlapis, blur latar belakang yang halus, serta border tipis menyerupai kaca, gaya ini memberikan kesan futuristik sekaligus elegan pada aplikasi web modern.',
                'penulis' => 'Creative Director'
            ]
        ];

        $stmt = $conn->prepare("INSERT INTO `berita` (`judul`, `konten`, `penulis`) VALUES (?, ?, ?)");
        if ($stmt) {
            foreach ($dummyNews as $news) {
                $stmt->bind_param('sss', $news['judul'], $news['konten'], $news['penulis']);
                $stmt->execute();
            }
            $stmt->close();
            $statusMessages[] = [
                'type' => 'success',
                'text' => 'Berhasil memasukkan 3 data sampel berita ke dalam database.'
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
            'text' => 'Tabel `berita` sudah terisi dengan ' . $total . ' data. Tidak ada data sampel baru yang dimasukkan.'
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
        <p class="text-secondary small">Setup tabel `berita` di database `<?= htmlspecialchars($nama_database) ?>`</p>
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
        <a href="dashboard.php?page=berita" class="btn btn-primary">
            <i class="bi bi-newspaper me-2"></i>Buka Kelola Berita
        </a>
    </div>
</div>

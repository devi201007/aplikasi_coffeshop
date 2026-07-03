<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$statusMessages = [];
$error = false;

// 1. Cek / Buat tabel faq
$createTableQuery = "CREATE TABLE IF NOT EXISTS `faq` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `pertanyaan` VARCHAR(255) NOT NULL,
    `jawaban` TEXT NOT NULL,
    `urutan` INT NOT NULL DEFAULT 0,
    `status` ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if ($conn->query($createTableQuery)) {
    $statusMessages[] = [
        'type' => 'success',
        'text' => 'Tabel `faq` berhasil dibuat atau sudah ada.'
    ];
} else {
    $error = true;
    $statusMessages[] = [
        'type' => 'danger',
        'text' => 'Gagal membuat tabel `faq`: ' . $conn->error
    ];
}

// 2. Cek apakah tabel kosong. Jika ya, masukkan data sampel.
if (!$error) {
    $checkQuery = "SELECT COUNT(*) as total FROM `faq`";
    $result = $conn->query($checkQuery);
    $row = $result ? $result->fetch_assoc() : null;
    $total = $row ? (int)$row['total'] : 0;

    if ($total === 0) {
        $dummyFaq = [
            ['pertanyaan' => 'Apakah Kopi Senja menerima pemesanan online?', 'jawaban' => "Saat ini kami belum melayani pemesanan online.\nSilakan datang langsung ke kedai untuk menikmati menu kami.", 'urutan' => 1],
            ['pertanyaan' => 'Apakah tersedia Wi-Fi gratis?', 'jawaban' => 'Ya, kami menyediakan Wi-Fi gratis untuk semua pelanggan yang berkunjung.', 'urutan' => 2],
            ['pertanyaan' => 'Jam berapa kedai buka setiap hari?', 'jawaban' => "Kedai kami buka setiap hari.\nSenin-Jumat pukul 08.00-22.00, Sabtu-Minggu pukul 09.00-23.00.", 'urutan' => 3],
            ['pertanyaan' => 'Bagaimana cara mendaftar membership?', 'jawaban' => 'Anda bisa mendaftar membership langsung di kasir saat berkunjung ke kedai kami.', 'urutan' => 4],
            ['pertanyaan' => 'Apakah tersedia area parkir?', 'jawaban' => 'Ya, kami menyediakan area parkir yang cukup luas untuk kendaraan roda dua maupun roda empat.', 'urutan' => 5],
<<<<<<< HEAD
=======
            ['pertanyaan' => 'Apakah Kopi Senja menyediakan menu untuk vegetarian?', 'jawaban' => 'Ya, kami memiliki beberapa pilihan menu yang cocok untuk vegetarian. Silakan tanyakan kepada staf kami saat memesan.', 'urutan' => 6],
            ['pertanyaan' => 'Apakah ada promo khusus untuk pelanggan setia?', 'jawaban' => 'Kami sering mengadakan promo dan diskon khusus untuk pelanggan setia. Pastikan untuk mengikuti media sosial kami agar tidak ketinggalan informasi terbaru.', 'urutan' => 7],
            ['pertanyaan' => 'Apakah Kopi Senja menerima pesanan untuk acara atau catering?', 'jawaban' => 'Ya, kami menerima pesanan untuk acara atau catering. Silakan hubungi kami melalui kontak yang tersedia untuk informasi lebih lanjut.', 'urutan' => 8],
            ['pertanyaan' => 'Apakah tersedia menu minuman non-kopi?', 'jawaban' => 'Tentu saja! Kami juga menyediakan berbagai pilihan minuman non-kopi seperti teh, cokelat panas, dan jus segar.', 'urutan' => 9],
            ['pertanyaan' => 'Apakah ada batasan waktu untuk duduk di kedai?', 'jawaban' => "Tidak ada batasan waktu resmi.\nNamun, kami menghargai kenyamanan semua pelanggan, jadi mohon pertimbangkan jika kedai sedang ramai.", 'urutan' => 10]
>>>>>>> 256dab96f9ef7c8e169efed93d627ea8cf8d6786
        ];

        $stmt = $conn->prepare("INSERT INTO `faq` (`pertanyaan`, `jawaban`, `urutan`) VALUES (?, ?, ?)");
        if ($stmt) {
            foreach ($dummyFaq as $item) {
                $stmt->bind_param('ssi', $item['pertanyaan'], $item['jawaban'], $item['urutan']);
                $stmt->execute();
            }
            $stmt->close();
            $statusMessages[] = [
                'type' => 'success',
                'text' => 'Berhasil memasukkan ' . count($dummyFaq) . ' data sampel FAQ ke dalam database.'
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
            'text' => 'Tabel `faq` sudah terisi dengan ' . $total . ' data. Tidak ada data sampel baru yang dimasukkan.'
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
        <p class="text-secondary small">Setup tabel `faq` di database `<?= htmlspecialchars($nama_database) ?>`</p>
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
        <a href="dashboard.php?page=faq" class="btn btn-primary">
            <i class="bi bi-question-circle-fill me-2"></i>Buka Kelola FAQ
        </a>
    </div>
</div>

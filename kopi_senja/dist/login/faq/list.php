<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

// Ambil data faq
$faqList = [];
$dbError = '';
$tableExists = true;

$hasPertanyaan = false;
$hasJawaban = false;
$hasUrutan = false;
$hasStatus = false;

if (!isset($_SESSION)) {
    session_start();
}

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
    $checkTable = $conn->query("SHOW TABLES LIKE 'faq'");
    if ($checkTable && $checkTable->num_rows > 0) {
        $countResult = $conn->query("SELECT COUNT(*) AS total FROM `faq`");
        $countRow = $countResult ? $countResult->fetch_assoc() : null;
        $totalFaq = $countRow ? (int) $countRow['total'] : 0;

        if ($totalFaq === 0) {
            $dummyFaq = [
                ['pertanyaan' => 'Apakah Kopi Senja menerima pemesanan online?', 'jawaban' => "Saat ini kami belum melayani pemesanan online.\nSilakan datang langsung ke kedai untuk menikmati menu kami.", 'urutan' => 1],
                ['pertanyaan' => 'Apakah tersedia Wi-Fi gratis?', 'jawaban' => 'Ya, kami menyediakan Wi-Fi gratis untuk semua pelanggan yang berkunjung.', 'urutan' => 2],
                ['pertanyaan' => 'Jam berapa kedai buka setiap hari?', 'jawaban' => "Kedai kami buka setiap hari.\nSenin-Jumat pukul 08.00-22.00, Sabtu-Minggu pukul 09.00-23.00.", 'urutan' => 3],
            ];

            $stmt = $conn->prepare("INSERT INTO `faq` (`pertanyaan`, `jawaban`, `urutan`) VALUES (?, ?, ?)");
            if ($stmt) {
                foreach ($dummyFaq as $item) {
                    $stmt->bind_param('ssi', $item['pertanyaan'], $item['jawaban'], $item['urutan']);
                    $stmt->execute();
                }
                $stmt->close();
            }
        }

        $schemaResult = $conn->query("SHOW COLUMNS FROM `faq`");
        if ($schemaResult) {
            while ($col = $schemaResult->fetch_assoc()) {
                $field = $col['Field'];
                if ($field === 'pertanyaan') {
                    $hasPertanyaan = true;
                }
                if ($field === 'jawaban') {
                    $hasJawaban = true;
                }
                if ($field === 'urutan') {
                    $hasUrutan = true;
                }
                if ($field === 'status') {
                    $hasStatus = true;
                }
            }
        }

        if ($hasPertanyaan && $hasJawaban) {
            $orderBy = $hasUrutan ? "ORDER BY `urutan` ASC, `id` DESC" : "ORDER BY `id` DESC";
            $result = $conn->query("SELECT `id`, `pertanyaan`, `jawaban`, `urutan`, COALESCE(`status`, 'aktif') AS `status` FROM `faq` " . $orderBy);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $faqList[] = $row;
                }
            } else {
                $dbError = 'Gagal mengambil data FAQ: ' . $conn->error;
            }
        } else {
            $dbError = 'Struktur tabel faq tidak sesuai. Silakan jalankan setup ulang.';
        }
    } else {
        $tableExists = false;
    }
} else {
    $dbError = 'Gagal menyiapkan tabel FAQ: ' . $conn->error;
    $tableExists = false;
}

$successMsg = $_SESSION['success_message'] ?? '';
$errorMsg = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-question-circle-fill me-2 text-primary"></i>Kelola FAQ</h2>
        <p class="text-secondary small mb-0">Kelola daftar pertanyaan yang sering diajukan pada website</p>
    </div>
    <div>
        <?php if ($tableExists): ?>
            <a href="dashboard.php?page=faq_create" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah FAQ
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if ($successMsg !== ''): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($successMsg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($errorMsg !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i><?= htmlspecialchars($errorMsg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (!$tableExists): ?>
    <div class="card border-0 shadow-sm p-5 text-center bg-white">
        <div class="display-1 text-warning mb-4">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <h3 class="h4 text-dark mb-3">Tabel database tidak ditemukan!</h3>
        <p class="text-secondary mb-4 mx-auto" style="max-width: 500px;">
            Tabel `faq` belum dibuat di dalam database `<?= htmlspecialchars($nama_database) ?>`.
            Silakan klik tombol di bawah untuk menginisialisasi tabel dan data sampel secara otomatis.
        </p>
        <div>
            <a href="dashboard.php?page=faq_setup" class="btn btn-warning px-4">
                <i class="bi bi-database-fill-gear me-2"></i>Jalankan Setup Database
            </a>
        </div>
    </div>
<?php elseif ($dbError !== ''): ?>
    <div class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-octagon-fill me-2"></i><?= htmlspecialchars($dbError) ?>
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 850px;">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4 py-3" style="width: 70px;">Urutan</th>
                            <th scope="col" class="py-3">Pertanyaan</th>
                            <th scope="col" class="py-3" style="width: 110px;">Status</th>
                            <th scope="col" class="pe-4 py-3 text-end" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($faqList) === 0): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-secondary">
                                    <i class="bi bi-question-circle fs-1 d-block mb-2 text-muted"></i>
                                    Belum ada FAQ yang ditambahkan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($faqList as $faq): ?>
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark"><?= (int) $faq['urutan'] ?></td>
                                    <td>
                                        <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($faq['pertanyaan']) ?></div>
                                        <div class="text-muted small text-truncate" style="max-width: 450px;">
                                            <?= htmlspecialchars($faq['jawaban']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($faq['status'] === 'aktif'): ?>
                                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 small">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-3 py-2 small">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="dashboard.php?page=faq_edit&id=<?= $faq['id'] ?>" class="btn btn-outline-primary btn-sm me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-outline-danger btn-sm"
                                            title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?= $faq['id'] ?>"
                                        >
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>

                                        <div class="modal fade text-start" id="deleteModal<?= $faq['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $faq['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-danger text-white border-0">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $faq['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <p class="mb-1">Apakah Anda yakin ingin menghapus FAQ berikut?</p>
                                                        <p class="fw-bold text-danger">"<?= htmlspecialchars($faq['pertanyaan']) ?>"</p>
                                                        <p class="text-secondary small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                                    </div>
                                                    <div class="modal-footer border-0 bg-light">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="dashboard.php?page=faq_delete&id=<?= $faq['id'] ?>" class="btn btn-danger px-4">Ya, Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

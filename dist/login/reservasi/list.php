<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$reservasiList = [];
$dbError = '';

$createTableQuery = "CREATE TABLE IF NOT EXISTS `reservasi` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_pelanggan` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NULL,
    `telepon` VARCHAR(20) NULL,
    `tanggal` DATE NOT NULL,
    `jam` TIME NOT NULL,
    `jumlah_orang` INT NOT NULL DEFAULT 1,
    `catatan` TEXT NULL,
    `status` ENUM('baru','dikonfirmasi','dibatalkan') NOT NULL DEFAULT 'baru',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if ($conn->query($createTableQuery)) {
    $result = $conn->query("SELECT * FROM `reservasi` ORDER BY `tanggal` DESC, `jam` DESC, `id` DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $reservasiList[] = $row;
        }
    } else {
        $dbError = 'Gagal mengambil data reservasi: ' . $conn->error;
    }
} else {
    $dbError = 'Gagal menyiapkan tabel reservasi: ' . $conn->error;
}

$successMsg = $_SESSION['success_message'] ?? '';
$errorMsg = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-calendar2-check-fill me-2 text-primary"></i>Kelola Reservasi</h2>
        <p class="text-secondary small mb-0">Lihat dan kelola pesanan meja pelanggan</p>
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

<?php if ($dbError !== ''): ?>
    <div class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-octagon-fill me-2"></i><?= htmlspecialchars($dbError) ?>
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 1000px;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3">Nama</th>
                            <th class="py-3">Kontak</th>
                            <th class="py-3">Tanggal & Jam</th>
                            <th class="py-3">Jumlah</th>
                            <th class="py-3">Status</th>
                            <th class="pe-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($reservasiList) === 0): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">Belum ada reservasi.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($reservasiList as $item): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark"><?= htmlspecialchars($item['nama_pelanggan']) ?></td>
                                    <td class="text-secondary">
                                        <div><?= htmlspecialchars($item['email']) ?></div>
                                        <div><?= htmlspecialchars($item['telepon']) ?></div>
                                    </td>
                                    <td>
                                        <div><?= htmlspecialchars($item['tanggal']) ?></div>
                                        <div class="text-secondary small"><?= htmlspecialchars($item['jam']) ?></div>
                                    </td>
                                    <td><?= (int) $item['jumlah_orang'] ?></td>
                                    <td>
                                        <?php if ($item['status'] === 'dikonfirmasi'): ?>
                                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 small">Dikonfirmasi</span>
                                        <?php elseif ($item['status'] === 'dibatalkan'): ?>
                                            <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-3 py-2 small">Dibatalkan</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 small">Baru</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="dashboard.php?page=reservasi_update&id=<?= $item['id'] ?>" class="btn btn-outline-primary btn-sm">Update</a>
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

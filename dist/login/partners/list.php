<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$partners = [];
$dbError = '';
$tableExists = true;

$createTableQuery = "CREATE TABLE IF NOT EXISTS `partners` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(100) NOT NULL,
    `deskripsi` TEXT NULL,
    `foto` VARCHAR(255) NULL,
    `status` ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

if ($conn->query($createTableQuery)) {
    $result = $conn->query("SELECT * FROM `partners` ORDER BY `id` DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $partners[] = $row;
        }
    } else {
        $dbError = 'Gagal mengambil data partners: ' . $conn->error;
    }
} else {
    $dbError = 'Gagal menyiapkan tabel partners: ' . $conn->error;
    $tableExists = false;
}

$successMsg = $_SESSION['success_message'] ?? '';
$errorMsg = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-people-fill me-2 text-primary"></i>Kelola Our Partners</h2>
        <p class="text-secondary small mb-0">Kelola partner yang tampil di website</p>
    </div>
    <a href="dashboard.php?page=partners_create" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Partner
    </a>
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
                <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3">Nama</th>
                            <th class="py-3">Deskripsi</th>
                            <th class="py-3">Foto</th>
                            <th class="py-3">Status</th>
                            <th class="pe-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($partners) === 0): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-secondary">Belum ada partner yang ditambahkan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($partners as $partner): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark"><?= htmlspecialchars($partner['nama']) ?></td>
                                    <td class="text-secondary"><?= htmlspecialchars($partner['deskripsi']) ?></td>
                                    <td>
                                        <?php if (!empty($partner['foto'])): ?>
                                            <img src="../../<?= htmlspecialchars($partner['foto']) ?>" alt="Foto <?= htmlspecialchars($partner['nama']) ?>" class="rounded" style="width: 72px; height: 72px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($partner['status'] === 'aktif'): ?>
                                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 small">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-3 py-2 small">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <form method="get" action="dashboard.php" class="d-inline">
                                            <input type="hidden" name="page" value="partners_edit">
                                            <input type="hidden" name="id" value="<?= (int) $partner['id'] ?>">
                                            <button type="submit" class="btn btn-outline-primary btn-sm me-1" title="Edit">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </form>

                                        <form method="post" action="dashboard.php?page=partners_delete" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus partner ini?');">
                                            <input type="hidden" name="page" value="partners_delete">
                                            <input type="hidden" name="id" value="<?= (int) $partner['id'] ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
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

<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

// Ambil data berita
$beritaList = [];
$dbError = '';
$tableExists = true;

// Cek apakah tabel ada
$checkTable = $conn->query("SHOW TABLES LIKE 'berita'");
if ($checkTable && $checkTable->num_rows > 0) {
    $result = $conn->query("SELECT * FROM `berita` ORDER BY `id` DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $beritaList[] = $row;
        }
    } else {
        $dbError = 'Gagal mengambil data berita: ' . $conn->error;
    }
} else {
    $tableExists = false;
}

// Alert notifications dari session
$successMsg = $_SESSION['success_message'] ?? '';
$errorMsg = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<!-- Header Section di dalam Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-newspaper me-2 text-primary"></i>Kelola Berita</h2>
        <p class="text-secondary small mb-0">Kelola artikel berita dan pengumuman perusahaan</p>
    </div>
    <div>
        <?php if ($tableExists): ?>
            <a href="dashboard.php?page=berita_create" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah Berita
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Notifikasi -->
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

<!-- Konten Utama -->
<?php if (!$tableExists): ?>
    <div class="card border-0 shadow-sm p-5 text-center bg-white">
        <div class="display-1 text-warning mb-4">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <h3 class="h4 text-dark mb-3">Tabel database tidak ditemukan!</h3>
        <p class="text-secondary mb-4 mx-auto" style="max-width: 500px;">
            Tabel `berita` belum dibuat di dalam database `<?= htmlspecialchars($nama_database) ?>`. 
            Silakan klik tombol di bawah untuk menginisialisasi tabel dan data sampel secara otomatis.
        </p>
        <div>
            <a href="dashboard.php?page=setup_db" class="btn btn-warning px-4">
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
                <table class="table table-hover align-middle mb-0" style="min-width: 700px;">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4 py-3" style="width: 80px;">No</th>
                            <th scope="col" class="py-3">Judul Berita</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3" style="width: 150px;">Penulis</th>
                            <th scope="col" class="py-3" style="width: 180px;">Tanggal Dibuat</th>
                            <th scope="col" class="pe-4 py-3 text-end" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($beritaList) === 0): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-muted"></i>
                                    Belum ada berita yang diterbitkan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($beritaList as $berita): ?>
                                <tr>
                                    <td class="ps-4 fw-medium text-secondary"><?= $no++ ?></td>
                                    <td>
                                        <div class="fw-bold text-dark mb-1"><?= htmlspecialchars($berita['judul']) ?></div>
                                        <div class="text-muted small text-truncate" style="max-width: 400px;">
                                            <?= htmlspecialchars(strip_tags($berita['konten'])) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $berita['status'] === 'Publish' ? 'success' : 'secondary' ?>-subtle text-<?= $berita['status'] === 'Publish' ? 'success' : 'secondary' ?>-emphasis rounded-pill px-3 py-2 small">
                                            <?= htmlspecialchars($berita['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-3 py-2 small">
                                            <?= htmlspecialchars($berita['penulis']) ?>
                                        </span>
                                   </td>
                                    <td>
                                        <div class="text-dark small">
                                            <?= date('d M Y', strtotime($berita['tanggal_dibuat'])) ?>
                                        </div>
                                        <div class="text-secondary small" style="font-size: 0.75rem;">
                                            <?= date('H:i', strtotime($berita['tanggal_dibuat'])) ?> WIB
                                        </div>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="dashboard.php?page=berita_edit&id=<?= $berita['id'] ?>" class="btn btn-outline-primary btn-sm me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <button 
                                            type="button" 
                                            class="btn btn-outline-danger btn-sm" 
                                            title="Hapus" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal<?= $berita['id'] ?>"
                                        >
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade text-start" id="deleteModal<?= $berita['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $berita['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-danger text-white border-0">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $berita['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <p class="mb-1">Apakah Anda yakin ingin menghapus berita berikut?</p>
                                                        <p class="fw-bold text-danger">"<?= htmlspecialchars($berita['judul']) ?>"</p>
                                                        <p class="text-secondary small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                                    </div>
                                                    <div class="modal-footer border-0 bg-light">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="dashboard.php?page=berita_delete&id=<?= $berita['id'] ?>" class="btn btn-danger px-4">Ya, Hapus</a>
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

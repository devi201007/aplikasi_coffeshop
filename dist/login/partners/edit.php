<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$errorMessage = '';
$partner = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM `partners` WHERE `id` = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $partner = $result ? $result->fetch_assoc() : null;
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $nama = trim((string) ($_POST['nama'] ?? ''));
    $deskripsi = trim((string) ($_POST['deskripsi'] ?? ''));
    $status = ($_POST['status'] ?? 'aktif') === 'nonaktif' ? 'nonaktif' : 'aktif';
    $foto = $partner['foto'] ?? '';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        if (!in_array($_FILES['foto']['type'], $allowedTypes, true)) {
            $errorMessage = 'Format foto tidak didukung. Gunakan JPG, PNG, atau WebP.';
        } else {
            $fileName = time() . '_' . basename($_FILES['foto']['name']);
            $targetPath = __DIR__ . '/../../../uploads/partners/' . $fileName;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
                $foto = 'uploads/partners/' . $fileName;
            } else {
                $errorMessage = 'Gagal mengunggah foto partner.';
            }
        }
    }

    if ($nama === '' && $errorMessage === '') {
        $errorMessage = 'Nama partner wajib diisi.';
    }

    if ($nama !== '' && $errorMessage === '') {
        $stmt = $conn->prepare("UPDATE `partners` SET `nama` = ?, `deskripsi` = ?, `foto` = ?, `status` = ? WHERE `id` = ?");
        if ($stmt) {
            $stmt->bind_param('ssssi', $nama, $deskripsi, $foto, $status, $id);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'Partner berhasil diperbarui!';
                $stmt->close();
                header('Location: dashboard.php?page=partners');
                exit;
            } else {
                $errorMessage = 'Gagal memperbarui partner: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Partner</h2>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
<?php endif; ?>

<?php if ($partner): ?>
<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4">
        <form action="dashboard.php?page=partners_edit&id=<?= $id ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit" />
            <div class="mb-3">
                <label class="form-label">Nama Partner</label>
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($partner['nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3"><?= htmlspecialchars($partner['deskripsi']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Partner</label>
                <input type="file" class="form-control" name="foto" accept="image/jpeg,image/png,image/webp,image/jpg">
                <div class="form-text">Unggah foto baru jika ingin mengganti gambar partner.</div>
                <?php if (!empty($partner['foto'])): ?>
                    <img src="../../<?= htmlspecialchars($partner['foto']) ?>" alt="Foto partner" class="img-fluid rounded mt-3" style="max-height: 160px;">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="aktif" <?= $partner['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="nonaktif" <?= $partner['status'] === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <a href="dashboard.php?page=partners" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = 0;
if (isset($_POST['id']) && $_POST['id'] !== '') {
    $id = (int) $_POST['id'];
} elseif (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = (int) $_GET['id'];
} elseif (isset($_SERVER['QUERY_STRING'])) {
    if (preg_match('/(?:^|[?&])id=([0-9]+)/', (string) $_SERVER['QUERY_STRING'], $matches)) {
        $id = (int) $matches[1];
    }
}
$errorMessage = '';
$partner = null;

if ($id >= 0) {
    $createTableQuery = "CREATE TABLE IF NOT EXISTS `partners` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `nama` VARCHAR(100) NOT NULL,
        `deskripsi` TEXT NULL,
        `foto` VARCHAR(255) NULL,
        `status` ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $conn->query($createTableQuery);

    $stmt = $conn->prepare("SELECT * FROM `partners` WHERE `id` = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $partner = $result ? $result->fetch_assoc() : null;
            if ($partner) {
                $partnerName = (string) ($partner['nama'] ?? '');
                $partnerDescription = (string) ($partner['deskripsi'] ?? '');
                $partnerPhoto = (string) ($partner['foto'] ?? '');
                $partnerStatus = (string) ($partner['status'] ?? 'aktif');
                $partnerId = (int) ($partner['id'] ?? 0);
            } else {
                $partnerName = '';
                $partnerDescription = '';
                $partnerPhoto = '';
                $partnerStatus = 'aktif';
                $partnerId = $id;
                $errorMessage = 'Data partner tidak ditemukan. Pastikan ID partner benar dan data sudah tersimpan.';
            }
        } else {
            $partnerName = '';
            $partnerDescription = '';
            $partnerPhoto = '';
            $partnerStatus = 'aktif';
            $partnerId = $id;
            $errorMessage = 'Gagal mengambil data partner: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $partnerName = '';
        $partnerDescription = '';
        $partnerPhoto = '';
        $partnerStatus = 'aktif';
        $partnerId = $id;
        $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
    }
} else {
    $errorMessage = 'ID partner tidak valid. Buka halaman ini dari tombol Edit di daftar partner.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $nama = trim((string) ($_POST['nama'] ?? ''));
    $deskripsi = trim((string) ($_POST['deskripsi'] ?? ''));
    $status = ($_POST['status'] ?? 'aktif') === 'nonaktif' ? 'nonaktif' : 'aktif';
    $foto = $partner['foto'] ?? '';

    if (isset($_POST['remove_photo']) && $_POST['remove_photo'] === '1') {
        $foto = '';
    }

    if (isset($_FILES['foto']) && is_array($_FILES['foto']) && ($_FILES['foto']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
        $detectedType = $_FILES['foto']['type'] ?? '';
        if (!in_array($detectedType, $allowedTypes, true)) {
            $errorMessage = 'Format foto tidak didukung. Gunakan JPG, PNG, atau WebP.';
        } else {
            $uploadDir = __DIR__ . '/../../../uploads/partners/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', basename((string) $_FILES['foto']['name']));
            $targetPath = $uploadDir . $fileName;
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
        <form action="dashboard.php?page=partners_edit&id=<?= (int) $partnerId ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit" />
            <input type="hidden" name="id" value="<?= (int) $partnerId ?>" />
            <div class="mb-3">
                <label class="form-label">Nama Partner</label>
                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($partnerName) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3"><?= htmlspecialchars($partnerDescription) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Partner</label>
                <input type="file" class="form-control" name="foto" accept="image/jpeg,image/png,image/webp,image/jpg" id="partnerPhotoInput">
                <div class="form-text">Pilih file foto baru untuk mengganti gambar partner. Jika tidak dipilih, foto lama tetap dipakai.</div>
                <?php if (!empty($partnerPhoto)): ?>
                    <div class="mt-3">
                        <img src="../../<?= htmlspecialchars($partnerPhoto) ?>" alt="Foto partner" class="img-fluid rounded" style="max-height: 160px;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_photo" value="1" id="removePhoto">
                            <label class="form-check-label" for="removePhoto">Hapus foto saat ini</label>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="aktif" <?= $partnerStatus === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="nonaktif" <?= $partnerStatus === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
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

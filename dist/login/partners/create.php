<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $nama = trim((string) ($_POST['nama'] ?? ''));
    $deskripsi = trim((string) ($_POST['deskripsi'] ?? ''));
    $status = ($_POST['status'] ?? 'aktif') === 'nonaktif' ? 'nonaktif' : 'aktif';
    $foto = '';

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
        $stmt = $conn->prepare("INSERT INTO `partners` (`nama`, `deskripsi`, `foto`, `status`) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssss', $nama, $deskripsi, $foto, $status);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'Partner berhasil ditambahkan!';
                $stmt->close();
                header('Location: dashboard.php?page=partners');
                exit;
            } else {
                $errorMessage = 'Gagal menyimpan partner: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-plus-circle-fill me-2 text-primary"></i>Tambah Partner</h2>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4">
        <form action="dashboard.php?page=partners_create" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create" />
            <div class="mb-3">
                <label class="form-label">Nama Partner</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Partner</label>
                <input type="file" class="form-control" name="foto" accept="image/jpeg,image/png,image/webp,image/jpg">
                <div class="form-text">Unggah foto partner untuk ditampilkan di halaman website.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <a href="dashboard.php?page=partners" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

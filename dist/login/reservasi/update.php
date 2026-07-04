<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$errorMessage = '';
$reservasi = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM `reservasi` WHERE `id` = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $reservasi = $result ? $result->fetch_assoc() : null;
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $status = ($_POST['status'] ?? 'baru');
    $stmt = $conn->prepare("UPDATE `reservasi` SET `status` = ? WHERE `id` = ?");
    if ($stmt) {
        $stmt->bind_param('si', $status, $id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Status reservasi berhasil diperbarui!';
            $stmt->close();
            header('Location: dashboard.php?page=reservasi');
            exit;
        } else {
            $errorMessage = 'Gagal memperbarui status reservasi: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Update Reservasi</h2>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
<?php endif; ?>

<?php if ($reservasi): ?>
<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4">
        <p><strong>Nama:</strong> <?= htmlspecialchars($reservasi['nama_pelanggan']) ?></p>
        <p><strong>Kontak:</strong> <?= htmlspecialchars($reservasi['email']) ?> / <?= htmlspecialchars($reservasi['telepon']) ?></p>
        <p><strong>Jadwal:</strong> <?= htmlspecialchars($reservasi['tanggal']) ?> <?= htmlspecialchars($reservasi['jam']) ?></p>
        <p><strong>Catatan:</strong> <?= htmlspecialchars($reservasi['catatan']) ?></p>
        <form action="dashboard.php?page=reservasi_update&id=<?= $id ?>" method="post">
            <input type="hidden" name="action" value="update" />
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="baru" <?= $reservasi['status'] === 'baru' ? 'selected' : '' ?>>Baru</option>
                    <option value="dikonfirmasi" <?= $reservasi['status'] === 'dikonfirmasi' ? 'selected' : '' ?>>Dikonfirmasi</option>
                    <option value="dibatalkan" <?= $reservasi['status'] === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <a href="dashboard.php?page=reservasi" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

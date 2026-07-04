<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$errorMessage = '';
$message = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM `feedback` WHERE `id` = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $message = $result ? $result->fetch_assoc() : null;
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $status = ($_POST['status'] ?? 'baru') === 'ditutup' ? 'ditutup' : ((($_POST['status'] ?? 'baru') === 'dibaca') ? 'dibaca' : 'baru');
    $stmt = $conn->prepare("UPDATE `feedback` SET `status` = ? WHERE `id` = ?");
    if ($stmt) {
        $stmt->bind_param('si', $status, $id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Status feedback berhasil diperbarui!';
            $stmt->close();
            header('Location: dashboard.php?page=feedback');
            exit;
        } else {
            $errorMessage = 'Gagal memperbarui status: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Update Feedback</h2>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
<?php endif; ?>

<?php if ($message): ?>
<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4">
        <p><strong>Nama:</strong> <?= htmlspecialchars($message['nama']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($message['email']) ?></p>
        <p><strong>Pesan:</strong> <?= htmlspecialchars($message['pesan']) ?></p>
        <form action="dashboard.php?page=feedback_update&id=<?= $id ?>" method="post">
            <input type="hidden" name="action" value="update" />
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="baru" <?= $message['status'] === 'baru' ? 'selected' : '' ?>>Baru</option>
                    <option value="dibaca" <?= $message['status'] === 'dibaca' ? 'selected' : '' ?>>Dibaca</option>
                    <option value="ditutup" <?= $message['status'] === 'ditutup' ? 'selected' : '' ?>>Ditutup</option>
                </select>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <a href="dashboard.php?page=feedback" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['error_message'] = 'ID FAQ tidak valid.';
    echo "<script>window.location.href='dashboard.php?page=faq';</script>";
    exit;
}

$errorMessage = '';
$faq = null;

$stmt = $conn->prepare("SELECT * FROM `faq` WHERE `id` = ? LIMIT 1");
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $faq = $result ? $result->fetch_assoc() : null;
    $stmt->close();
} else {
    $errorMessage = 'Gagal memproses data: ' . $conn->error;
}

if (!$faq && $errorMessage === '') {
    $_SESSION['error_message'] = 'Data FAQ tidak ditemukan.';
    echo "<script>window.location.href='dashboard.php?page=faq';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $pertanyaan = trim((string) ($_POST['pertanyaan'] ?? ''));
    $jawaban = trim((string) ($_POST['jawaban'] ?? ''));
    $urutan = (int) ($_POST['urutan'] ?? 0);
    $status = ($_POST['status'] ?? 'aktif') === 'nonaktif' ? 'nonaktif' : 'aktif';

    if ($pertanyaan === '' || $jawaban === '') {
        $errorMessage = 'Pertanyaan dan jawaban wajib diisi.';
    } else {
        $updateStmt = $conn->prepare("UPDATE `faq` SET `pertanyaan` = ?, `jawaban` = ?, `urutan` = ?, `status` = ? WHERE `id` = ?");
        if ($updateStmt) {
            $updateStmt->bind_param('ssisi', $pertanyaan, $jawaban, $urutan, $status, $id);
            if ($updateStmt->execute()) {
                $_SESSION['success_message'] = 'FAQ berhasil diperbarui!';
                $updateStmt->close();
                header('Location: dashboard.php?page=faq');
                exit;
            } else {
                $errorMessage = 'Gagal memperbarui FAQ: ' . $updateStmt->error;
            }
            $updateStmt->close();
        } else {
            $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit FAQ</h2>
    <p class="text-secondary small mb-0">Ubah pertanyaan dan jawaban FAQ</p>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($faq): ?>
    <div class="card border-0 shadow-sm bg-white">
        <div class="card-body p-4 p-md-5">
            <form action="dashboard.php?page=faq_edit&id=<?= $id ?>" method="post">
                <input type="hidden" name="action" value="edit" />

                <div class="mb-4">
                    <label for="pertanyaan" class="form-label fw-bold">Pertanyaan</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        id="pertanyaan"
                        name="pertanyaan"
                        value="<?= isset($_POST['pertanyaan']) ? htmlspecialchars((string)$_POST['pertanyaan']) : htmlspecialchars($faq['pertanyaan']) ?>"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="jawaban" class="form-label fw-bold">Jawaban</label>
                    <textarea
                        class="form-control"
                        id="jawaban"
                        name="jawaban"
                        rows="5"
                        required
                    ><?= isset($_POST['jawaban']) ? htmlspecialchars((string)$_POST['jawaban']) : htmlspecialchars($faq['jawaban']) ?></textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="urutan" class="form-label fw-bold">Urutan Tampil</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="urutan"
                            name="urutan"
                            value="<?= isset($_POST['urutan']) ? htmlspecialchars((string)$_POST['urutan']) : htmlspecialchars((string)$faq['urutan']) ?>"
                        />
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold d-block">Status</label>
                        <?php $currentStatus = $_POST['status'] ?? $faq['status']; ?>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="status" id="statusAktif" value="aktif" <?= $currentStatus === 'aktif' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="statusAktif">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="nonaktif" <?= $currentStatus === 'nonaktif' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="statusNonaktif">Nonaktif</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-end pt-4 border-top mt-4">
                    <a href="dashboard.php?page=faq" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $pertanyaan = trim((string) ($_POST['pertanyaan'] ?? ''));
    $jawaban = trim((string) ($_POST['jawaban'] ?? ''));
    $urutan = (int) ($_POST['urutan'] ?? 0);
    $status = ($_POST['status'] ?? 'aktif') === 'nonaktif' ? 'nonaktif' : 'aktif';

    if ($pertanyaan === '' || $jawaban === '') {
        $errorMessage = 'Pertanyaan dan jawaban wajib diisi.';
    } else {
        $stmt = $conn->prepare("INSERT INTO `faq` (`pertanyaan`, `jawaban`, `urutan`, `status`) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssis', $pertanyaan, $jawaban, $urutan, $status);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'FAQ berhasil ditambahkan!';
                $stmt->close();
                header('Location: dashboard.php?page=faq');
                exit;
            } else {
                $errorMessage = 'Gagal menyimpan FAQ: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-plus-circle-fill me-2 text-primary"></i>Tambah FAQ Baru</h2>
    <p class="text-secondary small mb-0">Tambahkan pertanyaan yang sering diajukan pelanggan</p>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4 p-md-5">
        <form action="dashboard.php?page=faq_create" method="post">
            <input type="hidden" name="action" value="create" />

            <div class="mb-4">
                <label for="pertanyaan" class="form-label fw-bold">Pertanyaan</label>
                <input
                    type="text"
                    class="form-control form-control-lg"
                    id="pertanyaan"
                    name="pertanyaan"
                    placeholder="Contoh: Apakah tersedia Wi-Fi gratis?"
                    value="<?= isset($_POST['pertanyaan']) ? htmlspecialchars((string)$_POST['pertanyaan']) : '' ?>"
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
                    placeholder="Tuliskan jawaban lengkap di sini..."
                    required
                ><?= isset($_POST['jawaban']) ? htmlspecialchars((string)$_POST['jawaban']) : '' ?></textarea>
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
                        placeholder="1"
                        value="<?= isset($_POST['urutan']) ? htmlspecialchars((string)$_POST['urutan']) : '0' ?>"
                    />
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold d-block">Status</label>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="aktif" checked>
                        <label class="form-check-label" for="statusAktif">Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusNonaktif" value="nonaktif">
                        <label class="form-check-label" for="statusNonaktif">Nonaktif</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-end pt-4 border-top mt-4">
                <a href="dashboard.php?page=faq" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan FAQ
                </button>
            </div>
        </form>
    </div>
</div>

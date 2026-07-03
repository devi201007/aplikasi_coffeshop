<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['error_message'] = 'ID berita tidak valid.';
    echo "<script>window.location.href='dashboard.php?page=berita';</script>";
    exit;
}

$errorMessage = '';
$berita = null;

// Ambil data berita yang akan diedit
$stmt = $conn->prepare("SELECT * FROM `berita` WHERE `id` = ? LIMIT 1");
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $berita = $result ? $result->fetch_assoc() : null;
    $stmt->close();
} else {
    $errorMessage = 'Gagal memproses data: ' . $conn->error;
}

if (!$berita && $errorMessage === '') {
    $_SESSION['error_message'] = 'Data berita tidak ditemukan.';
    echo "<script>window.location.href='dashboard.php?page=berita';</script>";
    exit;
}

// Proses form update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $judul = trim((string) ($_POST['judul'] ?? ''));
    $penulis = trim((string) ($_POST['penulis'] ?? ''));
    $konten = trim((string) ($_POST['konten'] ?? ''));

    if ($judul === '' || $penulis === '' || $konten === '') {
        $errorMessage = 'Semua kolom wajib diisi.';
    } else {
        $updateStmt = $conn->prepare("UPDATE `berita` SET `judul` = ?, `konten` = ?, `penulis` = ? WHERE `id` = ?");
        if ($updateStmt) {
            $updateStmt->bind_param('sssi', $judul, $konten, $penulis, $id);
            if ($updateStmt->execute()) {
                $_SESSION['success_message'] = 'Berita berhasil diperbarui!';
                $updateStmt->close();
                header('Location: dashboard.php?page=berita');
                exit;
            } else {
                $errorMessage = 'Gagal memperbarui berita: ' . $updateStmt->error;
            }
            $updateStmt->close();
        } else {
            $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Berita</h2>
    <p class="text-secondary small mb-0">Ubah isi berita dan perbarui informasi</p>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($berita): ?>
    <div class="card border-0 shadow-sm bg-white">
        <div class="card-body p-4 p-md-5">
            <form action="dashboard.php?page=berita_edit&id=<?= $id ?>" method="post">
                <input type="hidden" name="action" value="edit" />
                
                <!-- Judul Berita -->
                <div class="mb-4">
                    <label for="judul" class="form-label fw-bold">Judul Berita</label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg" 
                        id="judul" 
                        name="judul" 
                        placeholder="Masukkan judul berita..." 
                        value="<?= isset($_POST['judul']) ? htmlspecialchars((string)$_POST['judul']) : htmlspecialchars($berita['judul']) ?>"
                        required 
                    />
                </div>

                <!-- Penulis -->
                <div class="mb-4">
                    <label for="penulis" class="form-label fw-bold">Penulis</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="penulis" 
                        name="penulis" 
                        placeholder="Nama penulis..." 
                        value="<?= isset($_POST['penulis']) ? htmlspecialchars((string)$_POST['penulis']) : htmlspecialchars($berita['penulis']) ?>"
                        required 
                    />
                </div>

                <!-- Konten Berita -->
                <div class="mb-4">
                    <label for="konten" class="form-label fw-bold">Konten / Isi Berita</label>
                    <textarea 
                        class="form-control" 
                        id="konten" 
                        name="konten" 
                        rows="8" 
                        placeholder="Tuliskan isi berita secara lengkap..." 
                        required
                    ><?= isset($_POST['konten']) ? htmlspecialchars((string)$_POST['konten']) : htmlspecialchars($berita['konten']) ?></textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                    <a href="dashboard.php?page=berita" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

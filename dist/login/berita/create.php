<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $judul = trim((string) ($_POST['judul'] ?? ''));
    $penulis = trim((string) ($_POST['penulis'] ?? ''));
    $konten = trim((string) ($_POST['konten'] ?? ''));

    if ($judul === '' || $penulis === '' || $konten === '') {
        $errorMessage = 'Semua kolom wajib diisi.';
    } else {
        $stmt = $conn->prepare("INSERT INTO `berita` (`judul`, `konten`, `penulis`) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $judul, $konten, $penulis);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'Berita berhasil ditambahkan!';
                $stmt->close();
                header('Location: dashboard.php?page=berita');
                exit;
            } else {
                $errorMessage = 'Gagal menyimpan berita: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-plus-circle-fill me-2 text-primary"></i>Tambah Berita Baru</h2>
    <p class="text-secondary small mb-0">Tulis dan terbitkan berita baru di portal</p>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4 p-md-5">
        <form action="dashboard.php?page=berita_create" method="post">
            <input type="hidden" name="action" value="create" />
            
            <!-- Judul Berita -->
            <div class="mb-4">
                <label for="judul" class="form-label fw-bold">Judul Berita</label>
                <input 
                    type="text" 
                    class="form-control form-control-lg" 
                    id="judul" 
                    name="judul" 
                    placeholder="Masukkan judul berita yang menarik..." 
                    value="<?= isset($_POST['judul']) ? htmlspecialchars((string)$_POST['judul']) : '' ?>"
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
                    value="<?= isset($_POST['penulis']) ? htmlspecialchars((string)$_POST['penulis']) : htmlspecialchars($userName) ?>"
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
                    placeholder="Tuliskan isi berita secara lengkap di sini..." 
                    required
                ><?= isset($_POST['konten']) ? htmlspecialchars((string)$_POST['konten']) : '' ?></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                <a href="dashboard.php?page=berita" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$errorMessage = '';
$kategoriOptions = ['Coffee', 'Non-Coffee', 'Makanan', 'Snack'];
$uploadDir = __DIR__ . '/../../../uploads/menu/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $nama_menu = trim((string) ($_POST['nama_menu'] ?? ''));
    $kategori = trim((string) ($_POST['kategori'] ?? 'Coffee'));
    $harga = (string) ($_POST['harga'] ?? '0');
    $deskripsi = trim((string) ($_POST['deskripsi'] ?? ''));
    $status = ($_POST['status'] ?? 'tersedia') === 'habis' ? 'habis' : 'tersedia';
    $hargaFloat = (float) str_replace(['.', ','], ['', '.'], $harga);

    $gambarNama = null;

    if ($nama_menu === '' || $kategori === '') {
        $errorMessage = 'Nama menu dan kategori wajib diisi.';
    } elseif ($hargaFloat < 0) {
        $errorMessage = 'Harga tidak boleh negatif.';
    } else {
        // Proses upload gambar (opsional)
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['gambar']['tmp_name'];
            $fileName = $_FILES['gambar']['name'];
            $fileSize = $_FILES['gambar']['size'];
            $fileExt = strtolower((string) pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($fileExt, $allowedExt, true)) {
                $errorMessage = 'Format gambar harus jpg, jpeg, png, atau webp.';
            } elseif ($fileSize > 2 * 1024 * 1024) {
                $errorMessage = 'Ukuran gambar maksimal 2MB.';
            } else {
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $gambarNama = 'menu_' . uniqid() . '.' . $fileExt;
                if (!move_uploaded_file($fileTmp, $uploadDir . $gambarNama)) {
                    $errorMessage = 'Gagal mengunggah gambar.';
                    $gambarNama = null;
                }
            }
        }

        if ($errorMessage === '') {
            $stmt = $conn->prepare("INSERT INTO `menu` (`nama_menu`, `kategori`, `harga`, `deskripsi`, `gambar`, `status`) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param('ssdsss', $nama_menu, $kategori, $hargaFloat, $deskripsi, $gambarNama, $status);
                if ($stmt->execute()) {
                    $_SESSION['success_message'] = 'Menu berhasil ditambahkan!';
                    $stmt->close();
                    header('Location: dashboard.php?page=menu');
                    exit;
                } else {
                    $errorMessage = 'Gagal menyimpan menu: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
            }
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-plus-circle-fill me-2 text-primary"></i>Tambah Menu Baru</h2>
    <p class="text-secondary small mb-0">Tambahkan menu kopi, non-kopi, atau makanan ke website</p>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm bg-white">
    <div class="card-body p-4 p-md-5">
        <form action="dashboard.php?page=menu_create" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create" />

            <div class="row g-4">
                <div class="col-md-8">
                    <!-- Nama Menu -->
                    <div class="mb-4">
                        <label for="nama_menu" class="form-label fw-bold">Nama Menu</label>
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            id="nama_menu"
                            name="nama_menu"
                            placeholder="Contoh: Cappuccino"
                            value="<?= isset($_POST['nama_menu']) ? htmlspecialchars((string)$_POST['nama_menu']) : '' ?>"
                            required
                        />
                    </div>

                    <div class="row g-3">
                        <!-- Kategori -->
                        <div class="col-md-6 mb-4">
                            <label for="kategori" class="form-label fw-bold">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <?php foreach ($kategoriOptions as $opt): ?>
                                    <option value="<?= htmlspecialchars($opt) ?>" <?= (isset($_POST['kategori']) && $_POST['kategori'] === $opt) ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Harga -->
                        <div class="col-md-6 mb-4">
                            <label for="harga" class="form-label fw-bold">Harga (Rp)</label>
                            <input
                                type="number"
                                min="0"
                                step="500"
                                class="form-control"
                                id="harga"
                                name="harga"
                                placeholder="20000"
                                value="<?= isset($_POST['harga']) ? htmlspecialchars((string)$_POST['harga']) : '' ?>"
                                required
                            />
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea
                            class="form-control"
                            id="deskripsi"
                            name="deskripsi"
                            rows="5"
                            placeholder="Deskripsi singkat menu..."
                        ><?= isset($_POST['deskripsi']) ? htmlspecialchars((string)$_POST['deskripsi']) : '' ?></textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block">Status Ketersediaan</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusTersedia" value="tersedia" checked>
                            <label class="form-check-label" for="statusTersedia">Tersedia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="statusHabis" value="habis">
                            <label class="form-check-label" for="statusHabis">Habis</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="gambar" class="form-label fw-bold">Foto Menu (opsional)</label>
                    <div class="border rounded-3 p-3 text-center bg-light">
                        <i class="bi bi-image fs-1 text-secondary mb-2 d-block"></i>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">
                        <p class="text-muted small mt-2 mb-0">Format JPG/PNG/WEBP, maks 2MB.</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                <a href="dashboard.php?page=menu" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>

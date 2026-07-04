<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$kategoriOptions = ['Coffee', 'Non-Coffee', 'Makanan', 'Snack'];
$uploadDir = __DIR__ . '/../../../uploads/menu/';

if ($id <= 0) {
    $_SESSION['error_message'] = 'ID menu tidak valid.';
    echo "<script>window.location.href='dashboard.php?page=menu';</script>";
    exit;
}

$errorMessage = '';
$menu = null;

// Ambil data menu yang akan diedit
$stmt = $conn->prepare("SELECT * FROM `menu` WHERE `id` = ? LIMIT 1");
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $menu = $result ? $result->fetch_assoc() : null;
    $stmt->close();
} else {
    $errorMessage = 'Gagal memproses data: ' . $conn->error;
}

if (!$menu && $errorMessage === '') {
    $_SESSION['error_message'] = 'Data menu tidak ditemukan.';
    echo "<script>window.location.href='dashboard.php?page=menu';</script>";
    exit;
}

// Proses form update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $nama_menu = trim((string) ($_POST['nama_menu'] ?? ''));
    $kategori = trim((string) ($_POST['kategori'] ?? 'Coffee'));
    $harga = (string) ($_POST['harga'] ?? '0');
    $deskripsi = trim((string) ($_POST['deskripsi'] ?? ''));
    $status = ($_POST['status'] ?? 'tersedia') === 'habis' ? 'habis' : 'tersedia';
    $hargaFloat = (float) str_replace(['.', ','], ['', '.'], $harga);
    $gambarNama = $menu['gambar'];

    if ($nama_menu === '' || $kategori === '') {
        $errorMessage = 'Nama menu dan kategori wajib diisi.';
    } elseif ($hargaFloat < 0) {
        $errorMessage = 'Harga tidak boleh negatif.';
    } else {
        // Proses upload gambar baru (opsional, menggantikan yang lama)
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
                $newGambarNama = 'menu_' . uniqid() . '.' . $fileExt;
                if (move_uploaded_file($fileTmp, $uploadDir . $newGambarNama)) {
                    // Hapus gambar lama jika ada
                    if (!empty($gambarNama) && file_exists($uploadDir . $gambarNama)) {
                        unlink($uploadDir . $gambarNama);
                    }
                    $gambarNama = $newGambarNama;
                } else {
                    $errorMessage = 'Gagal mengunggah gambar baru.';
                }
            }
        }

        // Hapus gambar jika dicentang "Hapus foto saat ini"
        if ($errorMessage === '' && isset($_POST['hapus_gambar']) && $_POST['hapus_gambar'] === '1') {
            if (!empty($gambarNama) && file_exists($uploadDir . $gambarNama)) {
                unlink($uploadDir . $gambarNama);
            }
            $gambarNama = null;
        }

        if ($errorMessage === '') {
            $updateStmt = $conn->prepare("UPDATE `menu` SET `nama_menu` = ?, `kategori` = ?, `harga` = ?, `deskripsi` = ?, `gambar` = ?, `status` = ? WHERE `id` = ?");
            if ($updateStmt) {
                $updateStmt->bind_param('ssdsssi', $nama_menu, $kategori, $hargaFloat, $deskripsi, $gambarNama, $status, $id);
                if ($updateStmt->execute()) {
                    $_SESSION['success_message'] = 'Menu berhasil diperbarui!';
                    $updateStmt->close();
                    header('Location: dashboard.php?page=menu');
                    exit;
                } else {
                    $errorMessage = 'Gagal memperbarui menu: ' . $updateStmt->error;
                }
                $updateStmt->close();
            } else {
                $errorMessage = 'Terjadi kesalahan sistem: ' . $conn->error;
            }
        }
    }
}
?>

<div class="mb-4">
    <h2 class="h4 mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Menu</h2>
    <p class="text-secondary small mb-0">Ubah informasi menu kedai</p>
</div>

<?php if ($errorMessage !== ''): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($errorMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($menu): ?>
    <div class="card border-0 shadow-sm bg-white">
        <div class="card-body p-4 p-md-5">
            <form action="dashboard.php?page=menu_edit&id=<?= $id ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit" />

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
                                value="<?= isset($_POST['nama_menu']) ? htmlspecialchars((string)$_POST['nama_menu']) : htmlspecialchars($menu['nama_menu']) ?>"
                                required
                            />
                        </div>

                        <div class="row g-3">
                            <!-- Kategori -->
                            <div class="col-md-6 mb-4">
                                <label for="kategori" class="form-label fw-bold">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <?php foreach ($kategoriOptions as $opt): ?>
                                        <?php $selectedVal = $_POST['kategori'] ?? $menu['kategori']; ?>
                                        <option value="<?= htmlspecialchars($opt) ?>" <?= ($selectedVal === $opt) ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
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
                                    value="<?= isset($_POST['harga']) ? htmlspecialchars((string)$_POST['harga']) : htmlspecialchars((string)$menu['harga']) ?>"
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
                            ><?= isset($_POST['deskripsi']) ? htmlspecialchars((string)$_POST['deskripsi']) : htmlspecialchars((string)$menu['deskripsi']) ?></textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Status Ketersediaan</label>
                            <?php $currentStatus = $_POST['status'] ?? $menu['status']; ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusTersedia" value="tersedia" <?= $currentStatus === 'tersedia' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusTersedia">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusHabis" value="habis" <?= $currentStatus === 'habis' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusHabis">Habis</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold d-block">Foto Menu</label>
                        <?php if (!empty($menu['gambar']) && file_exists($uploadDir . $menu['gambar'])): ?>
<<<<<<< HEAD
                            <img src="../../../uploads/menu/<?= htmlspecialchars($menu['gambar']) ?>" class="img-fluid rounded mb-2 border" alt="Foto menu">
=======
                        <img src="/aplikasi_coffeshop/uploads/menu/<?= htmlspecialchars($menu['gambar']) ?>" class="img-fluid rounded mb-2 border" alt="Foto menu">
>>>>>>> 256dab96f9ef7c8e169efed93d627ea8cf8d6786
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="hapus_gambar" value="1" id="hapusGambar">
                                <label class="form-check-label small text-danger" for="hapusGambar">Hapus foto saat ini</label>
                            </div>
                        <?php else: ?>
                            <div class="border rounded-3 p-4 text-center bg-light mb-2">
                                <i class="bi bi-cup-hot-fill fs-1 text-secondary"></i>
                                <p class="text-muted small mb-0 mt-2">Belum ada foto</p>
                            </div>
                        <?php endif; ?>
                        <div class="border rounded-3 p-3 text-center bg-light">
                            <input type="file" class="form-control" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">
                            <p class="text-muted small mt-2 mb-0">Unggah untuk mengganti foto. Maks 2MB.</p>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                    <a href="dashboard.php?page=menu" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

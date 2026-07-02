<?php
require_once __DIR__ . '/../../koneksi/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim((string) ($_POST['nama'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $pesan = trim((string) ($_POST['pesan'] ?? ''));

    if ($nama !== '' && $pesan !== '') {
        $stmt = $conn->prepare("INSERT INTO `feedback` (`nama`, `email`, `pesan`) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $nama, $email, $pesan);
            $stmt->execute();
            $stmt->close();
            $success = true;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kritik & Saran - Kedai Kopi Senja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container py-5">
    <a href="../../index.php" class="btn btn-outline-secondary btn-sm mb-4">Kembali</a>
    <h1 class="h3 fw-bold mb-3">Kritik & Saran</h1>
    <p class="text-secondary">Berikan masukan Anda untuk Kedai Kopi Senja.</p>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">Terima kasih atas masukan Anda.</div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pesan</label>
                    <textarea class="form-control" name="pesan" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
require_once __DIR__ . '/../../koneksi/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim((string) ($_POST['nama'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $telepon = trim((string) ($_POST['telepon'] ?? ''));
    $tanggal = trim((string) ($_POST['tanggal'] ?? ''));
    $jam = trim((string) ($_POST['jam'] ?? ''));
    $jumlah_orang = (int) ($_POST['jumlah_orang'] ?? 1);
    $catatan = trim((string) ($_POST['catatan'] ?? ''));

    if ($nama !== '' && $tanggal !== '' && $jam !== '') {
        $stmt = $conn->prepare("INSERT INTO `reservasi` (`nama_pelanggan`, `email`, `telepon`, `tanggal`, `jam`, `jumlah_orang`, `catatan`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sssssis', $nama, $email, $telepon, $tanggal, $jam, $jumlah_orang, $catatan);
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
    <title>Reservasi - Kedai Kopi Senja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container py-5">
    <a href="../../index.php" class="btn btn-outline-secondary btn-sm mb-4">Kembali</a>
    <h1 class="h3 fw-bold mb-3">Reservasi Meja</h1>
    <p class="text-secondary">Isi form di bawah untuk reservasi meja di Kedai Kopi Senja.</p>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">Reservasi Anda berhasil dikirim. Kami akan menghubungi Anda segera.</div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jam</label>
                        <input type="time" class="form-control" name="jam" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Orang</label>
                        <input type="number" class="form-control" name="jumlah_orang" min="1" value="1">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="4"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Kirim Reservasi</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

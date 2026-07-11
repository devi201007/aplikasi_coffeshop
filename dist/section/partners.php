<?php
require_once __DIR__ . '/../../koneksi/db_connection.php';

$partners = [];
$check = $conn->query("SHOW TABLES LIKE 'partners'");
if ($check && $check->num_rows > 0) {
    $result = $conn->query("SELECT * FROM `partners` WHERE `status` = 'aktif' ORDER BY `id` DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $partners[] = $row;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Our Partners - Kedai Kopi Senja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container py-5">
    <a href="../../index.php" class="btn btn-outline-secondary btn-sm mb-4">Kembali</a>
    <h1 class="h3 fw-bold mb-3">Our Partners</h1>
    <p class="text-secondary">Partner yang mendukung Kedai Kopi Senja.</p>
    <?php if (count($partners) === 0): ?>
        <div class="alert alert-info">Belum ada partner aktif.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($partners as $partner): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <?php if (!empty($partner['foto'])): ?>
<img src="/aplikasi_coffeshop/uploads/partners/<?= htmlspecialchars($partner['foto']) ?>" 
     class="img-fluid rounded mb-3" 
     style="height: 180px; width: 100%; object-fit: cover;">
                        <?php endif; ?>
                            <h2 class="h5 fw-bold"><?= htmlspecialchars($partner['nama']) ?></h2>
                            <p class="text-secondary small mb-3"><?= htmlspecialchars($partner['deskripsi']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>


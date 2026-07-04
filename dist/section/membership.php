<?php
require_once __DIR__ . '/../../koneksi/db_connection.php';

function formatHarga(float $harga): string
{
    return 'Rp ' . number_format($harga, 0, ',', '.');
}

$membershipList = [];
$membershipTableExists = false;

$checkTable = $conn->query("SHOW TABLES LIKE 'membership'");
if ($checkTable && $checkTable->num_rows > 0) {
    $membershipTableExists = true;
    $result = $conn->query("SELECT * FROM `membership` WHERE `status` = 'aktif' ORDER BY `harga` ASC, `id` DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $membershipList[] = $row;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Membership - Kedai Kopi Senja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <style>
        :root {
            --kopi-dark: #2b1b12;
            --kopi-brown: #5c3a21;
            --kopi-accent: #c8823a;
            --kopi-cream: #f4ead9;
            --kopi-cream-2: #fbf6ee;
        }
        body { background: var(--kopi-cream-2); color: var(--kopi-dark); font-family: 'Poppins', sans-serif; }
        .btn-kopi { background: var(--kopi-accent); color: #fff; }
        .btn-kopi:hover { background: #a86a2c; color: #fff; }
        .section-title { color: var(--kopi-brown); }
        .menu-card { border: none; border-radius: 1rem; background: #fff; box-shadow: 0 2px 10px rgba(43,27,18,0.06); }
        .menu-price { color: var(--kopi-accent); font-weight: 700; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <a href="../../index.php" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
            <h1 class="section-title fw-bold">Membership Kopi Senja</h1>
            <p class="text-secondary mx-auto" style="max-width: 620px;">
                Nikmati keuntungan eksklusif dengan menjadi member resmi Kedai Kopi Senja.
            </p>
        </div>

        <?php if (!$membershipTableExists || count($membershipList) === 0): ?>
            <div class="alert alert-warning text-center mx-auto" style="max-width: 560px;">
                <i class="bi bi-info-circle me-2"></i>Data membership belum tersedia. Silakan tambahkan melalui panel admin.
            </div>
        <?php else: ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($membershipList as $paket): ?>
                    <?php $benefitLines = array_filter(array_map('trim', explode("\n", (string) $paket['benefit']))); ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card menu-card h-100 p-3">
                            <div class="card-body text-center">
                                <?php if ((int) $paket['is_populer'] === 1): ?>
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-2">Paling Populer</span>
                                <?php endif; ?>
                                <h2 class="h5 fw-bold section-title mb-1"><?= htmlspecialchars($paket['nama_paket']) ?></h2>
                                <div class="text-secondary small mb-3"><?= htmlspecialchars($paket['jenis']) ?></div>
                                <div class="mb-3">
                                    <span class="fs-3 fw-bold menu-price"><?= formatHarga((float) $paket['harga']) ?></span>
                                    <span class="text-secondary small">/ <?= htmlspecialchars($paket['periode']) ?></span>
                                </div>
                                <ul class="list-unstyled text-start mb-0">
                                    <?php foreach ($benefitLines as $benefit): ?>
                                        <li class="d-flex mb-2">
                                            <i class="bi bi-check-circle-fill me-2" style="color: var(--kopi-accent);"></i>
                                            <span class="text-secondary small"><?= htmlspecialchars($benefit) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

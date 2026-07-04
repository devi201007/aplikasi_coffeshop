<?php
require_once __DIR__ . '/../../koneksi/db_connection.php';

$faqList = [];
$faqTableExists = false;

$checkTable = $conn->query("SHOW TABLES LIKE 'faq'");
if ($checkTable && $checkTable->num_rows > 0) {
    $faqTableExists = true;
    $result = $conn->query("SELECT * FROM `faq` ORDER BY `urutan` ASC, `id` DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $faqList[] = $row;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FAQ - Kedai Kopi Senja</title>
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
        body { background: var(--kopi-cream-2); color: var(--kopi-dark); }
        .section-title { color: var(--kopi-brown); }
        .accordion-button { box-shadow: none !important; }
        .accordion-button:not(.collapsed) {
            background-color: #fff8ef;
            color: var(--kopi-brown);
        }
        .accordion-button:focus {
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <a href="../../index.php" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
            <h1 class="section-title fw-bold">FAQ Kedai Kopi Senja</h1>
            <p class="text-secondary mx-auto" style="max-width: 620px;">
                Temukan jawaban atas pertanyaan seputar kedai, menu, dan layanan kami.
            </p>
        </div>

        <?php if (!$faqTableExists || count($faqList) === 0): ?>
            <div class="alert alert-warning text-center mx-auto" style="max-width: 560px;">
                <i class="bi bi-info-circle me-2"></i>Belum ada data FAQ. Silakan tambahkan melalui panel admin.
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <?php foreach ($faqList as $i => $faq): ?>
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-3 overflow-hidden">
                                <h2 class="accordion-header" id="faqHeading<?= $faq['id'] ?>">
                                    <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $faq['id'] ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faqCollapse<?= $faq['id'] ?>">
                                        <span class="fw-semibold section-title"><?= htmlspecialchars($faq['pertanyaan']) ?></span>
                                    </button>
                                </h2>
                                <div id="faqCollapse<?= $faq['id'] ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" aria-labelledby="faqHeading<?= $faq['id'] ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-secondary">
                                        <?= nl2br(htmlspecialchars($faq['jawaban'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var triggers = document.querySelectorAll('.accordion-button');
            triggers.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var target = btn.getAttribute('data-bs-target');
                    if (!target) return;
                    var collapse = document.querySelector(target);
                    if (collapse) {
                        var instance = bootstrap.Collapse.getOrCreateInstance(collapse, { toggle: false });
                        instance.toggle();
                    }
                });
            });
        });
    </script>
</body>
</html>

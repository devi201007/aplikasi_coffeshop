<!-- ===================== PROMO / ARTIKEL ===================== -->
<?php if (count($beritaList) > 0): ?>
<section id="promo" class="section-py">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase small fw-semibold section-sub">Info Terbaru</span>
            <h2 class="h3 fw-bold section-title mt-2">Promo &amp; Berita Kedai</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($beritaList as $berita): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="text-secondary small mb-2">
                                <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime((string)$berita['tanggal_dibuat'])) ?>
                            </div>
                            <h3 class="h6 fw-bold mb-2"><?= htmlspecialchars($berita['judul']) ?></h3>
                            <p class="text-secondary small mb-0">
                                <?= htmlspecialchars(mb_strimwidth(strip_tags((string)$berita['konten']), 0, 140, '...')) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===================== MENU ===================== -->
<section id="menu" class="section-py" style="background-color: var(--kopi-cream);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase small fw-semibold section-sub">Menu Pilihan</span>
            <h2 class="h3 fw-bold section-title mt-2">Daftar Menu Kedai</h2>
            <p class="text-secondary mx-auto" style="max-width: 560px;">
                Menu di bawah hanya bersifat informasi. Untuk menikmatinya, silakan datang langsung ke kedai kami.
            </p>
        </div>

        <?php if (!$menuTableExists || count($menuByCategory) === 0): ?>
            <div class="alert alert-warning text-center mx-auto" style="max-width: 500px;">
                <i class="bi bi-info-circle me-2"></i>Menu belum tersedia. Silakan setup data menu melalui panel admin.
            </div>
        <?php else: ?>
            <?php foreach ($menuByCategory as $kategori => $items): ?>
                <div class="mb-5">
                    <span class="badge category-pill rounded-pill px-3 py-2 mb-3"><?= htmlspecialchars($kategori) ?></span>
                    <div class="row g-4">
                        <?php foreach ($items as $item): ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card menu-card h-100">
                                    <?php if (!empty($item['gambar']) && file_exists(__DIR__ . '/../uploads/menu/' . $item['gambar'])): ?>
                                        <img src="uploads/menu/<?= htmlspecialchars($item['gambar']) ?>" class="menu-img" alt="<?= htmlspecialchars($item['nama_menu']) ?>">
                                    <?php else: ?>
                                        <div class="menu-img-placeholder">
                                            <i class="bi bi-cup-hot-fill"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h3 class="h6 fw-bold mb-1"><?= htmlspecialchars($item['nama_menu']) ?></h3>
                                        <p class="text-secondary small mb-2" style="min-height: 40px;">
                                            <?= htmlspecialchars((string) $item['deskripsi']) ?>
                                        </p>
                                        <div class="menu-price"><?= formatHarga((float) $item['harga']) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Kopi Senja</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #fdf6f0; margin: 0; }

        /* ── NAV ── */
        nav { 
            background:#eee; 
            text-align:center; 
            padding:15px; 
        }
        nav a { 
            margin:0 10px; 
            text-decoration:none; 
            color:#6f4e37; 
            font-weight:bold; 
        }
        nav a:hover { 
            color:#8b5e3c; 
        }

        /* ── HEADER ── */
        header {
            background: #6f4e37;
            color: #fff;
            text-align: center;
            padding: 80px 40px 70px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .header-logo { margin: 0 auto 24px; display: block; }
        header h1 { font-size: 3em; margin-bottom: 12px; letter-spacing: 2px; }
        header p { font-size: 1.15em; color: rgba(255,255,255,0.8); margin-bottom: 32px; }
        .btn-order {
            background: #fff;
            color: #6f4e37;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1em;
            display: inline-block;
            transition: background 0.2s, color 0.2s, transform 0.15s;
            border: none;
            cursor: pointer;
        }
        .btn-order:hover { background: #fbbf24; color: #3b1f0a; transform: translateY(-2px); }

        /* ── TAGLINE STRIP ── */
        .tagline-strip {
            background: #3b1f0a;
            color: #fbbf24;
            text-align: center;
            padding: 18px 20px;
            font-size: 0.82em;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        /* ── ABOUT SECTION ── */
        .about {
            max-width: 820px;
            margin: 60px auto;
            padding: 0 30px;
            text-align: center;
        }
        .about h2 { color: #6f4e37; font-size: 1.8em; margin-bottom: 16px; }
        .about p { color: #7a5540; font-size: 1em; line-height: 1.9; }

        /* ── DIVIDER ── */
        .divider {
            width: 60px;
            height: 3px;
            background: #f97316;
            margin: 20px auto;
            border-radius: 2px;
        }

        /* ── FEATURE CARDS ── */
        .features {
            background: #fff8f2;
            padding: 50px 30px;
        }
        .features h2 {
            text-align: center;
            color: #6f4e37;
            font-size: 1.6em;
            margin-bottom: 36px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 960px;
            margin: 0 auto;
        }
        .feature-card {
            background: #fff;
            border-radius: 12px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(111,78,55,0.09);
            border-top: 3px solid #f97316;
        }
        .feature-icon { font-size: 2.2em; margin-bottom: 14px; }
        .feature-card h3 { color: #6f4e37; margin-bottom: 10px; font-size: 1.1em; }
        .feature-card p { color: #8b6450; font-size: 0.88em; line-height: 1.7; }

        /* ── QUOTE ── */
        .quote-strip {
            background: #6f4e37;
            color: #fff;
            text-align: center;
            padding: 60px 30px;
        }
        .quote-strip blockquote {
            font-size: 1.25em;
            font-style: italic;
            max-width: 600px;
            margin: 0 auto 14px;
            line-height: 1.8;
        }
        .quote-strip cite { font-size: 0.8em; opacity: 0.6; font-style: normal; letter-spacing: 2px; }

        /* ── FOOTER ── */
        footer {
            background: #3b1f0a;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            color: rgba(255,255,255,0.5);
            font-size: 0.85em;
        }
        .footer-brand { display: flex; align-items: center; gap: 8px; color: #fbbf24; font-weight: bold; }

        @media (max-width: 700px) {
            header h1 { font-size: 2em; }
            .features-grid { grid-template-columns: 1fr; }
            footer { flex-direction: column; gap: 8px; text-align: center; padding: 16px; }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <h1>Kopi Senja</h1>
    <p>Selamat datang! Nikmati kopi terbaik dan suasana hangat.</p>
</header>

<div class="tagline-strip"> Coffee & Bakery · Est. 2024 · Brew Happiness in Every Cup</div>

<!-- NAV -->
<nav>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact</a>
    <a href="faq.php">FAQ</a>
    <a href="membership.php">Membership</a>
    <a href="gallerycaffe.php">Gallery</a>
    <a href="ourpartners.php">Our Partners</a>
</nav>

<main>
    <!-- ABOUT -->
    <section class="about">
        <h2>Tentang Kopi Senja</h2>
        <div class="divider"></div>
        <p>Kopi Senja adalah tempat di mana setiap tegukan membawa kehangatan. Kami percaya bahwa secangkir kopi yang baik bisa mengubah hari yang biasa menjadi momen yang tak terlupakan. Dari biji pilihan hingga roti yang dipanggang segar setiap pagi — semua hadir untuk kamu.</p>
    </section>

    <!-- FEATURE CARDS -->
    <section class="features">
        <h2>Mengapa Kopi Senja?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"></div>
                <h3>Kopi Pilihan</h3>
                <p>Biji kopi premium dari berbagai daerah, diseduh dengan penuh perhatian oleh barista berpengalaman.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"></div>
                <h3>Bakery Segar</h3>
                <p>Roti dan pastri dipanggang setiap pagi. Renyah di luar, lembut di dalam, hangat saat tiba di mejamu.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"></div>
                <h3>Suasana Hangat</h3>
                <p>Tempat yang nyaman untuk bekerja, bersantai, atau menghabiskan waktu bersama orang tersayang.</p>
            </div>
        </div>
    </section>

    <!-- QUOTE -->
    <div class="quote-strip">
        <blockquote>"Tempat di mana waktu melambat, kopi menghangatkan, dan senja selalu terasa indah."</blockquote>
        <cite>— Kopi Senja</cite>
    </div>
</main>

<!-- FOOTER -->
<footer>
    <div class="footer-brand">
        Kopi Senja
    </div>
    <p>&copy; 2024 Kopi Senja · Coffee & Bakery</p>
</footer>

</body>

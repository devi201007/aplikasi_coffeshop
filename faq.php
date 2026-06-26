<!DOCTYPE html>
<html>
<head>
    <title>FAQ - Coffee Shop App</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:#fff; text-align:center; padding:40px; }
        h1 { margin:0; font-size:2.5em; }

        .faq-box { width: 700px; margin: 40px auto; }
        .faq-item { margin-bottom: 20px; }
        .faq-item h3 {
            cursor: pointer;
            background:#f4e1d2;
            padding:10px;
            border-radius:6px;
            color:#6f4e37;
        }
        .faq-item p {
            display:none;
            padding:10px;
            background:#fff;
            border:1px solid #ccc;
            border-radius:6px;
        }

        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
    <script>
        function toggleFAQ(id) {
            var x = document.getElementById(id);
            x.style.display = (x.style.display === "block") ? "none" : "block";
        }
    </script>
</head>
<body>
<header>
    <h1>❓ Frequently Asked Questions</h1>
    <p>Jawaban cepat untuk pertanyaan umum</p>
</header>

<section class="faq-box">
    <div class="faq-item">
        <h3 onclick="toggleFAQ('faq1')">Jam buka coffee shop?</h3>
        <p id="faq1">Kami buka setiap hari pukul 08.00 – 22.00 WIB.</p>
    </div>
    <div class="faq-item">
        <h3 onclick="toggleFAQ('faq2')">Metode pembayaran apa saja?</h3>
        <p id="faq2">Kami menerima tunai, kartu debit/kredit, dan e-wallet (OVO, GoPay, Dana).</p>
    </div>
    <div class="faq-item">
        <h3 onclick="toggleFAQ('faq3')">Apakah ada layanan delivery?</h3>
        <p id="faq3">Ya, kami bekerja sama dengan GoFood dan GrabFood.</p>
    </div>
    <div class="faq-item">
        <h3 onclick="toggleFAQ('faq4')">Apakah tersedia koneksi Wi-Fi?</h3>
        <p id="faq4">Tentu saja! Kami menyediakan Wi-Fi gratis berkecepatan tinggi beserta banyak colokan listrik untuk pelanggan yang ingin Work From Cafe (WFC).</p>
    </div>
    <div class="faq-item">
        <h3 onclick="toggleFAQ('faq5')">Bisakah saya melakukan reservasi tempat?</h3>
        <p id="faq5">Bisa. Anda dapat melakukan reservasi untuk acara, meeting, atau kumpul-kumpul melalui halaman Contact maksimal H-1.</p>
    </div>
    <div class="faq-item">
        <h3 onclick="toggleFAQ('faq6')">Apakah ada area khusus merokok (smoking area)?</h3>
        <p id="faq6">Ada, kami menyediakan area outdoor dan semi-outdoor yang sejuk dan nyaman khusus untuk pengunjung yang merokok.</p>
    </div>
</section>

<nav>
    <a href="home.php">Beranda</a>
    <a href="about.php">About Us</a>
    <a href="menu.php">Menu</a>
    <a href="order.php">Order</a>
    <a href="contact.php">Contact</a>
    <a href="faq.php">FAQ</a>
    <a href="membership.php">Membership</a>
</nav>
</body>
</html>
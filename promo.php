<!DOCTYPE html>
<html>
<head>
    <title>Promo & Events - Coffee Shop</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; padding:0; }
        header { background:#6f4e37; color:#fff; text-align:center; padding:30px; }
        h1 { margin:0; font-size:2.5em; }
        .promo-section { display:flex; flex-wrap:wrap; justify-content:center; margin:40px auto; max-width:1000px; }
        .promo-card { background:#fff; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.2); margin:20px; width:280px; overflow:hidden; transition:transform 0.3s; }
        .promo-card:hover { transform:scale(1.05); }
        .promo-card img { width:100%; height:180px; object-fit:cover; }
        .promo-card h3 { margin:15px; color:#6f4e37; }
        .promo-card p { margin:0 15px 15px; color:#333; }
        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
    </style>
</head>
<body>
<header>
    <h1>🎉 Promo & Events</h1>
    <p>Jangan lewatkan penawaran spesial dan acara seru di Coffee Shop kami!</p>
</header>

<section class="promo-section">
    <div class="promo-card">
        <img src="uploads/foto/coffee.png" alt="Latte Promo">
        <h3>Diskon Latte 20%</h3>
        <p>Hanya minggu ini! Nikmati Latte favoritmu dengan harga spesial.</p>
    </div>
    <div class="promo-card">
        <img src="uploads/foto/croissant.png" alt="Croissant Deal">
        <h3>Beli 2 Croissant Gratis 1 Espresso</h3>
        <p>Promo sarapan hemat untuk kamu dan temanmu.</p>
    </div>
    <div class="promo-card">
        <img src="uploads/foto/barista1.png" alt="Event Acoustic">
        <h3>Live Acoustic Night</h3>
        <p>Sabtu, 27 Juni 2026 – nikmati musik akustik sambil menyeruput kopi hangat.</p>
    </div>
    <div class="promo-card">
        <img src="uploads/foto/barista2.png" alt="Latte Art Workshop">
        <h3>Workshop Latte Art</h3>
        <p>Minggu, 5 Juli 2026 – belajar bikin latte art bersama barista profesional.</p>
    </div>
</section>

<nav>
    <a href="index.php">Home</a>
    <a href="menu.php">Menu</a>
    <a href="order.php">Order</a>
    <a href="contact.php">Contact</a>
    <a href="faq.php">FAQ</a>
</nav>
</body>
</html>

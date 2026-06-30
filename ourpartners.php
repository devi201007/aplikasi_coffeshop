<!DOCTYPE html>
<html>
<head>
    <title>Our Partners - Coffee Shop App</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:#fff; text-align:center; padding:40px; }
        h1 { margin:0; font-size:2.5em; }

        .partners-container {
            display:flex; flex-wrap:wrap; justify-content:center;
            gap:30px; padding:40px;
        }
        .partner-card {
            background:#fff; width:220px; text-align:center;
            border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.25);
            padding:20px; transition:0.3s;
        }
        .partner-card:hover { transform:scale(1.05); }
        .partner-card img {
            width:100%; height:120px; object-fit:contain;
            margin-bottom:10px;
        }
        .partner-card h3 { color:#6f4e37; margin:10px 0 0; }


        nav { background:#eee; text-align:center; padding:15px; margin-top:30px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
</head>
<body>
<header>
    <h1> Our Partners</h1>
    <p>Kami bangga bekerja sama dengan partner terbaik</p>
</header>

<div class="partners-container">
    <div class="partner-card">
        <img src="uploads/foto/otten.jpeg" alt="Otten Coffee">
        <h3>Otten Coffee</h3>
    </div>
    <div class="partner-card">
        <img src="uploads/foto/jco.png" alt="J.CO Donuts & Coffee">
        <h3>J.CO Donuts & Coffee</h3>
    </div>
    <div class="partner-card">
        <img src="uploads/foto/gofood.png" alt="GoFood">
        <h3>GoFood</h3>
    </div>
    <div class="partner-card">
        <img src="uploads/foto/grabfood.png" alt="GrabFood">
        <h3>GrabFood</h3>
    </div>
    <div class="partner-card">
        <img src="uploads/foto/shopee.png" alt="Shopee Food">
        <h3>Shopee Food</h3>
    </div>
</div>


<nav>
    <a href="home.php">Beranda</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact</a>
    <a href="order.php">Order</a>
    <a href="faq.php">FAQ</a>
    <a href="membership.php">Membership</a>
    <a href="gallery.php">Gallery</a>
    <a href="ourpartners.php">Our Partners</a>
</nav>
</body>
</html>

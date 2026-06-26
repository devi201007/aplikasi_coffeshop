<!DOCTYPE html>
<html>
<head>
    <title>Menu - Coffee Shop App</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:#fff; text-align:center; padding:40px; }
        h1 { margin:0; font-size:2.5em; }
        header p { font-size:1.2em; }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 40px;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
            width: 250px;
            text-align: center;
            padding: 20px;
            transition: 0.3s;
        }
        .card:hover { transform: scale(1.05); }
        .card img {
            width: 100%;
            border-radius: 8px;
        }
        .card h3 {
            margin: 15px 0 5px;
            color: #6f4e37;
        }
        .card p {
            margin: 5px 0;
            font-weight: bold;
        }
        .card button {
            margin-top: 10px;
            background: #6f4e37;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .card button:hover {
            background: #d2691e;
        }

        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
</head>
<body>
    <header>
        <h1>🍵 Our Menu</h1>
        <p>Pilih minuman dan makanan favoritmu</p>
    </header>

    <div class="menu-container">
        <!-- Coffee -->
        <div class="card">
            <img src="uploads/foto/espresso.png" alt="Espresso">
            <h3>Espresso</h3>
            <p>Rp25.000</p>
            <button onclick="window.location.href='order.php?menu=Espresso'">Pesan</button>
        </div>

        <div class="card">
            <img src="uploads/foto/cappuccino.png" alt="Cappuccino">
            <h3>Cappuccino</h3>
            <p>Rp30.000</p>
            <button onclick="window.location.href='order.php?menu=Cappuccino'">Pesan</button>
        </div>

        <div class="card">
            <img src="uploads/foto/latte.png" alt="Latte">
            <h3>Latte</h3>
            <p>Rp28.000</p>
            <button onclick="window.location.href='order.php?menu=Latte'">Pesan</button>
        </div>

        <!-- Non-Coffee -->
        <div class="card">
            <img src="uploads/foto/greentea.png" alt="Green Tea">
            <h3>Green Tea</h3>
            <p>Rp22.000</p>
            <button onclick="window.location.href='order.php?menu=Green Tea'">Pesan</button>
        </div>

        <!-- Bakery -->
        <div class="card">
            <img src="uploads/foto/croissant.png" alt="Croissant">
            <h3>Croissant</h3>
            <p>Rp20.000</p>
            <button onclick="window.location.href='order.php?menu=Croissant'">Pesan</button>
        </div>
    </div>

    <nav>
        <a href="home.php">Beranda</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="faq.php">FAQ</a>
        <a href="membership.php">Membership</a>
    </nav>
</body>
</html>

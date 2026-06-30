<!DOCTYPE html>
<html>
<head>
    <title>Menu - KOPI SENJA</title>
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
        <h1>🍵 Gallery Caffe</h1>
        <p>Most Popular Menu</p>
    </header>

    <div class="menu-container">
        <!-- Coffee -->
        <div class="card">
            <img src="uploads/foto/espresso.png" alt="Espresso">
            <h3>Espresso</h3>
            <p>Rp25.000</p>
            <button onclick="window.location.href='order.php?menu=Espresso'">☆☆☆</button>
        </div>

        <div class="card">
            <img src="uploads/foto/cappuccino.png" alt="Cappuccino">
            <h3>Cappuccino</h3>
            <p>Rp30.000</p>
            <button onclick="window.location.href='order.php?menu=Cappuccino'">☆☆☆</button>
        </div>

        <div class="card">
            <img src="uploads/foto/latte.png" alt="Latte">
            <h3>Latte</h3>
            <p>Rp28.000</p>
            <button onclick="window.location.href='order.php?menu=Latte'">☆☆☆</button>
        </div>

        <!-- Non-Coffee -->
        <div class="card">
            <img src="uploads/foto/greentea.png" alt="Green Tea">
            <h3>Green Tea</h3>
            <p>Rp22.000</p>
            <button onclick="window.location.href='order.php?menu=Green Tea'">☆☆</button>
        </div>

        <!-- Bakery -->
        <div class="card">
            <img src="uploads/foto/croissant.png" alt="Croissant">
            <h3>Croissant</h3>
            <p>Rp20.000</p>
            <button onclick="window.location.href='order.php?menu=Croissant'">☆☆☆</button>
        </div>

         <!-- Bakery -->
        <div class="card">
            <img src="uploads/foto/cheescake.png" alt="Cheescake">
            <h3>Cheescake</h3>
            <p>Rp20.000</p>
            <button onclick="window.location.href='order.php?menu=Cheescake'">☆☆☆</button>
        </div>
    </div>
   <header>
    <h1>🍵 Gallery Caffe</h1>
    <p>All Menu</p>
</header>

<div class="menu-container">
    <!-- Non-Coffee -->
    <div class="card">
        <img src="uploads/foto/taro.png" alt="Taro Latte">
        <h3>Taro Latte</h3>
        <p>Rp22.000</p>
        <button onclick="window.location.href='order.php?menu=Taro Latte'">☆☆</button>
    </div>

    <!-- Non-Coffee -->
    <div class="card">
        <img src="uploads/foto/airmineral.png" alt="Air Mineral">
        <h3>Air Mineral</h3>
        <p>Rp50.000</p>
        <button onclick="window.location.href='order.php?menu=Air Mineral'">☆☆</button>
    </div>

    <!-- Bakery -->
    <div class="card">
        <img src="uploads/foto/cinnamon.png" alt="Cinnamon Cake">
        <h3>Cinnamon Cake</h3>
        <p>Rp20.000</p>
        <button onclick="window.location.href='order.php?menu=Cinnamon Cake'">☆☆</button>

    </div>
    <!-- Bakery -->
    <div class="card">
        <img src="uploads/foto/tiramisu.png" alt="Tiramisu Cake">
        <h3>Tiramisu Cake</h3>
        <p>Rp20.000</p>
        <button onclick="window.location.href='order.php?menu=Tiramisu Cake'">☆☆</button>
    </div>

    <!-- Bakery -->
    <div class="card">
        <img src="uploads/foto/muffin.png" alt="Bluberry Muffin">
        <h3>Blueberry Muffin</h3>
        <p>Rp20.000</p>
        <button onclick="window.location.href='order.php?menu=Blueberry Muffin'">☆☆</button>
    </div>

    <!-- Non-Coffee -->
    <div class="card">
        <img src="uploads/foto/chocolate.png" alt="Chocolate">
        <h3>Chocolate</h3>
        <p>Rp25.000</p>
        <button onclick="window.location.href='order.php?menu=Chocolate'">☆☆</button>
    </div>

    <!-- Non-Coffee -->
    <div class="card">
        <img src="uploads/foto/thaitea.png" alt="Thai Tea">
        <h3>Thai Tea</h3>
        <p>Rp25.000</p>
        <button onclick="window.location.href='order.php?menu=Thai Tea'">☆☆</button>
    </div>

    <!-- Non-Coffee -->
    <div class="card">
        <img src="uploads/foto/lemontea.png" alt="Lemon Tea">
        <h3>Lemon Tea</h3>
        <p>Rp20.000</p>
        <button onclick="window.location.href='order.php?menu=Lemon Tea'">☆☆</button>
    </div>

    <!-- Non-Coffee -->
    <div class="card">
        <img src="uploads/foto/red.png" alt="Red Velvet">
        <h3>Red Velvet</h3>
        <p>Rp20.000</p>
        <button onclick="window.location.href='order.php?menu=Red Velvet'">☆☆</button>
    </div>

     <!-- Coffee -->
        <div class="card">
            <img src="uploads/foto/americano.png" alt="Americano">
            <h3>Americano</h3>
            <p>Rp60.000</p>
            <button onclick="window.location.href='order.php?menu=Americano'">☆☆</button>
        </div>

         <!-- Coffee -->
        <div class="card">
            <img src="uploads/foto/flat.png" alt="Flat White">
            <h3>Flat White</h3>
            <p>Rp55.000</p>
            <button onclick="window.location.href='order.php?menu=Flat White'">☆☆</button>
        </div>

        <!-- Coffee -->
        <div class="card">
            <img src="uploads/foto/affogato.png" alt="Affogato">
            <h3>Affogato</h3>
            <p>Rp58.000</p>
            <button onclick="window.location.href='order.php?menu=Affogato'">☆☆</button>
        </div>

        <!-- Main Course -->
        <div class="card">
            <img src="uploads/foto/truffle.png" alt="Truffle Cream Pasta">
            <h3>Truffle Cream Pasta</h3>
            <p>Rp118.000</p>
            <button onclick="window.location.href='order.php?menu=Truffle Cream Pasta'">☆☆</button>
        </div>

         <!-- Main Course -->
        <div class="card">
            <img src="uploads/foto/fish.png" alt="Fish & Chips">
            <h3>Fish &Chips</h3>
            <p>Rp115.000</p>
            <button onclick="window.location.href='order.php?menu=Fish & Chips'">☆☆</button>
        </div>

         <!-- Main Course -->
        <div class="card">
            <img src="uploads/foto/wagyu.png" alt="Wagyu Beef Burger">
            <h3>Wagyu Beef Burger</h3>
            <p>Rp145.000</p>
            <button onclick="window.location.href='order.php?menu=Wagyu Beef Burger'">☆☆</button>
        </div>
</div>

    <nav>
        <a href="home.php">Beranda</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="faq.php">FAQ</a>
        <a href="membership.php">Membership</a>
        <a href="ourpartners.php">Our Partners</a>
   
    </nav>
main
</body>
</html>

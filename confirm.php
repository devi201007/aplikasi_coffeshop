<?php
$nama   = $_POST['nama'];
$menu   = $_POST['menu'];
$jumlah = $_POST['jumlah'];
$metode = $_POST['metode'];

// Harga produk
$harga = 0;
switch($menu){
    case "Espresso": $harga = 25000; break;
    case "Cappuccino": $harga = 30000; break;
    case "Latte": $harga = 28000; break;
    case "Green Tea": $harga = 22000; break;
    case "Croissant": $harga = 20000; break;
}
$total = $jumlah * $harga;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Pesanan - Coffee Shop App</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:#fff; text-align:center; padding:40px; }
        h1 { margin:0; font-size:2.5em; }
        header p { font-size:1.2em; }

        .confirm-box {
            background:#fff;
            padding:40px;
            border-radius:12px;
            box-shadow:0 6px 12px rgba(0,0,0,0.25);
            width:500px;
            margin:60px auto;
            text-align:center;
        }
        .confirm-box h2 { color:#6f4e37; }
        .confirm-box p { font-size:18px; margin:10px 0; }
        .confirm-box a {
            display:inline-block;
            margin-top:20px;
            background:#6f4e37;
            color:white;
            padding:12px 20px;
            border-radius:8px;
            text-decoration:none;
        }
        .confirm-box a:hover { background:#d2691e; }

        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
</head>
<body>
<header>
    <h1>✅ Konfirmasi Pesanan</h1>
    <p>Detail pesananmu sudah tercatat</p>
</header>

<div class="confirm-box">
    <h2>Pesanan Berhasil!</h2>
    <p><b>Nama:</b> <?php echo $nama; ?></p>
    <p><b>Menu:</b> <?php echo $menu; ?></p>
    <p><b>Jumlah:</b> <?php echo $jumlah; ?></p>
    <p><b>Total Bayar:</b> Rp<?php echo number_format($total,0,',','.'); ?></p>
    <p><b>Metode Pembayaran:</b> <?php echo $metode; ?></p>
    <hr>
    <p>
        Silakan lanjutkan pembayaran melalui <b><?php echo $metode; ?></b>.<br>
        Jika Cash, bayar langsung di kasir.<br>
        Jika QRIS/OVO/Dana, scan QR code di aplikasi.
    </p>
    <a href="menu.php">← Kembali ke Menu</a>
</div>

<nav>
    <a href="home.php">Beranda</a>
    <a href="about.php">About Us</a>
    <a href="menu.php">Menu</a>
    <a href="contact.php">Contact</a>
    <a href="faq.php">FAQ</a>
    <a href="membership.php">Membership</a>
</nav>
</body>
</html>

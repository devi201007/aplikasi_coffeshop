<?php
$menu = isset($_GET['menu']) ? $_GET['menu'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order - Coffee Shop App</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:#fff; text-align:center; padding:40px; }
        h1 { margin:0; font-size:2.5em; }
        header p { font-size:1.2em; }

        .order-form {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
            width: 450px;
            margin: 40px auto;
        }
        .order-form h2 { text-align: center; color: #6f4e37; }
        .order-form label { display:block; margin-top:15px; font-weight:bold; }
        .order-form input, .order-form select {
            width:100%; padding:10px; margin-top:5px;
            border-radius:6px; border:1px solid #ccc;
        }
        .order-form button {
            margin-top:20px; width:100%;
            background:#6f4e37; color:white;
            border:none; padding:12px; border-radius:8px;
            cursor:pointer; font-size:16px;
        }
        .order-form button:hover { background:#d2691e; }

        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
</head>
<body>
<header>
    <h1>🛒 Checkout Order</h1>
    <p>Lengkapi data pesananmu di bawah ini</p>
</header>

<div class="order-form">
    <form method="POST" action="confirm.php">
        <label>Nama Pelanggan:</label>
        <input type="text" name="nama" required>

        <label>Menu:</label>
        <input type="text" name="menu" value="<?php echo $menu; ?>" readonly>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" min="1" required>

        <label>Metode Pembayaran:</label>
        <select name="metode">
            <option>Cash</option>
            <option>QRIS</option>
            <option>OVO</option>
            <option>Dana</option>
        </select>

        <button type="submit">Bayar Sekarang</button>
    </form>
</div>

</body>
</html>

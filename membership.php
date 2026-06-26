<!DOCTYPE html>
<html>
<head>
    <title>Membership - Coffee Shop App</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:white; text-align:center; padding:40px; }
        h1 { margin:0; font-size:2.5em; }

        .container {
            width:500px; margin:40px auto;
            background:#fff; padding:30px;
            border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.25);
        }
        h2 { color:#6f4e37; text-align:center; }
        label { display:block; margin-top:15px; font-weight:bold; color:#6f4e37; }
        input {
            width:100%; padding:10px; margin-top:5px;
            border-radius:6px; border:1px solid #ccc;
        }
        button {
            margin-top:20px; width:100%;
            background:#6f4e37; color:white;
            border:none; padding:12px; border-radius:8px;
            cursor:pointer; font-size:16px;
        }
        button:hover { background:#d2691e; }

        .benefits {
            margin-top:30px; padding:20px; background:#fff8f0;
            border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.2);
        }
        .benefits h3 { color:#6f4e37; }
        .benefits ul { margin:0; padding-left:20px; }
        .benefits li { margin:8px 0; }
        
        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
</head>
<body>
<header>
    <h1>☕ Membership</h1>
    <p>Daftar jadi member dan nikmati keuntungannya</p>
</header>

<div class="container">
    <h2>Form Registrasi Member</h2>
    <form method="POST" action="register_member.php">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Nomor HP:</label>
        <input type="text" name="phone" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Daftar Member</button>
    </form>

    <div class="benefits">
        <h3>🎁 Keuntungan Membership</h3>
        <ul>
            <li>Dapat poin setiap kali order</li>
            <li>Tukar poin dengan diskon atau free item</li>
            <li>Akses promo khusus member</li>
            <li>Lihat riwayat pesanan di profil</li>
        </ul>
    </div>
</div>

<nav>
    <a href="home.php">Beranda</a>
    <a href="about.php">About Us</a>
    <a href="menu.php">Menu</a>
    <a href="order.php">Order</a>
    <a href="review.php">Review</a>
    <a href="contact.php">Contact</a>
    <a href="faq.php">FAQ</a>
    <a href="promo.php">Promo</a>
    <a href="membership.php">Membership</a>
</nav>
</body>
</html>

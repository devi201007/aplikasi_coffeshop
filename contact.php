<!DOCTYPE html>
<html>
<head>
    <title>Contact - Coffee Shop App</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:white; padding:40px; text-align:center; }
        h1 { margin:0; font-size:2.5em; }

        .container {
            width:600px; margin:40px auto;
            background:#fff; padding:30px;
            border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.25);
        }
        h2 { color:#6f4e37; text-align:center; }
        label { display:block; margin-top:15px; font-weight:bold; color:#6f4e37; }
        input, textarea {
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

        nav { background:#eee; text-align:center; padding:15px; }
        nav a { margin:0 10px; text-decoration:none; color:#6f4e37; font-weight:bold; }
        nav a:hover { color:#8b5e3c; }
    </style>
</head>
<body>
<header>
    <h1>📩 Hubungi Kami</h1>
    <p>Kirim pesan atau pertanyaanmu melalui form di bawah</p>
</header>

<div class="container">
    <form method="POST" action="contact_confirm.php">
        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Pesan:</label>
        <textarea name="pesan" rows="4" required></textarea>

        <button type="submit">Kirim Pesan</button>
    </form>
</div>

<nav>
    <a href="home.php">Beranda</a>
    <a href="about.php">About Us</a>
    <a href="menu.php">Menu</a>
    <a href="faq.php">FAQ</a>
    <a href="membership.php">Membership</a>
</nav>
</body>
</html>

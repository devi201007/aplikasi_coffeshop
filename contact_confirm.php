<?php
$nama  = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$pesan = $_POST['pesan'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Kontak</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header { background:#6f4e37; color:white; padding:20px; text-align:center; }
        .container {
            width:600px; margin:40px auto;
            background:#fff3e0; padding:30px;
            border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.25);
            text-align:center;
        }
        h2 { color:#6f4e37; }
        p { font-size:18px; margin:10px 0; }
        a.back {
            display:inline-block; margin-top:20px;
            background:#6f4e37; color:white;
            padding:12px 20px; border-radius:8px;
            text-decoration:none;
        }
        a.back:hover { background:#ff8c42; }
        nav {
            background:#6f4e37; padding:10px; text-align:center;
            position:fixed; bottom:0; left:0; right:0;
        }
        nav a { color:white; margin:0 10px; text-decoration:none; }
        nav a:hover { text-decoration:underline; }
    </style>
</head>
<body>
    <header>
        <h1>Konfirmasi Kontak</h1>
    </header>

    <div class="container">
        <h2>✅ Pesan Terkirim!</h2>
        <p>Terima kasih <b><?php echo htmlspecialchars($nama); ?></b> sudah menghubungi kami.</p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Pesan: "<?php echo htmlspecialchars($pesan); ?>"</p>
        <p>Kami akan segera membalas pesanmu melalui email.</p>
        <a href="contact.php" class="back">← Kembali ke Form Kontak</a>
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="order.php">Order</a>
        <a href="review.php">Review</a>
        <a href="about.php">About Us</a>
    </nav>
</body>
</html>

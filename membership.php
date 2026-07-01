<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membership - Kopi Senja</title>
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
    <h1>Membership & Promo</h1>
    <p>Jadilah Member dan Nikmati Berbagai Keuntungan Menarik!</p>
</header>

<section>

    <div class="card">
        <h2>☕ Silver Member</h2>
        <p>✔ Diskon 5% setiap pembelian.</p>
        <p>✔ Gratis 1 kopi setelah 10 kali transaksi.</p>
        
    </div>

    <div class="card">
        <h2>☕ Gold Member</h2>
        <p>✔ Diskon 10% setiap pembelian.</p>
        <p>✔ Gratis minuman saat ulang tahun.</p>
        <p>✔ Prioritas promo terbaru.</p>
        
    </div>

    <div class="card">
        <h2>🎉 Promo Bulan Ini</h2>
        <p>Beli 2 Gratis 1.</p>
        <p>Diskon 20% untuk semua Latte.</p>
        <p>Promo berlaku sampai akhir bulan.</p>
    
    </div>

</section>

<section>

<div class="card" style="width:450px;">

<h2>Form Pendaftaran Membership</h2>

<form method="post">

<p>Nama Lengkap</p>
<input type="text" name="nama" style="width:95%; padding:10px;">

<p>Email</p>
<input type="email" name="email" style="width:95%; padding:10px;">

<p>No. Handphone</p>
<input type="text" name="hp" style="width:95%; padding:10px;">

<p>Pilih Membership</p>

<select name="member" style="width:100%; padding:10px;">
    <option>Silver Member</option>
    <option>Gold Member</option>
</select>

<br><br>

<button type="submit" name="daftar">Daftar Sekarang</button>

</form>

<?php

if(isset($_POST['daftar'])){

$nama=$_POST['nama'];
$email=$_POST['email'];
$hp=$_POST['hp'];

if($nama=="" || $email=="" || $hp==""){

echo "<p style='color:red; font-weight:bold;'>Data belum lengkap!</p>";

}else{

echo "<p style='color:green; font-weight:bold;'>Pendaftaran Berhasil! Selamat menjadi Member Coffee Shop.</p>";

}

}

?>

</div>

</section>

<nav>
        <a href="home.php">Beranda</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="faq.php">FAQ</a>
        <a href="gallerycaffe.php">Gallery</a>
        <a href="ourpartners.php">Our Partners</a>
</nav>

</body>
</html>
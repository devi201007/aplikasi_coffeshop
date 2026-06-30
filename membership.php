<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membership - Kopi Senja</title>
    <link rel="stylesheet" href="assets/style.css">
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
        <button>Join Now</button>
    </div>

    <div class="card">
        <h2>☕ Gold Member</h2>
        <p>✔ Diskon 10% setiap pembelian.</p>
        <p>✔ Gratis minuman saat ulang tahun.</p>
        <p>✔ Prioritas promo terbaru.</p>
        <button>Join Now</button>
    </div>

    <div class="card">
        <h2>🎉 Promo Bulan Ini</h2>
        <p>Beli 2 Gratis 1.</p>
        <p>Diskon 20% untuk semua Latte.</p>
        <p>Promo berlaku sampai akhir bulan.</p>
        <button>Lihat Promo</button>
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
    <a href="home.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact</a>
    <a href="faq.php">FAQ</a>
    <a href="membership.php">Membership</a>
    <a href="gallery.php">Gallery</a>
    <a href="ourpartners.php">Our Partner</a>
</nav>

</body>
</html>
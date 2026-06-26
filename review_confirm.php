<?php
session_start();
if(!isset($_SESSION['reviews'])) {
    $_SESSION['reviews'] = [];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama   = $_POST['nama'] ?? '';
    $rating = $_POST['rating'] ?? 0;
    $ulasan = $_POST['ulasan'] ?? '';

    $newReview = [
        'nama'   => $nama,
        'rating' => $rating,
        'ulasan' => $ulasan
    ];
    $_SESSION['reviews'][] = $newReview;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Review</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fdf6f0; margin:0; }
        header {
            background:#6f4e37; color:white; padding:20px; text-align:center;
        }
        .confirm-box {
            background:#fff3e0;
            padding:40px;
            border-radius:12px;
            box-shadow:0 6px 12px rgba(0,0,0,0.25);
            width:600px;
            margin:40px auto;
        }
        .confirm-box h2 { color:#6f4e37; text-align:center; }
        .review-card {
            background:#ffffff;
            border-left:8px solid #d2691e;
            border-radius:10px;
            box-shadow:0 4px 8px rgba(0,0,0,0.2);
            padding:20px;
            margin:20px 0;
        }
        .review-card h3 { margin:0; color:#6f4e37; }
        .stars { color:gold; font-size:20px; margin-bottom:10px; }
        .confirm-box a {
            display:inline-block;
            margin-top:20px;
            background:#6f4e37;
            color:white;
            padding:12px 20px;
            border-radius:8px;
            text-decoration:none;
        }
        .confirm-box a:hover { background:#ff8c42; }
    </style>
</head>
<body>
    <header>
        <h1>📖 Daftar Review</h1>
    </header>

    <div class="confirm-box">
        <h2>✅ Review Terkirim!</h2>
        <p>Terima kasih atas ulasanmu. Berikut review yang sudah masuk:</p>
        <?php
        foreach($_SESSION['reviews'] as $r){
            echo "<div class='review-card'>";
            echo "<h3>".$r['nama']."</h3>";
            echo "<div class='stars'>".str_repeat("⭐",$r['rating'])."</div>";
            echo "<p>".$r['ulasan']."</p>";
            echo "</div>";
        }
        ?>
        <a href="review.php">← Kembali ke Form Review</a>
    </div>
</body>
</html>

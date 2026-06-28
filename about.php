<!DOCTYPE html>
<html>
<head>
    <title>About Us - Coffee Shop App</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #fdf6f0; 
            margin: 0; 
            padding: 0; 
        }
        header { 
            background: #6f4e37; 
            color: #fff; 
            text-align: center; 
            padding: 40px 20px; 
        }
        header h1 { 
            margin: 0; 
            font-size: 3em; 
            text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
        }
        header p {
            margin-top: 15px;
            font-size: 1.2em;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        nav { 
            background: #eee; 
            text-align: center; 
            padding: 15px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        nav a { 
            margin: 0 10px; 
            text-decoration: none; 
            color: #6f4e37; 
            font-weight: bold; 
        }
        nav a:hover { 
            color: #8b5e3c; 
            text-decoration: underline;
        }

        /* Video Section */
        .video-section {
            text-align: center; 
            margin: 50px auto;
            max-width: 1100px;
            padding: 0 20px;
        }
        .video-section h2 {
            color: #6f4e37;
            font-size: 2em;
            margin-bottom: 30px;
        }
        .video-container {
            display: flex; 
            justify-content: center; 
            gap: 25px; 
            flex-wrap: wrap; 
        }
        .video-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            padding: 10px;
            transition: transform 0.3s ease;
        }
        .video-card:hover {
            transform: translateY(-5px);
        }
        .video-card video {
            border-radius: 8px;
            display: block;
            object-fit: cover;
        }
    </style>
</head>
<body>

<header>
    <h1>Tentang Kami</h1>
    <p>
        Kami adalah coffee shop yang berkomitmen menghadirkan pengalaman terbaik bagi pecinta kopi. 
        Dengan biji kopi pilihan, suasana hangat, dan pelayanan ramah, kami ingin menjadi tempat 
        favorit Anda untuk menikmati secangkir kopi dan berbagi cerita.
    </p>
</header>
       
<nav>
    <nav>
        <a href="home.php">Beranda</a>
        <a href="ourpartners.php">Our Partners</a>
        <a href="contact.php">Contact</a>
        <a href="faq.php">FAQ</a>
        <a href="membership.php">Membership</a>
        <a href="gallercoffee.php">Gallery</a>
    </nav>

</nav>

<section class="video-section" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
    <h2>Cerita Kopi Kami</h2>
    <div class="video-container">
        <div class="video-card">
            <video autoplay loop muted playsinline width="400">
                <source src="uploads/video/frame1.mp4" type="video/mp4">
            </video>
        </div>
        <div class="video-card">
            <video autoplay loop muted playsinline width="340">
                <source src="uploads/video/frame2.mp4" type="video/mp4">
            </video>
        </div>

        <section class="foto-section">
    <h2>Barista</h2>
    <div class="foto-container">
        <div class="foto-card">
            <img src="uploads/foto/kevin.png" alt="Kevin - Barista">
            <p>Kevin - Barista</p>
        </div>
        <div class="foto-card">
            <img src="uploads/foto/joshua.png" alt="Joshua - Barista">
            <p>Joshua - Barista</p>
        </div>

    <img src="uploads/foto/maria.png" alt="Maria - Barista">
    <p>Maria - Barista</p>
</div>
        </div>
    </div>
</section>

        </div>
    </div>
</section>

        </div>
    </div>
</section>

</body>
</html>

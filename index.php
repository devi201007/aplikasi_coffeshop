<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Kopi Senja</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #fdf6f0; margin: 0; }
 
        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 999;
            background: rgba(111,78,55,0.95);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 36px;
        }
        .nav-logo-wrap { display: flex; align-items: center; gap: 10px; }
        .nav-brand { color: #fbbf24; font-weight: bold; font-size: 1.05em; letter-spacing: 2px; }
        .nav-links { display: flex; gap: 24px; list-style: none; }
        .nav-links a { text-decoration: none; color: #fdf6f0; font-weight: bold; font-size: 0.9em; }
        .nav-links a:hover { color: #fbbf24; }
 
        /* ── HERO ── */
        .hero {
            width: 100%;
            min-height: 100vh;
            background: #3b1f0a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
 
        /* Fallback gradient biar ga polos kalau video ga ada */
        .hero-bg-fallback {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 80%, rgba(249,115,22,0.3) 0%, transparent 65%),
                        linear-gradient(180deg, #1C0F07 0%, #3b1f0a 100%);
        }
 
        .hero video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(20, 8, 2, 0.65);
            z-index: 2;
        }
 
        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: #fff;
            padding: 120px 20px 60px;
        }
 
        .hero-logo { margin: 0 auto 20px; display: block; }
 
        .hero-eyebrow {
            font-size: 0.72em;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: #f97316;
            margin-bottom: 14px;
        }
        .hero h1 {
            font-size: clamp(2.2em, 6vw, 4.2em);
            font-weight: bold;
            line-height: 1.15;
            color: #ffffff;
            margin-bottom: 12px;
        }
        .hero h1 span { color: #fbbf24; }
        .hero-tagline {
            font-size: 1.05em;
            color: rgba(255,255,255,0.7);
            font-style: italic;
            margin-bottom: 32px;
        }
        .btn-order {
            background: #fff;
            color: #6f4e37;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.2s, color 0.2s;
        }
        .btn-order:hover { background: #fbbf24; color: #3b1f0a; }
 
        /* ── INTRO ── */
        .intro-strip {
            background: #6f4e37;
            color: #fff;
            text-align: center;
            padding: 48px 30px;
        }
        .intro-strip p {
            font-size: 1.1em;
            font-style: italic;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.9;
            color: rgba(255,255,255,0.88);
        }
        .intro-strip strong { color: #fbbf24; font-style: normal; }
 
        /* ── FEATURED ── */
        .featured {
            max-width: 1000px;
            margin: 60px auto;
            padding: 0 30px;
        }
        .featured h2 { text-align: center; font-size: 2em; color: #6f4e37; margin-bottom: 8px; }
        .featured-sub { text-align: center; color: #8b6450; font-size: 0.95em; margin-bottom: 40px; }
        .featured-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; }
        .featured-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(111,78,55,0.12);
            text-align: center;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .featured-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(111,78,55,0.2); }
        .featured-card img { width: 100%; height: 240px; object-fit: cover; display: block; }
        .featured-card-body { padding: 20px; }
        .featured-card-body h3 { color: #6f4e37; font-size: 1.25em; margin-bottom: 8px; }
        .featured-card-body p { color: #8b6450; font-size: 0.93em; line-height: 1.6; }
 
        /* ── QUOTE ── */
        .quote-strip {
            background: #6f4e37;
            color: #fff;
            text-align: center;
            padding: 60px 30px;
            margin-top: 40px;
        }
        .quote-strip blockquote {
            font-size: 1.25em;
            font-style: italic;
            max-width: 600px;
            margin: 0 auto 14px;
            line-height: 1.8;
        }
        .quote-strip cite { font-size: 0.82em; opacity: 0.6; font-style: normal; letter-spacing: 2px; }
 
        /* ── FOOTER ── */
        footer {
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 36px;
            color: #6f4e37;
            font-size: 0.88em;
        }
        .footer-brand { display: flex; align-items: center; gap: 8px; font-weight: bold; }
 
        @media (max-width: 650px) {
            nav { padding: 10px 16px; }
            .nav-links { display: none; }
            .featured-grid { grid-template-columns: 1fr; }
            footer { flex-direction: column; gap: 8px; text-align: center; padding: 16px; }
        }
    </style>
</head>
<body>
 
 
<!-- HERO -->
<header class="hero">
    <div class="hero-bg-fallback"></div>
    <video autoplay muted loop playsinline>
        <source src="uploads/video/promo.mp4" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
 
    <div class="hero-content">
        <!-- Logo besar -->
        <svg class="hero-logo" width="100" height="100" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="55" cy="55" r="53" fill="#1C0F07" stroke="#f97316" stroke-width="1.5"/>
            <circle cx="55" cy="55" r="46" fill="none" stroke="rgba(249,115,22,0.25)" stroke-width="0.8"/>
            <line x1="55" y1="18" x2="55" y2="10" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
            <line x1="73" y1="23" x2="78" y2="15" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
            <line x1="86" y1="36" x2="93" y2="30" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
            <line x1="37" y1="23" x2="32" y2="15" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
            <line x1="24" y1="36" x2="17" y2="30" stroke="#f97316" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
            <clipPath id="hc"><rect x="20" y="16" width="70" height="42"/></clipPath>
            <circle cx="55" cy="58" r="24" fill="#f97316" clip-path="url(#hc)"/>
            <circle cx="55" cy="58" r="16" fill="#fbbf24" clip-path="url(#hc)"/>
            <rect x="20" y="56" width="70" height="5" fill="#1C0F07"/>
            <path d="M36 60 L39 82 Q55 90 71 82 L74 60Z" fill="#fdf6f0"/>
            <path d="M71 68 Q83 68 83 76 Q83 83 71 81" fill="none" stroke="#fdf6f0" stroke-width="4" stroke-linecap="round"/>
            <ellipse cx="55" cy="83" rx="21" ry="4.5" fill="#c47a2b"/>
            <path d="M44 55 Q41 47 44 40" fill="none" stroke="#f97316" stroke-width="1.8" stroke-linecap="round" opacity="0.6"/>
            <path d="M55 53 Q52 43 55 36" fill="none" stroke="#f97316" stroke-width="1.8" stroke-linecap="round" opacity="0.6"/>
            <path d="M66 55 Q69 47 66 40" fill="none" stroke="#f97316" stroke-width="1.8" stroke-linecap="round" opacity="0.6"/>
        </svg>
 
        <p class="hero-eyebrow">Coffee & Bakery · Est. 2024</p>
        <h1>Welcome to<br><span>Kopi Senja</span></h1>
        <p class="hero-tagline">"Brew Happiness in Every Cup"</p>
        <button class="btn-order" onclick="window.location.href='home.php'">check now</button>
    </div>
</header>
 
 
<!-- FOOTER -->
<footer>
    <div class="footer-brand">
        <svg width="22" height="22" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="55" cy="55" r="53" fill="#6f4e37"/>
            <clipPath id="fc"><rect x="20" y="16" width="70" height="42"/></clipPath>
            <circle cx="55" cy="58" r="24" fill="#f97316" clip-path="url(#fc)"/>
            <circle cx="55" cy="58" r="16" fill="#fbbf24" clip-path="url(#fc)"/>
            <rect x="20" y="56" width="70" height="5" fill="#6f4e37"/>
            <path d="M36 60 L39 82 Q55 90 71 82 L74 60Z" fill="#fdf6f0"/>
            <ellipse cx="55" cy="83" rx="21" ry="4.5" fill="#c47a2b"/>
        </svg>
        Kopi Senja
    </div>
    <p>&copy; 2024 Kopi Senja · Coffee & Bakery</p>
</footer>
 
</body>
</html>
<style>
    :root {
        --kopi-dark: #2b1b12;
        --kopi-brown: #5c3a21;
        --kopi-accent: #c8823a;
        --kopi-cream: #f4ead9;
        --kopi-cream-2: #fbf6ee;
    }
    body {
        font-family: 'Poppins', sans-serif;
        color: var(--kopi-dark);
        background-color: var(--kopi-cream-2);
    }
    h1, h2, h3, .brand-font {
        font-family: 'Playfair Display', serif;
    }
    .navbar-kopi {
        background-color: var(--kopi-cream-2);
    }
    .navbar-kopi .nav-link {
        color: var(--kopi-dark);
        font-weight: 500;
    }
    .navbar-kopi .nav-link:hover {
        color: var(--kopi-accent);
    }
    .btn-kopi {
        background-color: var(--kopi-accent);
        border-color: var(--kopi-accent);
        color: #fff;
        font-weight: 600;
    }
    .btn-kopi:hover {
        background-color: #a86a2c;
        border-color: #a86a2c;
        color: #fff;
    }
    .btn-outline-kopi {
        border-color: var(--kopi-brown);
        color: var(--kopi-brown);
        font-weight: 600;
    }
    .btn-outline-kopi:hover {
        background-color: var(--kopi-brown);
        color: #fff;
    }
    .hero-kopi {
        background: linear-gradient(135deg, var(--kopi-dark) 0%, var(--kopi-brown) 100%);
        color: #fdf7ee;
        position: relative;
        overflow: hidden;
    }
    .hero-kopi::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 85% 20%, rgba(200,130,58,0.25), transparent 45%);
    }
    .badge-kopi {
        background-color: rgba(200,130,58,0.2);
        color: #f4c78f;
        border: 1px solid rgba(244,199,143,0.4);
    }
    .section-title {
        color: var(--kopi-brown);
    }
    .section-sub {
        color: #8a7462;
    }
    .menu-card {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        background: #fff;
        transition: transform .2s ease, box-shadow .2s ease;
        box-shadow: 0 2px 10px rgba(43,27,18,0.06);
    }
    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(43,27,18,0.12);
    }
    .menu-card .menu-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        background-color: var(--kopi-cream);
    }
    .menu-img-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--kopi-cream);
        color: var(--kopi-accent);
        font-size: 2.5rem;
    }
    .menu-price {
        color: var(--kopi-accent);
        font-weight: 700;
    }
    .category-pill {
        background-color: var(--kopi-brown);
        color: #fff;
    }
    .about-photo {
        border-radius: 1rem;
        overflow: hidden;
        background-color: var(--kopi-brown);
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.5);
        font-size: 4rem;
    }
    .info-strip {
        background-color: var(--kopi-cream);
    }
    footer.footer-kopi {
        background-color: var(--kopi-dark);
        color: #d8c7b8;
    }
    footer.footer-kopi a {
        color: #f4c78f;
        text-decoration: none;
    }
    .section-py {
        padding-top: 4.5rem;
        padding-bottom: 4.5rem;
    }
    .map-wrap {
        border-radius: 1rem;
        overflow: hidden;
    }
    .accordion-button:not(.collapsed) {
        background-color: #fff;
        box-shadow: none;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(200,130,58,0.3);
    }
</style>

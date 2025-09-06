<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<style>
    /* Fade-in on scroll */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        /* opsional jeda per elemen */
        will-change: opacity, transform;
    }

    .reveal.is-visible {
        opacity: 1;
        transform: none
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important
        }
    }

    /* Breadcrumb */
    .breadcrumb-modern {
        background: rgba(0, 98, 204, 0.06);
        border: 1px solid rgba(0, 98, 204, 0.12);
        --bs-breadcrumb-divider-color: rgba(0, 0, 0, .35);
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #0d6efd;
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: rgba(0, 0, 0, .6);
    }

    /* Hero gradient glass */
    .about-hero {
        background:
            radial-gradient(1200px 300px at -10% -10%, rgba(13, 110, 253, 0.25), transparent 60%),
            radial-gradient(900px 300px at 110% -10%, rgba(32, 201, 151, 0.25), transparent 60%),
            linear-gradient(135deg, #0d1b2a, #163f6b 55%, #1b5eaa);
        box-shadow: 0 12px 40px rgba(13, 27, 42, 0.25);
        position: relative;
        overflow: hidden;
    }

    .about-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        backdrop-filter: saturate(120%) blur(0px);
        pointer-events: none;
    }

    /* Meta chips */
    .chip {
        display: inline-flex;
        align-items: center;
        gap: .25rem;
        padding: .4rem .7rem;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .25);
        color: #fff;
        border-radius: 999px;
        font-weight: 600;
        font-size: .875rem;
    }

    /* Card */
    .shadow-soft {
        box-shadow: 0 8px 28px rgba(0, 0, 0, .08);
    }

    /* Typography modern */
    .content-typo p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #495057;
    }

    .content-typo h2,
    .content-typo h3,
    .content-typo h4 {
        color: #0f2a4a;
    }

    .content-typo em {
        color: #0d6efd;
    }

    /* Lists */
    .list-modern {
        counter-reset: item;
        padding-left: 0;
        margin-left: 0;
    }

    .list-modern>li {
        list-style: none;
        position: relative;
        padding-left: 2.2rem;
        margin-bottom: .5rem;
    }

    .list-modern>li::before {
        counter-increment: item;
        content: counter(item);
        position: absolute;
        left: 0;
        top: .05rem;
        width: 1.75rem;
        height: 1.75rem;
        border-radius: .5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f1ff;
        color: #0d6efd;
        font-weight: 700;
        box-shadow: inset 0 0 0 1px rgba(13, 110, 253, .2);
    }

    .list-check {
        padding-left: 0;
        margin-left: 0;
    }

    .list-check>li {
        list-style: none;
        position: relative;
        padding-left: 1.8rem;
        margin-bottom: .5rem;
    }

    .list-check>li::before {
        content: "\f00c";
        /* Font Awesome check */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: .15rem;
        color: #20c997;
    }

    /* Responsiveness */
    @media (max-width: 991.98px) {
        .chip {
            background: rgba(255, 255, 255, .18);
        }
    }

    /* ====== PLANT CARD ====== */
    .plant-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .06);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(16, 24, 40, .06), 0 2px 8px rgba(16, 24, 40, .05);
        overflow: hidden;
        display: grid;
        grid-template-rows: auto 1fr auto;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .plant-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 36px rgba(16, 24, 40, .10), 0 6px 16px rgba(16, 24, 40, .08);
        border-color: rgba(13, 110, 253, .18);
    }

    .plant-cover {
        margin: 0;
        position: relative;
        aspect-ratio: 16/10;
        /* responsif */
        background: linear-gradient(180deg, rgba(13, 110, 253, .06), rgba(32, 201, 151, .06));
    }

    .plant-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .plant-body {
        padding: 1rem 1rem .5rem 1rem;
    }

    .plant-title {
        font-size: clamp(1.05rem, .95rem + .5vw, 1.15rem);
        font-weight: 800;
        margin: 0;
    }

    .plant-latin {
        color: #6c757d;
        margin: .15rem 0 .5rem 0;
        font-size: .95rem;
    }

    /* Meta sebagai definition list rapi */
    .plant-meta {
        margin: .25rem 0 0 0;
    }

    .plant-meta dt {
        font-weight: 700;
        color: #0f2a4a;
        font-size: .95rem;
    }

    .plant-meta dd {
        margin: 0 0 .6rem 0;
        color: #495057;
    }

    /* Tags */
    .badge.tag {
        border-radius: 999px;
        background: #e7f1ff;
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, .2);
        font-weight: 600;
    }

    .badge.tag.alt {
        background: #e9f7f3;
        color: #109c7e;
        border-color: rgba(16, 156, 126, .2);
    }

    /* Actions */
    .plant-actions {
        padding: 0 1rem 1rem 1rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .btn-plant {
        --btn-bg: #0d6efd;
        background: var(--btn-bg);
        color: #fff !important;
        border-radius: 999px;
        padding: .55rem 1rem;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(13, 110, 253, .28);
        transition: transform .15s ease, box-shadow .2s ease, background-color .2s ease;
        text-decoration: none;
    }

    .btn-plant:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(13, 109, 253, 0.54);
        color: #0d6efd !important;
    }

    /* ====== Fade-in on scroll (pakai .reveal yang sudah ada) ====== */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        will-change: opacity, transform;
    }

    .reveal.is-visible {
        opacity: 1;
        transform: none
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important
        }
    }

    /* ====== Dark mode aware (opsional kalau pakai data-bs-theme="dark") ====== */
    [data-bs-theme="dark"] .plant-card {
        background: #0f1113;
        border-color: rgba(255, 255, 255, .08);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .45);
    }

    [data-bs-theme="dark"] .plant-meta dd {
        color: #cfd3d8
    }

    [data-bs-theme="dark"] .plant-meta dt {
        color: #e9ecef
    }

    [data-bs-theme="dark"] .badge.tag {
        background: rgba(13, 110, 253, .15);
        color: #9ec5fe;
        border-color: rgba(13, 110, 253, .25);
    }

    [data-bs-theme="dark"] .badge.tag.alt {
        background: rgba(16, 156, 126, .15);
        color: #94e2d0;
        border-color: rgba(16, 156, 126, .25);
    }

    .search-box .form-control {
        border-radius: 0 999px 999px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
        transition: box-shadow .2s ease;
    }

    .search-box .form-control:focus {
        box-shadow: 0 6px 16px rgba(13, 110, 253, .2);
        border-color: #0d6efd;
    }

    .search-box .input-group-text {
        border-radius: 999px 0 0 999px;
        background: #fff;
    }
</style>

<!-- LOADER OVERLAY -->
<div id="app-loader" role="status" aria-live="polite" aria-label="Memuat halaman">
    <div class="loader-box">
        <div class="spinner-modern" aria-hidden="true"></div>
        <div class="loader-label">Memuat…</div>
        <div class="loader-hint">Mohon tunggu sebentar</div>
    </div>
</div>

<section class="section-about py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tanamanku</li>
            </ol>
        </nav>

        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Tanamanku</h1>
                    <p class="lead mb-0 opacity-90">
                        TP PKK Kelurahan Lebak Denok — bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                    </p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li><span class="chip"><i class="fa-solid fa-user me-2"></i>Admin</span></li>
                        <li><span class="chip"><i class="fa-solid fa-calendar me-2"></i>06 September 2025</span></li>
                        <li><span class="chip"><i class="fa-solid fa-signal me-2"></i>150 Kunjungan</span></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <article class="card shadow-soft border-0 rounded-4 overflow-hidden reveal" style="--d:120ms">
            <div class="card-body p-4 p-lg-5 content-typo">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="text-body-secondary small">Tanamanku</span>
                </div>

                <!-- Search bar modern -->
                <div class="search-box mb-4">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text"
                            class="form-control border-start-0"
                            placeholder="Cari tanaman di Kelurahan Lebak Denok..."
                            aria-label="Cari Tanaman">
                    </div>
                </div>


                <!-- Grid Kartu Tanaman -->
                <div class="row g-4">
                    <!-- Item Tanaman -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="plant-card h-100 reveal" style="--d:180ms">
                            <figure class="plant-cover">
                                <img src="<?= base_url('assets/img/img-phn-mangga.png') ?>"
                                    alt="Pohon Mangga (Mangifera indica)"
                                    class="plant-img">
                            </figure>

                            <div class="plant-body">
                                <h3 class="plant-title">Mangga</h3>
                                <p class="plant-latin"><em>Mangifera indica</em></p>

                                <div class="plant-tags mb-2">
                                    <span class="badge tag">Pohon buah</span>
                                    <span class="badge tag alt">Obat Tradisional</span>
                                </div>

                                <dl class="plant-meta">
                                    <dt>Asal/Daerah</dt>
                                    <dd>Tumbuh di halaman rumah RT 02 RW 01</dd>

                                    <dt>Manfaat</dt>
                                    <dd>Buah untuk konsumsi; kayu dapat dimanfaatkan; daun untuk obat tradisional</dd>
                                </dl>
                            </div>

                            <div class="plant-actions">
                                <a href="<?= base_url('/tanamanku/1') ?>" class="btn btn-plant">
                                    <i class="fa-solid fa-eye me-2" aria-hidden="true"></i>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /Item Tanaman -->

                    <!-- Contoh item lain (duplikasi & ganti datanya jika perlu)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="plant-card h-100 reveal" style="--d:220ms">
          ...
        </div>
      </div>
      -->
                </div>
            </div>
        </article>
    </div>
</section>

<script type="module">
    // Loader with minimal stay
    (function() {
        const LOADER_MIN_MS = 700;
        const loader = document.getElementById('app-loader');
        const start = Date.now();
        window.addEventListener('load', () => {
            const delay = Math.max(0, LOADER_MIN_MS - (Date.now() - start));
            setTimeout(() => {
                if (loader) {
                    loader.classList.add('hidden');
                    setTimeout(() => loader.remove(), 450);
                }
            }, delay);
        });
        window.addEventListener('pageshow', e => {
            if (e.persisted && loader) loader.classList.add('hidden');
        });
    })();

    // Sticky nav controller (menghindari CLS)
    document.addEventListener('DOMContentLoaded', () => {
        const topbar = document.querySelector('.navbar-information-sosmed');
        const nav = document.querySelector('nav.navbar');
        if (!nav) return;
        nav.classList.remove('sticky-top');
        const placeholder = document.createElement('div');
        placeholder.setAttribute('aria-hidden', 'true');
        placeholder.style.height = '5px';
        nav.parentNode.insertBefore(placeholder, nav.nextSibling);

        let threshold = 0;
        const recalc = () => {
            threshold = topbar ? topbar.offsetHeight : 0;
            if (nav.classList.contains('fixed-top')) placeholder.style.height = nav.offsetHeight + 'px';
        };
        const onScroll = () => {
            const y = window.scrollY || 0;
            if (y >= threshold) {
                if (!nav.classList.contains('fixed-top')) {
                    nav.classList.add('fixed-top');
                    placeholder.style.height = nav.offsetHeight + 'px';
                }
            } else {
                if (nav.classList.contains('fixed-top')) {
                    nav.classList.remove('fixed-top');
                    placeholder.style.height = '0px';
                }
            }
        };
        recalc();
        onScroll();
        window.addEventListener('resize', () => {
            recalc();
            onScroll();
        });
        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        setTimeout(() => {
            recalc();
            onScroll();
        }, 200);
    });

    // Reveal on view
    (function() {
        const items = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window) || !items.length) {
            items.forEach(el => el.classList.add('is-visible'));
            return;
        }
        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: .12,
            rootMargin: '0px 0px -8% 0px'
        });
        items.forEach((el, i) => {
            if (!el.style.getPropertyValue('--d')) el.style.setProperty('--d', (i % 8) * 60);
            io.observe(el);
        });
    })();
</script>

<?= $this->endSection() ?>
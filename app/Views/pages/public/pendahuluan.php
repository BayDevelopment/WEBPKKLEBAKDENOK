<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<style>
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

    /* style two */
    :root {
        --glass-bg: rgba(255, 255, 255, 0.75);
        --glass-border: rgba(255, 255, 255, 0.5);
        --card-shadow: 0 10px 30px rgba(16, 24, 40, .08), 0 2px 6px rgba(16, 24, 40, .06);
        --gradient: radial-gradient(800px 200px at -10% -10%, rgba(13, 110, 253, .18), transparent 60%),
            radial-gradient(600px 200px at 110% -10%, rgba(32, 201, 151, .18), transparent 60%);
    }

    [data-bs-theme="dark"] :root,
    :root[data-bs-theme="dark"] {
        --glass-bg: rgba(33, 37, 41, 0.7);
        --glass-border: rgba(255, 255, 255, .08);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, .35), 0 2px 6px rgba(0, 0, 0, .25);
        --gradient: radial-gradient(800px 200px at -10% -10%, rgba(13, 110, 253, .25), transparent 60%),
            radial-gradient(600px 200px at 110% -10%, rgba(32, 201, 151, .25), transparent 60%);
    }

    .section-pendahuluan {
        background:
            var(--gradient),
            linear-gradient(180deg, rgba(13, 110, 253, .06), transparent 40%),
            linear-gradient(180deg, rgba(32, 201, 151, .06), transparent 60%);
    }

    .modern-card {
        background: var(--glass-bg);
        backdrop-filter: saturate(150%) blur(10px);
        border: 1px solid var(--glass-border);
        box-shadow: var(--card-shadow);
        position: relative;
    }

    .modern-card-accent {
        position: absolute;
        inset: 0 0 auto 0;
        height: 4px;
        background: linear-gradient(90deg, #0d6efd, #20c997, #6f42c1);
    }

    .modern-title {
        font-size: clamp(1.5rem, 1.1rem + 1.5vw, 2.125rem);
        line-height: 1.2;
        letter-spacing: -0.02em;
        font-weight: 800;
        background: linear-gradient(90deg, #111, rgba(17, 17, 17, .6));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    [data-bs-theme="dark"] .modern-title {
        background: linear-gradient(90deg, #f8f9fa, rgba(248, 249, 250, .7));
    }

    .content-typo p {
        font-size: clamp(0.98rem, 0.95rem + 0.2vw, 1.05rem);
        line-height: 1.85;
        color: var(--bs-body-color);
    }

    /* Drop cap for first paragraph */
    .first-paragraph::first-letter {
        float: left;
        font-size: 3.2rem;
        line-height: 1;
        padding-right: .25rem;
        padding-top: .15rem;
        font-weight: 800;
        color: #0d6efd;
    }

    [data-bs-theme="dark"] .first-paragraph::first-letter {
        color: #6ea8fe;
    }

    .modern-meta .badge {
        border-radius: 999px;
    }

    /* Reveal on scroll */
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
    }

    .reveal-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal-on-scroll {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
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

        <!-- Breadcrumb modern -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pendahuluan</li>
            </ol>
        </nav>

        <!-- Header / Title -->
        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Pendahuluan</h1>
                    <p class="lead mb-0 opacity-90">
                        TP PKK Kelurahan Lebak Denok — bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                    </p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li>
                            <span class="chip"><i class="fa-solid fa-user me-2"></i>Admin</span>
                        </li>
                        <li>
                            <span class="chip"><i class="fa-solid fa-calendar me-2"></i>06 September 2025</span>
                        </li>
                        <li>
                            <span class="chip"><i class="fa-solid fa-signal me-2"></i>150 Kunjungan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content card -->
        <!-- SECTION: Pendahuluan (Modern Card) -->
        <section class="section-pendahuluan py-5 py-lg-6">
            <div class="container">
                <div class="mx-auto" style="max-width: 900px;">
                    <article class="card modern-card border-0 rounded-4 overflow-hidden" style="--d:120ms">
                        <!-- Accent top line -->
                        <span class="modern-card-accent"></span>

                        <div class="card-body p-4 p-lg-5 content-typo reveal-on-scroll">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="text-body-secondary small">Pendahuluan</span>
                            </div>

                            <h2 class="modern-title mb-4">
                                Pendahuluan
                            </h2>

                            <p class="lead first-paragraph">
                                Hakikat pembangunan nasional membangun manusia seutuhnya dan membangun masyarakat Indonesia seluruhnya. Hakekat pembangunan nasional akan terwujud apabila kesejahteraan keluarga dan masyarakat dapat terlaksana dengan baik.
                            </p>

                            <p>
                                Dalam usaha untuk mencapai keluarga dan masyarakat yang sejahtera tersebut maka dilaksanakanlah <strong>10 Program Pokok PKK</strong>. 10 Program Pokok PKK merupakan dasar manusia yang hendaknya dilaksanakan oleh setiap keluarga.
                            </p>

                            <p>
                                Dalam usahanya melaksanakan 10 Program Pokok PKK maka Tim Penggerak PKK Kelurahan Lebak yang didukung Pembina (Lurah) senantiasa memelihara hubungan konsultatif, koordinasi dengan tetap memperhatikan hirarki di seluruh jenjang kelompok kelompok PKK mulai dari kelompok PKK RW kelompok PKK RT dan kelompok Dasa Wisma. Kelompok Dasa Wisma inilah yang menjadi ujung lingkungan dalam penyampaian informasi-informasi pembangunan dan menggerakkan keluarga agar melaksanakan pembangunan yang diharapkan.
                            </p>

                            <p>
                                Penyusunan Rencana Program Kerja Tim Penggerak PKK Kelurahan Lebak Denok dimulai dari kelompok Dasawisma sampai ke tingkat Kelurahan dengan memperhatikan kebutuhan dan asporasi masyarakat sesuai dengan situasi serta potensi yang ada di wilayah Kelurahan Lebak Denok dengan mengacu pada Proses Perencanaan Program Pemerintah Kota Cilegon.
                            </p>

                            <p class="mb-0">
                                Untuk mengetahui keberhasilan setiap program PKK di masing-masing, maka Tim Penggerak PKK Kelurahan Lebak Denok berusaha melaksanakan kegiatan PKK, tertib administrasi sesuai ketentuan yang berlaku dan senantiasa mengadakan refleksi demi perbaikan program serta kegiatan di masa yang akan datang.
                            </p>

                            <!-- Optional meta footer -->
                            <div class="modern-meta mt-4 pt-3 d-flex flex-wrap gap-3 border-top">
                                <div class="small text-body-secondary">Terakhir diperbarui: <span class="fw-semibold">September 2025</span></div>
                                <div class="vr d-none d-sm-block"></div>
                                <div class="small">
                                    <span class="badge text-bg-light border"><i class="bi bi-journal-text"></i> Dokumen PKK</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

    </div>
</section>

<script type="module">
    // tahun otomatis
    document.getElementById('year').textContent = new Date().getFullYear();

    document.addEventListener('DOMContentLoaded', function() {
        const topbar = document.querySelector('.navbar-information-sosmed');
        const nav = document.querySelector('nav.navbar'); // nav kamu
        if (!nav) return;

        // Matikan sticky-top (kalau ada di HTML), biar kontrol penuh di JS
        nav.classList.remove('sticky-top');

        // Placeholder untuk cegah layout shift saat nav jadi fixed
        const placeholder = document.createElement('div');
        placeholder.setAttribute('aria-hidden', 'true');
        placeholder.style.height = '5px';
        nav.parentNode.insertBefore(placeholder, nav.nextSibling);

        let threshold = 0;

        function recalc() {
            // ambil tinggi topbar sebagai ambang
            threshold = topbar ? topbar.offsetHeight : 0;
            // kalau sedang fixed, update tinggi placeholder sesuai tinggi nav terbaru
            if (nav.classList.contains('fixed-top')) {
                placeholder.style.height = nav.offsetHeight + 'px';
            }
        }

        function onScroll() {
            const y = window.scrollY || window.pageYOffset || 0;
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
        }

        // init
        recalc();
        onScroll();

        // responsive: hitung ulang saat resize/orientasi berubah
        window.addEventListener('resize', () => {
            recalc();
            onScroll();
        });
        window.addEventListener('scroll', onScroll, {
            passive: true
        });

        // rerun kecil setelah font/asset selesai load (tinggi bisa berubah)
        setTimeout(() => {
            recalc();
            onScroll();
        }, 200);
    });

    (function() {
        const LOADER_MIN_MS = 700; // durasi minimum loader (halus)
        const SHOW_MODAL_ONCE = true; // ubah ke false jika ingin tampil setiap kunjungan
        const SESSION_KEY = 'welcomeShown';

        const loader = document.getElementById('app-loader');
        const modalEl = document.getElementById('welcomeModal');

        const startTime = Date.now();

        // Ketika semua aset selesai dimuat
        window.addEventListener('load', function() {
            const elapsed = Date.now() - startTime;
            const delay = Math.max(0, LOADER_MIN_MS - elapsed);

            setTimeout(function() {
                // Sembunyikan & lepas loader
                if (loader) {
                    loader.classList.add('hidden');
                    setTimeout(() => loader.remove(), 450);
                }

                // Tampilkan modal (sekali per sesi, bisa diubah)
                const already = sessionStorage.getItem(SESSION_KEY);
                if (!SHOW_MODAL_ONCE || !already) {
                    if (window.bootstrap && modalEl) {
                        const modal = new bootstrap.Modal(modalEl, {
                            backdrop: 'static',
                            keyboard: false
                        });
                        modal.show();
                    }
                    sessionStorage.setItem(SESSION_KEY, '1');
                }
            }, delay);
        });

        // Fallback: jika browser kembali dari BFCache, pastikan loader tidak muncul lagi
        window.addEventListener('pageshow', function(e) {
            if (e.persisted && loader) {
                loader.classList.add('hidden');
            }
        });
    })();

    // fade in
    (function() {
        const items = document.querySelectorAll('.reveal');

        if (!('IntersectionObserver' in window) || !items.length) {
            // Fallback: tampilkan langsung
            items.forEach(el => el.classList.add('is-visible'));
            return;
        }

        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target); // animasi sekali saja
                }
            });
        }, {
            root: null,
            threshold: 0.12,
            rootMargin: '0px 0px -8% 0px'
        });

        items.forEach((el, i) => {
            // jika belum set delay, kasih stagger otomatis 60ms
            if (!el.style.getPropertyValue('--d')) {
                el.style.setProperty('--d', (i % 8) * 60);
            }
            io.observe(el);
        });
    })();

    // fade in scroll to 
    (function() {
        const els = document.querySelectorAll('.reveal-on-scroll');
        if (!('IntersectionObserver' in window)) {
            els.forEach(el => el.classList.add('is-visible'));
            return;
        }
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('is-visible');
            });
        }, {
            threshold: 0.12
        });
        els.forEach(el => io.observe(el));
    })();
</script>

<?= $this->endSection() ?>
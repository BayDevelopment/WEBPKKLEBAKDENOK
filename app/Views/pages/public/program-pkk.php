<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<style>
    /* Fade-in on scroll */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        will-change: opacity, transform;
    }

    .reveal.is-visible {
        opacity: 1;
        transform: none;
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
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

    /* Responsiveness */
    @media (max-width: 991.98px) {
        .chip {
            background: rgba(255, 255, 255, .18);
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

<section class="section-about py-5 reveal">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pelaksanaan Program</li>
            </ol>
        </nav>

        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Pelaksanaan Program PKK</h1>
                    <p class="lead mb-0 opacity-90">
                        TP PKK Kelurahan Lebak Denok — Bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
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
                    <span class="text-body-secondary small">Pelaksanaan Program PKK</span>
                </div>

                <h2 class="modern-title mb-3">Pelaksanaan Program PKK Kelurahan Lebak Denok</h2>

                <p>
                    Berikut adalah pelaksanaan program yang telah dilaksanakan oleh TP PKK Kelurahan Lebak Denok dalam rangka mewujudkan keluarga sehat, cerdas, dan sejahtera.
                </p>

                <h3 class="h5 mt-4">1. Program Penghayatan dan Pengamalan Pancasila POKJA I</h3>
                <ul class="list-check">
                    <li>
                        Mengikuti penyuluhan tentang trafficking dan kekerasan terhadap perempuan dan anak dalam rumah tangga (KDRT) dipertemuan rutin Tim Penggerak PKK, Ketua Keompok PKK RW, Ketua Kelompok PKK RT dan disampaikan ke Dasawisma masing-masing.
                    </li>
                    <li>
                        Melaksanakan penyuluhan/ sosialisasi pola asuh anak pada Pertemuan Tim Penggerak PKK, Ketua Kelompok RT dan disampaikan ke Dasawisma masing-masing.
                    </li>
                </ul>

                <h3 class="h5 mt-4">2. Kegiatan Keagamaan</h3>
                <ul class="list-check">
                    <li>Pengajian dan kerohanian dilaksanakan dengan baik dan rutin/ bergiliran dari kelurahan ke kelurahan dengan biaya swadaya.</li>
                    <li>Penanganan anak remaja/ kenakalan anak disampaikan pada Tim Penggerak PKK, Ketua Kelompok PKK RW, Ketua Kelompok PKK RT, dan diteruskan ke Dasawisma masing-masing.</li>
                </ul>

                <h3 class="h5 mt-4">3. Gotong Royong</h3>
                <ul class="list-check">
                    <li>Kelompok arisan yang dilaksanakan dengan bermacam-macam uang, tikar, daging, alat-alat dapur, dan sebagainya.</li>
                    <li>Menghadiri pengajian-pengajian di majelis ta’alim yang ada di tiap RW atau majelis ta’lim RT.</li>
                    <li>Berpartisipasi dalam kegiatan Peringatan Hari Besar Islam seperti Isra Mi’raj, Tahun Baru Hijriyah, Gema Ramadhan, dan Maulid.</li>
                    <li>Menengok warga sakit, meninggal, dan tertimpa musibah seperti kecelakaan, kebakaran, kebanjiran, dan lain sebagainya.</li>
                </ul>

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
</script>

<?= $this->endSection() ?>
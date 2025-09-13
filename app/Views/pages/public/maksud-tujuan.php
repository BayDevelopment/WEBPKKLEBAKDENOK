<?php

use CodeIgniter\I18n\Time;
?>
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

    /* Kompat: dukung kedua kelas visible */
    .reveal.is-visible,
    .reveal.show {
        opacity: 1;
        transform: none;
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
                <li class="breadcrumb-item active" aria-current="page">Maksud dan Tujuan</li>
            </ol>
        </nav>

        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Maksud dan Tujuan</h1>
                    <p class="lead mb-0 opacity-90">
                        TP PKK Kelurahan Lebak Denok — bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                    </p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li><span class="chip"><i class="fa-solid fa-calendar me-2"></i>
                                <?php
                                $nowJakarta = Time::now('Asia/Jakarta');              // WIB
                                $labelNow   = $nowJakarta->toLocalizedString('d MMMM yyyy');
                                ?>
                                <?php echo $labelNow ?>
                            </span></li>
                        <li><span class="chip"><i class="fa-solid fa-signal me-2"></i>150 Kunjungan</span></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <article class="card shadow-soft border-0 rounded-4 overflow-hidden reveal" style="--d:120ms">
            <div class="card-body p-4 p-lg-5 content-typo">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="text-body-secondary small">Maksud & Tujuan</span>
                </div>

                <h2 class="modern-title mb-3">Maksud dan Tujuan</h2>

                <p>
                    Penyusunan Profil Pelaksanaan Kegiatan 10 Program PKK dimaksudkan sebagai bahan evaluasi
                    atas pelaksanaan Pemberdayaan dan Kesejahteraan Keluarga (PKK). Profil ini juga menjadi
                    pedoman penerapan program hingga ke tingkat Kelompok Dasa Wisma di wilayah Kelurahan Lebak Denok,
                    Kecamatan Citangkil, Kota Cilegon.
                </p>

                <p>
                    Melalui penyusunan ini diharapkan dapat terwujud empat prioritas pembangunan, yaitu:
                    <strong>Ketahanan Ekonomi</strong>, <strong>Revolusi Mental</strong>,
                    <strong>Peningkatan Pelayanan Dasar</strong>, serta <strong>Perlindungan Lingkungan Hidup</strong>.
                </p>

                <h3 class="h5 mt-4">Tujuan penyusunan Profil Pelaksanaan 10 Program Pokok PKK Kelurahan Lebak Denok:</h3>
                <ol class="list-modern">
                    <li>Meningkatkan kualitas kader PKK agar menjadi kader yang tangguh, sigap, dan profesional dalam mengelola kegiatan 10 Program Pokok PKK.</li>
                    <li>Memotivasi serta mengembangkan keterampilan dan kemampuan kader dalam mengelola Gerakan PKK.</li>
                    <li>Memperkuat ketertiban administrasi PKK di seluruh tingkatan, mulai dari Kelompok Dasa Wisma, PKK RT, PKK RW, hingga PKK Kelurahan.</li>
                </ol>
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

    (function() {
        // 1) Auto-tag elemen umum jadi .reveal (kalau belum)
        const autoTargets = [
            '.breadcrumb-modern',
            'header.about-hero',
            'article.card',
            '.content-typo p',
            '.list-modern',
            '.list-check'
        ];
        document.querySelectorAll(autoTargets.join(',')).forEach(el => {
            if (!el.classList.contains('reveal')) el.classList.add('reveal');
        });

        const items = Array.from(document.querySelectorAll('.reveal'));
        if (!items.length) return;

        // 2) Fallback cepat bila IntersectionObserver tak ada
        if (!('IntersectionObserver' in window)) {
            items.forEach(el => el.classList.add('is-visible')); // atau .show
            return;
        }

        // 3) Observer utama
        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambah KEDUA kelas agar kompatibel dengan CSS lama/baru
                    entry.target.classList.add('is-visible');
                    entry.target.classList.add('show');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.14,
            rootMargin: '0px 0px -6% 0px'
        });

        // 4) Stagger otomatis bila belum di-set
        items.forEach((el, i) => {
            if (!el.style.getPropertyValue('--d')) el.style.setProperty('--d', (i % 8) * 60);
            io.observe(el);
        });

        // 5) Backup check setelah loader/font siap (kasus elemen sudah di viewport)
        const inView = el => {
            const r = el.getBoundingClientRect();
            const vh = window.innerHeight || document.documentElement.clientHeight;
            return r.top <= vh * 0.86 && r.bottom >= 0;
        };

        function forceCheck() {
            items.forEach(el => {
                if (!el.classList.contains('is-visible') && inView(el)) {
                    el.classList.add('is-visible');
                    el.classList.add('show');
                }
            });
        }
        window.addEventListener('load', () => setTimeout(forceCheck, 60), {
            once: true
        });
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(() => setTimeout(forceCheck, 60));
        }
        window.addEventListener('resize', () => requestAnimationFrame(forceCheck), {
            passive: true
        });
        window.addEventListener('scroll', () => requestAnimationFrame(forceCheck), {
            passive: true
        });
    })();
</script>

<?= $this->endSection() ?>
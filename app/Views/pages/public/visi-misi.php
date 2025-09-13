<?php

use CodeIgniter\I18n\Time;
?>
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
                <li class="breadcrumb-item active" aria-current="page">Visi, Misi, & Motto</li>
            </ol>
        </nav>

        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Visi, Misi, & Motto</h1>
                    <p class="lead mb-0 opacity-90">
                        TP PKK Kelurahan Lebak Denok — bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                    </p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li>
                            <span class="chip"><i class="fa-solid fa-calendar me-2"></i>
                                <?php
                                $nowJakarta = Time::now('Asia/Jakarta');              // WIB
                                $labelNow   = $nowJakarta->toLocalizedString('d MMMM yyyy');
                                ?>
                                <?php echo $labelNow ?>
                            </span>
                        </li>
                        <li>
                            <span class="chip"><i class="fa-solid fa-signal me-2"></i>150 Kunjungan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <article class="card shadow-soft border-0 rounded-4 overflow-hidden reveal" style="--d:120ms">
            <div class="card-body p-4 p-lg-5 content-typo">

                <!-- VISI -->
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="text-body-secondary small">Visi</span>
                </div>
                <h2 class="modern-title mb-3">Visi</h2>
                <ol class="list-modern mb-4">
                    <li>
                        Terwujudnya keluarga yang beriman dan bertaqwa kepada Tuhan Yang Maha Esa,
                        berakhlak mulia, sehat, sejahtera, maju, mandiri, menjunjung kesetaraan dan keadilan gender,
                        serta memiliki kesadaran hukum dan lingkungan.
                    </li>
                    <li>
                        Menjadi sekretaris yang profesional, terampil, dan teliti dalam mendukung keberhasilan organisasi.
                    </li>
                </ol>

                <!-- MISI -->
                <div class="d-flex align-items-center gap-2 mb-3 mt-5">
                    <span class="text-body-secondary small">Misi</span>
                </div>
                <h2 class="modern-title mb-3">Misi</h2>
                <ul class="list-check mb-4">
                    <li>
                        Meningkatkan mental spiritual dan perilaku hidup dengan menghayati serta mengamalkan Pancasila.
                        Menguatkan pelaksanaan hak dan kewajiban sesuai dengan Hak Asasi Manusia (HAM),
                        menegakkan demokrasi, memperkokoh kesetiakawanan sosial, gotong royong, dan
                        membangun watak bangsa yang serasi dan seimbang.
                    </li>
                    <li>
                        Memperhatikan pendidikan dan keterampilan untuk mencerdaskan kehidupan serta meningkatkan pendapatan keluarga.
                    </li>
                    <li>
                        Meningkatkan kualitas pangan keluarga serta memanfaatkan pekarangan melalui program
                        <em>HATINYA PKK</em> (Halaman Asri, Teratur, Indah, dan Nyaman), perbaikan perumahan,
                        serta tata laksana rumah tangga yang sehat.
                    </li>
                    <li>
                        Meningkatkan derajat kesehatan, menjaga kelestarian lingkungan hidup,
                        membiasakan hidup berencana dalam semua aspek, serta menumbuhkan budaya menabung
                        sebagai bagian dari perencanaan ekonomi keluarga.
                    </li>
                    <li>
                        Memperkuat pengelolaan Gerakan PKK baik dalam pengorganisasian maupun
                        pelaksanaan program-program yang disesuaikan dengan kondisi masyarakat setempat.
                    </li>
                </ul>

                <!-- MOTTO -->
                <div class="d-flex align-items-center gap-2 mb-3 mt-5">
                    <span class="text-body-secondary small">Motto</span>
                </div>
                <h2 class="modern-title mb-3">Motto</h2>
                <blockquote class="blockquote px-3 py-2 border-start border-4 border-primary bg-light-subtle rounded-3 fst-italic">
                    “Kerapihan administrasi adalah pondasi keberhasilan organisasi”
                </blockquote>

            </div>
        </article>
    </div>
</section>

<script type="module">
    // Loader minimal stay + welcome modal (optional)
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
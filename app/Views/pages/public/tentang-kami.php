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

        <!-- Breadcrumb modern -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>

        <!-- Header / Title -->
        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Tentang Kami</h1>
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
        <article class="card shadow-soft border-0 rounded-4 overflow-hidden" style="--d:120ms">
            <div class="card-body p-4 p-lg-5 content-typo">

                <p>
                    PKK (Pemberdayaan Kesejahteraan Keluarga) adalah organisasi kemasyarakatan yang bertujuan
                    untuk memberdayakan perempuan. Secara umum, istilah “ibu-ibu PKK” sudah luas dikenal dan
                    biasanya diasosiasikan dengan perkumpulan yang memiliki berbagai kegiatan positif.
                </p>

                <p>
                    PKK kerap dianggap hanya beranggotakan perempuan. Padahal sejatinya, Pemberdayaan dan
                    Kesejahteraan Keluarga bersifat inklusif. Karena gerakannya pragmatis, PKK memegang beragam
                    fungsi yang menyentuh kebutuhan keluarga dan masyarakat.
                </p>

                <h2 class="h5 mt-4">10 Fungsi Dasar PKK</h2>
                <ol class="list-modern">
                    <li>Penghayatan dan Pengamalan Pancasila</li>
                    <li>Gotong Royong</li>
                    <li>Pangan</li>
                    <li>Sandang</li>
                    <li>Perumahan serta Tatalaksana Rumah Tangga</li>
                    <li>Pendidikan dan Keterampilan</li>
                    <li>Kesehatan</li>
                    <li>Pengembangan Kehidupan Berkoperasi</li>
                    <li>Kelestarian Lingkungan Hidup</li>
                    <li>Perencanaan Sehat</li>
                </ol>

                <p class="mt-4">
                    Kegiatan PKK menggerakkan dan membina masyarakat untuk melaksanakan 10 Program Pokok PKK
                    dengan sasaran keluarga sebagai unit terkecil dalam masyarakat, guna mewujudkan keluarga sejahtera.
                </p>

                <p>
                    Selain itu, berikut adalah contoh kegiatan per <em>pokja</em> (kelompok kerja) yang diadopsi dari
                    10 Program Pokok PKK.
                </p>

                <h3 class="h6 mt-4">Pokja I</h3>
                <ol class="list-modern">
                    <li>Penghayatan dan Pengamalan Pancasila</li>
                </ol>

                <h4 class="h6 mt-3">Contoh Kegiatan</h4>
                <ul class="list-check">
                    <li>Melaksanakan penyuluhan Undang-undang Perkawinan.</li>
                </ul>

            </div>
        </article>

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

    particlesJS("particles-js", {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: "#3498db"
            }, // biru modern
            shape: {
                type: "circle"
            },
            opacity: {
                value: 0.6,
                random: true
            },
            size: {
                value: 4,
                random: true
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: "#3498db",
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 3,
                direction: "none",
                random: false,
                straight: false,
                out_mode: "out"
            }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: {
                    enable: true,
                    mode: "grab"
                },
                onclick: {
                    enable: true,
                    mode: "push"
                }
            },
            modes: {
                grab: {
                    distance: 200,
                    line_linked: {
                        opacity: 0.8
                    }
                },
                push: {
                    particles_nb: 4
                }
            }
        },
        retina_detect: true
    });

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
</script>

<?= $this->endSection() ?>
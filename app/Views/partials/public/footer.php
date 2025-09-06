<!-- footer -->
<section class="footer-pkk text-white">
    <div class="container py-5">
        <div class="row g-4 align-items-start">

            <!-- Brand / title -->
            <div class="col-md-6 col-lg-4">
                <div class="brand-wrap">
                    <h5 class="mb-1 text-uppercase fw-bold">TP PKK</h5>
                    <h5 class="m-0 text-uppercase fw-semibold">Kelurahan Lebak Denok</h5>
                    <p class="mt-3 small opacity-75">
                        Bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                    </p>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-md-6 col-lg-4">
                <h6 class="fw-bold mb-3">Kontak</h6>
                <ul class="list-unstyled footer-list">
                    <li>
                        <span class="icon-circle"><i class="fa-solid fa-location-dot"></i></span>
                        <span>Kel. Lebak Denok, Kec. Citangkil, Kota Cilegon</span>
                    </li>
                    <li>
                        <span class="icon-circle"><i class="fa-solid fa-phone"></i></span>
                        <a href="tel:082112341234" class="link-light text-decoration-none">082112341234</a>
                    </li>
                    <li>
                        <span class="icon-circle"><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:pkklebakdenok@gmail.com" class="link-light text-decoration-none">pkklebakdenok@gmail.com</a>
                    </li>
                </ul>
            </div>

            <!-- Sosial -->
            <div class="col-md-12 col-lg-4">
                <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="#" class="social-btn" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-btn" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <hr class="footer-divider my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small">
            <div class="opacity-85">
                <i class="fa-solid fa-copyright me-1"></i>
                Collaborative with
                <a href="https://unival-cilegon.ac.id/" class="link-light text-decoration-none fw-semibold" target="_blank" rel="noopener">Unival</a>
                and
                <a href="https://kellebakdenok.cilegon.go.id/" class="link-light text-decoration-none fw-semibold" target="_blank" rel="noopener">Kampung Programmer</a>
            </div>
            <div class="opacity-75">© <span id="year"></span> TP PKK Kelurahan Lebak Denok</div>
        </div>
    </div>
</section>

<script>

</script>

<!-- partikel js -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>


<!-- typed js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.1.0"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script type="module">
    // tahun otomatis
    document.getElementById('year').textContent = new Date().getFullYear();

    import Typed from "https://cdn.jsdelivr.net/npm/typed.js@2.1.0/dist/typed.module.js";

    new Typed("#typed", {
        strings: [
            "TP PKK Kelurahan Lebak Denok",
            "Pelaksanaan Pemberdayaan & Kesejahteraan Keluarga"
        ],
        typeSpeed: 50, // lebih cepat
        backSpeed: 30, // lebih halus
        backDelay: 1500, // tunggu sebentar sebelum menghapus
        loop: true,
        smartBackspace: false // matikan biar hapus full, lebih smooth
    });


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


</body>

</html>
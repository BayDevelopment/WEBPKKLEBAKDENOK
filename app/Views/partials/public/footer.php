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
                        <a href="tel:0254-310067" class="link-light text-decoration-none">0254-310067</a>
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
                    <a href="https://www.instagram.com/pkkkellebakdenok/" class="social-btn" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <hr class="footer-divider my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small">
            <div class="opacity-85">
                <i class="fa-solid fa-copyright me-1"></i>
                Collaborative with
                <a href="https://unival-cilegon.ac.id/" class="link-light text-decoration-none fw-semibold" target="_blank" rel="noopener">FIK Unival</a>
                and
                <a href="https://kellebakdenok.cilegon.go.id/" class="link-light text-decoration-none fw-semibold" target="_blank" rel="noopener">Posyantek Harapan Denok</a>
            </div>
            <div class="opacity-75">© <span id="year"></span> TP PKK Kelurahan Lebak Denok</div>
        </div>
    </div>
</section>


<!-- partikel js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.1.0/dist/typed.umd.js" defer></script>
<!-- Memuat library Particles.js -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Flash SweetAlert (PASTIKAN DI DALAM <script>) -->
<?php if (session()->getFlashdata('sweet_success')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",
            title: "<?= session()->getFlashdata('sweet_success'); ?>"
        });
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet_error')) : ?>
    <script>
        const ToastError = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        ToastError.fire({
            icon: "error",
            title: "<?= session()->getFlashdata('sweet_error'); ?>"
        });
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('flash_logout')) : ?>
    <script>
        const ToastLogout = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        ToastLogout.fire({
            icon: "success",
            title: "<?= session()->getFlashdata('flash_logout'); ?>"
        });
    </script>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalEl = document.getElementById("welcomeModal");
        if (!modalEl || !window.bootstrap) return;

        // Pastikan hanya satu instance
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

        // Cari tombol Tutup
        const btnTutup = modalEl.querySelector(".btn.btn-secondary");
        if (btnTutup) {
            btnTutup.addEventListener("click", function(e) {
                e.preventDefault();
                modal.hide(); // tutup paksa via API
            });
        }

        // Optional: tampilkan modal otomatis saat halaman pertama load
        modal.show();

        // Bersihkan state setelah modal ditutup
        modalEl.addEventListener("hidden.bs.modal", () => {
            document.body.classList.remove("modal-open");
            document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
        });
    });
    /* ========== Utils ========== */

    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.getElementById("navbar");
        const sticky = navbar.offsetTop; // Mendapatkan posisi offset navbar

        // Fungsi untuk menambah/menghapus kelas fixed-top berdasarkan scroll
        function onScroll() {
            if (window.pageYOffset > sticky) {
                navbar.classList.add("fixed-top"); // Menambahkan kelas fixed-top
            } else {
                navbar.classList.remove("fixed-top"); // Menghapus kelas fixed-top
            }
        }

        // Menambahkan event listener saat scroll
        window.addEventListener("scroll", onScroll);
    });

    // Aktivasi Modal ketika halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Menunggu halaman selesai dimuat sebelum menampilkan modal
        const modal = new bootstrap.Modal(document.getElementById('welcomeModal'), {
            backdrop: 'static',
            keyboard: false
        });

        // Menampilkan modal
        modal.show();
    });

    function ensureScript(id, src) {
        return new Promise((res, rej) => {
            if (document.getElementById(id)) return res();
            const s = document.createElement('script');
            s.id = id;
            s.src = src;
            s.async = true;
            s.onload = res;
            s.onerror = rej;
            document.head.appendChild(s);
        });
    }

    const isMobile = () => window.matchMedia('(max-width:575.98px)').matches;
    const reduceMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ========== Loader + Modal once per session ========== */
    (function() {
        const LOADER_MIN_MS = 700,
            SHOW_MODAL_ONCE = true,
            KEY = 'welcomeShown';
        const loader = document.getElementById('app-loader');
        const modalEl = document.getElementById('welcomeModal');
        const t0 = Date.now();

        window.addEventListener('load', () => {
            const delay = Math.max(0, LOADER_MIN_MS - (Date.now() - t0));
            setTimeout(() => {
                if (loader) {
                    loader.classList.add('hidden');
                    setTimeout(() => loader.remove(), 450);
                }
                const shown = sessionStorage.getItem(KEY);
                if ((!shown || !SHOW_MODAL_ONCE) && window.bootstrap && modalEl && !isMobile()) {
                    new bootstrap.Modal(modalEl, {
                        backdrop: 'static',
                        keyboard: false
                    }).show();
                    sessionStorage.setItem(KEY, '1');
                }
            }, delay);
        });

        window.addEventListener('pageshow', e => {
            if (e.persisted && loader) loader.classList.add('hidden');
        });
    })();

    /* ========== Fade-in (kompat .show & .is-visible + force check) ========== */
    function initReveal() {
        const items = [...document.querySelectorAll('.reveal')];
        if (!items.length) return;
        const markVisible = el => {
            el.classList.add('show');
            el.classList.add('is-visible');
        };

        if (!('IntersectionObserver' in window) || reduceMotion()) {
            items.forEach(markVisible);
            return;
        }

        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    markVisible(e.target);
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: .15,
            rootMargin: '0px 0px -6% 0px'
        });

        items.forEach((el, i) => {
            if (!el.style.getPropertyValue('--d')) el.style.setProperty('--d', (i % 8) * 60);
            io.observe(el);
        });

        const inView = el => {
            const r = el.getBoundingClientRect(),
                vh = window.innerHeight || document.documentElement.clientHeight;
            return r.top <= vh * 0.86 && r.bottom >= 0;
        };
        const forceCheck = () => items.forEach(el => {
            if (!el.classList.contains('show') && inView(el)) markVisible(el);
        });

        window.addEventListener('load', () => setTimeout(forceCheck, 60), {
            once: true
        });
        if (document.fonts && document.fonts.ready) document.fonts.ready.then(() => setTimeout(forceCheck, 60));
        window.addEventListener('resize', () => requestAnimationFrame(forceCheck), {
            passive: true
        });
        window.addEventListener('scroll', () => requestAnimationFrame(forceCheck), {
            passive: true
        });
    }

    /* ========== Typed.js ========== */
    let typedInstance = null;
    const typedStrings = () => isMobile() ? ["Keluarga Sehat · Cerdas · Sejahtera", "PKK Lebak Denok — Bergerak Bersama"] : ["TP PKK Kelurahan Lebak Denok", "Bersama mewujudkan keluarga sehat, cerdas, dan sejahtera", "Sinergi warga, RT/RW, dan Kelurahan"];

    async function loadTypedLib() {
        if (window.Typed) return;
        try {
            await ensureScript('typedjs-cdn', 'https://cdn.jsdelivr.net/npm/typed.js@2.1.0/dist/typed.umd.js');
        } catch (e) {}
    }

    function mountTyped() {
        const target = document.getElementById('typed');
        if (!target) return;
        if (reduceMotion()) {
            target.textContent = typedStrings()[0] || "";
            return;
        }
        if (!window.Typed) return;
        if (typedInstance) {
            typedInstance.destroy();
            typedInstance = null;
        }
        typedInstance = new window.Typed('#typed', {
            strings: typedStrings(),
            typeSpeed: isMobile() ? 36 : 42,
            backSpeed: isMobile() ? 26 : 32,
            backDelay: 1100,
            startDelay: 150,
            smartBackspace: true,
            loop: true,
            showCursor: true,
            cursorChar: '|'
        });
    }

    /* ========== Particles.js ========== */
    function particlesConfig() {
        return {
            particles: {
                number: {
                    value: 50,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#0da3de" // Particle color
                },
                shape: {
                    type: "circle"
                },
                opacity: {
                    value: 0.5,
                    random: true,
                },
                size: {
                    value: 5,
                    random: true,
                },
                move: {
                    enable: true,
                    speed: 3,
                    direction: "none",
                }
            },
            interactivity: {
                events: {
                    onhover: {
                        enable: true,
                        mode: "repulse"
                    }
                }
            },
            retina_detect: true
        };
    }

    function mountParticles() {
        const host = document.getElementById('particles-js');
        if (!host) {
            console.warn('[particles] #particles-js not found');
            return;
        }

        if (!window.particlesJS) {
            console.warn('[particles] particles.js not loaded');
            return;
        }

        host.innerHTML = ''; // Clear previous canvas
        window.particlesJS('particles-js', particlesConfig());
    }

    /* ========== Boot (Once Only, Clean Setup) ========== */
    document.addEventListener('DOMContentLoaded', async () => {
        await loadTypedLib();

        initReveal();
        mountTyped();
        mountParticles();

        /* Re-mount setelah gambar hero selesai */
        window.addEventListener('load', () => mountParticles(), {
            once: true
        });

        /* Re-init ringan saat resize */
        let rt = null;
        window.addEventListener('resize', () => {
            clearTimeout(rt);
            rt = setTimeout(() => {
                mountTyped();
                mountParticles();
            }, 160);
        }, {
            passive: true
        });
    });
</script>
</body>

</html>
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
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.1.0/dist/typed.umd.js" defer></script>
<!-- partikel -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>
    /* ========== Utils ========== */
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

    /* Tahun footer */
    document.addEventListener('DOMContentLoaded', () => {
        const y = document.getElementById('year');
        if (y) y.textContent = new Date().getFullYear();
    });

    /* ========== Sticky nav dinamis (tanpa CLS) ========== */
    document.addEventListener('DOMContentLoaded', function() {
        const topbar = document.querySelector('.navbar-information-sosmed');
        const nav = document.querySelector('nav.navbar');
        if (!nav) return;
        nav.classList.remove('sticky-top');

        const placeholder = document.createElement('div');
        placeholder.setAttribute('aria-hidden', 'true');
        placeholder.style.height = '0px';
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
        }, {
            passive: true
        });
        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        setTimeout(() => {
            recalc();
            onScroll();
        }, 200);
    });

    /* ========== Loader + Modal sekali sesi ========== */
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
    const FORCE_PARTICLES_FOR_TEST = false; // set true bila ingin memaksa saat Reduce Motion aktif
    async function loadParticlesLib() {
        if (window.particlesJS) return;
        try {
            await ensureScript('particlesjs-cdn', 'https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js');
        } catch (e) {
            try {
                await ensureScript('particlesjs-local', '/assets/vendor/particles.min.js');
            } catch (_e) {}
        }
    }

    function particlesConfig() {
        const m = isMobile();

        // ambil dari CSS var --brand (fallback ke biru brand)
        const brandHex =
            getComputedStyle(document.documentElement).getPropertyValue('--brand').trim() || '#0da3de';

        return {
            particles: {
                number: {
                    value: m ? 24 : 48,
                    density: {
                        enable: true,
                        value_area: m ? 600 : 900
                    }
                },
                // WARNA PARTIKEL
                color: {
                    value: brandHex
                }, // <-- hex 6 digit
                shape: {
                    type: 'circle'
                }, // jangan pakai stroke 8-digit hex
                opacity: {
                    value: 0.45,
                    random: true
                }, // sedikit lebih tebal biar terlihat biru
                size: {
                    value: m ? 1.8 : 2.8,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: m ? 110 : 140,
                    color: brandHex, // <-- hex 6 digit
                    opacity: 0.5,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: m ? 0.9 : 1.2,
                    direction: 'none',
                    out_mode: 'out'
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: false
                    },
                    onclick: {
                        enable: false
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 140,
                        line_linked: {
                            opacity: 0.5
                        }
                    },
                    bubble: {
                        distance: 200,
                        size: 3,
                        duration: 0.4,
                        opacity: 0.8,
                        speed: 3
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 2
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        };
    }



    function mountParticles() {
        const host = document.getElementById('particles-js');
        if (!host) {
            console.warn('[particles] #particles-js tidak ditemukan');
            return;
        }

        const reduce = reduceMotion();
        console.log('[particles] reduceMotion=', reduce, 'FORCE=', FORCE_PARTICLES_FOR_TEST);

        // paksa tampil saat tes
        if (reduce && !FORCE_PARTICLES_FOR_TEST) {
            host.style.display = 'none';
            console.log('[particles] dimatikan karena prefers-reduced-motion');
            return;
        } else {
            host.style.display = '';
        }

        if (!window.particlesJS) {
            console.warn('[particles] library belum siap (particlesJS undefined)');
            return;
        }

        // Cek ukuran kontainer; kalau 0 jangan init dulu
        const rect = host.getBoundingClientRect();
        console.log('[particles] host rect:', rect);
        if (rect.width === 0 || rect.height === 0) {
            // coba tunggu sampai layout settle
            requestAnimationFrame(() => setTimeout(mountParticles, 120));
            console.log('[particles] tunda init karena ukuran 0');
            return;
        }

        host.innerHTML = ''; // reset canvas lama
        window.particlesJS('particles-js', particlesConfig());
        console.log('[particles] inisialisasi OK');
    }


    /* ========== Boot (satu kali, rapi) ========== */
    document.addEventListener('DOMContentLoaded', async () => {
        await loadTypedLib();
        await loadParticlesLib();

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
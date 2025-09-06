<?= $this->extend('templates/template_public') ?>
<?= $this->section('content_public') ?>

<style>
    /* Hero header */
    .contact-hero {
        background: linear-gradient(135deg, #0d1b2a, #1b5eaa);
        color: #fff;
        border-radius: 1rem;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(13, 27, 42, 0.25);
    }

    /* Card info */
    .contact-card {
        border: 1px solid rgba(0, 0, 0, .06);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 6px 20px rgba(16, 24, 40, .06);
        transition: transform .25s ease, box-shadow .25s ease;
        background: #fff;
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(16, 24, 40, .10);
    }

    /* Form */
    .form-control,
    .form-select {
        border-radius: .75rem;
        padding: .75rem 1rem;
        border: 1px solid #dee2e6;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .15);
    }

    .btn-send {
        border-radius: 999px;
        padding: .6rem 1.5rem;
        font-weight: 600;
        background: #0d6efd;
        color: #fff;
        transition: all .2s ease;
    }

    .btn-send:hover {
        background: #0b5ed7;
        box-shadow: 0 6px 20px rgba(13, 110, 253, .25);
        transform: translateY(-1px);
    }

    .contact-sticky {
        position: sticky;
        top: 90px;
        /* jarak dari atas navbar */
        z-index: 100;
    }
</style>

<section class="container py-5">
    <!-- Hero -->
    <div class="contact-hero text-center reveal" style="--d:100ms">
        <h1 class="fw-bold mb-2">Hubungi Kami</h1>
        <p class="lead opacity-90 mb-0">Kami siap mendengar saran, kritik, dan pertanyaan dari Anda.</p>
    </div>

    <div class="row g-4">
        <!-- Form Kontak -->
        <div class="col-lg-7 reveal" style="--d:180ms">
            <div class="card shadow-soft border-0 rounded-4 p-4 p-lg-5">
                <h4 class="fw-semibold mb-4">Kirim Pesan</h4>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subjek</label>
                        <input type="text" class="form-control" id="subject" placeholder="Masukkan subjek pesan">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-send">
                        <i class="fa-solid fa-paper-plane me-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        <!-- Info Kontak -->
        <div class="col-lg-5 reveal" style="--d:240ms">
            <div class="list-group shadow-sm rounded-4 contact-sticky">
                <div class="list-group-item d-flex align-items-start gap-3">
                    <i class="fa-solid fa-map-marker-alt text-primary fs-5"></i>
                    <div>
                        <h6 class="fw-semibold mb-1">Alamat</h6>
                        <small>Jl. Raya Lebak Denok No. 123<br>Kecamatan Citangkil, Kota Cilegon, Banten</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-start gap-3">
                    <i class="fa-solid fa-phone text-primary fs-5"></i>
                    <div>
                        <h6 class="fw-semibold mb-1">Telepon</h6>
                        <small>+62 812 3456 7890</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-start gap-3">
                    <i class="fa-solid fa-envelope text-primary fs-5"></i>
                    <div>
                        <h6 class="fw-semibold mb-1">Email</h6>
                        <small>info@lebakdenok.id</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Maps -->
    <div class="mt-5 reveal" style="--d:300ms">
        <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.614058502243!2d106.121!3d-6.1234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420000000000%3A0x123456789abc!2sLebak%20Denok%2C%20Citangkil!5e0!3m2!1sid!2sid!4v1693920212345"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<script>
    // Fade-in efek (IntersectionObserver)
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
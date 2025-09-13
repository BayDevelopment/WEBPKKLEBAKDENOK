<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<style>
    /* --- Reuse style dari referensi + tambahan untuk form --- */

    /* Fade-in on scroll (dari referensi) */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        will-change: opacity, transform
    }

    .reveal.is-visible,
    .reveal.show {
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

    /* Breadcrumb (dari referensi) */
    .breadcrumb-modern {
        background: rgba(0, 98, 204, .06);
        border: 1px solid rgba(0, 98, 204, .12);
        --bs-breadcrumb-divider-color: rgba(0, 0, 0, .35)
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #0d6efd
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: rgba(0, 0, 0, .6)
    }

    /* Hero gradient glass (dari referensi) */
    .about-hero {
        background:
            radial-gradient(1200px 300px at -10% -10%, rgba(13, 110, 253, .25), transparent 60%),
            radial-gradient(900px 300px at 110% -10%, rgba(32, 201, 151, .25), transparent 60%),
            linear-gradient(135deg, #0d1b2a, #163f6b 55%, #1b5eaa);
        box-shadow: 0 12px 40px rgba(13, 27, 42, .25);
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .about-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        backdrop-filter: saturate(120%) blur(0px);
        pointer-events: none
    }

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
        font-size: .875rem
    }

    .shadow-soft {
        box-shadow: 0 8px 28px rgba(0, 0, 0, .08)
    }

    .content-typo p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #495057
    }

    .content-typo h2,
    .content-typo h3,
    .content-typo h4 {
        color: #0f2a4a
    }

    .list-check {
        padding-left: 0;
        margin-left: 0
    }

    .list-check>li {
        list-style: none;
        position: relative;
        padding-left: 1.8rem;
        margin-bottom: .5rem
    }

    .list-check>li::before {
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: .15rem;
        color: #20c997
    }

    /* --- Tambahan khusus form --- */
    .form-card {
        border: 1px solid rgba(13, 110, 253, .12);
        border-radius: 1.25rem
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
    }

    .required::after {
        content: "*";
        color: #dc3545;
        margin-left: .25rem;
        font-weight: 700
    }

    .hint {
        font-size: .85rem;
        color: #6c757d
    }

    .section-title {
        font-weight: 800;
        color: #0f2a4a
    }

    .btn-join {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        width: 100%;
        padding: .9rem 1.25rem;
        border-radius: 999px;
        font-weight: 800;
        letter-spacing: .4px;
        color: #fff;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        border: 0;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .15);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .btn-join:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .2);
        filter: saturate(1.05)
    }

    .btn-join:active {
        transform: none;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .16)
    }

    .custom-file .form-control {
        padding: .5rem .75rem
    }

    .badge-req {
        background: #e7f1ff;
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, .28)
    }

    .divider-label {
        display: flex;
        align-items: center;
        gap: .75rem;
        color: #6c757d;
        margin: 1.25rem 0;
    }

    .divider-label::before,
    .divider-label::after {
        content: "";
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, rgba(0, 0, 0, .08), rgba(0, 0, 0, .02));
    }

    @media (max-width: 991.98px) {
        .chip {
            background: rgba(255, 255, 255, .18)
        }
    }

    /* Kolom persyaratan ngambang */
    .sticky-join {
        position: sticky;
        top: 92px;
        /* sesuaikan dgn tinggi navbar/hero kamu */
        z-index: 2;
    }

    /* Card persyaratan: tinggi menyesuaikan viewport dan isi bisa scroll */
    .scroll-card {
        max-height: calc(100vh - 140px);
        /* aman agar tidak nabrak header/footer */
        display: flex;
        flex-direction: column;
    }

    /* Bagian dalam card yang discroll */
    .scroll-card .card-body {
        overflow: auto;
        overscroll-behavior: contain;
        scrollbar-gutter: stable;
    }

    /* Scrollbar halus */
    .scroll-card .card-body::-webkit-scrollbar {
        width: 8px
    }

    .scroll-card .card-body::-webkit-scrollbar-thumb {
        background: rgba(13, 110, 253, .35);
        border-radius: 8px;
    }

    .scroll-card .card-body::-webkit-scrollbar-track {
        background: rgba(13, 110, 253, .08);
        border-radius: 8px;
    }

    /* Non-sticky di layar kecil */
    @media (max-width: 991.98px) {
        .sticky-join {
            position: static;
            top: auto
        }

        .scroll-card {
            max-height: none
        }
    }
</style>

<!-- LOADER (opsional, bisa dilepas jika sudah ada di layout) -->
<div id="app-loader" class="d-none" aria-hidden="true"></div>

<section class="py-5 reveal">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 reveal">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="<?= site_url('/') ?>" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Gabung TP PKK</li>
            </ol>
        </nav>

        <!-- Hero -->
        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white reveal" style="--d:80ms">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Gabung Bersama Kami</h1>
                    <p class="lead mb-0 opacity-90">Berkolaborasi mewujudkan keluarga sehat, cerdas, dan sejahtera di Kelurahan Lebak Denok.</p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li><span class="chip"><i class="fa-solid fa-user-plus me-2"></i>Pendaftaran Relawan</span></li>
                        <li><span class="chip"><i class="fa-solid fa-shield-heart me-2"></i>Komitmen Masyarakat</span></li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="row g-4">
            <!-- Persyaratan -->
            <div class="col-lg-5 reveal" style="--d:120ms">
                <div class="sticky-join">
                    <article class="card shadow-soft form-card scroll-card">
                        <div class="card-body p-4 p-lg-4">
                            <!-- Judul & isi persyaratan tetap sama -->
                            <h2 class="h5 section-title mb-3">
                                <i class="fa-solid fa-list-check me-2"></i>Persyaratan Gabung TP PKK
                            </h2>
                            <ul class="list-check mb-3">
                                <li>Warga Kelurahan Lebak Denok atau berdomisili di sekitar wilayah.</li>
                                <li>Berusia minimal 17 tahun (memiliki KTP).</li>
                                <li>Sehat jasmani dan rohani.</li>
                                <li>Memiliki komitmen waktu untuk kegiatan PKK (minimal 4 jam/minggu).</li>
                                <li>Berkepribadian baik dan mampu bekerja dalam tim.</li>
                            </ul>
                            <div class="divider-label"><span class="small">Dokumen yang disiapkan</span></div>
                            <ul class="list-check mb-0">
                                <li>Scan/Foto KTP.</li>
                                <li>Pas foto terbaru (background polos).</li>
                                <li>Opsional: Sertifikat/Portofolio (jika ada).</li>
                            </ul>
                            <p class="mt-3 mb-0">
                                <span class="badge badge-req rounded-pill px-2 py-1">Catatan</span>
                                Berkas dikirim melalui form di samping, pastikan ukuran file sesuai ketentuan.
                            </p>
                        </div>
                    </article>
                </div>
            </div>


            <!-- Form Pendaftaran -->
            <div class="col-lg-7 reveal" style="--d:160ms">
                <article class="card shadow-soft form-card">
                    <div class="card-body p-4 p-lg-4">
                        <h2 class="h5 section-title mb-3"><i class="fa-solid fa-pen-to-square me-2"></i>Formulir Pendaftaran</h2>

                        <form action="<?= site_url('gabung/submit') ?>" method="post" enctype="multipart/form-data" novalidate>
                            <?= csrf_field() ?>

                            <!-- Data Pribadi -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Siti Aminah" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">NIK</label>
                                    <input type="text" name="nik" class="form-control" inputmode="numeric" minlength="16" maxlength="16" placeholder="16 digit" required>
                                    <div class="hint">Isi sesuai KTP (16 digit).</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">No. HP/WA</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="08xxxxxxxxxx" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Jenis Kelamin</label>
                                    <div class="d-flex gap-3 pt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="L" required>
                                            <label class="form-check-label" for="jkL">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="P" required>
                                            <label class="form-check-label" for="jkP">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label required">Alamat Lengkap</label>
                                    <textarea name="alamat" rows="2" class="form-control" placeholder="Nama jalan, RT/RW, Kelurahan, Kecamatan" required></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Kelurahan</label>
                                    <input type="text" name="kelurahan" class="form-control" value="Lebak Denok" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" placeholder="Contoh: Citangkil" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Kota/Kabupaten</label>
                                    <input type="text" name="kota" class="form-control" placeholder="Contoh: Cilegon" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Pendidikan Terakhir</label>
                                    <select name="pendidikan" class="form-select" required>
                                        <option value="" hidden>Pilih salah satu</option>
                                        <option>SD</option>
                                        <option>SMP</option>
                                        <option>SMA/SMK</option>
                                        <option>D3</option>
                                        <option>S1</option>
                                        <option>S2</option>
                                        <option>S3</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control" placeholder="Contoh: Ibu Rumah Tangga / Guru">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kesediaan Waktu</label>
                                    <select name="kesediaan_waktu" class="form-select">
                                        <option value="" hidden>Pilih</option>
                                        <option>Hari kerja</option>
                                        <option>Akhir pekan</option>
                                        <option>Fleksibel</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Minat Bidang Kegiatan</label>
                                    <div class="row g-2">
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="minat[]" value="Pendidikan" id="minat1">
                                                <label class="form-check-label" for="minat1">Pendidikan</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="minat[]" value="Kesehatan" id="minat2">
                                                <label class="form-check-label" for="minat2">Kesehatan</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="minat[]" value="Lingkungan" id="minat3">
                                                <label class="form-check-label" for="minat3">Lingkungan</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="minat[]" value="Ekonomi" id="minat4">
                                                <label class="form-check-label" for="minat4">Ekonomi</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="minat[]" value="Administrasi" id="minat5">
                                                <label class="form-check-label" for="minat5">Administrasi</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Keahlian/Kompetensi</label>
                                    <input type="text" name="keahlian" class="form-control" placeholder="Contoh: Microsoft Office, Public Speaking, Desain">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Pengalaman Organisasi</label>
                                    <textarea name="pengalaman" rows="2" class="form-control" placeholder="Tuliskan pengalaman organisasi (jika ada)"></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label required">Alasan Bergabung</label>
                                    <textarea name="alasan" rows="3" class="form-control" placeholder="Ceritakan motivasi Anda bergabung" required></textarea>
                                </div>

                                <!-- Upload -->
                                <div class="col-md-6">
                                    <label class="form-label required">Unggah KTP (JPG/PNG, maks 2MB)</label>
                                    <input type="file" name="ktp_file" accept=".jpg,.jpeg,.png" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Pas Foto (JPG/PNG, maks 2MB)</label>
                                    <input type="file" name="foto_file" accept=".jpg,.jpeg,.png" class="form-control" required>
                                </div>

                                <!-- Persetujuan -->
                                <div class="col-12">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
                                        <label class="form-check-label required" for="agree">
                                            Saya menyatakan data yang diberikan benar dan bersedia mengikuti ketentuan TP PKK Kelurahan Lebak Denok.
                                        </label>
                                    </div>
                                    <div class="hint mt-1">Dengan mengirim formulir ini, Anda menyetujui pengolahan data sesuai kebijakan privasi.</div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn-join" type="submit">
                                    <i class="fa-solid fa-user-plus"></i> Kirim Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Reveal on scroll (ringkas) -->
<script>
    (() => {
        const items = [...document.querySelectorAll('.reveal')];
        if (!items.length) return;
        if (!('IntersectionObserver' in window)) {
            items.forEach(el => el.classList.add('is-visible', 'show'));
            return;
        }
        const io = new IntersectionObserver((e, o) => {
            e.forEach(x => {
                if (x.isIntersecting) {
                    x.target.classList.add('is-visible', 'show');
                    o.unobserve(x.target)
                }
            })
        }, {
            threshold: .14,
            rootMargin: '0px 0px -6% 0px'
        });
        items.forEach((el, i) => {
            if (!el.style.getPropertyValue('--d')) el.style.setProperty('--d', (i % 8) * 60 + 'ms');
            io.observe(el);
        });
    })();
</script>
<?= $this->endSection() ?>
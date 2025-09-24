<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>
<style>
    /* ====== BASE (Desktop besar) ====== */
    .sidebar .sidebar-card-illustration {
        width: 140px;
        /* default besar di desktop */
        height: auto;
        transition: width .2s ease, transform .2s ease, opacity .2s ease;
    }

    /* ====== Laptop (≤ 1199px) ====== */
    @media (max-width: 1199.98px) {
        .sidebar .sidebar-card-illustration {
            width: 120px;
        }
    }

    /* ====== Tablet (≤ 991px) ====== */
    @media (max-width: 991.98px) {
        .sidebar .sidebar-card-illustration {
            width: 100px;
        }
    }

    /* ====== Mobile (≤ 767px) ====== */
    @media (max-width: 767.98px) {

        /* Kalau mau kartu terlihat juga di mobile, hapus class d-none d-lg-flex di HTML,
     atau override:
     .sidebar .sidebar-card { display: flex !important; } */
        .sidebar .sidebar-card-illustration {
            width: 80px;
        }
    }

    /* ====== SAAT SIDEBAR DITOGGLE (DICIUTKAN) ======
   SB Admin 2 menambahkan:
   - body.sidebar-toggled
   - .sidebar.toggled
   Kaitkan dua-duanya biar aman di semua halaman.
*/
    .sidebar.toggled .sidebar-card-illustration,
    body.sidebar-toggled .sidebar .sidebar-card-illustration {
        width: 36px;
        /* kecil saat collapse */
        transform: scale(0.95);
        opacity: .95;
    }

    /* (Opsional) Sembunyikan teks & tombol saat collapse biar rapi */
    .sidebar.toggled .sidebar-card p,
    .sidebar.toggled .sidebar-card .btn,
    body.sidebar-toggled .sidebar .sidebar-card p,
    body.sidebar-toggled .sidebar .sidebar-card .btn {
        display: none !important;
    }

    /* (Opsional) rapikan tombol toggler */
    #sidebarToggle {
        cursor: pointer;
        outline: none;
    }


    /* AWAL CSS */
    .page-title {
        font-weight: 800;
        letter-spacing: .2px;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent
    }

    .card-modern {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        overflow: hidden
    }

    .card-modern .card-header {
        background: #fff;
        border: 0
    }

    .card-modern::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, rgba(78, 115, 223, .6), rgba(28, 200, 138, .6));
        opacity: .5
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff !important;
        border: none;
        box-shadow: 0 8px 18px rgba(78, 115, 223, .25);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease
    }

    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(78, 115, 223, .35);
        filter: saturate(1.05)
    }

    .form-soft {
        background: #f8fafc;
        border: 1px solid #e5e7eb
    }

    .form-soft:focus {
        border-color: #c7d2fe;
        box-shadow: 0 0 0 .15rem rgba(78, 115, 223, .15)
    }

    .img-preview {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: .75rem;
        border: 1px solid #e5e7eb
    }

    .badge-soft {
        background: rgba(78, 115, 223, .08);
        color: #4e73df;
        border: 1px solid rgba(78, 115, 223, .2);
        border-radius: 999px
    }

    .help-text {
        color: #6b7280;
        font-size: .85rem
    }

    .required:after {
        content: " *";
        color: #e11d48;
        font-weight: 700
    }

    /* clock */
    .clock-float {
        position: fixed;
        right: calc(16px + env(safe-area-inset-right));
        bottom: calc(16px + env(safe-area-inset-bottom));
        z-index: 1080;
        transition: right .18s ease;
    }

    /* Saat tombol Back to Top tampil, geser clock ke kiri sejajar */
    body.has-btt .clock-float {
        /* 16px (gap) + lebar tombol back-to-top + 16px margin kanan */
        right: calc(16px + var(--btt-width, 44px) + 16px + env(safe-area-inset-right));
    }

    /* Tampilan pill modern */
    .clock-widget {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .55rem .9rem;
        background: linear-gradient(135deg, rgba(78, 115, 223, .10), rgba(28, 200, 138, .10));
        border: 1px solid rgba(78, 115, 223, .22);
        border-radius: 9999px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .12);
        backdrop-filter: blur(6px);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .clock-widget:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, .16);
    }

    .clock-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(78, 115, 223, .14);
        color: #4e73df;
    }

    .clock-time {
        font-weight: 800;
        letter-spacing: .6px;
        font-variant-numeric: tabular-nums;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        color: #1f2937;
        min-width: 92px;
        text-align: center;
        display: inline-block;
    }

    @media (max-width: 576px) {
        .clock-widget {
            padding: .45rem .75rem;
        }

        .clock-icon {
            width: 28px;
            height: 28px;
        }

        .clock-time {
            min-width: 84px;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .clock-widget,
        .clock-float {
            transition: none;
        }
    }

    /* desain input css */
    :root {
        --up-border: #e5e7eb;
        --up-border-h: #9ca3af;
        --up-bg: #fbfbff;
        --up-bg-h: #f5f7ff;
        --up-primary: #2563eb;
        --up-text: #334155;
        --up-sub: #64748b;
        --up-danger: #dc2626;
    }

    /* Kontainer input file custom */
    .upload-field {
        position: relative;
        display: grid;
        grid-template-columns: 48px 1fr auto;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        border: 1.5px dashed var(--up-border);
        border-radius: 14px;
        background: var(--up-bg);
        cursor: pointer;
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease, transform .1s ease;
        box-shadow: 0 6px 20px rgba(2, 6, 23, .04);
    }

    .upload-field:hover {
        border-color: var(--up-border-h);
        background: var(--up-bg-h);
        transform: translateY(-1px);
    }

    .upload-field:focus-within {
        outline: 2px solid color-mix(in oklab, var(--up-primary) 40%, transparent);
        outline-offset: 2px;
        border-color: color-mix(in oklab, var(--up-primary) 55%, var(--up-border));
        box-shadow: 0 10px 28px rgba(37, 99, 235, .12);
    }

    /* icon */
    .upload-ico {
        inline-size: 48px;
        block-size: 48px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: radial-gradient(100% 100% at 50% 0%, #ffffff 0%, #eef2ff 100%);
        box-shadow: inset 0 1px 0 #fff, 0 6px 16px rgba(2, 6, 23, .06);
        color: var(--up-primary);
        font-size: 18px;
    }

    /* teks */
    .upload-texts {
        display: grid;
        gap: 2px;
    }

    .upload-title {
        font-weight: 700;
        color: var(--up-text);
        line-height: 1.2;
    }

    .upload-sub {
        font-size: .875rem;
        color: var(--up-sub);
    }

    /* tombol kecil di kanan */
    .upload-cta {
        padding: 8px 12px;
        border-radius: 10px;
        background: var(--up-primary);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(37, 99, 235, .25);
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .upload-field:hover .upload-cta {
        transform: translateY(-1px);
        box-shadow: 0 10px 26px rgba(37, 99, 235, .28);
    }

    /* sembunyikan input asli tapi tetap aksesibel */
    .upload-field>input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    /* state invalid */
    .upload-field.is-invalid {
        border-color: color-mix(in oklab, var(--up-danger) 60%, var(--up-border));
        background: #fff7f7;
    }

    .upload-field.is-invalid .upload-cta {
        background: var(--up-danger);
        box-shadow: 0 6px 18px rgba(220, 38, 38, .25);
    }

    /* helper & error */
    .help-text {
        color: var(--up-sub);
        font-size: .875rem;
    }

    .invalid-feedback {
        color: var(--up-danger);
        font-size: .875rem;
    }

    /* preview responsive */
    .preview-wrap {
        margin-top: 12px;
        display: inline-block;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 10px 26px rgba(2, 6, 23, .10);
        max-inline-size: min(240px, 60vw);
    }

    .preview-img {
        display: block;
        inline-size: 100%;
        block-size: 160px;
        object-fit: cover;
        background: #f3f4f6;
    }

    /* ====== PAS FOTO: input file modern + preview 3x4 ====== */

    /* Gaya input file (CI4/Bootstrap .form-control) */
    #pas_foto.form-control[type="file"] {
        padding: 10px 12px;
        border: 1.5px dashed #e5e7eb;
        /* garis putus-putus elegan */
        border-radius: 14px;
        background: #fbfbff;
        box-shadow: 0 6px 20px rgba(2, 6, 23, .04);
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease, transform .1s ease;
    }

    #pas_foto.form-control[type="file"]:hover {
        border-color: #c7d2fe;
        background: #f5f7ff;
        transform: translateY(-1px);
    }

    #pas_foto.form-control[type="file"]:focus {
        box-shadow: 0 10px 28px rgba(37, 99, 235, .12);
        border-color: #93c5fd;
    }

    /* Tombol "Pilih File" yang modern */
    #pas_foto.form-control[type="file"]::file-selector-button {
        margin-right: 12px;
        padding: 8px 12px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        box-shadow: 0 6px 18px rgba(78, 115, 223, .25);
        cursor: pointer;
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }

    #pas_foto.form-control[type="file"]::file-selector-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 26px rgba(78, 115, 223, .28);
        filter: saturate(1.05);
    }

    /* Safari/WebKit fallback */
    #pas_foto.form-control[type="file"]::-webkit-file-upload-button {
        margin-right: 12px;
        padding: 8px 12px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        box-shadow: 0 6px 18px rgba(78, 115, 223, .25);
        cursor: pointer;
    }

    /* Preview pas foto (rasio 3x4, crop tengah) */
    #prev_pas_foto {
        display: block;
        inline-size: clamp(180px, 34vw, 260px);
        /* responsif */
        aspect-ratio: 3 / 4;
        /* rasio pas foto 3x4 */
        object-fit: cover;
        /* crop tengah */
        object-position: center;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        background:
            radial-gradient(100% 100% at 50% 0%, #ffffff 0%, #eef2ff 100%);
        /* base */
        box-shadow:
            inset 0 1px 0 #fff,
            0 10px 24px rgba(15, 23, 42, .12);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }

    #prev_pas_foto:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, .16);
        filter: saturate(1.02);
    }

    /* Jika kamu masih pakai .img-preview sebelumnya, pastikan id ini override */
    .img-preview#prev_pas_foto {
        height: auto;
    }

    /* biar ikut aspect-ratio 3/4 */

    /* State saat error validasi pada input file */
    .is-invalid#pas_foto {
        border-color: #fca5a5;
        background: #fff7f7;
    }
</style>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><i class="fa-solid fa-user-pen me-2"></i> Edit Rekrutmen</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/rekrutmen') ?>">Rekrutmen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-3">
        <div class="col-xl-8 col-lg-9">
            <div class="card card-modern">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 me-2">
                            <i class="fa-solid fa-user-pen"></i> Form
                        </span>
                        <h6 class="m-0 fw-bold">Edit Pendaftaran</h6>
                    </div>
                    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <?php
                    /** @var array $rekrut data pendaftaran yang diedit */
                    /** @var array $d_pkkpokja list pokja aktif */
                    $validation = session('validation') ?? \Config\Services::validation();
                    ?>
                    <?php if (!empty($rekrut) && !empty($d_pkkpokja)): ?>
                        <form id="formRekrutmen"
                            action="<?= site_url('admin/rekrutmen/update/' . (int)$rekrut['id_pendaftaran']) ?>"
                            method="post" novalidate>
                            <?= csrf_field(); ?>

                            <input type="hidden" name="id_pendaftaran" value="<?= (int)$rekrut['id_pendaftaran'] ?>">

                            <div class="row g-3 mb-4">
                                <!-- Nama -->
                                <div class="col-md-6">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap"
                                        class="form-control form-soft <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : '' ?>"
                                        value="<?= old('nama_lengkap', $rekrut['nama_lengkap'] ?? '') ?>"
                                        placeholder="Masukan nama lengkap.." required>
                                    <div class="invalid-feedback"><?= $validation->getError('nama_lengkap') ?></div>
                                </div>

                                <!-- NIK -->
                                <div class="col-md-6">
                                    <label class="form-label required">NIK (16 digit)</label>
                                    <input type="text" name="nik" maxlength="16"
                                        class="form-control form-soft <?= $validation->hasError('nik') ? 'is-invalid' : '' ?>"
                                        value="<?= old('nik', $rekrut['nik'] ?? '') ?>"
                                        placeholder="Masukan NIK.." required>
                                    <div class="invalid-feedback"><?= $validation->getError('nik') ?></div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-12">
                                    <label class="form-label required">Alamat</label>
                                    <textarea name="alamat" rows="2"
                                        class="form-control form-soft <?= $validation->hasError('alamat') ? 'is-invalid' : '' ?>"
                                        placeholder="Masukan Alamat.." required><?= old('alamat', $rekrut['alamat'] ?? '') ?></textarea>
                                    <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                                </div>

                                <!-- No HP -->
                                <div class="col-md-6">
                                    <label class="form-label">No. HP (WhatsApp)</label>
                                    <input type="tel" name="no_hp"
                                        class="form-control form-soft <?= $validation->hasError('no_hp') ? 'is-invalid' : '' ?>"
                                        value="<?= old('no_hp', $rekrut['no_hp'] ?? '') ?>"
                                        placeholder="08xxxxxxxxxx">
                                    <div class="invalid-feedback"><?= $validation->getError('no_hp') ?></div>
                                    <div class="help-text">Masukan No Handphone yang aktif.</div>
                                </div>

                                <!-- Pilih Pokja -->
                                <style>
                                    /* ===== Minimal Modern Select (scoped ke kolom ini) ===== */
                                    .select-pokja-col .form-label.required::after {
                                        content: " *";
                                        color: #ef4444;
                                        margin-left: .25rem;
                                    }

                                    .select-pokja-col .form-select.form-soft {
                                        width: 100%;
                                        border: 1px solid #e5e7eb;
                                        border-radius: 12px;
                                        padding: .625rem .875rem;
                                        min-height: 44px;
                                        background-color: #fff;
                                        transition: border-color .2s, box-shadow .2s;
                                    }

                                    .select-pokja-col .form-select.form-soft:hover {
                                        border-color: #d1d5db;
                                    }

                                    .select-pokja-col .form-select.form-soft:focus {
                                        border-color: #6366f1;
                                        /* indigo */
                                        box-shadow: 0 0 0 .2rem rgba(99, 102, 241, .15);
                                        outline: 0;
                                    }

                                    .select-pokja-col .form-select.form-soft.is-invalid {
                                        border-color: #ef4444 !important;
                                        box-shadow: 0 0 0 .2rem rgba(239, 68, 68, .15);
                                    }

                                    .select-pokja-col .invalid-feedback {
                                        display: block;
                                        margin-top: .35rem;
                                    }
                                </style>

                                <div class="col-md-6 select-pokja-col">
                                    <label class="form-label required" for="id_pkkpokja">Pilih Pokja</label>
                                    <select id="id_pkkpokja" name="id_pkkpokja"
                                        class="form-select form-soft <?= $validation->hasError('id_pkkpokja') ? 'is-invalid' : '' ?>"
                                        required aria-describedby="pokjaHelp">
                                        <option value="" disabled <?= old('id_pkkpokja', $rekrut['id_pkkpokja'] ?? '') === '' ? 'selected' : '' ?>>— Pilih Pokja —</option>
                                        <?php foreach ($d_pkkpokja as $p): ?>
                                            <option value="<?= (int)$p['id_pkkpokja'] ?>"
                                                <?= (string)old('id_pkkpokja', $rekrut['id_pkkpokja'] ?? '') === (string)$p['id_pkkpokja'] ? 'selected' : '' ?>>
                                                <?= esc($p['kode']) ?> — <?= esc($p['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="pokjaHelp" class="help-text">Pilih satu Pokja yang sesuai.</div>
                                    <div class="invalid-feedback"><?= $validation->getError('id_pkkpokja') ?></div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="<?= site_url('admin/rekrutmen') ?>" class="btn btn-outline-secondary rounded-pill mr-2">
                                    <i class="fa-solid fa-xmark"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-gradient rounded-pill" id="btnSubmitForm">
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="<?= base_url('assets/img/icons-empty.png') ?>" alt="empty" style="width:120px;height:auto;opacity:.9;">
                            <div class="mt-3 text-muted">Data tidak tersedia.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // NIK: jaga tetap angka & 16 digit (tanpa alert)
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formRekrutmen');
        if (!form) return;

        const nikInput = form.querySelector('input[name="nik"]');
        if (nikInput) {
            const keepDigits = () => {
                const digits = (nikInput.value || '').replace(/\D/g, '').slice(0, 16);
                if (digits !== nikInput.value) nikInput.value = digits;
            };
            nikInput.setAttribute('inputmode', 'numeric');
            nikInput.setAttribute('pattern', '\\d*');
            nikInput.setAttribute('maxlength', '16');
            nikInput.addEventListener('input', keepDigits);
            nikInput.addEventListener('blur', keepDigits);
            nikInput.addEventListener('paste', () => setTimeout(keepDigits, 0));
        }

        // Kunci UI saat submit (tanpa men-disable select/checkbox/radio)
        form.addEventListener('submit', function() {
            form.querySelectorAll('button, input[type="submit"], input[type="button"], input[type="reset"]').forEach(b => b.disabled = true);
            form.querySelectorAll('input:not([type="hidden"]), select, textarea').forEach(el => {
                el.style.pointerEvents = 'none';
                const type = (el.type || '').toLowerCase();
                if (el.tagName !== 'SELECT' && !['checkbox', 'radio', 'file', 'hidden', 'submit', 'button', 'reset'].includes(type)) {
                    el.readOnly = true;
                }
            });
            const btn = document.getElementById('btnSubmitForm');
            if (btn) {
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Menyimpan...';
                btn.classList.add('disabled');
                btn.setAttribute('aria-disabled', 'true');
            }
        }, {
            once: true
        });
    });
</script>

<?= $this->endSection() ?>
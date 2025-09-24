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
</style>

<div class="container-fluid">

    <!-- Heading + Breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title">
            <i class="fa-solid fa-layer-group me-2"></i>
            <?= esc($sub_judul) ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item"><a href="<?= site_url('admin/pokja') ?>">Data Pokja</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($sub_judul) ?></li>
            </ol>
        </nav>
    </div>

    <div class="row mb-3">
        <div class="col-xl-8 col-lg-9">
            <div class="card card-modern position-relative">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-pen-to-square"></i> Form</span>
                        <h6 class="m-0 fw-bold"><?= esc($sub_judul) ?></h6>
                    </div>
                    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">

                    <form action="<?= base_url('admin/rekrutmen/pokja/create') ?>" method="post" novalidate>
                        <?php $validation = session('validation') ?? \Config\Services::validation(); ?>

                        <?= csrf_field(); ?>

                        <div class="row g-3">
                            <!-- KODE -->
                            <div class="col-md-4 mb-4">
                                <label class="form-label required">Kode Pokja</label>
                                <input type="text"
                                    name="kode"
                                    maxlength="16"
                                    class="form-control form-soft <?= $validation->hasError('kode') ? 'is-invalid' : '' ?>"
                                    value="<?= esc($auto_kode) ?>"
                                    placeholder="mis: POKJA1"
                                    readonly>
                                <div class="invalid-feedback"><?= $validation->getError('kode') ?></div>
                            </div>

                            <!-- NAMA -->
                            <div class="col-md-8 mb-4">
                                <label class="form-label required">Nama Pokja</label>
                                <input type="text"
                                    name="nama"
                                    maxlength="50"
                                    class="form-control form-soft <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>"
                                    value="<?= old('nama', $pokja['nama'] ?? '') ?>"
                                    placeholder="mis: Pokja I"
                                    required>
                                <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="col-12 mb-4">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi"
                                    rows="3"
                                    class="form-control form-soft <?= $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>"
                                    placeholder="Ringkasan fokus/tugas Pokja (opsional)"><?= old('deskripsi', $pokja['deskripsi'] ?? '') ?></textarea>
                                <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
                            </div>

                            <!-- AKTIF -->
                            <?php $valAktif = (int) old('aktif', $d_pkkpokja['aktif'] ?? 1); ?>
                            <div class="col-md-6">
                                <label class="form-label d-block">Status</label>
                                <div class="d-flex align-items-center gap-4">

                                    <div class="form-check form-switch">
                                        <!-- Checkbox HANYA untuk UI (tanpa name), pakai id yang benar -->
                                        <input class="form-check-input" type="checkbox" id="aktifSwitch"
                                            <?= $valAktif === 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="aktifSwitch">Aktif</label>
                                    </div>

                                    <span id="statusPreview" class="badge rounded-pill bg-white">
                                        <?= $valAktif === 1
                                            ? '<i class="fa-solid fa-check-circle me-1"></i> Active'
                                            : '<i class="fa-solid fa-pause-circle me-1"></i> Inactive' ?>
                                    </span>
                                </div>

                                <!-- Yang disubmit ke server CUMA hidden ini -->
                                <input type="hidden" name="aktif" id="aktifInput" value="<?= $valAktif ?>">
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-outline-secondary rounded-pill mr-2">
                                <i class="fa-solid fa-rotate-left"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-gradient rounded-pill" id="btnSubmitForm">
                                <i class="fa-solid fa-floppy-disk"></i> Tambah
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview gambar & Ambil GPS -->
<script>
    // Sinkron switch -> input hidden 'aktif' + preview badge
    (function() {
        const sw = document.getElementById('aktifSwitch');
        const hid = document.getElementById('aktifInput');
        const pv = document.getElementById('statusPreview');
        if (!sw || !hid || !pv) return;

        function render() {
            const on = sw.checked;
            hid.value = on ? 1 : 0;
            pv.className = 'badge rounded-pill bg-white';
            pv.innerHTML = on ?
                '<i class="fa-solid fa-check-circle me-1"></i> Active' :
                '<i class="fa-solid fa-pause-circle me-1"></i> Inactive';
        }
        sw.addEventListener('change', render);
        render();
    })();

    // Konfirmasi sebelum submit (opsional, jika pakai SweetAlert2)
    (function() {
        const btn = document.getElementById('btnSubmitForm');
        if (!btn || !window.Swal) return;
        btn.addEventListener('click', function(ev) {
            ev.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Simpan data Pokja?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Simpan'
            }).then(r => {
                if (r.isConfirmed) form.submit();
            });
        });
    })();
</script>

<?= $this->endSection() ?>
<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>
<style>
    /* ====== Sidebar image responsive ====== */
    .sidebar .sidebar-card-illustration {
        width: 140px;
        height: auto;
        transition: width .2s ease, transform .2s ease, opacity .2s ease
    }

    @media (max-width:1199.98px) {
        .sidebar .sidebar-card-illustration {
            width: 120px
        }
    }

    @media (max-width:991.98px) {
        .sidebar .sidebar-card-illustration {
            width: 100px
        }
    }

    @media (max-width:767.98px) {
        .sidebar .sidebar-card-illustration {
            width: 80px
        }
    }

    .sidebar.toggled .sidebar-card-illustration,
    body.sidebar-toggled .sidebar .sidebar-card-illustration {
        width: 36px;
        transform: scale(.95);
        opacity: .95
    }

    .sidebar.toggled .sidebar-card p,
    .sidebar.toggled .sidebar-card .btn,
    body.sidebar-toggled .sidebar .sidebar-card p,
    body.sidebar-toggled .sidebar .sidebar-card .btn {
        display: none !important
    }

    #sidebarToggle {
        cursor: pointer;
        outline: none
    }

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

    .form-soft {
        background: #f8fafc;
        border: 1px solid #e5e7eb
    }

    .form-soft:focus {
        border-color: #c7d2fe;
        box-shadow: 0 0 0 .15rem rgba(78, 115, 223, .15)
    }

    .required:after {
        content: " *";
        color: #e11d48;
        font-weight: 700
    }

    .invalid-feedback {
        display: block
    }

    /* upload */
    .upload-field {
        position: relative;
        display: grid;
        grid-template-columns: 48px 1fr auto;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        border: 1.5px dashed #e5e7eb;
        border-radius: 14px;
        background: #fbfbff;
        cursor: pointer;
        transition: .2s;
        border-color: #e5e7eb;
        box-shadow: 0 6px 20px rgba(2, 6, 23, .04)
    }

    .upload-field:hover {
        border-color: #9ca3af;
        background: #f5f7ff
    }

    .upload-field>input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer
    }

    .upload-ico {
        inline-size: 48px;
        block-size: 48px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: radial-gradient(100% 100% at 50% 0%, #fff 0, #eef2ff 100%);
        color: #2563eb
    }

    .upload-cta {
        padding: 8px 12px;
        border-radius: 10px;
        background: #2563eb;
        color: #fff;
        font-weight: 600
    }

    .preview-wrap {
        margin-top: 12px;
        display: inline-block;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 10px 26px rgba(2, 6, 23, .10);
        max-inline-size: min(240px, 60vw)
    }

    .preview-img {
        display: block;
        inline-size: 100%;
        block-size: 160px;
        object-fit: cover;
        background: #f3f4f6
    }

    /* ===== Modern floating select ===== */
    .form-floating-select {
        position: relative;
    }

    .form-floating-select select {
        border-radius: .75rem;
        padding: 1rem .75rem .25rem;
        border: 1px solid #e5e7eb;
        background-color: #f8fafc;
        font-weight: 500;
        transition: all .2s ease;
    }

    .form-floating-select select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 .2rem rgba(78, 115, 223, .25);
        background-color: #fff;
    }

    .form-floating-select label {
        position: absolute;
        top: .75rem;
        left: .75rem;
        padding: 0 .25rem;
        font-size: .9rem;
        color: #6b7280;
        pointer-events: none;
        transition: all .2s ease;
        background: #f8fafc;
        border-radius: 4px;
    }

    .form-floating-select select:focus+label,
    .form-floating-select select:not(:placeholder-shown)+label {
        top: -.55rem;
        left: .65rem;
        font-size: .75rem;
        color: #4e73df;
        background: #fff;
    }

    /* ===== Modern Form (semua field) ===== */
    .mf-group {
        position: relative
    }

    .mf-group .mf-input,
    .mf-group .mf-select,
    .mf-group .mf-textarea {
        width: 100%;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        border-radius: .9rem;
        padding: 1.1rem 1rem .55rem 2.65rem;
        /* ruang icon kiri */
        font-weight: 500;
        transition: border-color .18s, box-shadow .18s, background .18s, transform .18s;
    }

    .mf-group .mf-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 2.5rem
    }

    .mf-group .mf-input:focus,
    .mf-group .mf-select:focus,
    .mf-group .mf-textarea:focus {
        border-color: #4e73df;
        background: #fff;
        box-shadow: 0 0 0 .18rem rgba(78, 115, 223, .22)
    }

    .mf-group .mf-label {
        position: absolute;
        left: 2.65rem;
        top: .95rem;
        font-size: .95rem;
        color: #6b7280;
        pointer-events: none;
        padding: 0 .25rem;
        background: transparent;
        transition: all .18s ease
    }

    .mf-group .mf-input::placeholder,
    .mf-group .mf-textarea::placeholder {
        color: transparent
    }

    .mf-group .mf-input:focus+.mf-label,
    .mf-group .mf-input:not(:placeholder-shown)+.mf-label,
    .mf-group .mf-select:focus+.mf-label,
    .mf-group .mf-select:not([value=""])+.mf-label,
    .mf-group .mf-textarea:focus+.mf-label,
    .mf-group .mf-textarea:not(:placeholder-shown)+.mf-label {
        top: -.6rem;
        left: 2.4rem;
        font-size: .75rem;
        color: #4e73df;
        background: #fff;
        border-radius: 6px
    }

    /* ikon kiri */
    .mf-ico {
        position: absolute;
        left: .85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 36px;
        height: 36px;
        display: grid;
        place-items: center;
        border-radius: .75rem;
        background: rgba(78, 115, 223, .12);
        color: #4e73df
    }

    /* caret select kanan */
    .mf-caret {
        position: absolute;
        right: .8rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        pointer-events: none
    }

    /* textarea khusus */
    .mf-group .mf-textarea {
        min-height: 120px;
        padding-left: 2.65rem;
        resize: vertical
    }

    /* helper & error */
    .mf-help {
        color: #6b7280;
        font-size: .85rem;
        margin-top: .35rem
    }

    .is-invalid {
        border-color: #dc2626 !important
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 .18rem rgba(220, 38, 38, .18) !important
    }

    .invalid-feedback {
        display: block
    }

    /* switch modern */
    .form-switch .form-check-input {
        width: 3rem;
        height: 1.6rem;
        border-radius: 2rem;
        background: #e5e7eb;
        border: 1px solid #d1d5db;
        cursor: pointer
    }

    .form-switch .form-check-input:checked {
        background: #22c55e;
        border-color: #16a34a
    }

    .form-switch .form-check-input:focus {
        box-shadow: 0 0 0 .18rem rgba(34, 197, 94, .25)
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

    /* upload field tetap cantik dari punyamu */
</style>

<?php $validation = session('validation') ?? (\Config\Services::validation()); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><i class="fa-solid fa-clipboard-check"></i> Edit Quiz</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/quiz') ?>">Quiz</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card card-modern">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="m-0 fw-bold">Form Edit Quiz</h6>
            <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body p-4">

            <form action="<?= site_url('admin/quiz/update/' . $quiz['id_quiz']) ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="row g-3">

                    <!-- JUDUL -->
                    <div class="col-md-8 mb-3">
                        <div class="mf-group">
                            <span class="mf-ico"><i class="fa-solid fa-heading"></i></span>
                            <input type="text" name="judul" id="judul"
                                value="<?= old('judul', $quiz['judul'] ?? '') ?>"
                                class="mf-input <?= validation_show_error('judul') ? 'is-invalid' : '' ?>"
                                placeholder=" ">
                            <label for="judul" class="mf-label required">Judul</label>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('judul'); ?></div>
                    </div>

                    <!-- SLUG -->
                    <div class="col-md-4 mb-3">
                        <div class="mf-group">
                            <span class="mf-ico"><i class="fa-solid fa-link"></i></span>
                            <input type="text" name="slug" id="slug"
                                value="<?= old('slug', $quiz['slug'] ?? '') ?>"
                                class="mf-input <?= validation_show_error('slug') ? 'is-invalid' : '' ?>"
                                placeholder=" ">
                            <label for="slug" class="mf-label required">Slug (URL)</label>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('slug'); ?></div>
                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-6 mb-3">
                        <div class="mf-group">
                            <span class="mf-ico"><i class="fa-solid fa-folder-tree"></i></span>
                            <select id="kategori" name="kategori"
                                class="mf-select <?= validation_show_error('kategori') ? 'is-invalid' : '' ?>"
                                value="<?= old('kategori', $quiz['kategori'] ?? '') ?>" required>
                                <option value="" hidden></option>
                                <?php
                                $opts = ['PKK', 'Stunting', 'Pola Asuh', 'Digitalisasi', 'Semua'];
                                $val  = old('kategori', $quiz['kategori'] ?? '');
                                foreach ($opts as $o):
                                ?>
                                    <option value="<?= $o ?>" <?= $val === $o ? 'selected' : ''; ?>><?= $o ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="kategori" class="mf-label required">Kategori</label>
                            <span class="mf-caret"><i class="fa-solid fa-chevron-down"></i></span>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('kategori'); ?></div>
                    </div>

                    <!-- DURASI -->
                    <div class="col-md-3 mb-3">
                        <div class="mf-group">
                            <span class="mf-ico"><i class="fa-regular fa-clock"></i></span>
                            <input type="number" min="1" name="durasi_menit"
                                value="<?= old('durasi_menit', $quiz['durasi_menit'] ?? '') ?>"
                                class="mf-input <?= validation_show_error('durasi_menit') ? 'is-invalid' : '' ?>"
                                placeholder=" ">
                            <label for="durasi_menit" class="mf-label required">Durasi (menit)</label>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('durasi_menit'); ?></div>
                    </div>

                    <!-- STATUS -->
                    <div class="col-md-3 mb-3">
                        <div class="mf-group">
                            <span class="mf-ico"><i class="fa-solid fa-flag"></i></span>
                            <?php $v = old('status', $quiz['status'] ?? ''); ?>
                            <select id="status" name="status"
                                class="mf-select <?= validation_show_error('status') ? 'is-invalid' : '' ?>"
                                value="<?= $v ?>" required>
                                <option value="" hidden></option>
                                <option value="active" <?= $v === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $v === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="draft" <?= $v === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            </select>
                            <label for="status" class="mf-label required">Status</label>
                            <span class="mf-caret"><i class="fa-solid fa-chevron-down"></i></span>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('status'); ?></div>
                    </div>

                    <!-- IS VIRTUAL ALL -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Buka untuk Semua Peserta?</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_virtual_all"
                                name="is_virtual_all" value="1"
                                <?= old('is_virtual_all', $quiz['is_virtual_all'] ?? 0) ? 'checked' : '' ?>>
                            <label class="form-check-label ml-4" for="is_virtual_all">
                                Centang jika quiz bisa diikuti semua mahasiswa
                            </label>
                        </div>
                        <?php if (validation_show_error('is_virtual_all')): ?>
                            <div class="invalid-feedback d-block"><?= validation_show_error('is_virtual_all'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="col-12 mb-3">
                        <div class="mf-group">
                            <span class="mf-ico"><i class="fa-regular fa-note-sticky"></i></span>
                            <textarea name="deskripsi" id="deskripsi"
                                class="mf-textarea <?= validation_show_error('deskripsi') ? 'is-invalid' : '' ?>"
                                placeholder=" "><?= old('deskripsi', $quiz['deskripsi'] ?? '') ?></textarea>
                            <label for="deskripsi" class="mf-label">Deskripsi</label>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>

                    <!-- THUMBNAIL -->
                    <div class="col-md-6">
                        <label class="form-label">Thumbnail</label>
                        <label class="upload-field <?= validation_show_error('thumbnail') ? 'is-invalid' : '' ?>">
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/png,image/jpeg">
                            <span class="upload-ico"><i class="fa-solid fa-image"></i></span>
                            <span><strong>Upload gambar</strong><br><small>JPG/PNG • Maks 2MB</small></span>
                            <span class="upload-cta">Pilih File</span>
                        </label>
                        <div class="invalid-feedback"><?= validation_show_error('thumbnail'); ?></div>

                        <div class="preview-wrap">
                            <img id="thumbPreview"
                                src="<?= !empty($quiz['thumbnail']) ? base_url('assets/uploads/quiz/' . $quiz['thumbnail']) : 'https://placehold.co/320x160?text=Preview' ?>"
                                class="preview-img" alt="Preview thumbnail">
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= site_url('admin/quiz') ?>" class="btn btn-outline-secondary rounded-pill mr-2">
                        <i class="fa-solid fa-rotate-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-gradient rounded-pill">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS ringan: floating select & preview -->
<script>
    (function() {
        // floating select: sync attribute value agar label tetap melayang
        const selects = document.querySelectorAll('.mf-select');
        const sync = el => el.setAttribute('value', el.value || '');
        selects.forEach(el => {
            sync(el);
            el.addEventListener('change', () => sync(el));
        });

        // preview thumbnail
        const i = document.getElementById('thumbnail'),
            p = document.getElementById('thumbPreview');
        i?.addEventListener('change', e => {
            const f = e.target.files?.[0];
            if (!f) return;
            const r = new FileReader();
            r.onload = ev => p.src = ev.target.result;
            r.readAsDataURL(f);
        });
    })();
</script>

<?= $this->endSection() ?>
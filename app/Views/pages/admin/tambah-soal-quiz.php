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

    /* Floating container */
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

    @media (prefers-reduced-motion: reduce) {

        .clock-widget,
        .clock-float {
            transition: none;
        }
    }

    /* upload field tetap cantik dari punyamu */
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title mb-3"><i class="fa-solid fa-clipboard-check"></i> Tambah Quiz - Soal <?= esc($quiz['kategori']) ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/quiz') ?>">Quiz - <?= esc($quiz['kategori']) ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-3">
        <div class="col-xl-9 col-lg-10">
            <div class="card card-modern position-relative">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">Form Tambah Quiz - <?= esc($quiz['kategori']) ?></h6>
                    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body p-4">

                    <form action="<?= site_url('admin/quiz/soal/' . esc($quiz['slug']) . '/tambah'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <?php
                        // QUIZ (dari slug, fixed + tetap kirim balik old agar PRG jalan)
                        $quizId    = old('quiz_id', $quiz['id_quiz']);
                        $quizJudul = $quiz['judul'] ?? '—';
                        ?>

                        <input type="hidden" name="quiz_id" id="quiz_id" value="<?= esc($quizId) ?>">

                        <div class="col-md-12 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><i class="fa-solid fa-list-check"></i></span>
                                <input type="text"
                                    class="mf-input <?= validation_show_error('quiz_id') ? 'is-invalid' : '' ?>"
                                    value="<?= esc($quizJudul) ?> (ID: <?= esc($quizId) ?>)" readonly>
                                <label class="mf-label required">Quiz</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('quiz_id') ?></div>
                        </div>

                        <!-- URUTAN -->
                        <div class="col-lg-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><i class="fa-solid fa-hashtag"></i></span>
                                <input type="number" name="urutan" id="urutan"
                                    value="<?= esc(old('urutan', $soal['urutan'] ?? 1)) ?>"
                                    class="mf-input <?= validation_show_error('urutan') ? 'is-invalid' : '' ?>"
                                    min="1">
                                <label for="urutan" class="mf-label required">Urutan</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('urutan') ?></div>
                        </div>

                        <!-- SKOR -->
                        <div class="col-lg-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><i class="fa-solid fa-star"></i></span>
                                <input type="number" name="skor" id="skor"
                                    value="<?= esc(old('skor', $soal['skor'] ?? 1)) ?>"
                                    class="mf-input <?= validation_show_error('skor') ? 'is-invalid' : '' ?>"
                                    min="0" step="1">
                                <label for="skor" class="mf-label required">Skor</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('skor') ?></div>
                        </div>

                        <!-- PERTANYAAN -->
                        <div class="col-12 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><i class="fa-regular fa-circle-question"></i></span>
                                <textarea name="pertanyaan" id="pertanyaan"
                                    class="mf-textarea <?= validation_show_error('pertanyaan') ? 'is-invalid' : '' ?>"><?= esc(old('pertanyaan', $soal['pertanyaan'] ?? '')) ?></textarea>
                                <label for="pertanyaan" class="mf-label required">Pertanyaan</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('pertanyaan') ?></div>
                        </div>

                        <!-- GAMBAR (opsional) -->
                        <div class="col-lg-6 m-3">
                            <label for="gambar" class="form-label">Gambar (opsional)</label>

                            <?php $fileInvalid = validation_show_error('gambar') ? 'is-invalid' : ''; ?>
                            <label class="upload-field <?= $fileInvalid ?>">
                                <input type="file" id="gambar" name="gambar"
                                    class="<?= $fileInvalid ?>"
                                    accept="image/png,image/jpeg,image/jpg">
                                <span class="upload-ico"><i class="fa-solid fa-image"></i></span>
                                <span><strong>Upload gambar soal</strong><br><small>JPG/PNG • Maks 2MB</small></span>
                                <span class="upload-cta">Pilih File</span>
                            </label>
                            <div class="invalid-feedback"><?= validation_show_error('gambar') ?></div>

                            <div class="preview-wrap">
                                <img id="imgPreview" src="https://placehold.co/320x160?text=Preview" class="preview-img" alt="Preview">
                            </div>
                        </div>

                        <!-- OPSI A -->
                        <div class="col-md-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><strong>A</strong></span>
                                <input type="text" name="opsi_a" id="opsi_a"
                                    value="<?= esc(old('opsi_a', $soal['opsi_a'] ?? '')) ?>"
                                    class="mf-input <?= validation_show_error('opsi_a') ? 'is-invalid' : '' ?>">
                                <label for="opsi_a" class="mf-label required">Opsi A</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('opsi_a') ?></div>
                        </div>

                        <!-- OPSI B -->
                        <div class="col-md-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><strong>B</strong></span>
                                <input type="text" name="opsi_b" id="opsi_b"
                                    value="<?= esc(old('opsi_b', $soal['opsi_b'] ?? '')) ?>"
                                    class="mf-input <?= validation_show_error('opsi_b') ? 'is-invalid' : '' ?>">
                                <label for="opsi_b" class="mf-label required">Opsi B</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('opsi_b') ?></div>
                        </div>

                        <!-- OPSI C -->
                        <div class="col-md-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><strong>C</strong></span>
                                <input type="text" name="opsi_c" id="opsi_c"
                                    value="<?= esc(old('opsi_c', $soal['opsi_c'] ?? '')) ?>"
                                    class="mf-input <?= validation_show_error('opsi_c') ? 'is-invalid' : '' ?>">
                                <label for="opsi_c" class="mf-label required">Opsi C</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('opsi_c') ?></div>
                        </div>

                        <!-- OPSI D -->
                        <div class="col-md-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><strong>D</strong></span>
                                <input type="text" name="opsi_d" id="opsi_d"
                                    value="<?= esc(old('opsi_d', $soal['opsi_d'] ?? '')) ?>"
                                    class="mf-input <?= validation_show_error('opsi_d') ? 'is-invalid' : '' ?>">
                                <label for="opsi_d" class="mf-label required">Opsi D</label>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('opsi_d') ?></div>
                        </div>

                        <!-- KUNCI JAWABAN -->
                        <?php $kj = old('kunci_jawaban', $soal['kunci_jawaban'] ?? ''); ?>
                        <div class="col-md-6 mb-3">
                            <div class="mf-group">
                                <span class="mf-ico"><i class="fa-solid fa-key"></i></span>
                                <select name="kunci_jawaban" id="kunci_jawaban"
                                    class="mf-select <?= validation_show_error('kunci_jawaban') ? 'is-invalid' : '' ?>">
                                    <option value="" hidden></option>
                                    <?php foreach (['A', 'B', 'C', 'D'] as $opt): ?>
                                        <option value="<?= $opt; ?>" <?= $kj === $opt ? 'selected' : '' ?>><?= $opt; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="kunci_jawaban" class="mf-label required">Kunci Jawaban</label>
                                <span class="mf-caret"><i class="fa-solid fa-chevron-down"></i></span>
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('kunci_jawaban') ?></div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-outline-secondary rounded-pill mr-2">
                                <i class="fa-solid fa-rotate-left"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-gradient rounded-pill">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Preview gambar
    const imgInput = document.getElementById('gambar');
    const imgPrev = document.getElementById('imgPreview');
    if (imgInput) {
        imgInput.addEventListener('change', e => {
            const f = e.target.files?.[0];
            if (!f) return;
            const rd = new FileReader();
            rd.onload = ev => imgPrev.src = ev.target.result;
            rd.readAsDataURL(f);
        });
    }

    // preview gambar 
    document.getElementById('gambar')?.addEventListener('change', function(e) {
        const file = e.target.files?.[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        const img = document.getElementById('imgPreview');
        if (img) img.src = url;
    });
</script>

<?= $this->endSection() ?>
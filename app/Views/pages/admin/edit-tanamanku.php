<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>

<?php $validation = session('validation') ?? ($validation ?? \Config\Services::validation()); ?>


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
        <h1 class="h3 mb-0 page-title"><span><i class="fa-solid fa-seedling"></i></span> <?= esc($sub_judul ?? 'Edit Tanaman') ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Tanaman</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-xl-9 col-lg-10">
            <div class="card card-modern position-relative">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-leaf"></i> Form</span>
                        <h6 class="m-0 fw-bold">Edit Data Tanaman</h6>
                    </div>
                    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <!-- ACTION: arahkan ke route update, pakai PUT -->
                    <form action="<?= site_url('admin/tanamanku/edit/' . (int)($row['id_tanamanku'] ?? 0)) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="row g-3">
                            <!-- Nama Umum -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Nama Umum</label>
                                <input type="text" name="nama_umum" value="<?= esc(old('nama_umum', $row['nama_umum'] ?? '')) ?>"
                                    class="form-control form-soft <?= $validation->hasError('nama_umum') ? 'is-invalid' : '' ?>"
                                    placeholder="mis. Kelor">
                                <div class="invalid-feedback"><?= esc($validation->getError('nama_umum')) ?></div>
                            </div>

                            <!-- Nama Latin -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Latin</label>
                                <input
                                    type="text"
                                    name="nama_latin"
                                    value="<?= esc(old('nama_latin', $row['nama_latin'] ?? '')) ?>"
                                    maxlength="150"
                                    class="form-control form-soft <?= $validation->hasError('nama_latin') ? 'is-invalid' : '' ?>"
                                    placeholder="mis. Moringa oleifera">
                                <div class="invalid-feedback"><?= esc($validation->getError('nama_latin')) ?></div>
                            </div>


                            <!-- Foto: tampilkan foto saat ini + opsi ganti -->
                            <div class="col-md-6 mb-3">
                                <div class="flex-grow-1">
                                    <label for="foto_tanaman" class="form-label fw-semibold">Foto Tanaman (kosongkan jika tidak diganti)</label>

                                    <label class="upload-field <?= $validation->hasError('foto_tanaman') ? 'is-invalid' : '' ?>">
                                        <input
                                            type="file"
                                            id="foto_tanaman"
                                            name="foto_tanaman"
                                            accept="image/png,image/jpeg"
                                            class="<?= $validation->hasError('foto_tanaman') ? 'is-invalid' : '' ?>">
                                        <span class="upload-ico"><i class="fa-solid fa-image"></i></span>
                                        <span class="upload-texts">
                                            <span class="upload-title">Klik untuk unggah</span>
                                            <span class="upload-sub">JPG/PNG • Maks 3MB</span>
                                        </span>
                                        <span class="upload-cta">Pilih File</span>
                                    </label>

                                    <div class="help-text mt-1">Biarkan kosong bila tidak ingin mengganti foto.</div>
                                    <div class="invalid-feedback"><?= esc($validation->getError('foto_tanaman')) ?></div>

                                    <!-- Preview: pakai foto lama dulu -->
                                    <div class="preview-wrap">
                                        <img id="previewImg" src="<?= base_url('assets/uploads/tanaman/' .  esc(old('foto_tanaman', $row['foto_tanaman'] ?? ''))) ?>"
                                            alt="Preview foto"
                                            class="preview-img rounded">
                                    </div>
                                </div>
                            </div>

                            <!-- Asal Daerah -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Asal Daerah</label>
                                <input type="text" name="asal_daerah" value="<?= esc(old('asal_daerah', $row['asal_daerah'] ?? '')) ?>"
                                    class="form-control form-soft <?= $validation->hasError('asal_daerah') ? 'is-invalid' : '' ?>"
                                    placeholder="mis. NTT, Jawa Barat">
                                <div class="invalid-feedback"><?= esc($validation->getError('asal_daerah')) ?></div>
                            </div>

                            <!-- Manfaat -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Manfaat</label>
                                <textarea name="manfaat" rows="2"
                                    class="form-control form-soft <?= $validation->hasError('manfaat') ? 'is-invalid' : '' ?>"
                                    placeholder="Tuliskan manfaat utama tanaman..."><?= esc(old('manfaat', $row['manfaat'] ?? '')) ?></textarea>
                                <div class="invalid-feedback"><?= esc($validation->getError('manfaat')) ?></div>
                            </div>

                            <!-- Keterangan -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" rows="3"
                                    class="form-control form-soft <?= $validation->hasError('keterangan') ? 'is-invalid' : '' ?>"
                                    placeholder="Catatan tambahan..."><?= esc(old('keterangan', $row['keterangan'] ?? '')) ?></textarea>
                                <div class="invalid-feedback"><?= esc($validation->getError('keterangan')) ?></div>
                            </div>

                            <!-- Tanggal, Jumlah, Status -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label required">Tanggal & Waktu Pendataan</label>
                                <input type="datetime-local"
                                    id="tanggal_pendataan"
                                    name="tanggal_pendataan"
                                    step="60"
                                    value="<?= esc(old('tanggal_pendataan') ?: indo_date($row['tanggal_pendataan'] ?? null)) ?>"
                                    class="form-control form-soft <?= $validation->hasError('tanggal_pendataan') ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?= esc($validation->getError('tanggal_pendataan')) ?></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label required">Jumlah</label>
                                <input type="number" min="1" name="jumlah" value="<?= esc(old('jumlah', $row['jumlah'] ?? '')) ?>"
                                    class="form-control form-soft <?= $validation->hasError('jumlah') ? 'is-invalid' : '' ?>"
                                    placeholder="mis. 10">
                                <div class="invalid-feedback"><?= esc($validation->getError('jumlah')) ?></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label required">Status</label>
                                <?php
                                // Ambil dari $row (bisa array atau object), lalu fallback ke old('status')
                                $statusFromRow = is_array($row) ? ($row['status'] ?? '') : (is_object($row) ? ($row->status ?? '') : '');
                                $currStatus    = strtolower((string) old('status', $statusFromRow));
                                ?>
                                <select name="status" required
                                    class="form-select form-soft <?= $validation->hasError('status') ? 'is-invalid' : '' ?>">
                                    <option value="" disabled <?= $currStatus === '' ? 'selected' : '' ?>>-- pilih status --</option>
                                    <option value="active" <?= $currStatus === 'active'   ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $currStatus === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                                <div class="invalid-feedback"><?= esc($validation->getError('status')) ?></div>
                            </div>


                            <!-- Petugas (readonly dari session) -->
                            <div class="col-md-12 mb-3">
                                <label for="petugas_nama" class="form-label">Nama Petugas</label>
                                <input type="text"
                                    id="petugas_nama"
                                    value="<?= esc(old('petugas_nama', $row['petugas_nama'] ?? '')) ?>"
                                    class="form-control form-soft"
                                    readonly aria-readonly="true">
                            </div>

                            <!-- GPS -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi GPS (Lat)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-location-crosshairs"></i></span>
                                    <input type="text" name="lokasi_gps_lat" id="gps_lat"
                                        value="<?= esc(old('lokasi_gps_lat', $row['lokasi_gps_lat'] ?? '')) ?>"
                                        class="form-control form-soft <?= $validation->hasError('lokasi_gps_lat') ? 'is-invalid' : '' ?>"
                                        placeholder="-6.2xxxxx">
                                </div>
                                <div class="invalid-feedback"><?= esc($validation->getError('lokasi_gps_lat')) ?></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi GPS (Lng)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                    <input type="text" name="lokasi_gps_lng" id="gps_lng"
                                        value="<?= esc(old('lokasi_gps_lng', $row['lokasi_gps_lng'] ?? '')) ?>"
                                        class="form-control form-soft <?= $validation->hasError('lokasi_gps_lng') ? 'is-invalid' : '' ?>"
                                        placeholder="106.8xxxxx">
                                </div>
                                <div class="invalid-feedback"><?= esc($validation->getError('lokasi_gps_lng')) ?></div>
                                <button type="button" id="btnGetGPS" class="btn btn-outline-secondary mt-2">
                                    <i class="fa-solid fa-compass"></i> Ambil Lokasi Saya
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="<?= site_url('admin/tanamanku') ?>" class="btn btn-outline-secondary rounded-pill py-2 mr-2"><i class="fa-solid fa-xmark"></i> Batal</a>
                            <button type="submit" class="btn btn-gradient rounded-pill py-2"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Preview gambar & Ambil GPS -->
<script>
    // Preview foto baru, tapi default tampilkan foto lama
    const fotoInput = document.getElementById('foto_tanaman');
    const preview = document.getElementById('previewImg');
    if (fotoInput) {
        fotoInput.addEventListener('change', (e) => {
            const file = e.target.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = evt => preview.src = evt.target.result;
            reader.readAsDataURL(file);
        });
    }

    // Ambil GPS
    const btnGPS = document.getElementById('btnGetGPS');
    if (btnGPS) {
        btnGPS.addEventListener('click', () => {
            if (!navigator.geolocation) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak didukung',
                    text: 'Browser kamu tidak mendukung geolocation.'
                });
                return;
            }
            navigator.geolocation.getCurrentPosition((pos) => {
                const {
                    latitude,
                    longitude
                } = pos.coords;
                document.getElementById('gps_lat').value = latitude.toFixed(6);
                document.getElementById('gps_lng').value = longitude.toFixed(6);
                Swal.fire({
                    icon: 'success',
                    title: 'Lokasi diambil',
                    text: `Lat: ${latitude.toFixed(6)}, Lng: ${longitude.toFixed(6)}`
                });
            }, (err) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal ambil lokasi',
                    text: err.message || 'Izin lokasi ditolak.'
                });
            }, {
                enableHighAccuracy: true,
                timeout: 10000
            });
        });
    }

    // Untuk edit: jangan auto-isi tanggal, cukup pakai data lama.
    // (Tetap jaga kalau kosong banget – mis. data legacy)
    document.addEventListener('DOMContentLoaded', () => {
        const el = document.getElementById('tanggal_pendataan');
        if (el && !el.value) {
            const d = new Date();
            const pad = n => String(n).padStart(2, '0');
            el.value = `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }
    });
</script>

<?= $this->endSection() ?>
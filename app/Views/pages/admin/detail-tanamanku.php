<?php

use CodeIgniter\I18n\Time;
?>
<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>
<?php
$status      = strtolower((string)($row['status'] ?? ''));
$statusClass = $status === 'active' ? 'success' : ($status === 'inactive' ? 'secondary' : 'light');
$statusLabel = $status === 'active' ? 'Active' : ($status === 'inactive' ? 'Inactive' : '-');
?>
<style>
    /* IMG SIDE BAR LOGO */
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

    /* ====== Accent Modern ====== */
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
        overflow: hidden;
        position: relative;
        background: #fff
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

    .badge-soft {
        background: rgba(78, 115, 223, .08);
        color: #4e73df;
        border: 1px solid rgba(78, 115, 223, .2);
        border-radius: 999px
    }

    /* ====== Detail area ====== */
    .plant-hero {
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 18px
    }

    .plant-hero .hero-img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
        cursor: pointer
    }

    .meta-list {
        display: grid;
        gap: 10px
    }

    .meta-item .label {
        font-size: .8rem;
        color: #6b7280
    }

    .meta-item .value {
        font-weight: 600;
        color: #111827
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: .4rem .75rem;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        font-weight: 600;
        color: #374151;
        font-size: .9rem
    }

    /* ====== Related (kanan) ====== */
    .plant-related {
        position: sticky;
        top: 1rem
    }

    .plant-related .related-list {
        max-height: 200px;
        overflow-y: auto;
        padding-right: 6px
    }

    .plant-related .related-list::-webkit-scrollbar {
        width: 8px
    }

    .plant-related .related-list::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #e5e7eb, #cbd5e1);
        border-radius: 8px
    }

    .related-item {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        background: #fff
    }

    .related-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(15, 23, 42, .10);
        border-color: #d1d5db
    }

    .related-info .name {
        font-weight: 700;
        color: #111827;
        line-height: 1.1
    }

    .related-info .latin {
        font-size: .9rem;
        color: #6b7280;
        font-style: italic
    }

    /* ====== Responsive ====== */
    @media (max-width: 991.98px) {
        .plant-hero {
            grid-template-columns: 1fr
        }
    }

    /* Modal image */
    .modal-img {
        width: 100%;
        border-radius: 12px;
        object-fit: cover
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
</style>

<div class="container-fluid">
    <!-- Heading + Breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><i class="fa-solid fa-seedling"></i> Detail Tanaman</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('admin/tanamanku') ?>">Tanamanku</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($row['nama_umum'] ?: 'Detail') ?></li>
            </ol>
        </nav>
    </div>

    <div class="row g-4 mb-4">
        <!-- KIRI: Detail Lengkap -->
        <div class="col-lg-6">
            <div class="card card-modern">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-leaf"></i> Detail</span>
                        <h6 class="m-0 fw-bold"><?= esc($row['nama_umum'] ?: 'Tanaman') ?></h6>
                    </div>
                    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body p-4">
                    <!-- Hero -->
                    <div class="plant-hero mb-4">
                        <img src="<?= base_url('assets/uploads/tanaman/' . esc($row['foto_tanaman'])) ?>" alt="Foto Tanaman" class="hero-img" data-toggle="modal" data-target="#imgModal">
                        <div class="d-grid gap-2">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="chip"><i class="fa-solid fa-cubes-stacked"></i> Jumlah: <?= esc($row['jumlah'] !== '' ? esc($row['jumlah']) : '-') ?></span>
                                <span class="chip mt-2">
                                    <i class="fa-solid fa-circle-info"></i> Status:
                                    <span class="badge badge-<?= $statusClass ?> ml-1"><?= esc($row['status']) ?></span>
                                </span>
                            </div>
                            <div class="mt-2">
                                <span class="label text-muted">Nama Latin</span>
                                <div class="h5 m-0 fst-italic"><?= esc($row['nama_latin']) ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Meta grid -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="meta-list">
                                <div class="meta-item">
                                    <div class="label">Asal Daerah</div>
                                    <div class="value"><?= esc($row['asal_daerah'] ?: '-') ?></div>
                                </div>
                                <div class="meta-item">
                                    <div class="label">Tanggal Pendataan</div>
                                    <div class="value"><i class="fa-solid fa-calendar-day"></i> <?= indo_date(esc($row['tanggal_pendataan'])) ?></div>
                                </div>
                                <div class="meta-item">
                                    <div class="label">Petugas</div>
                                    <div class="value"><i class="fa-solid fa-user-shield"></i> <?= esc($row['petugas_nama'] ?: '-') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="meta-list">
                                <div class="meta-item">
                                    <div class="label">Lokasi GPS</div>
                                    <div class="value">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span id="gpsText"><?= esc($row['lokasi_gps_lat']) ?>, <?= esc($row['lokasi_gps_lng']) ?></span>
                                        <div class="mt-2 d-flex gap-2">
                                            <a class="btn btn-sm btn-outline-primary rounded-pill mr-2"
                                                href="https://www.google.com/maps/search/?api=1&query=<?= urlencode(esc($row['lokasi_gps_lat']) . ',' . esc($row['lokasi_gps_lng'])) ?>"
                                                target="_blank" rel="noopener">
                                                <i class="fa-solid fa-map-location-dot"></i> Buka Maps
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" id="btnCopyGPS">
                                                <i class="fa-solid fa-copy"></i> Salin
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mb-3">
                        <h6 class="text-uppercase text-muted mb-2"><i class="fa-solid fa-hand-holding-heart"></i> Manfaat</h6>
                        <p class="mb-0"><?= nl2br(esc($row['manfaat']) ?: '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <h6 class="text-uppercase text-muted mb-2"><i class="fa-solid fa-note-sticky"></i> Keterangan</h6>
                        <p class="mb-0"><?= nl2br(esc($row['keterangan']) ?: '-') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN: Tanaman Lainnya (scroll jika >500px) -->
        <div class="col-lg-6">
            <div class="card card-modern plant-related">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-seedling"></i> List</span>
                        <h6 class="m-0 fw-bold">Tanaman Lainnya</h6>
                    </div>
                    <a href="<?= site_url('admin/tanamanku') ?>" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                        <i class="fa-solid fa-list"></i> Semua
                    </a>
                </div>

                <div class="card-body p-3">
                    <?php if (!empty($related)): ?>
                        <div class="related-list d-grid gap-2">
                            <?php foreach ($related as $t): ?>
                                <div class="related-item mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= base_url('assets/uploads/tanaman/' . esc($t['foto_tanaman'])) ?>" alt="foto" style="width:54px;height:54px;object-fit:cover;border-radius:10px;border:1px solid #e5e7eb; margin-right: 5px;">
                                        <div class="related-info">
                                            <div class="name"><?= esc($row['nama_umum'] ?: 'Tanaman') ?></div>
                                            <div class="latin"><?= esc($row['nama_latin'] ?: '-') ?></div>
                                        </div>
                                    </div>
                                    <a href="<?= site_url('tanamanku/detail/' . esc($row['id_tanamanku'])) ?>" class="btn btn-sm btn-gradient rounded-pill p-2">
                                        Lihat <i class="fa-solid fa-arrow-right-long ml-1"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="<?= base_url('assets/img/empty-state.svg') ?>" alt="empty" style="width:120px;height:auto;opacity:.85;">
                            <div class="mt-3 text-muted">Belum ada data tanaman lainnya.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gambar -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h6 class="modal-title" id="imgModalLabel"><?= esc($row['nama_umum'] ?: 'Foto Tanaman') ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/uploads/tanaman/' . esc($row['foto_tanaman'])) ?>" alt="Foto Tanaman" class="modal-img">
            </div>
        </div>
    </div>
</div>

<script>
    // Salin koordinat GPS ke clipboard
    (function() {
        const btn = document.getElementById('btnCopyGPS');
        const txt = document.getElementById('gpsText');
        if (!btn || !txt) return;
        btn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(txt.textContent.trim());
                if (window.Swal) Swal.fire({
                    icon: 'success',
                    title: 'Disalin',
                    text: 'Koordinat tersalin ke clipboard.'
                });
                else alert('Koordinat tersalin!');
            } catch (e) {
                if (window.Swal) Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Tidak dapat menyalin.'
                });
                else alert('Gagal menyalin.');
            }
        });
    })();
</script>

<?= $this->endSection() ?>
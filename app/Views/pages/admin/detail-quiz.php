<?php

use CodeIgniter\I18n\Time;

/** @var array $row */
/** @var array $quizzes */

$status      = strtolower((string)($row['status'] ?? ''));
$statusClass = $status === 'active' ? 'success' : ($status === 'inactive' ? 'secondary' : 'light');
$statusLabel = $status === 'active' ? 'Active' : ($status === 'inactive' ? 'Inactive' : '-');
?>
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
        transition: transform .18s, box-shadow .18s, filter .18s
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

    /* Hero */
    .cat-hero {
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 18px
    }

    .cat-hero .hero-img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
        cursor: pointer
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: .45rem .8rem;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        font-weight: 700;
        color: #374151;
        font-size: .9rem
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

    /* Related */
    .related {
        position: sticky;
        top: 1rem
    }

    .related .list {
        max-height: 420px;
        overflow: auto;
        padding-right: 6px
    }

    .related .item {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 12px;
        align-items: center;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #fff;
        transition: .15s
    }

    .related .item:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(15, 23, 42, .10);
        border-color: #d1d5db
    }

    .thumb-sm {
        width: 54px;
        height: 54px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb
    }

    @media (max-width: 991.98px) {
        .cat-hero {
            grid-template-columns: 1fr
        }
    }

    /* overflow */
    /* Munculkan scroll hanya jika konten melebihi 200px */
    .scroll-200 {
        max-height: 200px;
        overflow: auto;
        /* = overflow-auto */
        -webkit-overflow-scrolling: touch;
        /* smooth di iOS */
        overscroll-behavior: contain;
        /* biar scroll-nya ga narik parent */
        overflow-x: hidden;
        /* hindari scrollbar horizontal */
        word-wrap: break-word;
        /* teks panjang tetap patah */
    }

    /* ===========================
   Table Modern
   =========================== */
    .table-modern {
        --tbl-radius: 14px;
        --tbl-shadow: 0 10px 24px rgba(16, 24, 40, .06);
        --tbl-head-bg: #fff;
    }

    .table-modern .table {
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        overflow: hidden;
        /* untuk rounded di wrapper */
        box-shadow: var(--tbl-shadow);
    }

    .table-modern .table thead th {
        position: sticky;
        top: 0;
        background: var(--tbl-head-bg);
        z-index: 2;
        border-bottom: 2px solid var(--bs-border-color);
        font-weight: 700;
    }

    .table-modern .table tr:first-child th:first-child {
        border-top-left-radius: var(--tbl-radius);
    }

    .table-modern .table tr:first-child th:last-child {
        border-top-right-radius: var(--tbl-radius);
    }

    .table-modern .table tbody tr:last-child td:first-child {
        border-bottom-left-radius: var(--tbl-radius);
    }

    .table-modern .table tbody tr:last-child td:last-child {
        border-bottom-right-radius: var(--tbl-radius);
    }

    .table-modern .table tbody tr:hover {
        background: #f9fafb;
    }

    /* Responsive image cell */
    .thumb-wrap {
        width: 100%;
        max-width: 120px;
        /* sama dengan th width */
    }

    .thumb-quiz {
        width: 100%;
        height: 72px;
        border-radius: 10px;
        object-fit: cover;
        background: #f2f4f7;
        display: block;
    }

    /* Truncate helpers */
    .text-truncate-1 {
        display: block;
        max-width: 100%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* baris maksimum */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Table container rounded scroll (mobile) */
    .table-modern.table-responsive {
        border-radius: var(--tbl-radius);
        box-shadow: var(--tbl-shadow);
    }

    /* Small screens tuning */
    @media (max-width: 576px) {
        .thumb-quiz {
            height: 60px;
        }

        .table-modern .table td,
        .table-modern .table th {
            padding: .75rem;
        }
    }

    /* Wrapper: hanya area tabel yang scroll */
    .table-scroll-y {
        position: relative;
        max-height: 60vh;
        /* sesuaikan */
        overflow-y: auto;
        /* scroll vertikal */
        overflow-x: auto;
        /* scroll horizontal kalau kolom melebar */
        -webkit-overflow-scrolling: touch;
        background: #fff;
        border-radius: .5rem;
    }

    /* Rapiin table di dalam wrapper */
    .table-scroll-y table {
        margin-bottom: 0;
    }

    /* Header nempel di atas saat scroll */
    .table-scroll-y thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #fff;
        /* atau #f8f9fc biar ada kontras */
        box-shadow: 0 1px 0 rgba(0, 0, 0, .06);
    }

    /* (Opsional) Kolom pertama tetap terlihat saat geser horizontal */
    .table-scroll-y .sticky-col {
        position: sticky;
        left: 0;
        z-index: 3;
        background: #fff;
    }

    /* Mobile: paksa lebar minimum agar bisa di-scroll samping */
    @media (max-width: 767.98px) {
        .table-scroll-y table {
            min-width: 900px;
            /* sesuaikan kebutuhan kolom */
        }
    }

    /* Kalau kamu mau selalu fix 200px (bukan max), pakai ini: */
    /* .scroll-200--fixed { height: 200px; overflow: auto; } */
</style>

<div class="container-fluid">
    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><i class="fa-solid fa-layer-group"></i> Detail Kategori Soal</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('admin/quiz') ?>">Kategori Quiz</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($row['nama_kategori'] ?? 'Detail') ?></li>
            </ol>
        </nav>
    </div>

    <div class="row g-4 mb-4">
        <!-- Kiri: detail -->
        <div class="col-lg-6 mb-3">
            <div class="card card-modern">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-tags"></i> Detail</span>
                        <h6 class="m-0 fw-bold"><?= esc($row['kategori']) ?></h6>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= site_url('admin/quiz/update/' . esc($row['id_quiz'])) ?>" class="btn btn-sm btn-outline-primary rounded-pill mr-2"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Hero -->
                    <div class="cat-hero mb-4">
                        <img src="<?= base_url('assets/uploads/quiz/' . esc($row['thumbnail'])) ?>" alt="Thumbnail Kategori" class="hero-img" data-toggle="modal" data-target="#imgModal">
                        <div class="d-grid gap-2">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="chip mb-2"><i class="fa-solid fa-list-check"></i> Total Quiz: <?= esc($row['total_quiz'] ?? 0) ?></span>
                                <span class="chip mb-2"><i class="fa-solid fa-square-poll-vertical"></i> Total Soal: <?= esc($row['total_soal'] ?? 0) ?></span>
                                <span class="chip">
                                    <i class="fa-solid fa-circle-info"></i> Status:
                                    <span class="badge badge-<?= $statusClass ?> ml-1"><?= esc(ucfirst($statusLabel)) ?></span>
                                </span>
                            </div>

                            <!-- Slug -->
                            <div class="mt-2">
                                <span class="label text-muted">Slug</span>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="h5 m-0" id="slugText"><?= esc($row['slug'] ?? '-') ?></div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" id="btnCopySlug">
                                        <i class="fa-solid fa-copy"></i> Salin
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Meta -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="meta-list">
                                <div class="meta-item">
                                    <div class="label">Dibuat</div>
                                    <div class="value">
                                        <i class="fa-solid fa-calendar-plus"></i>
                                        <?php
                                        $c = $row['created_at'] ?? null;
                                        echo $c ? Time::parse($c)->toLocalizedString('d MMMM yyyy HH:mm') : '-';
                                        ?>
                                    </div>
                                </div>
                                <div class="meta-item">
                                    <div class="label">Diubah</div>
                                    <div class="value">
                                        <i class="fa-solid fa-calendar-check"></i>
                                        <?php
                                        $u = $row['updated_at'] ?? null;
                                        echo $u ? Time::parse($u)->toLocalizedString('d MMMM yyyy HH:mm') : '-';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="meta-list">
                                <div class="meta-item">
                                    <div class="label">Nama Kategori</div>
                                    <div class="value"><?= esc($row['kategori'] ?? '-') ?></div>
                                </div>
                                <div class="meta-item">
                                    <div class="label">Visibilitas</div>
                                    <div class="value"><?= esc(($row['status'] ?? '') === 'active' ? 'Tampil' : 'Tersembunyi') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mb-2">
                        <h6 class="text-uppercase text-muted mb-2"><i class="fa-solid fa-note-sticky"></i> Deskripsi</h6>
                        <p class="mb-0"><?= nl2br(esc($row['deskripsi'] ?? '-')) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Quiz dalam kategori -->
        <div class="col-lg-6">
            <div class="card card-modern related">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-list"></i> List</span>
                        <h6 class="m-0 fw-bold">Quiz di Kategori Ini</h6>
                    </div>
                    <a href="<?= site_url('admin/quiz') ?>" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                        <i class="fa-solid fa-list-ul"></i> Semua Quiz
                    </a>
                </div>

                <div class="card-body p-3">
                    <?php if (!empty($quizzes_all)): ?>
                        <div class="list d-grid gap-2">
                            <?php foreach ($quizzes_all as $q): ?>
                                <div class="item mb-3">
                                    <div class="d-flex align-items-center gap-3 scroll-200">
                                        <img src="<?= !empty($q['thumbnail'])
                                                        ? base_url('assets/uploads/quiz/' . esc($q['thumbnail']))
                                                        : base_url('assets/img/no_image.jpeg') ?>"
                                            alt="<?= esc($q['judul'] ?? 'thumbnail') ?>" class="thumb-sm mr-3">

                                        <div>
                                            <div class="fw-bold"><?= esc($q['judul']) ?></div>
                                            <div class="text-muted small">
                                                Durasi: <?= esc($q['durasi_menit']) ?> menit •
                                                Status:
                                                <?php if (($q['status'] ?? '') === 'active'): ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php elseif (($q['status'] ?? '') === 'inactive'): ?>
                                                    <span class="badge badge-secondary">Inactive</span>
                                                <?php else: ?>
                                                    <span class="badge badge-light">-</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('admin/quiz/update/' . esc($q['id_quiz'])) ?>" class="btn btn-sm btn-outline-primary rounded-pill mr-2">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="<?= site_url('admin/quiz/detail/' . esc($q['id_quiz'])) ?>" class="btn btn-sm btn-gradient rounded-pill">
                                            Detail <i class="fa-solid fa-arrow-right-long ml-1"></i>
                                        </a>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img class="rounded-circle" src="<?= base_url('assets/img/icons-empty.png') ?>" alt="empty" style="width:120px;height:auto;opacity:.85;">
                            <div class="mt-3 text-muted">Belum ada quiz pada kategori ini.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <!-- all soal -->
        <div class="col-lg-12 mt-3">
            <div class="card card-modern related">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-list"></i> List</span>
                        <h6 class="m-0 fw-bold">Soal Quiz di Kategori - <?= $row['kategori'] ?></h6>
                    </div>
                    <!-- <a href="<?= site_url('admin/quiz') ?>" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                        <i class="fa-solid fa-list-ul"></i> Semua Quiz
                    </a> -->
                </div>

                <div class="card-body p-3">
                    <?php if (!empty($pertanyaan)): ?>
                        <div class="list d-grid gap-2">
                            <?php $no = 1; ?>

                            <div class="table-modern table-responsive">
                                <div class="table-scroll-y p-3">
                                    <table class="table align-middle table-hover mb-0">
                                        <thead class="table-modern-head">
                                            <tr>
                                                <th class="sticky-col" style="width:56px">No</th>
                                                <th style="width:120px">Gambar</th>
                                                <th style="min-width:320px">Pertanyaan</th>
                                                <th style="min-width:160px">Jawaban</th>
                                                <th style="width:120px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pertanyaan as $q): ?>
                                                <?php
                                                $imgSrc = !empty($q['gambar'])
                                                    ? base_url('assets/uploads/quiz/' . esc($q['gambar']))
                                                    : base_url('assets/img/icons-empty.png');
                                                ?>
                                                <tr>
                                                    <td class="text-muted fw-semibold sticky-col"><?= $no++; ?>.</td>
                                                    <td>
                                                        <div class="thumb-wrap">
                                                            <img class="thumb-quiz img-fluid"
                                                                src="<?= $imgSrc ?>"
                                                                alt="<?= esc($q['gambar'] ?: 'No image') ?>"
                                                                loading="lazy">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-truncate-2 lh-sm"><?= esc($q['pertanyaan']) ?></div>
                                                    </td>
                                                    <td>
                                                        <span class="badge rounded-pill bg-light text-dark border text-truncate-1">
                                                            <?= esc($q['kunci_jawaban']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="<?= site_url('admin/quiz/' . esc($row['id_quiz']) . '/urutan/' . esc($q['urutan']) . '/edit') ?>"
                                                                class="btn btn-sm btn-outline-primary rounded-pill mr-2"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <a href="javascript:void(0)"
                                                                onclick="deleteByIdUrutan(<?= (int)$row['id_quiz'] ?>, <?= (int)$q['urutan'] ?>)"
                                                                class="btn btn-danger btn-sm rounded-pill"
                                                                data-toggle="tooltip" title="Hapus">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <!-- ilustrasi kosong -->
                            <img src="<?= base_url('assets/img/icons-empty.png') ?>"
                                alt="empty"
                                style="width:120px;height:auto;opacity:.9;">

                            <div class="mt-3 text-muted">
                                Belum ada soal pada kategori ini.
                            </div>

                            <!-- tombol tambah soal -->
                            <div class="mt-4">
                                <a href="<?= site_url('admin/quiz/soal/' . ((int) ($row['id_quiz'] ?? 0)) . '/tambah') ?>"
                                    class="btn btn-gradient px-4 py-2 rounded-pill">
                                    <i class="fas fa-plus-circle me-2"></i> Tambah Soal
                                </a>
                            </div>
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
                <h6 class="modal-title" id="imgModalLabel"><?= esc($row['nama_kategori'] ?? 'Thumbnail Kategori') ?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/uploads/quiz/' . esc($row['thumbnail'])) ?>" alt="Thumbnail" class="modal-img w-100" style="border-radius:12px;object-fit:cover">
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const btn = document.getElementById('btnCopySlug');
        const txt = document.getElementById('slugText');
        if (btn && txt) {
            btn.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(txt.textContent.trim());
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Disalin',
                            text: 'Slug tersalin.'
                        });
                    } else alert('Slug tersalin');
                } catch (e) {
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tidak dapat menyalin.'
                        });
                    } else alert('Gagal menyalin');
                }
            });
        }
    })();

    // tooltiip table
    document.addEventListener('DOMContentLoaded', () => {
        if (window.bootstrap && bootstrap.Tooltip) {
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
                .forEach(el => new bootstrap.Tooltip(el));
        }
    });
</script>

<?= $this->endSection() ?>
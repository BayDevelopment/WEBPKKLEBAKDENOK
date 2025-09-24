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

    /* ====== Modern look & feel ====== */
    .page-title {
        font-weight: 800;
        letter-spacing: .2px;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent
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

    .dashboard-modern {
        position: relative
    }

    .dashboard-modern::before {
        content: "";
        position: absolute;
        inset: -80px -40px 0 -40px;
        background:
            radial-gradient(600px 200px at 10% 0%, rgba(78, 115, 223, .08), transparent 60%),
            radial-gradient(560px 200px at 90% 0%, rgba(28, 200, 138, .08), transparent 60%);
        pointer-events: none;
        z-index: 0
    }

    .card-modern {
        border: 0 !important;
        border-radius: 18px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        transition: transform .2s ease, box-shadow .2s ease;
        overflow: hidden;
        position: relative;
        z-index: 1
    }

    .card-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, .12)
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

    .card-modern .card-header {
        background: #fff;
        border: 0;
        padding: 1rem 1.25rem
    }

    .card-modern .card-header h6 {
        font-weight: 800;
        letter-spacing: .3px;
        color: #1f2937
    }

    /* ====== Toolbar ====== */
    .table-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #eef2ff
    }

    .toolbar-left {
        display: flex;
        gap: .5rem;
        align-items: center
    }

    .toolbar-right {
        display: flex;
        gap: .5rem;
        align-items: center
    }

    .input-soft {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        padding: .45rem .9rem;
        min-width: 220px
    }

    .input-soft:focus {
        outline: none;
        border-color: #c7d2fe;
        box-shadow: 0 0 0 .15rem rgba(78, 115, 223, .15)
    }

    .btn-ghost {
        border-radius: 999px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
        padding: .45rem .9rem
    }

    .btn-ghost:hover {
        background: #f9fafb
    }

    /* ====== Table modern ====== */
    .cover-table {
        padding: 0 1rem 1rem
    }

    .table-modern {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%
    }

    .table-modern thead th {
        position: sticky;
        top: 0;
        z-index: 1;
        background: #fff;
        border-bottom: 1px solid #eef2ff;
        font-size: .75rem;
        letter-spacing: .5px;
        text-transform: uppercase;
        color: #6b7280
    }

    .table-modern tbody td,
    .table-modern tbody th {
        vertical-align: middle
    }

    .table-modern tbody tr {
        transition: background .15s ease
    }

    .table-modern tbody tr:hover {
        background: #f9fafb
    }

    .table-responsive-modern {
        overflow: auto;
        border-radius: 14px;
        border: 1px solid #eef2ff
    }

    /* Avatar foto */
    .table-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 6px 14px rgba(15, 23, 42, .08)
    }

    /* Status badge */
    .badge-soft {
        border-radius: 999px;
        padding: .35rem .7rem;
        font-weight: 700;
        font-size: .75rem
    }

    .badge-soft.active {
        background: rgba(28, 200, 138, .12);
        color: #1cc88a;
        border: 1px solid rgba(28, 200, 138, .25)
    }

    .badge-soft.inactive {
        background: rgba(231, 74, 59, .12);
        color: #e74a3b;
        border: 1px solid rgba(231, 74, 59, .25)
    }

    /* Action buttons */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #4b5563
    }

    .btn-action:hover {
        background: #f3f4f6
    }

    /* Progress & charts */
    .progress-modern {
        height: 8px;
        background: #eef2ff;
        border-radius: 9999px;
        overflow: hidden
    }

    .progress-modern .progress-bar {
        background: linear-gradient(90deg, #4e73df, #36b9cc)
    }

    /* Biarkan DataTables yang handle horizontal scroll */
    .table-responsive-modern {
        overflow: visible;
    }

    /* Supaya kolom tidak membungkus saat scrollX */
    table.dataTable tbody td {
        white-space: nowrap;
    }

    /* Tombol Buttons selaras dengan tema */
    .dt-container .dt-buttons .dt-button {
        border-radius: 999px;
        padding: .45rem .9rem;
    }

    .dt-container .dt-buttons .buttons-excel {
        background: linear-gradient(135deg, #22c55e, #16a34a) !important;
        color: #fff !important;
        border: 0 !important;
        box-shadow: 0 8px 18px rgba(22, 163, 74, .25);
    }

    .dt-container .dt-buttons .buttons-colvis {
        background: #fff !important;
        color: #374151 !important;
        border: 1px solid #e5e7eb !important;
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

    /* Avatar/gambar di dalam tabel */
    .avatar-figure {
        inline-size: clamp(44px, 6vw, 64px);
        /* responsif: 44–64px */
        aspect-ratio: 1 / 1;
        margin: 0;
        padding: 0;
        border-radius: 12px;
        overflow: hidden;
        background: #f3f4f6;
        /* fallback bg */
        box-shadow: 0 4px 14px rgba(0, 0, 0, .08);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .avatar-figure:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
    }

    .avatar-figure>img.table-avatar {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        /* crop rapi */
    }

    /* Tabel responsif aman overflow */
    .table-responsive-modern {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Empty state */
    .cover-empty-data {
        position: relative;
        display: grid;
        place-items: center;
        text-align: center;
        gap: 14px;
        min-height: 44vh;
        padding: 28px 20px;
        border-radius: 16px;
        background:
            radial-gradient(1200px 400px at 50% 0%, rgba(99, 102, 241, .07), transparent 60%),
            linear-gradient(180deg, #fff 0%, #fafafa 100%);
    }

    /* Frame ilustrasi supaya responsif */
    .empty-illustration {
        width: min(560px, 86vw);
        display: grid;
        place-items: center;
        aspect-ratio: 16/10;
    }

    /* Gambar */
    .img-empty-data {
        width: 50%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    /* Trik “remove background” untuk gambar berlatar putih */
    .rmbg-white .img-empty-data {
        mix-blend-mode: multiply;
        /* putih jadi menyatu dg background */
        isolation: isolate;
        /* biar efek blend gak bocor ke luar container */
    }

    /* Teks */
    .text-img-empty {
        margin: 0;
        font-weight: 700;
        letter-spacing: .2px;
        color: #334155;
    }

    /* Optional: tombol aksi biar UX enak */
    .btn-empty {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 12px;
        border: 1px solid rgba(2, 6, 23, .06);
        background: #0ea5e9;
        color: #fff;
        box-shadow: 0 6px 18px rgba(14, 165, 233, .25);
        text-decoration: none;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .btn-empty:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 26px rgba(14, 165, 233, .28);
    }

    /* Sedikit rapikan badge status */
    .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef7ff;
        color: #0b5ed7;
        border: 1px solid rgba(13, 110, 253, .15);
    }

    .badge-soft.active {
        background: #e9f9ef;
        color: #198754;
        border-color: rgba(25, 135, 84, .18);
    }

    .badge-soft.nonaktif {
        background: #fff2f2;
        color: #dc3545;
        border-color: rgba(220, 53, 69, .18);
    }

    /* Ikon aksi biar enak dilihat */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, .06);
        background: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, .1);
        background: #f8f9fa;
    }

    .mr-1 {
        margin-right: .5rem;
    }

    .text-img-empty {
        font-size: 19px;
        font-weight: 500;
        justify-content: center;
        text-align: center;
    }

    .badge-soft {
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid rgba(0, 0, 0, .08);
    }

    .badge-soft.active {
        background: #e9f9ef;
        color: #198754;
        border-color: rgba(25, 135, 84, .18);
    }

    .badge-soft.inactive {
        background: #fff2f2;
        color: #dc3545;
        border-color: rgba(220, 53, 69, .18);
    }

    .badge-soft.neutral {
        background: #f1f5f9;
        color: #334155;
        border-color: rgba(15, 23, 42, .08);
    }

    .thumb {
        width: 100px;
    }
</style>

<div class="container-fluid dashboard-modern">

    <!-- Heading + Breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title mb-3"><i class="fa-solid fa-file-lines"></i> <?= esc($sub_judul ?? 'Data Pendaftaran') ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($sub_judul ?? 'Data Pendaftaran') ?></li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <!-- Tabel Data Pendafatarn -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 card-modern">

                <!-- Toolbar -->
                <div class="table-toolbar">
                    <div class="ms-auto d-flex align-items-center gap-2">
                        <a href="<?= base_url('admin/rekrutmen/create') ?>" class="btn btn-gradient rounded-pill py-2"><i class="fa-solid fa-file-circle-plus mr-1"></i> Rekrutmen</a>
                    </div>
                </div>

                <?php if (!empty($d_rekrut)) : ?>
                    <style>
                        /* ===== Modern Table for #tblRekrut ===== */
                        #tblRekrut.table-modern {
                            --tbl-radius: 12px;
                            --tbl-border: #e5e7eb;
                            --tbl-head1: #f8fafc;
                            --tbl-head2: #f1f5f9;
                            --tbl-text: #334155;
                            width: 100%;
                            border: 1px solid var(--tbl-border);
                            border-radius: var(--tbl-radius);
                            overflow: hidden;
                            /* rounding terlihat */
                            table-layout: fixed;
                            /* kolom konsisten */
                        }

                        /* Header */
                        #tblRekrut.table-modern thead th {
                            background: linear-gradient(180deg, var(--tbl-head1), var(--tbl-head2));
                            color: var(--tbl-text);
                            font-weight: 600;
                            letter-spacing: .02em;
                            vertical-align: middle;
                            padding: .75rem .9rem;
                            border-color: var(--tbl-border);
                            white-space: nowrap;
                        }

                        /* Sel */
                        #tblRekrut.table-modern th,
                        #tblRekrut.table-modern td {
                            vertical-align: middle !important;
                            padding: .7rem .9rem;
                            border-color: var(--tbl-border);
                            overflow: hidden;
                            /* untuk ellipsis */
                            text-overflow: ellipsis;
                            /* … */
                            white-space: nowrap;
                            /* satu baris */
                            color: #0f172a;
                        }

                        /* Lebar kolom khusus sesuai header */
                        #tblRekrut.table-modern thead th:first-child,
                        #tblRekrut.table-modern tbody th:first-child {
                            width: 56px;
                            text-align: center;
                            color: #64748b;
                        }

                        #tblRekrut.table-modern thead th:last-child,
                        #tblRekrut.table-modern tbody td:last-child {
                            width: 120px;
                            text-align: center;
                        }

                        /* Hover row */
                        #tblRekrut.table-modern tbody tr:hover {
                            background-color: #f9fafb;
                        }

                        /* Aksi: ikon tombol lebih rapi */
                        #tblRekrut .btn-action {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 34px;
                            height: 34px;
                            border-radius: 8px;
                            border: 1px solid #e5e7eb;
                            background: #fff;
                            color: #334155;
                            transition: transform .08s ease, box-shadow .12s ease, border-color .12s ease;
                        }

                        #tblRekrut .btn-action:hover {
                            transform: translateY(-1px);
                            box-shadow: 0 4px 12px rgba(2, 6, 23, .06);
                            border-color: #cbd5e1;
                        }

                        /* Opsional: header sticky saat tabel tinggi & di-scroll */
                        .table-wrap-sticky {
                            max-height: 480px;
                            overflow: auto;
                        }

                        .table-wrap-sticky thead th {
                            position: sticky;
                            top: 0;
                            z-index: 2;
                        }
                    </style>

                    <div class="cover-table">
                        <div class="table-responsive-modern p-3">
                            <table id="tblRekrut" class="table table-striped table-bordered nowrap table-modern" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:56px">No</th>
                                        <th class="no-export">Nama Lengkap</th>
                                        <th>Nik</th>
                                        <th>Alamat</th>
                                        <th>No Hp</th>
                                        <th class="no-export" style="width:120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($d_rekrut as $d_p): ?>
                                        <tr>
                                            <th class="nowrap"><?= $no++ ?>.</th>
                                            <td><?= esc($d_p['nama_lengkap']) ?></td>
                                            <td><?= esc($d_p['nik']) ?></td>
                                            <td><?= esc($d_p['no_hp']) ?></td>
                                            <td><?= esc($d_p['alamat']) ?></td>
                                            <td class="no-export">
                                                <div class="d-inline-flex">
                                                    <a href="<?= base_url('admin/rekrutmen/detail/' . (int)(esc($d_p['id_pendaftaran']) ?? 0)) ?>" class="btn-action mr-1" title="Detail"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= base_url('admin/rekrutmen/update/' . (int)(esc($d_p['id_pendaftaran']) ?? 0)) ?>" class="btn-action mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <button type="button"
                                                        onclick="confirmDeleteRekrutmenById(<?= esc($d_p['id_pendaftaran'] ?? 0, 'js') ?>)"
                                                        class="btn-action"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="cover-empty-data">
                        <div class="empty-illustration rmbg-white">
                            <img src="<?= base_url('assets/img/icons-empty.png') ?>" alt="Tidak ada data saat ini" class="img-empty-data" loading="lazy" decoding="async">
                        </div>
                        <h6 class="text-img-empty">Belum ada data rekrutmen saat ini</h6>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <!-- Ringkasan / List Pokja (panel kanan) -->
        <style>
            /* clamp 3 baris untuk deskripsi */
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* efek hover ringan */
            .pokja-card {
                transition: transform .12s ease, box-shadow .12s ease;
            }

            .pokja-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .08);
            }

            /* fallback util warna badge */
            .bg-primary-subtle {
                background: rgba(13, 110, 253, .1) !important;
            }

            .bg-success-subtle {
                background: rgba(25, 135, 84, .1) !important;
            }

            .bg-secondary-subtle {
                background: rgba(108, 117, 125, .12) !important;
            }

            .border-primary-subtle {
                border-color: rgba(13, 110, 253, .25) !important;
            }

            .border-success-subtle {
                border-color: rgba(25, 135, 84, .25) !important;
            }

            .border-secondary-subtle {
                border-color: rgba(108, 117, 125, .25) !important;
            }

            /* tinggi tetap 300px, hanya scroll vertikal */
            .pokja-scroll {
                height: 300px;
                overflow-y: auto;
                /* atas-bawah */
                overflow-x: hidden;
                /* hilangkan scroll kanan-kiri */
                overscroll-behavior: contain;
                -webkit-overflow-scrolling: touch;
            }

            /* optional: cegah row bootstrap bikin overflow karena margin negatif */
            .pokja-scroll .row {
                margin-right: 0;
                margin-left: 0;
            }
        </style>

        <div class="col-xl-4 col-lg-5 mt-sm-3">
            <div class="card card-modern related">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 me-2"><i class="fa-solid fa-list"></i> List</span>
                        <h6 class="m-0 fw-bold">Data Pokja</h6>
                    </div>
                </div>
                <div class="container">
                    <a href="<?= site_url('admin/rekrutmen/pokja/create') ?>" class="btn btn-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-plus-circle me-2"></i> Tambah
                    </a>
                </div>

                <div class="card-body p-3">
                    <?php if (!empty($d_pokja)): ?>
                        <div class="pokja-scroll">
                            <div class="row row-cols-1 g-3 mx-0">
                                <?php foreach ($d_pokja as $dp): ?>
                                    <div class="col mb-3">
                                        <article class="card pokja-card h-100 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                                        <?= esc($dp['kode']) ?>
                                                    </span>
                                                    <?php $isAktif = (int)($dp['aktif'] ?? 0) === 1; ?>
                                                    <span class="badge <?= $isAktif ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle' ?>">
                                                        <?= $isAktif ? 'Aktif' : 'Nonaktif' ?>
                                                    </span>
                                                </div>

                                                <h6 class="fw-bold mb-1"><?= esc($dp['kode']) ?></h6>
                                                <?php if (!empty($dp['nama'])): ?>
                                                    <div class="text-muted mb-2 small"><?= esc($dp['nama']) ?></div>
                                                <?php endif; ?>
                                                <p class="text-muted mb-0 line-clamp-3">
                                                    <?= esc($dp['deskripsi'] ?: '—') ?>
                                                </p>
                                            </div>

                                            <div class="card-footer bg-transparent border-0 pt-0">
                                                <div class="d-flex gap-2">
                                                    <a href="<?= site_url('admin/rekrutmen/pokja/update/' . (int)$dp['id_pkkpokja']) ?>"
                                                        class="btn btn-sm btn-outline-primary rounded-pill me-2 mr-2">
                                                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger rounded-pill"
                                                        onclick="confirmDeletePokja(<?= (int)$dp['id_pkkpokja'] ?>)">
                                                        <i class="fa fa-trash me-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="<?= base_url('assets/img/icons-empty.png') ?>" alt="empty" style="width:120px;height:auto;opacity:.9;">
                            <div class="mt-3 text-muted">Belum ada data Pokja saat ini.</div>
                            <div class="mt-4">
                                <a href="<?= site_url('admin/rekrutmen/pokja/create') ?>" class="btn btn-gradient px-4 py-2 rounded-pill">
                                    <i class="fas fa-plus-circle me-2"></i> Tambah
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- DataTables & ChartJS init -->
<script>
    // table pokja
    document.addEventListener('DOMContentLoaded', function() {
        const dt = $('#tblPokja').DataTable({
            // layout: length (l), search (f), table (t), info (i), pagination (p)
            dom: "<'row align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            // length menu + default page length
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],
            pageLength: 10,

            // biar kolom No & Aksi gak bisa sort/search
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false
                }, // No
                {
                    targets: -1,
                    orderable: false,
                    searchable: false
                }, // Aksi
            ],

            // kalau mau: aktifin horizontal scroll karena kolom lebar
            scrollX: true,
            autoWidth: false,

            // jangan pre-sort
            order: []
        });

        // Opsional: auto-reindex kolom "No." saat sort/search
        dt.on('order.dt search.dt', function() {
            let i = 1;
            dt.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell) {
                cell.innerHTML = (i++) + '.';
            });
        }).draw();
    });

    // table rekrut
    document.addEventListener('DOMContentLoaded', function() {
        const dt = $('#tblRekrut').DataTable({
            // layout: length (l), search (f), table (t), info (i), pagination (p)
            dom: "<'row align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            // length menu + default page length
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'Semua']
            ],
            pageLength: 10,

            // kolom No & Aksi: non-sort/non-search
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'text-muted'
                }, // No
                {
                    targets: -1,
                    orderable: false,
                    searchable: false
                } // Aksi
            ],

            scrollX: true,
            autoWidth: false,

            // jangan pre-sort
            order: []
        });

        // Auto-reindex kolom "No." saat sort/search
        dt.on('order.dt search.dt', function() {
            dt.column(0, {
                    search: 'applied',
                    order: 'applied'
                })
                .nodes()
                .each((cell, i) => {
                    cell.innerHTML = (i + 1) + '.';
                });
        }).draw();
    });

    // delete pokja by id
    function confirmDeletePokja(id) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Pokja ini?',
                text: 'Tindakan tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d'
            }).then(res => {
                if (res.isConfirmed) {
                    window.location.href = '<?= site_url('admin/rekrutmen/pokja/delete/') ?>' + id;
                }
            });
        } else {
            if (confirm('Hapus Pokja ini?')) {
                window.location.href = '<?= site_url('admin/rekrutmen/pokja/delete/') ?>' + id;
            }
        }
    }
    // delete rekrutmen by id
    function confirmDeleteRekrutmenById(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('admin/rekrutmen/delete') ?>/" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>
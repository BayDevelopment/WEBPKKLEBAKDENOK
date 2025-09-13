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
</style>

<div class="container-fluid dashboard-modern">

    <!-- Heading + Breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><span><i class="fa-solid fa-seedling"></i></span> <?= esc($sub_judul) ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><span><i class="fa-solid fa-house"></i></span> Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($sub_judul) ?></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Tabel Data -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 card-modern">

                <!-- Toolbar -->
                <div class="table-toolbar">
                    <div class="toolbar-left">
                        <form method="get" action="<?= site_url('admin/tanamanku') ?>" class="toolbar-left">
                            <input class="input-soft" type="text" name="q" placeholder="Cari Tanaman…"
                                value="<?= esc($filters['q'] ?? '') ?>">

                            <select name="status" class="input-soft">
                                <option value="">Semua Status</option>
                                <option value="active" <?= (isset($filters['status']) && $filters['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= (isset($filters['status']) && $filters['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                            </select>

                            <button class="btn btn-ghost" type="submit">
                                <i class="fas fa-filter mr-1"></i>Filter
                            </button>
                        </form>
                    </div>
                    <div class="toolbar-right">
                        <a href="<?= base_url('admin/tanamanku/create') ?>" class="btn btn-gradient rounded-pill py-2">
                            <i class="fa-solid fa-file-circle-plus mr-1"></i> Tambah
                        </a>
                    </div>
                </div>

                <?php if (!empty($d_tanaman)): ?>
                    <div class="cover-table">
                        <div class="table-responsive-modern p-3">
                            <table id="tblTanamanku" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:56px">No</th>
                                        <th class="no-export">Foto</th>
                                        <th>Nama</th>
                                        <th>Latin</th>
                                        <th>Tanggal Pendataan</th>
                                        <th class="text-center" style="width:100px">Jumlah</th>
                                        <th style="width:120px">Status</th>
                                        <th class="no-export" style="width:110px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- contoh row -->
                                    <?php $no = 1;
                                    foreach ($d_tanaman as $dt): ?>
                                        <tr>
                                            <th><?= esc($no++) ?>.</th>
                                            <td>
                                                <figure class="avatar-figure">
                                                    <img
                                                        src="<?= base_url('assets/uploads/tanaman/' . esc($dt['foto_tanaman'])) ?>"
                                                        alt="Foto Tanaman: Mangga"
                                                        class="table-avatar"
                                                        loading="lazy"
                                                        decoding="async">
                                                </figure>
                                            </td>
                                            <td><?= esc($dt['nama_umum']) ?></td>
                                            <td><em><?= esc($dt['nama_latin']) ?></em></td>
                                            <td><?= indo_date(esc($dt['tanggal_pendataan'])) ?></td>
                                            <td class="text-center"><?= esc($dt['jumlah']) ?></td>
                                            <td>
                                                <?php $isActive = in_array(strtolower(trim($dt['status'] ?? '')), ['active']); ?>
                                                <span class="badge-soft <?= $isActive ? 'active' : 'inactive' ?>"><?= esc($dt['status'] ?? '') ?></span>
                                            </td>

                                            <td class="no-export">
                                                <div class="d-inline-flex">
                                                    <a href="<?= base_url('admin/tanamanku/detail/' . esc($dt['id_tanamanku'])) ?>" class="btn-action mr-1" title="Detail"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= base_url('admin/tanamanku/edit/' . esc($dt['id_tanamanku'])) ?>" class="btn-action mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a onclick="confirmDeleteAbout(<?= esc($dt['id_tanamanku']) ?>)" class="btn-action" title="Hapus"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- /contoh row -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="cover-empty-data">
                        <div class="empty-illustration rmbg-white">
                            <img
                                src="<?= base_url('assets/img/img-empty.png') ?>"
                                alt="Tidak ada data saat ini"
                                class="img-empty-data"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <h6 class="text-img-empty">Tidak ada data saat ini!</h6>

                        <!-- Opsional: ajakan aksi -->
                        <!-- <a href="<?= site_url('admin/tanamanku/tambah') ?>" class="btn-empty">
    <i class="fas fa-plus"></i> Tambah Data
  </a> -->
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="chart-card">
                <h6 class="mb-2 page-title">Top 10 Tanaman berdasarkan Jumlah</h6>
                <div class="chart-wrap">
                    <canvas id="pillChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div> <!-- /container-fluid -->

<?= $this->endSection() ?>
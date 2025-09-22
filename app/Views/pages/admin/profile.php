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

    /* clock */
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

    /* ====== Minimal Modern Look (dipakai di halaman ini saja) ====== */
    .page-title {
        font-weight: 800;
        letter-spacing: .2px;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    .card-modern {
        border: 0 !important;
        border-radius: 18px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        background: #fff;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .card-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, .12);
    }

    .card-modern .card-header {
        background: #fff;
        border: 0;
        padding: 1rem 1.25rem;
    }

    .card-modern .card-header h6 {
        margin: 0;
        font-weight: 800;
        letter-spacing: .3px;
        color: #1f2937;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff !important;
        border: none;
        box-shadow: 0 8px 18px rgba(78, 115, 223, .25);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(78, 115, 223, .35);
        filter: saturate(1.05);
    }

    .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 6px;
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

    .profile-avatar {
        width: 112px;
        height: 112px;
        border-radius: 18px;
        object-fit: cover;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .12);
    }

    .list-clean {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .kv {
        display: flex;
        gap: .5rem;
        align-items: flex-start;
        padding: .4rem 0;
    }

    .kv .k {
        min-width: 120px;
        color: #6b7280;
    }

    .kv .v {
        color: #111827;
        font-weight: 600;
    }

    @media (max-width: 575.98px) {
        .profile-avatar {
            width: 92px;
            height: 92px;
        }

        .kv .k {
            min-width: 96px;
        }
    }

    .section-gap {
        margin-bottom: 1rem;
    }

    .hr-soft {
        border: 0;
        border-top: 1px solid #eef2ff;
        margin: 1rem 0;
    }

    .small-muted {
        color: #6b7280;
        font-size: .875rem;
    }
</style>

<div class="container-fluid">
    <div class="row align-items-center section-gap">
        <div class="col">
            <h1 class="h3 page-title">My Profile</h1>
            <div class="small-muted">Kelola informasi akun dan detail profil Anda.</div>
        </div>
    </div>

    <div class="row">
        <!-- Kiri: ringkasan user -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card card-modern h-100">
                <div class="card-body text-center">
                    <?php
                    $avatar = !empty($d_admin['img_admin'])
                        ? base_url('assets/uploads/avatars/' . $d_admin['img_admin'])
                        : base_url('assets/img/default-avatar.png');
                    ?>
                    <img src="<?= esc($avatar) ?>" alt="Avatar" class="profile-avatar mb-3">
                    <h5 class="mb-1"><?= esc($d_admin['fullname'] ?? $d_admin['name'] ?? 'Administrator') ?></h5>
                    <div class="small-muted mb-2"><?= esc($d_admin['email'] ?? '-') ?></div>
                    <?php
                    $status = strtolower($d_admin['status_account'] ?? 'inactive');
                    $badgeClass = $status === 'active' ? 'active' : 'inactive';
                    ?>
                    <span class="badge-soft <?= $badgeClass ?> text-uppercase" style="font-size:.75rem;">
                        <?= esc($status) ?>
                    </span>

                    <hr class="hr-soft">
                    <ul class="list-clean text-left">
                        <li class="kv"><span class="k">Role</span><span class="v"><?= esc($d_admin['role'] ?? 'Admin') ?></span></li>
                        <li class="kv"><span class="k">Username</span><span class="v"><?= esc($d_admin['username'] ?? '-') ?></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kanan: detail akun -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card card-modern mb-4">
                <div class="card-header">
                    <h6>Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-clean">
                                <li class="kv"><span class="k">Email</span><span class="v"><?= esc($d_admin['email'] ?? '-') ?></span></li>
                                <li class="kv"><span class="k">Username</span><span class="v"><?= esc($d_admin['username'] ?? '-') ?></span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-clean">
                                <li class="kv"><span class="k">Dibuat pada</span><span class="v">
                                        <?php
                                        $created = $d_admin['created_at'] ?? null;
                                        echo $created ? esc(date('d M Y, H:i', strtotime($created))) : '-';
                                        ?>
                                    </span></li>
                                <li class="kv"><span class="k">Status</span>
                                    <span class="v">
                                        <span class="badge-soft <?= $badgeClass ?> text-uppercase" style="font-size:.7rem;">
                                            <?= esc($status) ?>
                                        </span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="hr-soft">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= site_url('admin/profile/edit') ?>" class="btn btn-gradient rounded-pill py-2 mr-2">
                            <i class="fas fa-pen mr-1"></i> Ubah data
                        </a>
                        <a href="<?= site_url('admin/profile/ganti-password') ?>" class="btn btn-light border rounded-pill py-2">
                            <i class="fas fa-key mr-1"></i> Ganti Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
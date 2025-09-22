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
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    .card-modern {
        border: 0 !important;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        background: #fff;
    }

    .card-modern .card-header {
        background: #fff;
        border: 0;
        padding: 1rem 1.25rem
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff !important;
        border: none;
        box-shadow: 0 8px 18px rgba(78, 115, 223, .25)
    }

    .form-label {
        font-weight: 600;
        color: #374151
    }

    .is-invalid {
        border-color: #dc3545
    }

    .invalid-feedback {
        display: block
    }

    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 18px;
        object-fit: cover;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .12)
    }

    .hr-soft {
        border: 0;
        border-top: 1px solid #eef2ff;
        margin: 1rem 0
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
</style>

<div class="container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col">
            <h1 class="h3 page-title">Ubah Data Profile</h1>
            <div class="text-muted">Perbarui informasi akun Anda.</div>
        </div>
        <div class="col-auto">
            <a href="<?= site_url('admin/profile') ?>" class="btn btn-light border rounded-pill">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card card-modern">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-gray-800">Form Profile</h6>
        </div>

        <div class="card-body">
            <?php
            $avatarPath = !empty($d_admin['img_admin'])
                ? base_url('assets/uploads/avatars/' . $d_admin['img_admin'])
                : base_url('assets/img/no_image.jpeg');
            ?>

            <?= form_open_multipart(site_url('admin/profile/edit')) ?>
            <?= csrf_field() ?>

            <div class="row">
                <!-- Foto Profil -->
                <div class="col-md-4 mb-4">
                    <label class="form-label">Foto Profil</label>
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= esc($avatarPath) ?>" id="previewAvatar" alt="Avatar"
                            style="width:120px;height:120px;object-fit:cover;border-radius:14px" class="mr-3">
                        <div>
                            <input
                                type="file"
                                name="img_admin"
                                accept="image/*"
                                id="avatarInput"
                                class="form-control-file <?= session('errors.img_admin') ? 'is-invalid' : '' ?>">
                            <small class="text-muted d-block mt-1">Format: JPG/PNG • Maks 2MB (Opsional)</small>

                            <?php if ($msg = validation_show_error('img_admin')): ?>
                                <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="col-md-8">
                    <div class="form-row">
                        <!-- Username -->
                        <div class="form-group col-md-6">
                            <label class="form-label">Username</label>
                            <input
                                type="text"
                                name="username"
                                value="<?= old('username', $d_admin['username'] ?? '') ?>"
                                placeholder="Masukkan Username"
                                class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>">

                            <?php if ($msg = validation_show_error('username')): ?>
                                <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="form-group col-md-6">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="<?= old('email', $d_admin['email'] ?? '') ?>"
                                placeholder="example@gmail.com"
                                class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>">

                            <?php if ($msg = validation_show_error('email')): ?>
                                <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Jenis Kelamin -->
                        <div class="form-group col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <?php $jk = old('jenis_kelamin', $d_admin['jenis_kelamin'] ?? ''); ?>
                            <select
                                name="jenis_kelamin"
                                class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>">
                                <option value="" disabled <?= $jk === '' ? 'selected' : '' ?>>-- Pilih --</option>
                                <option value="L" <?= $jk === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= $jk === 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>

                            <?php if ($msg = validation_show_error('jenis_kelamin')): ?>
                                <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Status Account -->
                        <div class="form-group col-md-6">
                            <label class="form-label">Status Account</label>
                            <?php $st = old('status_account', $d_admin['status_account'] ?? ''); ?>
                            <select
                                name="status_account"
                                class="form-control <?= session('errors.status_account') ? 'is-invalid' : '' ?>">
                                <option value="" disabled <?= $st === '' ? 'selected' : '' ?>>-- Pilih --</option>
                                <option value="active" <?= $st === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= $st === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>

                            <?php if ($msg = validation_show_error('status_account')): ?>
                                <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="hr-soft">
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-gradient rounded-pill py-2 mr-2">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                </button>
                <a href="<?= site_url('admin/profile') ?>" class="btn btn-light border rounded-pill py-2">Batal</a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('avatarInput')?.addEventListener('change', function(e) {
        const f = e.target.files?.[0];
        if (!f) return;
        const rd = new FileReader();
        rd.onload = ev => (document.getElementById('previewAvatar').src = ev.target.result);
        rd.readAsDataURL(f);
    });
</script>

<?= $this->endSection() ?>
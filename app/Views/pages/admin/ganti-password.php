<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>

<?php helper('form'); ?>

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
        margin-bottom: 1rem;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent
    }

    .card-modern {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08)
    }

    .card-modern .card-header {
        background: #fff;
        border: 0;
        padding: 1rem 1.25rem
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff;
        border: 0
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

    .hr-soft {
        border: 0;
        border-top: 1px solid #eef2ff;
        margin: 1rem 0
    }

    .input-group .toggle-eye {
        border: 1px solid #e5e7eb;
        background: #fff
    }

    .pw-hint {
        font-size: .85rem;
        color: #6b7280
    }

    .progress {
        height: 8px;
        border-radius: 999px;
        background: #eef2ff
    }

    .progress-bar {
        transition: width .2s ease
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

    .badge-soft {
        background: rgba(78, 115, 223, .08);
        color: #4e73df;
        border: 1px solid rgba(78, 115, 223, .2);
        border-radius: 999px
    }
</style>

<div class="container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col">
            <h1 class="h3 page-title">Ganti Password</h1>
            <div class="text-muted">Amankan akun Anda dengan kata sandi yang kuat.</div>
        </div>
        <div class="col-auto">
            <a href="<?= site_url('admin/profile') ?>" class="btn btn-light border rounded-pill">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card card-modern">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <span class="badge badge-soft px-3 py-2 mr-2"><i class="fas fa-key"></i>Form</span>
                <h6 class="m-0 fw-bold">Ganti password</h6>
            </div>
        </div>

        <div class="card-body">
            <?= form_open(site_url('admin/profile/ganti-password')) ?>
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-lg-7">
                    <!-- Password sekarang -->
                    <div class="form-group">
                        <label class="form-label">Password Saat Ini</label>
                        <div class="input-group">
                            <div class="input-group">
                                <input id="curPwd" type="password" name="current_password" class="form-control" autocomplete="current-password" placeholder="Masukan Password Saat ini">
                                <div class="input-group-append">
                                    <button class="btn toggle-eye" type="button" data-target="#curPwd">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php if ($msg = validation_show_error('current_password')): ?>
                            <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                        <?php endif; ?>
                    </div>


                    <!-- Password baru -->
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group mt-2">
                            <input id="newPwd" type="password" name="password_hash" class="form-control" autocomplete="new-password" placeholder="Masukan Password Baru">
                            <div class="input-group-append">
                                <button class="btn toggle-eye" type="button" data-target="#newPwd">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="pw-hint mt-1">Gunakan kombinasi huruf besar, kecil, angka, dan simbol.</div>

                        <!-- Strength meter -->
                        <div class="progress mt-2">
                            <div id="pwBar" class="progress-bar" role="progressbar" style="width:0%"></div>
                        </div>
                        <small id="pwText" class="d-block mt-1 text-muted">Kekuatan: -</small>

                        <?php if ($msg = validation_show_error('password_hash')): ?>
                            <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Konfirmasi password baru -->
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group mt-2">
                            <input id="newPwd2" type="password" name="new_password_confirm" class="form-control" autocomplete="new-password" placeholder="Konfirmasi Password">
                            <div class="input-group-append">
                                <button class="btn toggle-eye" type="button" data-target="#newPwd2">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <?php if ($msg = validation_show_error('new_password_confirm')): ?>
                            <div class="invalid-feedback d-block"><?= esc($msg) ?></div>
                        <?php endif; ?>
                    </div>

                    <hr class="hr-soft">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-gradient rounded-pill py-2 mr-2">
                            <i class="fas fa-key mr-1"></i> Ubah Password
                        </button>
                        <a href="<?= site_url('admin/profile') ?>" class="btn btn-light border rounded-pill py-2">Batal</a>
                    </div>
                </div>

                <!-- Tips sisi kanan -->
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="p-3 rounded" style="background:#f8fafc;border:1px solid #eef2ff">
                        <h6 class="mb-2" style="font-weight:700;color:#374151">Tips Keamanan</h6>
                        <ul class="mb-0" style="padding-left:18px;color:#6b7280">
                            <li>Minimal 8 karakter.</li>
                            <li>Campur huruf besar/kecil, angka, dan simbol.</li>
                            <li>Jangan gunakan password yang sama dengan situs lain.</li>
                            <li>Ganti password secara berkala.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    // Satu handler saja, pakai event delegation
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.toggle-eye');
        if (!btn) return;

        // Cari input target: dari data-target atau fallback input di input-group
        const sel = btn.dataset.target;
        let field = sel ? document.querySelector(sel) : null;
        if (!field) field = btn.closest('.input-group')?.querySelector('input');
        if (!field) return;

        // Toggle tipe
        field.type = field.type === 'password' ? 'text' : 'password';

        // Toggle ikon
        const icon = btn.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    });

    // Strength meter
    const newPwd = document.getElementById('newPwd');
    const bar = document.getElementById('pwBar');
    const txt = document.getElementById('pwText');

    function strengthScore(v) {
        let s = 0;
        if (!v) return 0;
        if (v.length >= 8) s++;
        if (/[A-Z]/.test(v)) s++;
        if (/[a-z]/.test(v)) s++;
        if (/\d/.test(v)) s++;
        if (/[^\w\s]/.test(v)) s++;
        return Math.min(s, 5);
    }

    function updateMeter() {
        const v = newPwd.value || '';
        const sc = strengthScore(v);
        const pct = (sc / 5) * 100;
        bar.style.width = pct + '%';
        bar.className = 'progress-bar';
        let label = 'Lemah';
        if (sc <= 2) {
            bar.style.background = '#dc3545';
            label = 'Lemah';
        } else if (sc === 3) {
            bar.style.background = '#fd7e14';
            label = 'Sedang';
        } else if (sc === 4) {
            bar.style.background = '#198754';
            label = 'Kuat';
        } else if (sc === 5) {
            bar.style.background = '#0d6efd';
            label = 'Sangat Kuat';
        }
        txt.textContent = 'Kekuatan: ' + label;
    }
    newPwd?.addEventListener('input', updateMeter);
    updateMeter();
</script>


<?= $this->endSection() ?>
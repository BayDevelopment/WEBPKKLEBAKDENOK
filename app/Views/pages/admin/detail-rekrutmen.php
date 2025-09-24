<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>

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

    /* ===== Detail Modern ===== */
    .card-modern {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        overflow: hidden;
        position: relative
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

    .badge-soft {
        background: rgba(78, 115, 223, .08);
        color: #4e73df;
        border: 1px solid rgba(78, 115, 223, .2);
        border-radius: 999px
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

    .kv {
        display: grid;
        grid-template-columns: 160px 1fr;
        gap: .35rem 1rem
    }

    .kv .k {
        color: #64748b;
        white-space: nowrap
    }

    .kv .v {
        color: #0f172a
    }

    @media (max-width:576px) {
        .kv {
            grid-template-columns: 1fr
        }

        .k {
            font-weight: 600
        }
    }

    .divider {
        height: 1px;
        background: #e5e7eb;
        margin: 1rem 0
    }

    .chips {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .4rem .7rem;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        background: #fff
    }

    .chip i {
        opacity: .75
    }

    .copy-btn {
        border: 1px solid #e5e7eb;
        background: #fff;
        border-radius: 10px;
        padding: .25rem .5rem;
        font-size: .8rem
    }

    .copy-btn:hover {
        background: #f8fafc
    }

    .avatar-rect {
        width: 140px;
        aspect-ratio: 3/4;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #f3f4f6
    }

    .small-muted {
        font-size: .85rem;
        color: #6b7280
    }

    .action-bar {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem
    }

    @media print {

        .action-bar,
        .breadcrumb,
        .btn,
        .badge,
        .page-title {
            display: none !important
        }

        .card-modern {
            box-shadow: none;
            border: 0
        }
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
</style>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><i class="fa-solid fa-id-card-clip me-2"></i> Detail Rekrutmen</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/rekrutmen') ?>">Rekrutmen</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <?php
    $v = session('validation') ?? \Config\Services::validation();
    $pokjaKode = $rekrut['pokja_kode'] ?? ($pokja['kode'] ?? null);
    $pokjaNama = $rekrut['pokja_nama'] ?? ($pokja['nama'] ?? null);
    $fotoUrl   = !empty($rekrut['pas_foto']) ? base_url($rekrut['pas_foto']) : null;
    $createdAt = !empty($rekrut['created_at']) ? date('d M Y, H:i', strtotime($rekrut['created_at'])) : '—';
    $updatedAt = !empty($rekrut['updated_at']) ? date('d M Y, H:i', strtotime($rekrut['updated_at'])) : '—';
    ?>

    <div class="row">
        <!-- Left: Detail -->
        <div class="col-xl-8 col-lg-9 mb-3">
            <div class="card card-modern">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-soft px-3 py-2 me-2"><i class="fa-solid fa-user"></i> Pendaftar</span>
                        <h6 class="m-0 fw-bold mr-2"><?= esc($rekrut['nama_lengkap'] ?? '-') ?></h6>
                    </div>
                    <div class="action-bar">
                        <a class="btn btn-sm btn-outline-secondary rounded-pill" href="javascript:window.print()">
                            <i class="fa-solid fa-print me-1"></i> Cetak
                        </a>
                        <a class="btn btn-sm btn-outline-primary rounded-pill" href="<?= base_url('admin/rekrutmen/update/' . (int)$rekrut['id_pendaftaran']) ?>">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                        </a>
                        <!-- Hapus: gunakan POST agar aman; JS SweetAlert akan konfirmasi -->
                        <form action="<?= site_url('admin/rekrutmen/delete/' . (int)$rekrut['id_pendaftaran']) ?>" method="post" class="d-inline" id="formDeleteRekrut">
                            <?= csrf_field() ?>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" id="btnDelete">
                                <i class="fa-solid fa-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Chips -->
                    <div class="chips mb-3">
                        <?php if ($pokjaKode || $pokjaNama): ?>
                            <span class="chip"><i class="fa-solid fa-people-group"></i>
                                Pokja: <strong><?= esc($pokjaKode ?: '-') ?></strong>
                                <?php if ($pokjaNama): ?><span class="small-muted">— <?= esc($pokjaNama) ?></span><?php endif; ?>
                            </span>
                        <?php endif; ?>
                        <span class="chip"><i class="fa-regular fa-clock"></i>Dibuat: <?= esc($createdAt) ?></span>
                        <span class="chip"><i class="fa-regular fa-pen-to-square"></i>Diubah: <?= esc($updatedAt) ?></span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="kv">
                                <div class="k">Nama Lengkap</div>
                                <div class="v"><?= esc($rekrut['nama_lengkap'] ?? '-') ?></div>

                                <div class="k">NIK</div>
                                <div class="v d-flex align-items-center gap-2">
                                    <span id="nikText"><?= esc($rekrut['nik'] ?? '-') ?></span>
                                    <?php if (!empty($rekrut['nik'])): ?>
                                        <button class="copy-btn" type="button" data-copy="#nikText"><i class="fa-regular fa-copy me-1"></i> Salin</button>
                                    <?php endif; ?>
                                </div>

                                <div class="k">No. HP</div>
                                <div class="v d-flex align-items-center gap-2">
                                    <span id="hpText"><?= esc($rekrut['no_hp'] ?: '—') ?></span>
                                    <?php if (!empty($rekrut['no_hp'])): ?>
                                        <a class="copy-btn" href="https://wa.me/<?= preg_replace('/\D/', '', $rekrut['no_hp']) ?>" target="_blank" rel="noopener">
                                            <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                                        </a>
                                        <button class="copy-btn" type="button" data-copy="#hpText"><i class="fa-regular fa-copy me-1"></i> Salin</button>
                                    <?php endif; ?>
                                </div>

                                <div class="k">Alamat</div>
                                <div class="v"><?= nl2br(esc($rekrut['alamat'] ?? '-')) ?></div>
                            </div>

                            <div class="divider"></div>
                            <div class="small-muted">
                                Pastikan data sudah benar. Gunakan tombol <b>Edit</b> untuk pembaruan atau <b>Hapus</b> untuk menghapus pendaftaran.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right: Info ringkas -->
        <div class="col-xl-4 col-lg-3 mb-3">
            <div class="card card-modern">
                <div class="card-header">
                    <h6 class="m-0 fw-bold"><i class="fa-solid fa-circle-info me-2"></i> Ringkasan</h6>
                </div>
                <div class="card-body">
                    <div class="kv">
                        <div class="k">ID Pendaftaran</div>
                        <div class="v">#<?= (int)$rekrut['id_pendaftaran'] ?></div>

                        <div class="k">Pokja</div>
                        <div class="v"><?= esc($pokjaKode ?: '-') ?> <?= $pokjaNama ? '— ' . esc($pokjaNama) : '' ?></div>

                        <div class="k">Dibuat</div>
                        <div class="v"><?= esc($createdAt) ?></div>

                        <div class="k">Diubah</div>
                        <div class="v"><?= esc($updatedAt) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Copy to clipboard (NIK / HP)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-copy]');
        if (!btn) return;
        const sel = btn.getAttribute('data-copy');
        const el = document.querySelector(sel);
        if (!el) return;

        const text = (el.textContent || '').trim();
        if (!text) return;

        navigator.clipboard?.writeText(text).then(() => {
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Disalin',
                    text: 'Teks telah disalin.',
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });
    });

    // SweetAlert delete confirm (POST)
    document.getElementById('btnDelete')?.addEventListener('click', function() {
        const form = document.getElementById('formDeleteRekrut');
        if (!form) return;
        if (window.Swal) {
            Swal.fire({
                title: 'Hapus pendaftaran ini?',
                text: 'Tindakan tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                reverseButtons: true
            }).then(res => {
                if (res.isConfirmed) form.submit();
            });
        } else {
            if (confirm('Hapus pendaftaran ini?')) form.submit();
        }
    });
</script>

<?= $this->endSection() ?>
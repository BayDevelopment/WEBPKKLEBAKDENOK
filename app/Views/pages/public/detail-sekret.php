<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<?php
// Contoh data fallback supaya view tetap tampil jika controller belum supply $person
$p = $person ?? [
    'name'          => 'Hj. ALFI RIZKI AGHNIA',
    'position'      => 'Ketua Pokja III',
    'pokja'         => 'Pokja III',
    'unit'          => 'TP PKK Kelurahan Lebak Denok',
    'photo'         => base_url('assets/img/dumy-img.png'),
    'since'         => '2023 – Sekarang',
    'email'         => 'contoh@email.com',
    'phone'         => '08xx xxxx xxxx',
    'address'       => 'Lebak Denok, Citangkil, Kota Cilegon',
    'bio'           => 'Aktif membina dan menggerakkan kader dalam program PKK, berfokus pada peningkatan ketahanan keluarga, ekonomi kreatif, dan penguatan administrasi Pokja.',
    'skills'        => ['Manajemen Kegiatan', 'Koordinasi Pokja', 'Pelaporan & Administrasi'],
    'docs'          => [
        ['title' => 'SK Pengangkatan', 'url' => '#'],
        ['title' => 'Program Kerja Pokja III', 'url' => '#'],
        ['title' => 'Rekap Kegiatan 2024', 'url' => '#'],
    ],
    'socials'       => [
        ['icon' => 'fa-brands fa-whatsapp', 'label' => 'WhatsApp', 'url' => '#'],
        ['icon' => 'fa-solid fa-envelope', 'label' => 'Email', 'url' => 'mailto:contoh@email.com'],
    ],
];
?>

<style>
    /* ====== DETAIL PERSON — Modern Look (selaras style sebelumnya) ====== */

    /* Hero reused */
    .about-hero {
        background:
            radial-gradient(1200px 300px at -10% -10%, rgba(13, 110, 253, .25), transparent 60%),
            radial-gradient(900px 300px at 110% -10%, rgba(32, 201, 151, .25), transparent 60%),
            linear-gradient(135deg, #0d1b2a, #163f6b 55%, #1b5eaa);
        box-shadow: 0 12px 40px rgba(13, 27, 42, .25);
        color: #fff;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .18);
    }

    .about-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        backdrop-filter: saturate(120%) blur(0px);
        pointer-events: none
    }

    /* Chips */
    .chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .45rem .7rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, .14);
        border: 1px solid rgba(255, 255, 255, .28);
        color: #fff;
        font-weight: 700;
        font-size: .85rem
    }

    .chip i {
        opacity: .9
    }

    /* Section card */
    .form-card {
        border: 1px solid rgba(13, 110, 253, .12);
        border-radius: 1.25rem;
        background: #fff;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .08);
        position: relative
    }

    .form-card::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        pointer-events: none;
        box-shadow: 0 1px 0 rgba(13, 110, 253, .12) inset, 0 0 0 1px rgba(13, 110, 253, .06) inset
    }

    /* Profile header card */
    .dp-card {
        display: flex;
        gap: 1.25rem;
        align-items: stretch;
        border: 1px solid rgba(13, 110, 253, .12);
        border-radius: 1rem;
        padding: 1rem;
        background:
            radial-gradient(900px 300px at -20% -20%, rgba(13, 110, 253, .06), transparent 60%),
            radial-gradient(900px 300px at 120% -20%, rgba(32, 201, 151, .06), transparent 60%),
            #ffffff;
        box-shadow: 0 10px 28px rgba(0, 0, 0, .08);
    }

    .dp-photo {
        flex: 0 0 180px;
        max-width: 180px;
        position: relative;
        border-radius: 1rem;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(78, 115, 223, .18), rgba(28, 200, 138, .18));
        padding: .5rem;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .08)
    }

    .dp-photo img {
        display: block;
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: .9rem;
        background: #f8f9fa;
    }

    .dp-badge {
        position: absolute;
        left: .8rem;
        top: .8rem;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .35rem .55rem;
        border-radius: .65rem;
        background: #e7f1ff;
        color: #0d6efd;
        font-weight: 800;
        letter-spacing: .4px;
        text-transform: uppercase;
        border: 1px solid rgba(13, 110, 253, .28);
        box-shadow: 0 4px 12px rgba(13, 110, 253, .20);
    }

    .dp-body {
        flex: 1 1 auto;
        min-width: 0
    }

    .dp-name {
        margin: 0 0 .25rem;
        font-weight: 900;
        font-size: 1.4rem;
        line-height: 1.2;
        background: linear-gradient(45deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .dp-pos {
        margin: 0 0 .5rem;
        color: #0f2a4a;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px
    }

    .dp-meta {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem .75rem;
        margin: .75rem 0 0
    }

    .dp-meta .chip {
        background: #eff6ff;
        color: #0d6efd;
        border-color: rgba(13, 110, 253, .28)
    }

    .dp-socials {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: .9rem
    }

    .dp-socials a {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .5rem .75rem;
        border-radius: .7rem;
        text-decoration: none;
        color: #0d6efd;
        background: #eef5ff;
        border: 1px solid rgba(13, 110, 253, .28);
        font-weight: 700;
    }

    .dp-socials a:hover {
        background: #e7f1ff
    }

    /* Right info list */
    .info-list {
        padding-left: 0;
        margin-bottom: 0
    }

    .info-list li {
        list-style: none;
        display: flex;
        gap: .6rem;
        align-items: flex-start;
        margin: .4rem 0
    }

    .info-list .label {
        min-width: 110px;
        color: #6c757d;
        font-size: .9rem
    }

    .info-list .value {
        color: #0f2a4a
    }

    /* Tabs content block */
    .dp-block {
        border: 1px dashed rgba(13, 110, 253, .25);
        border-radius: 1rem;
        padding: 1rem
    }

    .dp-title {
        font-weight: 800;
        color: #0f2a4a;
        margin-bottom: .6rem
    }

    .dp-pills .nav-link {
        margin-bottom: .5rem;
        border-radius: .9rem;
        font-weight: 700;
        color: #0f2a4a;
        background: rgba(13, 110, 253, .06);
        border: 1px solid rgba(13, 110, 253, .12);
        padding: .6rem 1rem
    }

    .dp-pills .nav-link.active {
        color: #0d6efd;
        background: linear-gradient(135deg, rgba(78, 115, 223, .16), rgba(28, 200, 138, .16));
        border-color: rgba(78, 115, 223, .35)
    }

    .tab-content>.tab-pane {
        transition: opacity .25s ease, transform .25s ease
    }

    .tab-content>.tab-pane:not(.show) {
        display: block;
        height: 0;
        overflow: hidden;
        opacity: 0;
        transform: translateY(6px)
    }

    .tab-content>.tab-pane.show {
        height: auto;
        opacity: 1;
        transform: none
    }

    /* Buttons */
    .btn-native {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .65rem 1rem;
        border-radius: 999px;
        text-decoration: none;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff;
        font-weight: 800;
        letter-spacing: .3px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .btn-native:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(0, 0, 0, .18);
        filter: saturate(1.05)
    }

    .btn-outline-soft {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .65rem 1rem;
        border-radius: 999px;
        text-decoration: none;
        background: #eef5ff;
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, .28);
        font-weight: 800;
    }

    .btn-outline-soft:hover {
        background: #e7f1ff
    }

    /* Lists */
    .list-check {
        padding-left: 0;
        margin-left: 0
    }

    .list-check>li {
        list-style: none;
        position: relative;
        padding-left: 1.8rem;
        margin-bottom: .5rem
    }

    .list-check>li::before {
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: .15rem;
        color: #20c997
    }

    @media (max-width: 991.98px) {
        .dp-card {
            flex-direction: column;
            align-items: center;
            text-align: center
        }

        .dp-photo {
            flex: 0 0 auto;
            max-width: 220px
        }

        .info-list .label {
            min-width: 90px
        }
    }
</style>

<section class="py-5 reveal" style="--d:40ms">
    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>" class="text-decoration-none">
                        <i class="fa-solid fa-house me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sekretariat') ?>" class="text-decoration-none">Sekretariat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pengurus</li>
            </ol>
        </nav>

        <!-- Hero -->
        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white reveal" style="--d:80ms">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2"><?= esc($p['name']) ?></h1>
                    <p class="lead mb-0 opacity-90"><?= esc($p['position']) ?> — <?= esc($p['unit']) ?></p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li><span class="chip"><i class="fa-solid fa-sitemap"></i> <?= esc($p['pokja']) ?></span></li>
                        <li><span class="chip"><i class="fa-solid fa-calendar-check"></i> <?= esc($p['since']) ?></span></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="row g-4">
            <!-- Left: Profile summary -->
            <div class="col-lg-6 reveal" style="--d:120ms">
                <article class="form-card p-3 p-lg-4">
                    <div class="dp-card">
                        <div class="dp-photo">
                            <img src="<?= esc($p['photo']) ?>" alt="Foto <?= esc($p['name']) ?>" loading="lazy" decoding="async">
                            <span class="dp-badge"><i class="fa-solid fa-user-tie"></i> <?= esc($p['position']) ?></span>
                        </div>
                        <div class="dp-body">
                            <h2 class="dp-name"><?= esc($p['name']) ?></h2>
                            <div class="dp-pos"><?= esc($p['unit']) ?></div>

                            <ul class="info-list mt-3">
                                <li><span class="label"><i class="fa-solid fa-envelope me-1"></i> Email</span>
                                    <span class="value"><?= esc($p['email']) ?></span>
                                </li>
                                <li><span class="label"><i class="fa-solid fa-phone me-1"></i> Telp</span>
                                    <span class="value"><?= esc($p['phone']) ?></span>
                                </li>
                                <li><span class="label"><i class="fa-solid fa-location-dot me-1"></i> Alamat</span>
                                    <span class="value"><?= esc($p['address']) ?></span>
                                </li>
                            </ul>

                            <div class="dp-socials">
                                <?php foreach (($p['socials'] ?? []) as $s): ?>
                                    <a href="<?= esc($s['url']) ?>" target="_blank" rel="noopener">
                                        <i class="<?= esc($s['icon']) ?>"></i> <?= esc($s['label']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <a href="<?= site_url('sekretariat') ?>" class="btn-outline-soft"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Right: Tabs -->
            <div class="col-lg-6 reveal" style="--d:160ms">
                <article class="form-card p-3 p-lg-4">
                    <ul class="nav nav-pills dp-pills mb-3" id="dp-tab" role="tablist">
                        <li class="nav-item" role="presentation" style="margin-right: 10px !important;">
                            <button class="nav-link active" id="bio-tab" data-bs-toggle="pill" data-bs-target="#bio-pane" type="button" role="tab">Profil</button>
                        </li>
                        <li class="nav-item" role="presentation" style="margin-right: 10px !important;">
                            <button class="nav-link" id="tasks-tab" data-bs-toggle="pill" data-bs-target="#tasks-pane" type="button" role="tab">Tugas & Peran</button>
                        </li>
                        <li class="nav-item" role="presentation" style="margin-right: 10px !important;">
                            <button class="nav-link" id="docs-tab" data-bs-toggle="pill" data-bs-target="#docs-pane" type="button" role="tab">Dokumen</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="dp-tabContent">
                        <!-- Bio -->
                        <div class="tab-pane fade show active" id="bio-pane" role="tabpanel" aria-labelledby="bio-tab" tabindex="0">
                            <div class="dp-block">
                                <h3 class="dp-title"><i class="fa-solid fa-user-pen me-2"></i> Ringkasan</h3>
                                <p class="mb-3"><?= esc($p['bio']) ?></p>

                                <h4 class="h6 fw-bold mb-2">Keahlian</h4>
                                <ul class="list-check">
                                    <?php foreach (($p['skills'] ?? []) as $sk): ?>
                                        <li><?= esc($sk) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Tasks -->
                        <div class="tab-pane fade" id="tasks-pane" role="tabpanel" aria-labelledby="tasks-tab" tabindex="0">
                            <div class="dp-block">
                                <h3 class="dp-title"><i class="fa-solid fa-list-check me-2"></i> Tugas Utama</h3>
                                <ul class="list-check mb-0">
                                    <li>Koordinasi program kerja <?= esc($p['pokja']) ?> dan sinkronisasi dengan Sekretariat.</li>
                                    <li>Pembinaan kader dan monitoring evaluasi kegiatan.</li>
                                    <li>Penguatan administrasi dan pelaporan berkala.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Docs -->
                        <div class="tab-pane fade" id="docs-pane" role="tabpanel" aria-labelledby="docs-tab" tabindex="0">
                            <div class="dp-block">
                                <h3 class="dp-title"><i class="fa-solid fa-folder-open me-2"></i> Dokumen Terkait</h3>
                                <?php if (!empty($p['docs'])): ?>
                                    <div class="list-group">
                                        <?php foreach ($p['docs'] as $d): ?>
                                            <a href="<?= esc($d['url']) ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                                <span><i class="fa-solid fa-file-lines me-2 text-primary"></i><?= esc($d['title']) ?></span>
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted mb-0">Belum ada dokumen.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

    </div>
</section>

<!-- Reveal (ringkas) -->
<script>
    (() => {
        const items = [...document.querySelectorAll('.reveal')];
        if (!items.length) return;
        if (!('IntersectionObserver' in window)) {
            items.forEach(el => el.classList.add('is-visible', 'show'));
            return;
        }
        const io = new IntersectionObserver((e, o) => {
            e.forEach(x => {
                if (x.isIntersecting) {
                    x.target.classList.add('is-visible', 'show');
                    o.unobserve(x.target);
                }
            })
        }, {
            threshold: .14,
            rootMargin: '0px 0px -6% 0px'
        });
        items.forEach((el, i) => {
            if (!el.style.getPropertyValue('--d')) el.style.setProperty('--d', (i % 8) * 60 + 'ms');
            io.observe(el);
        });
    })();
</script>

<?= $this->endSection() ?>
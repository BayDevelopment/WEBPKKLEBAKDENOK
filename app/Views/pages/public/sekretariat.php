<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<style>
    /* --- Reuse style dari referensi + tambahan untuk form --- */

    /* Fade-in on scroll (dari referensi) */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        will-change: opacity, transform
    }

    .reveal.is-visible,
    .reveal.show {
        opacity: 1;
        transform: none
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important
        }
    }

    /* Breadcrumb */
    .breadcrumb-modern {
        background: rgba(0, 98, 204, .06);
        border: 1px solid rgba(0, 98, 204, .12);
        --bs-breadcrumb-divider-color: rgba(0, 0, 0, .35)
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #0d6efd
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: rgba(0, 0, 0, .6)
    }

    /* Hero gradient glass + accent */
    .about-hero {
        background:
            radial-gradient(1200px 300px at -10% -10%, rgba(13, 110, 253, .25), transparent 60%),
            radial-gradient(900px 300px at 110% -10%, rgba(32, 201, 151, .25), transparent 60%),
            linear-gradient(135deg, #0d1b2a, #163f6b 55%, #1b5eaa);
        box-shadow: 0 12px 40px rgba(13, 27, 42, .25);
        position: relative;
        overflow: hidden;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .18);
    }

    .about-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        backdrop-filter: saturate(120%) blur(0px);
        pointer-events: none
    }

    .about-hero::before {
        content: "";
        position: absolute;
        inset: -1px;
        border-radius: inherit;
        pointer-events: none;
        background: linear-gradient(135deg, rgba(255, 255, 255, .14), rgba(255, 255, 255, 0) 40%) border-box;
        mask: linear-gradient(#000 0 0) padding-box, linear-gradient(#000 0 0);
        -webkit-mask: linear-gradient(#000 0 0) padding-box, linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: .25rem;
        padding: .4rem .7rem;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .25);
        color: #fff;
        border-radius: 999px;
        font-weight: 600;
        font-size: .875rem;
        transition: transform .2s ease, box-shadow .25s ease, background .25s ease
    }

    .chip:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
        background: rgba(255, 255, 255, .16)
    }

    .shadow-soft {
        box-shadow: 0 8px 28px rgba(0, 0, 0, .08)
    }

    .content-typo p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #495057
    }

    .content-typo h2,
    .content-typo h3,
    .content-typo h4 {
        color: #0f2a4a
    }

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

    /* --- Card / form --- */
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

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15)
    }

    .required::after {
        content: "*";
        color: #dc3545;
        margin-left: .25rem;
        font-weight: 700
    }

    .hint {
        font-size: .85rem;
        color: #6c757d
    }

    .section-title {
        font-weight: 800;
        color: #0f2a4a
    }

    .btn-join {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        width: 100%;
        padding: .9rem 1.25rem;
        border-radius: 999px;
        font-weight: 800;
        letter-spacing: .4px;
        color: #fff;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        border: 0;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .15);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        backdrop-filter: saturate(120%);
    }

    .btn-join:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .2);
        filter: saturate(1.05)
    }

    .btn-join:active {
        transform: none;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .16)
    }

    .badge-req {
        background: #e7f1ff;
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, .28)
    }

    .divider-label {
        display: flex;
        align-items: center;
        gap: .75rem;
        color: #6c757d;
        margin: 1.25rem 0
    }

    .divider-label::before,
    .divider-label::after {
        content: "";
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, rgba(0, 0, 0, .08), rgba(0, 0, 0, .02))
    }

    @media (max-width: 991.98px) {
        .chip {
            background: rgba(255, 255, 255, .18)
        }
    }

    /* Sticky kiri */
    .sticky-join {
        position: sticky;
        top: 92px;
        z-index: 2
    }

    .scroll-card {
        max-height: calc(100vh - 140px);
        display: flex;
        flex-direction: column;
        position: relative
    }

    .scroll-card::before,
    .scroll-card::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        height: 18px;
        z-index: 1;
        pointer-events: none;
        background: linear-gradient(to bottom, rgba(255, 255, 255, .9), rgba(255, 255, 255, 0))
    }

    .scroll-card::after {
        bottom: 0;
        top: auto;
        transform: rotate(180deg)
    }

    .scroll-card .card-body {
        position: relative;
        z-index: 2;
        overflow: auto;
        overscroll-behavior: contain;
        scrollbar-gutter: stable
    }

    .scroll-card .card-body::-webkit-scrollbar {
        width: 8px
    }

    .scroll-card .card-body::-webkit-scrollbar-thumb {
        background: rgba(13, 110, 253, .35);
        border-radius: 8px
    }

    .scroll-card .card-body::-webkit-scrollbar-track {
        background: rgba(13, 110, 253, .08);
        border-radius: 8px
    }

    @media (max-width: 991.98px) {
        .sticky-join {
            position: static;
            top: auto
        }

        .scroll-card {
            max-height: none
        }
    }

    /* NAV-PILLS & TAB */
    .nav-pills .nav-link {
        margin-bottom: .5rem;
        border-radius: .9rem;
        font-weight: 700;
        letter-spacing: .2px;
        color: #0f2a4a;
        background: rgba(13, 110, 253, .06);
        border: 1px solid rgba(13, 110, 253, .12);
        padding: .65rem 1rem;
        transition: all .22s ease
    }

    .nav-pills .nav-link:not(.active):hover {
        background: rgba(13, 110, 253, .1);
        border-color: rgba(13, 110, 253, .22);
        transform: translateX(2px)
    }

    .nav-pills .nav-link.active {
        color: #0d6efd;
        background: linear-gradient(135deg, rgba(78, 115, 223, .18), rgba(28, 200, 138, .18));
        border-color: rgba(78, 115, 223, .35);
        box-shadow: inset 0 0 0 1px rgba(13, 110, 253, .18), 0 8px 22px rgba(13, 110, 253, .12);
        transform: translateX(2px)
    }

    .nav-pills .nav-link:focus-visible {
        outline: 3px solid rgba(13, 110, 253, .35);
        outline-offset: 2px
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

    /* ===== MODERNISASI AREA SEKRETARIAT (KANAN) ===== */
    .form-card .section-title i {
        color: #0d6efd
    }

    /* Container tiap Pokja */


    .cover-pokja-content:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 34px rgba(0, 0, 0, .12)
    }

    .cover-pokja-content::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        pointer-events: none;
        box-shadow: 0 1px 0 rgba(13, 110, 253, .10) inset, 0 0 0 1px rgba(13, 110, 253, .06) inset
    }

    /* Kartu profil orang */
    .cover-img-person {
        border-radius: 1rem;
        padding: .5rem;
        background: linear-gradient(135deg, rgba(78, 115, 223, .20), rgba(28, 200, 138, .20));
        box-shadow: 0 8px 22px rgba(0, 0, 0, .08)
    }

    .size-person-image {
        display: block;
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: .9rem;
        background: #f8f9fa;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .06);
    }

    .cover-biodata-person h5 {
        font-weight: 800;
        font-size: 1.05rem;
        margin-top: .9rem;
        margin-bottom: .25rem;
        letter-spacing: .3px;
        background: linear-gradient(45deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .cover-position-person h5 {
        font-size: .82rem;
        letter-spacing: .6px;
        color: #0f2a4a;
        text-transform: uppercase;
        display: inline-block;
        padding: .45rem .65rem;
        border-radius: .75rem;
        background: #e7f1ff;
        border: 1px solid rgba(13, 110, 253, .25);
        margin: .25rem 0 0;
        box-shadow: 0 2px 8px rgba(13, 110, 253, .10);
    }

    .cover-pokja-content .row {
        --bs-gutter-y: 1rem
    }

    @media (min-width: 992px) {
        .cover-pokja-content .row {
            --bs-gutter-x: 1.25rem
        }
    }

    /* Blok judul struktur */
    .cover-judul-struktural {
        margin-bottom: .75rem
    }

    .cover-judul-struktural h5:first-child {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        font-size: .8rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #0d6efd;
        padding: .35rem .6rem;
        border-radius: .6rem;
        background: #e7f1ff;
        border: 1px solid rgba(13, 110, 253, .28);
        box-shadow: 0 2px 8px rgba(13, 110, 253, .10);
        margin-bottom: .35rem;
    }

    .cover-judul-struktural h5+h5 {
        font-weight: 900;
        font-size: 1.25rem;
        letter-spacing: .3px;
        margin: 0;
        background: linear-gradient(45deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Wadah gambar struktur */
    .cover-judul-struktural+.cover-img-person {
        position: relative;
        border-radius: 1rem;
        padding: .6rem;
        background:
            radial-gradient(900px 300px at -20% -20%, rgba(13, 110, 253, .08), transparent 60%),
            radial-gradient(900px 300px at 120% -20%, rgba(32, 201, 151, .08), transparent 60%),
            #ffffff;
        border: 1px solid rgba(13, 110, 253, .12);
        box-shadow: 0 10px 28px rgba(0, 0, 0, .08);
        overflow: hidden;
    }

    .cover-judul-struktural+.cover-img-person::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        pointer-events: none;
        box-shadow: 0 1px 0 rgba(13, 110, 253, .10) inset, 0 0 0 1px rgba(13, 110, 253, .06) inset
    }

    .size-struktural-image {
        display: block;
        width: 100%;
        height: auto;
        border-radius: .8rem;
        background: #f8f9fa;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .06);
        transition: transform .35s ease, filter .35s ease, box-shadow .35s ease;
        will-change: transform, filter;
        cursor: zoom-in;
    }

    .cover-judul-struktural+.cover-img-person:hover .size-struktural-image {
        transform: scale(1.012);
        filter: saturate(1.03) contrast(1.02);
        box-shadow: 0 10px 28px rgba(0, 0, 0, .12)
    }

    .row.g-4+.row.g-4 {
        margin-top: .25rem
    }

    /* Biodata pengurus (bawah) */
    .cover-biodata-person span {
        display: inline-block;
        font-size: .8rem;
        color: #6c757d;
        margin-top: .5rem;
        margin-bottom: .15rem;
        padding: .25rem .5rem;
        border-radius: .5rem;
        background: #f8fafc;
        border: 1px solid rgba(13, 110, 253, .12);
    }

    .cover-btn-review {
        margin-top: 1rem
    }

    .btn-native {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .65rem 1rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff;
        text-decoration: none;
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

    .btn-native:active {
        transform: none;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .16)
    }

    /* ===== Modern Profile Card ===== */
    .profile-card {
        position: relative;
        border-radius: 1rem;
        background:
            radial-gradient(800px 300px at -20% -20%, rgba(13, 110, 253, .08), transparent 60%),
            radial-gradient(800px 300px at 120% -20%, rgba(32, 201, 151, .08), transparent 60%),
            #ffffff;
        border: 1px solid rgba(13, 110, 253, .12);
        box-shadow: 0 10px 28px rgba(0, 0, 0, .08);
        overflow: hidden;
        transition: transform .22s ease, box-shadow .22s ease, filter .22s ease;
    }

    .profile-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(0, 0, 0, .14);
        filter: saturate(1.02);
    }

    /* inner subtle border */
    .profile-card::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        border-radius: inherit;
        box-shadow: 0 1px 0 rgba(13, 110, 253, .1) inset, 0 0 0 1px rgba(13, 110, 253, .06) inset;
    }

    /* media (gambar) */
    .pc-media {
        position: relative;
        overflow: hidden;
        background: #f8fafc;
    }

    .pc-img {
        display: block;
        width: 100%;
        aspect-ratio: 4 / 3;
        /* proporsi landscape yang enak */
        object-fit: cover;
        transition: transform .6s ease, filter .6s ease;
    }

    .profile-card:hover .pc-img {
        transform: scale(1.05);
        filter: contrast(1.03)
    }

    /* badge jabatan overlay */
    .pc-badge {
        position: absolute;
        left: .75rem;
        top: .75rem;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .4rem .6rem;
        border-radius: .7rem;
        font-size: .8rem;
        font-weight: 800;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: #0d6efd;
        background: #e7f1ff;
        border: 1px solid rgba(13, 110, 253, .28);
        box-shadow: 0 4px 12px rgba(13, 110, 253, .20);
    }

    /* body */
    .pc-body {
        padding: .9rem 1rem 1.1rem
    }

    .pc-kicker {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: #0d6efd;
        background: #eff6ff;
        border: 1px solid rgba(13, 110, 253, .24);
        padding: .28rem .55rem;
        border-radius: .5rem;
        margin-bottom: .5rem;
    }

    .pc-title {
        margin: 0 0 .25rem;
        font-weight: 900;
        font-size: 1.15rem;
        line-height: 1.25;
        background: linear-gradient(45deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .pc-sub {
        margin: 0 0 .75rem;
        color: #5c6770;
        font-size: .92rem
    }

    /* meta (Nama/Jabatan) */
    .pc-meta {
        margin: 0 0 .9rem;
    }

    .pc-meta .label {
        display: block;
        font-size: .8rem;
        color: #6c757d;
        margin: .35rem 0 .15rem
    }

    .pc-meta .value {
        margin: 0;
        font-weight: 700;
        color: #0f2a4a
    }

    /* button */
    .pc-actions {
        display: flex;
        gap: .5rem;
    }

    .pc-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .6rem 1rem;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 800;
        color: #fff;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
        transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .pc-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(0, 0, 0, .18);
        filter: saturate(1.05)
    }

    .pc-btn:active {
        transform: none;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .16)
    }

    /* responsive tweaks */
    @media (max-width: 991.98px) {
        .pc-title {
            font-size: 1.05rem
        }
    }
</style>

<!-- LOADER (opsional) -->
<div id="app-loader" class="d-none" aria-hidden="true"></div>

<section class="py-5 reveal">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 reveal">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="<?= site_url('/') ?>" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Gabung TP PKK</li>
            </ol>
        </nav>

        <!-- Hero -->
        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white reveal" style="--d:80ms">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Sekretariat TP PKK Lebak Denok</h1>
                    <p class="lead mb-0 opacity-90">
                        Pusat administrasi, surat-menyurat, pendataan kader, dan koordinasi Pokja I – IV.
                    </p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li><span class="chip"><i class="fa-solid fa-building-flag me-2"></i>Sekretariat</span></li>
                        <li><span class="chip"><i class="fa-solid fa-sitemap me-2"></i>Struktur Organisasi</span></li>
                        <li><span class="chip"><i class="fa-solid fa-folder-open me-2"></i>Data & Arsip</span></li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="row g-4">
            <!-- KIRI: v-pills -->
            <div class="col-lg-3 reveal" style="--d:120ms">
                <div class="sticky-join">
                    <article class="card shadow-soft form-card scroll-card">
                        <div class="card-body p-4 p-lg-4">
                            <h2 class="h5 section-title mb-3">
                                <i class="fa-solid fa-list-check me-2"></i>Pilih PKK Pokja :
                            </h2>
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-pokjaI-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pokjaI" type="button" role="tab" aria-controls="v-pills-pokjaI" aria-selected="true">Pokja I</button>
                                    <button class="nav-link" id="v-pills-pokjaII-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pokjaII" type="button" role="tab" aria-controls="v-pills-pokjaII" aria-selected="false">Pokja II</button>
                                    <button class="nav-link" id="v-pills-pokjaIII-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pokjaIII" type="button" role="tab" aria-controls="v-pills-pokjaIII" aria-selected="false">Pokja III</button>
                                    <button class="nav-link" id="v-pills-pokjaIV-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pokjaIV" type="button" role="tab" aria-controls="v-pills-pokjaIV" aria-selected="false">Pokja IV</button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- KANAN: Konten Sekretariat / Pokja -->
            <div class="col-lg-9 reveal" style="--d:160ms">
                <article class="card shadow-soft form-card">
                    <div class="card-body p-4 p-lg-4">
                        <h2 class="h5 mb-3 fw-semibold">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Sekretariat
                        </h2>

                        <div class="tab-content" id="v-pills-tabContent">
                            <!-- Pokja I -->
                            <div class="tab-pane fade show active" id="v-pills-pokjaI" role="tabpanel" aria-labelledby="v-pills-pokjaI-tab" tabindex="0">
                                <div class="cover-pokja-content p-3 p-lg-4">
                                    <div class="row g-4">
                                        <div class="col-lg-4 col-md-6">
                                            <article class="profile-card">
                                                <div class="pc-media">
                                                    <img src="<?= base_url('assets/img/dumy-img.png') ?>" alt="Foto Pengurus Pokja III" class="pc-img" loading="lazy" decoding="async">
                                                </div>
                                                <div class="pc-body">
                                                    <div class="pc-kicker"><i class="fa-solid fa-id-badge"></i> Biodata Pengurus</div>
                                                    <div class="pc-meta">
                                                        <span class="label">Nama :</span>
                                                        <p class="value">Hj. ALFI RIZKI AGHNIA</p>
                                                        <span class="label">Jabatan :</span>
                                                        <p class="value text-uppercase">ketua tim pkk penggerak kota cilegon</p>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="cover-judul-struktural">
                                                <h5 class="text-uppercase">Struktur Organisasi</h5>
                                                <h5>TP PKK KELURAHAN LEBAK DENOK</h5>
                                            </div>
                                            <div class="cover-img-person">
                                                <img src="<?= base_url('assets/img/struktur I.png') ?>" alt="Struktur Organisasi TP PKK Kelurahan Lebak Denok" class="size-struktural-image" loading="lazy" decoding="async">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="cover-judul-struktural">
                                                <h5 class="text-uppercase">Struktur Organisasi</h5>
                                                <h5>POKJA III KELURAHAN LEBAK DENOK</h5>
                                            </div>
                                            <div class="cover-img-person">
                                                <img src="<?= base_url('assets/img/struktural II.png') ?>" alt="Struktur Organisasi Pokja III Kelurahan Lebak Denok" class="size-struktural-image" loading="lazy" decoding="async">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-lg-4 col-md-6">
                                            <article class="profile-card">
                                                <div class="pc-media">
                                                    <img src="<?= base_url('assets/img/img-person-pokja.png') ?>" alt="Foto Pengurus Pokja III" class="pc-img" loading="lazy" decoding="async">
                                                    <span class="pc-badge"><i class="fa-solid fa-user-tie"></i> Ketua Pokja III</span>
                                                </div>
                                                <div class="pc-body">
                                                    <div class="pc-kicker"><i class="fa-solid fa-id-badge"></i> Biodata Pengurus</div>
                                                    <p class="pc-sub">Kelurahan Lebak Denok</p>

                                                    <div class="pc-meta">
                                                        <span class="label">Nama :</span>
                                                        <p class="value text-uppercase">Umiyati</p>
                                                        <span class="label">Jabatan :</span>
                                                        <p class="value">Ketua Pokja III</p>
                                                    </div>

                                                    <div class="pc-actions">
                                                        <a href="/detail-sekret" class="pc-btn">
                                                            <i class="fa-solid fa-arrow-right-long"></i> Selengkapnya
                                                        </a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Pokja II -->
                            <div class="tab-pane fade" id="v-pills-pokjaII" role="tabpanel" aria-labelledby="v-pills-pokjaII-tab" tabindex="0">
                                <div class="cover-pokja-content p-3 p-lg-4">
                                    <div class="row g-4">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="cover-img-person">
                                                <img src="<?= base_url('assets/img/dumy-img.png') ?>" alt="FOTO PERSON" class="size-person-image">
                                            </div>
                                            <div class="cover-biodata-person">
                                                <h5 class="mb-1">Nama Person</h5>
                                            </div>
                                            <div class="cover-position-person">
                                                <h5 class="text-uppercase">Jabatan Pokja II</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pokja III -->
                            <div class="tab-pane fade" id="v-pills-pokjaIII" role="tabpanel" aria-labelledby="v-pills-pokjaIII-tab" tabindex="0">
                                <div class="cover-pokja-content p-3 p-lg-4">
                                    <div class="row g-4">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="cover-img-person">
                                                <img src="<?= base_url('assets/img/dumy-img.png') ?>" alt="FOTO PERSON" class="size-person-image">
                                            </div>
                                            <div class="cover-biodata-person">
                                                <h5 class="mb-1">Nama Person</h5>
                                            </div>
                                            <div class="cover-position-person">
                                                <h5 class="text-uppercase">Jabatan Pokja III</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pokja IV -->
                            <div class="tab-pane fade" id="v-pills-pokjaIV" role="tabpanel" aria-labelledby="v-pills-pokjaIV-tab" tabindex="0">
                                <div class="cover-pokja-content p-3 p-lg-4">
                                    <div class="row g-4">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="cover-img-person">
                                                <img src="<?= base_url('assets/img/dumy-img.png') ?>" alt="FOTO PERSON" class="size-person-image">
                                            </div>
                                            <div class="cover-biodata-person">
                                                <h5 class="mb-1">Nama Person</h5>
                                            </div>
                                            <div class="cover-position-person">
                                                <h5 class="text-uppercase">Jabatan Pokja IV</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /tab-content -->
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Reveal on scroll + shadow panel kiri -->
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
                    o.unobserve(x.target)
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

        // Shadow lembut saat scroll di panel kiri
        const sc = document.querySelector('.scroll-card .card-body'),
            wrap = document.querySelector('.scroll-card');
        if (sc && wrap) {
            const onScroll = () => {
                const atTop = sc.scrollTop <= 0;
                wrap.style.boxShadow = atTop ? '0 8px 28px rgba(0,0,0,.08)' : '0 10px 26px rgba(0,0,0,.10)';
            };
            sc.addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll();
        }
    })();
</script>
<?= $this->endSection() ?>
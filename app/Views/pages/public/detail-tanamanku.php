<?php

use CodeIgniter\I18n\Time;
?>
<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<style>
    /* Fade-in on scroll */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        /* opsional jeda per elemen */
        will-change: opacity, transform;
    }

    .reveal.is-visible {
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
        background: rgba(0, 98, 204, 0.06);
        border: 1px solid rgba(0, 98, 204, 0.12);
        --bs-breadcrumb-divider-color: rgba(0, 0, 0, .35);
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #0d6efd;
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: rgba(0, 0, 0, .6);
    }

    /* Hero gradient glass */
    .about-hero {
        background:
            radial-gradient(1200px 300px at -10% -10%, rgba(13, 110, 253, 0.25), transparent 60%),
            radial-gradient(900px 300px at 110% -10%, rgba(32, 201, 151, 0.25), transparent 60%),
            linear-gradient(135deg, #0d1b2a, #163f6b 55%, #1b5eaa);
        box-shadow: 0 12px 40px rgba(13, 27, 42, 0.25);
        position: relative;
        overflow: hidden;
    }

    .about-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        backdrop-filter: saturate(120%) blur(0px);
        pointer-events: none;
    }

    /* Meta chips */
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
    }

    /* Card */
    .shadow-soft {
        box-shadow: 0 8px 28px rgba(0, 0, 0, .08);
    }

    /* Typography modern */
    .content-typo p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #495057;
    }

    .content-typo h2,
    .content-typo h3,
    .content-typo h4 {
        color: #0f2a4a;
    }

    .content-typo em {
        color: #0d6efd;
    }

    /* Lists */
    .list-modern {
        counter-reset: item;
        padding-left: 0;
        margin-left: 0;
    }

    .list-modern>li {
        list-style: none;
        position: relative;
        padding-left: 2.2rem;
        margin-bottom: .5rem;
    }

    .list-modern>li::before {
        counter-increment: item;
        content: counter(item);
        position: absolute;
        left: 0;
        top: .05rem;
        width: 1.75rem;
        height: 1.75rem;
        border-radius: .5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f1ff;
        color: #0d6efd;
        font-weight: 700;
        box-shadow: inset 0 0 0 1px rgba(13, 110, 253, .2);
    }

    .list-check {
        padding-left: 0;
        margin-left: 0;
    }

    .list-check>li {
        list-style: none;
        position: relative;
        padding-left: 1.8rem;
        margin-bottom: .5rem;
    }

    .list-check>li::before {
        content: "\f00c";
        /* Font Awesome check */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: .15rem;
        color: #20c997;
    }

    /* Responsiveness */
    @media (max-width: 991.98px) {
        .chip {
            background: rgba(255, 255, 255, .18);
        }
    }

    /* ====== PLANT CARD ====== */
    .plant-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .06);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(16, 24, 40, .06), 0 2px 8px rgba(16, 24, 40, .05);
        overflow: hidden;
        display: grid;
        grid-template-rows: auto 1fr auto;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .plant-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 36px rgba(16, 24, 40, .10), 0 6px 16px rgba(16, 24, 40, .08);
        border-color: rgba(13, 110, 253, .18);
    }

    .plant-cover {
        margin: 0;
        position: relative;
        aspect-ratio: 16/10;
        /* responsif */
        background: linear-gradient(180deg, rgba(13, 110, 253, .06), rgba(32, 201, 151, .06));
    }

    .plant-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .plant-body {
        padding: 1rem 1rem .5rem 1rem;
    }

    .plant-title {
        font-size: clamp(1.05rem, .95rem + .5vw, 1.15rem);
        font-weight: 800;
        margin: 0;
    }

    .plant-latin {
        color: #6c757d;
        margin: .15rem 0 .5rem 0;
        font-size: .95rem;
    }

    /* Meta sebagai definition list rapi */
    .plant-meta {
        margin: .25rem 0 0 0;
    }

    .plant-meta dt {
        font-weight: 700;
        color: #0f2a4a;
        font-size: .95rem;
    }

    .plant-meta dd {
        margin: 0 0 .6rem 0;
        color: #495057;
    }

    /* Tags */
    .badge.tag {
        border-radius: 999px;
        background: #e7f1ff;
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, .2);
        font-weight: 600;
    }

    .badge.tag.alt {
        background: #e9f7f3;
        color: #109c7e;
        border-color: rgba(16, 156, 126, .2);
    }

    /* Actions */
    .plant-actions {
        padding: 0 1rem 1rem 1rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .btn-plant {
        --btn-bg: #0d6efd;
        background: var(--btn-bg);
        color: #fff !important;
        border-radius: 999px;
        padding: .55rem 1rem;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(13, 110, 253, .28);
        transition: transform .15s ease, box-shadow .2s ease, background-color .2s ease;
        text-decoration: none;
    }

    .btn-plant:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(13, 109, 253, 0.54);
        color: #0d6efd !important;
    }

    /* ====== Fade-in on scroll (pakai .reveal yang sudah ada) ====== */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        will-change: opacity, transform;
    }

    .reveal.is-visible {
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

    /* ====== Dark mode aware (opsional kalau pakai data-bs-theme="dark") ====== */
    [data-bs-theme="dark"] .plant-card {
        background: #0f1113;
        border-color: rgba(255, 255, 255, .08);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .45);
    }

    [data-bs-theme="dark"] .plant-meta dd {
        color: #cfd3d8
    }

    [data-bs-theme="dark"] .plant-meta dt {
        color: #e9ecef
    }

    [data-bs-theme="dark"] .badge.tag {
        background: rgba(13, 110, 253, .15);
        color: #9ec5fe;
        border-color: rgba(13, 110, 253, .25);
    }

    [data-bs-theme="dark"] .badge.tag.alt {
        background: rgba(16, 156, 126, .15);
        color: #94e2d0;
        border-color: rgba(16, 156, 126, .25);
    }

    /* ==== Plant Card ==== */
    .plant-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .06);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(16, 24, 40, .06), 0 2px 8px rgba(16, 24, 40, .05);
        overflow: hidden;
        display: grid;
        grid-template-rows: auto 1fr auto;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .plant-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 36px rgba(16, 24, 40, .10), 0 6px 16px rgba(16, 24, 40, .08);
        border-color: rgba(13, 110, 253, .18);
    }

    /* Cover */
    .plant-cover {
        margin: 0;
        position: relative;
        aspect-ratio: 16/10;
        background: linear-gradient(180deg, rgba(13, 110, 253, .06), rgba(32, 201, 151, .06));
    }

    .plant-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block
    }

    /* Body */
    .plant-body {
        padding: 1rem 1rem .25rem 1rem
    }

    .plant-title {
        font-size: clamp(1.05rem, .95rem + .5vw, 1.2rem);
        font-weight: 800
    }

    .plant-latin {
        color: #6c757d;
        font-size: .95rem
    }

    /* Meta (definition list) */
    .plant-meta {
        margin: .5rem 0 0 0
    }

    .plant-meta dt {
        font-weight: 700;
        color: #0f2a4a;
        font-size: .95rem
    }

    .plant-meta dd {
        margin: 0 0 .6rem 0;
        color: #495057
    }

    /* Tags */
    .badge.tag {
        border-radius: 999px;
        padding: .4rem .6rem;
        background: #e7f1ff;
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, .2);
        font-weight: 600;
    }

    .badge.tag.alt {
        background: #e9f7f3;
        color: #109c7e;
        border-color: rgba(16, 156, 126, .2);
    }

    .badge.tag.neutral {
        background: #f3f5f7;
        color: #495057;
        border-color: rgba(0, 0, 0, .08);
    }

    /* Actions */
    .plant-actions {
        padding: .75rem 1rem 1rem 1rem;
        display: flex;
        gap: .5rem;
        justify-content: flex-end;
        align-items: center;
    }

    .btn-plant {
        background: #0d6efd;
        color: #fff !important;
        border-radius: 999px;
        padding: .5rem 1rem;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(13, 110, 253, .28);
        transition: transform .15s ease, box-shadow .2s ease;
    }

    .btn-plant:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(13, 110, 253, .35)
    }

    .btn-plant-ghost {
        background: #eef4ff;
        color: #0d6efd !important;
        border-radius: 999px;
        padding: .5rem 1rem;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid rgba(13, 110, 253, .2);
    }

    .btn-plant-ghost:hover {
        background: #e7f1ff;
        color: #0d6efd !important;
        border: 1px solid rgba(13, 110, 253, .2);
    }

    /* “Tanamanku Lainnya” */
    .more-card {
        border: 1px dashed rgba(13, 110, 253, .25);
        background: linear-gradient(180deg, rgba(13, 110, 253, .04), rgba(32, 201, 151, .04));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .more-body {
        text-align: center;
        padding: 1rem 1.25rem
    }

    .btn-more {
        border-radius: 999px;
        padding: .55rem 1rem;
        font-weight: 700;
        text-decoration: none;
        background: #0d6efd;
        color: #fff !important;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 14px rgba(13, 110, 253, .28);
    }

    .btn-more:hover {
        filter: brightness(1.03)
    }

    /* Fade-in on scroll (pakai .reveal) */
    .reveal {
        opacity: 0;
        transform: translateY(14px);
        transition: opacity .6s ease, transform .6s ease;
        transition-delay: var(--d, 0ms);
        will-change: opacity, transform;
    }

    .reveal.is-visible {
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

    /* Dark mode aware (opsional jika pakai data-bs-theme="dark") */
    [data-bs-theme="dark"] .plant-card {
        background: #0f1113;
        border-color: rgba(255, 255, 255, .08);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .45);
    }

    [data-bs-theme="dark"] .plant-meta dd {
        color: #cfd3d8
    }

    [data-bs-theme="dark"] .plant-meta dt {
        color: #e9ecef
    }

    [data-bs-theme="dark"] .badge.tag {
        background: rgba(13, 110, 253, .15);
        color: #9ec5fe;
        border-color: rgba(13, 110, 253, .25)
    }

    [data-bs-theme="dark"] .badge.tag.alt {
        background: rgba(16, 156, 126, .15);
        color: #94e2d0;
        border-color: rgba(16, 156, 126, .25)
    }

    [data-bs-theme="dark"] .badge.tag.neutral {
        background: rgba(255, 255, 255, .06);
        color: #e2e6ea;
        border-color: rgba(255, 255, 255, .12)
    }

    :root {
        --surface: #ffffff;
        --bg: #f6f8fb;
        --border: #e6eaf0;
        --text: #1f2937;
        --muted: #6b7280;
        --accent: #2f7d32;
        /* hijau tanaman */
        --ring: rgba(47, 125, 50, .25);
        --shadow: 0 1px 2px rgba(16, 24, 40, .06), 0 8px 24px rgba(16, 24, 40, .06);
        --shadow-lg: 0 8px 24px rgba(16, 24, 40, .12);
    }

    /* ---- KARTU DETAIL ---- */
    .plant-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .plant-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(47, 125, 50, .25);
    }

    .plant-cover {
        --ratio: 16/9;
        margin: 0;
        block-size: auto;
        aspect-ratio: var(--ratio);
        background: var(--bg);
        overflow: hidden;
    }

    .plant-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transform: scale(1.02);
        transition: transform .6s cubic-bezier(.22, 1, .36, 1), filter .2s ease;
    }

    .plant-card:hover .plant-img {
        transform: scale(1.05);
    }

    .plant-body {
        padding: 1rem 1.25rem .5rem;
        color: var(--text);
    }

    .plant-title {
        font-weight: 700;
        letter-spacing: .2px;
    }

    .plant-latin {
        color: var(--muted);
        font-size: .95rem;
    }

    .plant-meta {
        margin: .75rem 0 0;
        display: grid;
        grid-template-columns: 160px 1fr;
        column-gap: .75rem;
        row-gap: .35rem;
    }

    .plant-meta dt {
        margin: 0;
        color: var(--muted);
        font-weight: 600;
    }

    .plant-meta dd {
        margin: 0;
        color: var(--text);
    }

    /* aksi di bawah kartu */
    .plant-actions {
        margin-top: auto;
        padding: 0 1.25rem 1.25rem;
    }

    .btn-plant {
        --btn-bg: var(--accent);
        --btn-bg-hover: #236b27;
        --btn-fg: #fff;
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: var(--btn-bg);
        color: var(--btn-fg);
        border: none;
        border-radius: 12px;
        padding: .65rem 1rem;
        font-weight: 600;
        text-decoration: none;
        transition: transform .15s ease, background .15s ease, box-shadow .15s ease;
    }

    .btn-plant:hover {
        background: var(--btn-bg-hover);
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-plant:focus-visible {
        outline: 2px solid transparent;
        box-shadow: 0 0 0 4px var(--ring);
    }

    /* ---- SECTION: TANAMAN LAINNYA ---- */
    /* Tambahkan class ini pada <section class="mt-5 plant-related"> */
    .plant-related h5 {
        font-weight: 700;
        letter-spacing: .2px;
    }

    .plant-related .related-list {
        display: flex;
        flex-direction: column;
        gap: .75rem;
    }

    .plant-related .related-item {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: .9rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        transition: background .2s ease, border-color .2s ease, transform .2s ease;
    }

    .plant-related .related-item:hover {
        border-color: rgba(47, 125, 50, .25);
        background: #fbfdfa;
        transform: translateY(-1px);
    }

    .plant-related .related-info .name {
        font-weight: 600;
        color: var(--text);
        line-height: 1.2;
    }

    .plant-related .related-info .latin {
        color: var(--muted);
        font-style: italic;
        font-size: .9rem;
    }

    .plant-related .btn-view {
        border-radius: 10px;
        font-weight: 600;
        padding: .5rem .75rem;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
    }

    .plant-related .btn-view i {
        transition: transform .15s ease;
    }

    .plant-related .btn-view:hover i {
        transform: translateX(2px);
    }

    /* ---- ANIMASI REVEAL ---- */
    .reveal {
        opacity: 0;
        transform: translateY(10px);
        animation: reveal .6s cubic-bezier(.22, 1, .36, 1) forwards;
        animation-delay: var(--d, 0ms);
    }

    @keyframes reveal {
        to {
            opacity: 1;
            transform: none;
        }
    }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 992px) {
        .plant-meta {
            grid-template-columns: 140px 1fr;
        }
    }

    @media (max-width: 576px) {
        .plant-meta {
            grid-template-columns: 1fr;
        }

        .plant-meta dt {
            margin-top: .5rem;
        }

        .plant-actions {
            padding: 0 1rem 1rem;
        }

        .plant-body {
            padding: .9rem 1rem .25rem;
        }
    }

    /* ---- DARK MODE ---- */
    @media (prefers-color-scheme: dark) {
        :root {
            --bg: #ffffffff;
            --border: #7a7a7adc;
            --text: #0b1220;
            --muted: #0b1220;
            --ring: rgba(34, 197, 94, .28);
            --shadow: 0 1px 2px rgba(0, 0, 0, .35), 0 8px 24px rgba(0, 0, 0, .35);
        }

        .plant-related .related-item:hover {
            background: #ffffffff;
        }
    }

    @media (min-width: 768px) {
        .plant-related {
            margin-top: 0 !important;
        }
    }



    /* new */
    /* SECTION related: header sticky, list scroll */
    .plant-related {
        display: flex;
        flex-direction: column;
        max-height: 200px;
        /* batas tinggi */
        overflow: hidden;
        /* sembunyikan overflow parent, biar yang scroll list-nya */
    }

    .plant-related>h5 {
        position: sticky;
        top: 0;
        z-index: 2;
        background: var(--surface, #fff);
        /* fallback jika variabel root belum ada */
        margin: 0 0 .75rem 0;
        padding: .5rem 0;
        border-bottom: 1px solid var(--border, #e6eaf0);
    }

    .plant-related .related-list {
        /* ini yang scroll */
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        /* Firefox */
        scrollbar-color: rgba(47, 125, 50, .45) transparent;
        padding-right: .25rem;
        /* beri ruang agar scrollbar tak nutup konten */
        min-height: 0;
        /* penting untuk flex child yg bisa scroll */
    }

    /* WebKit scrollbar */
    .plant-related .related-list::-webkit-scrollbar {
        width: 8px;
    }

    .plant-related .related-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .plant-related .related-list::-webkit-scrollbar-thumb {
        background: rgba(47, 125, 50, .45);
        border-radius: 8px;
    }

    .plant-related .related-list::-webkit-scrollbar-thumb:hover {
        background: rgba(47, 125, 50, .65);
    }

    /* Optional: nonaktifkan batas 500px di layar kecil agar tidak sempit */
    @media (max-width: 575.98px) {
        .plant-related {
            max-height: none;
        }
    }

    .badge-soft {
        background: rgba(78, 115, 223, .08);
        color: #4e73df;
        border: 1px solid rgba(78, 115, 223, .2);
        border-radius: 999px
    }
</style>

<!-- LOADER OVERLAY -->
<div id="app-loader" role="status" aria-live="polite" aria-label="Memuat halaman">
    <div class="loader-box">
        <div class="spinner-modern" aria-hidden="true"></div>
        <div class="loader-label">Memuat…</div>
        <div class="loader-hint">Mohon tunggu sebentar</div>
    </div>
</div>

<section class="section-about py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-modern px-3 py-2 rounded-3">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none"><i class="fa-solid fa-house me-1"></i>Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tanamanku</li>
            </ol>
        </nav>

        <header class="about-hero rounded-4 p-4 p-lg-5 mb-4 text-white">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">Tanamanku</h1>
                    <p class="lead mb-0 opacity-90">
                        TP PKK Kelurahan Lebak Denok — bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                    </p>
                </div>
                <div class="col-lg-4">
                    <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-lg-end mb-0">
                        <li><span class="chip"><i class="fa-solid fa-user me-2"></i><?= esc($row['petugas_nama']) ?></span></li>
                        <li>
                            <span class="chip"><i class="fa-solid fa-calendar me-2"></i>
                                <?php
                                $nowJakarta = Time::now('Asia/Jakarta');              // WIB
                                $labelNow   = $nowJakarta->toLocalizedString('d MMMM yyyy');
                                ?>
                                <?php echo $labelNow ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <article class="card shadow-soft border-0 rounded-4 overflow-hidden reveal" style="--d:120ms">
            <div class="card-body p-4 p-lg-5 content-typo">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge badge-soft px-3 py-2 mr-2"><i class="fa-solid fa-leaf"></i></span> Tanamanku
                </div>
                <!-- Grid Kartu Tanaman -->
                <div class="row g-4 align-items-start">
                    <!-- Kolom kiri -->
                    <div class="col-12 col-md-6">
                        <div class="plant-card h-100 reveal" style="--d:180ms">
                            <figure class="plant-cover">
                                <img
                                    src="<?= base_url('assets/uploads/tanaman/' . esc($row['foto_tanaman'])) ?>"
                                    alt="<?= esc($row['nama_umum']) ?> (<?= esc($row['nama_latin']) ?>)"
                                    class="plant-img">
                            </figure>

                            <div class="plant-body">
                                <h3 class="plant-title mb-0"><?= esc($row['nama_umum']) ?></h3>
                                <p class="plant-latin mb-2"><em><?= esc($row['nama_latin']) ?></em></p>

                                <dl class="plant-meta">
                                    <dt>Asal/Daerah</dt>
                                    <dd><?= esc($row['asal_daerah']) ?></dd>
                                    <dt>Manfaat</dt>
                                    <dd><?= esc($row['manfaat']) ?></dd>
                                    <dt>Keterangan</dt>
                                    <dd><?= esc($row['keterangan']) ?></dd>
                                    <dt>Tanggal Pendataan</dt>
                                    <dd><?= indo_date(esc($row['tanggal_pendataan'])) ?></dd>
                                    <dt>Lokasi GPS</dt>
                                    <dd><?= esc($row['lokasi_gps_lat']) . " . " . esc($row['lokasi_gps_lng']) ?></dd>
                                    <dt>Jumlah</dt>
                                    <dd><?= esc($row['jumlah']) ?></dd>
                                </dl>
                            </div>

                            <div class="plant-actions">
                                <a href="/tanamanku" class="btn btn-native rounded-pill py-2">
                                    <i class="fa-solid fa-arrow-left-long me-2" aria-hidden="true"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom kanan -->
                    <div class="col-12 col-md-6">
                        <?php if (!empty($related)) : ?>
                            <section class="plant-related"> <!-- hilangkan mt-5 -->
                                <h5 class="mb-3">Tanaman lainnya</h5>
                                <div class="related-list">
                                    <?php foreach ($related as $t): ?>
                                        <div class="related-item">
                                            <div class="related-info">
                                                <div class="name"><?= esc($t['nama_umum'] ?? '') ?></div>
                                                <div class="latin"><?= esc($t['nama_latin'] ?? '-') ?></div>
                                            </div>
                                            <a href="<?= site_url('tanamanku/detail/' . (int)($t['id_tanamanku'] ?? 0)) ?>" class="btn btn-native rounded-pill py2">
                                                Lihat <i class="fa-solid fa-arrow-right-long"></i>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </section>
                        <?php else: ?>
                            <div class="cover-nihil-data">
                                <h6>Tidak ada data saat ini!</h6>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </article>
    </div>
</section>

<script type="module">
    // Loader with minimal stay
    (function() {
        const LOADER_MIN_MS = 700;
        const loader = document.getElementById('app-loader');
        const start = Date.now();
        window.addEventListener('load', () => {
            const delay = Math.max(0, LOADER_MIN_MS - (Date.now() - start));
            setTimeout(() => {
                if (loader) {
                    loader.classList.add('hidden');
                    setTimeout(() => loader.remove(), 450);
                }
            }, delay);
        });
        window.addEventListener('pageshow', e => {
            if (e.persisted && loader) loader.classList.add('hidden');
        });
    })();

    // Sticky nav controller (menghindari CLS)
    document.addEventListener('DOMContentLoaded', () => {
        const topbar = document.querySelector('.navbar-information-sosmed');
        const nav = document.querySelector('nav.navbar');
        if (!nav) return;
        nav.classList.remove('sticky-top');
        const placeholder = document.createElement('div');
        placeholder.setAttribute('aria-hidden', 'true');
        placeholder.style.height = '5px';
        nav.parentNode.insertBefore(placeholder, nav.nextSibling);

        let threshold = 0;
        const recalc = () => {
            threshold = topbar ? topbar.offsetHeight : 0;
            if (nav.classList.contains('fixed-top')) placeholder.style.height = nav.offsetHeight + 'px';
        };
        const onScroll = () => {
            const y = window.scrollY || 0;
            if (y >= threshold) {
                if (!nav.classList.contains('fixed-top')) {
                    nav.classList.add('fixed-top');
                    placeholder.style.height = nav.offsetHeight + 'px';
                }
            } else {
                if (nav.classList.contains('fixed-top')) {
                    nav.classList.remove('fixed-top');
                    placeholder.style.height = '0px';
                }
            }
        };
        recalc();
        onScroll();
        window.addEventListener('resize', () => {
            recalc();
            onScroll();
        });
        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        setTimeout(() => {
            recalc();
            onScroll();
        }, 200);
    });

    // Reveal on view
    (function() {
        const items = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window) || !items.length) {
            items.forEach(el => el.classList.add('is-visible'));
            return;
        }
        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: .12,
            rootMargin: '0px 0px -8% 0px'
        });
        items.forEach((el, i) => {
            if (!el.style.getPropertyValue('--d')) el.style.setProperty('--d', (i % 8) * 60);
            io.observe(el);
        });
    })();
</script>

<?= $this->endSection() ?>
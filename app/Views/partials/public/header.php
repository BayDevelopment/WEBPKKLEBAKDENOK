<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Website resmi TP PKK Kelurahan Lebak Denok yang mempromosikan program-program kesejahteraan keluarga.">
    <meta name="keywords" content="PKK, Pkk Lebak Denok, Keluarga Sehat, Cerdas, Sejahtera, Program PKK, Kesejahteraan Keluarga">
    <meta property="og:title" content="TP PKK Kelurahan Lebak Denok">
    <meta property="og:description" content="Website resmi TP PKK Kelurahan Lebak Denok yang mempromosikan program-program kesejahteraan keluarga.">
    <meta property="og:image" content="<?= base_url('assets/img/logo-baru.jpg') ?>">
    <meta property="og:url" content="https://pkklebakdenok.my.id/">
    <title><?= esc($title) ?></title>
    <link rel="canonical" href="https://pkklebakdenok.my.id/"> <!-- Menghindari konten duplikat -->


    <!-- icon -->
    <link rel="icon" href="<?= base_url('assets/img/logo-baru.jpg') ?>" type="image/x-icon">
    <!-- font -->
    <link rel="preload" href="<?= base_url('assets/fonts/centurygothic.ttf') ?>"
        as="font" type="font/ttf" crossorigin>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- css external -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- cdn fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">



    <!-- css internal -->
    <style>
        /* Patch akhir: pastikan typed benar-benar responsif */
        #typed-container {
            display: block;
            width: 100%;
            max-width: 100%;
            min-height: 1em;
        }

        #typed {
            display: inline-block;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
            hyphens: auto;
            line-height: 1.3;
        }

        #typed {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(90deg, #138b318c, #138b318c, #ffffff);
            /* Gradien hijau, biru, putih */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            /* Efek bayangan untuk teks */
        }


        /* Cursor */
        .typed-cursor {
            display: inline-block;
            font-weight: 600;
            transform: translateY(0.05em);
        }

        /* Ukuran teks adaptif di HP */
        @media (max-width:575.98px) {
            .section-cover-jumbtron .fs-4 {
                font-size: clamp(16px, 5vw, 20px);
                line-height: 1.35;
                padding: 0 8px;
            }

            .section-cover-jumbtron .display-4 {
                font-size: clamp(22px, 8vw, 32px);
                line-height: 1.2;
                padding: 0 8px;
                word-break: break-word;
            }
        }

        /* Reveal util (gunakan .reveal + JS akan menambah .show) */
        .reveal {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity .6s ease, transform .6s ease;
            transition-delay: var(--d, 0ms);
            will-change: opacity, transform;
        }

        .reveal.show {
            opacity: 1;
            transform: none;
        }

        @media (prefers-reduced-motion:reduce) {

            .reveal,
            .reveal.show {
                transition: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }

        /* Particles tetap di belakang konten hero */
        #particles-js {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .section-cover-jumbtron .bg-body-jumbotron {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <header>
        <section class="navbar-information-sosmed py-2 bg-dark text-white">
            <div class="container">
                <!-- HILANG di mobile, MUNCUL mulai md -->
                <div class="d-none d-md-flex align-items-center justify-content-between gap-2">
                    <!-- KIRI -->
                    <div class="d-inline-flex align-items-center gap-3">
                        <a href="tel:0254-310067" class="text-native text-decoration-none d-inline-flex align-items-center gap-2">
                            <span><i class="fa-solid fa-phone"></i></span> 0254-310067
                        </a>
                        <a href="mailto:pkklebakdenok@example.com" class="text-native text-decoration-none d-inline-flex align-items-center gap-2">
                            <span><i class="fa-solid fa-envelope"></i></span> pkklebakdenok@gmail.com
                        </a>
                    </div>
                    <!-- KANAN -->
                    <div class="d-inline-flex align-items-center gap-3">
                        <a href="#" class="text-white text-decoration-none d-inline-flex align-items-center gap-2">
                            <i class="fa-brands fa-facebook-f"></i><span class="d-none d-sm-inline">Facebook</span>
                        </a>
                        <a href="https://www.instagram.com/pkkkellebakdenok/" class="text-white text-decoration-none d-inline-flex align-items-center gap-2">
                            <i class="fa-brands fa-instagram"></i><span class="d-none d-sm-inline">Instagram</span>
                        </a>
                    </div>
                </div>

                <!-- HANYA tampil di mobile -->
                <small class="d-block d-md-none text-center text-white mt-1">
                    Kerapihan administrasi adalah pondasi keberhasilan organisasi
                </small>
            </div>

        </section>

        <nav id="navbar" class="navbar navbar-expand-lg bg-body-native-navbar ">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?= base_url('assets/img/navbar-logo-new.png') ?>" alt="PKK LEBAK DENOK" class="w-navbar-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-modern">
                        <li class="nav-item">
                            <a class="nav-link <?= ($navLink === 'Beranda') ? 'active' : '' ?>"
                                aria-current="page"
                                href="<?= base_url('/') ?>">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($navLink === 'Tentang Kami') ? 'active' : '' ?>"
                                aria-current="page"
                                href="<?= base_url('/tentang-kami') ?>">Tentang Kami</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </a>
                            <!-- Tambah kelas: dropdown-menu-modern + dropdown-menu-cols-2 -->
                            <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-responsive" data-bs-auto-close="outside">
                                <li><a class="dropdown-item <?= ($navLink === 'Pendahuluan') ? 'active' : '' ?>"
                                        aria-current="page"
                                        href="<?= base_url('/pendahuluan') ?>">Pendahuluan</a></li>
                                <li><a class="dropdown-item <?= ($navLink === 'MaksudTujuan') ? 'active' : '' ?>"
                                        aria-current="page"
                                        href="<?= base_url('/maksud-dan-tujuan') ?>">Maksud dan Tujuan</a></li>
                                <li><a class="dropdown-item <?= ($navLink === 'VisiMisi') ? 'active' : '' ?>"
                                        aria-current="page"
                                        href="<?= base_url('/visi-misi-motto') ?>">Visi, Misi & Moto</a></li>
                                <li><a class="dropdown-item <?= ($navLink === 'KondisiWilayah') ? 'active' : '' ?>"
                                        aria-current="page"
                                        href="<?= base_url('/kondisi-wilayah') ?>">Kondisi Wilayah</a></li>
                                <li><a class="dropdown-item <?= ($navLink === 'Sekretariat') ? 'active' : '' ?>"
                                        aria-current="page"
                                        href="<?= base_url('/sekretariat') ?>">Sekretariat</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Galeri
                            </a>
                            <!-- Tambah kelas: dropdown-menu-modern + dropdown-menu-cols-2 -->
                            <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-responsive" data-bs-auto-close="outside">
                                <li><a class="dropdown-item <?= ($navLink === 'Tanamanku') ? 'active' : '' ?>"
                                        aria-current="page"
                                        href="<?= base_url('/tanamanku') ?>">Tanamanku</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="btn-native-quiz <?= ($navLink === 'Daftar Quiz') ? 'active' : '' ?>"
                                aria-current="page"
                                href="<?= base_url('/quiz-list') ?>"><i class="fa-solid fa-circle-question"></i>Kuis Sekarang</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
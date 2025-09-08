<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>
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
                        <a href="tel:082112341234" class="text-native text-decoration-none d-inline-flex align-items-center gap-2">
                            <span><i class="fa-solid fa-phone"></i></span> 082112341234
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
                        <a href="#" class="text-white text-decoration-none d-inline-flex align-items-center gap-2">
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

        <nav class="navbar navbar-expand-lg bg-body-native-navbar sticky-top">
            <div class="container">
                <a class="navbar-brand" href="/">PKK <span class="span-color">LEBAK DENOK</span></a>
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
                            <a class="btn-native-quiz <?= ($navLink === 'Kuis') ? 'active' : '' ?>"
                                aria-current="page"
                                href="<?= base_url('/kuis-masyarakat') ?>"><i class="fa-solid fa-circle-question"></i>Kuis Sekarang</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
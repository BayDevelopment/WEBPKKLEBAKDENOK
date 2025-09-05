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
                            <a class="nav-link <?= ($navLink === 'beranda') ? 'active' : '' ?>"
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
                                <li><a class="dropdown-item" href="#">Maksud dan Tujuan</a></li>
                                <li><a class="dropdown-item" href="#">Visi, Misi & Moto</a></li>
                                <li><a class="dropdown-item" href="#">Kondisi Wilayah</a></li>
                                <li><a class="dropdown-item" href="#">Kependudukan</a></li>
                                <li><a class="dropdown-item" href="#">Pendidikan</a></li>
                                <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                                <li><a class="dropdown-item" href="#">Profil Ketua dan Sekertaris</a></li>
                                <li><a class="dropdown-item" href="#">Perencanaan Kegiatan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Galeri
                            </a>
                            <!-- Tambah kelas: dropdown-menu-modern + dropdown-menu-cols-2 -->
                            <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-responsive" data-bs-auto-close="outside">
                                <li><a class="dropdown-item" href="#">Tanaman Hias</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="btn-native-quiz" href="#"><i class="fa-solid fa-circle-question"></i>Kuis Sekarang</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
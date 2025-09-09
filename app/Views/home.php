<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
<!-- CSS -->
<style>
    /* ====== Jumbotron Modern ====== */
    .section-cover-jumbotron {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: radial-gradient(1200px 600px at 20% 110%,
                rgba(13, 163, 222, 0.06),
                transparent),
            #fff;
        position: relative;
        color: white;
    }

    /* Text cutout gradient effect */
    .text-cutout {
        background: linear-gradient(90deg, #0da3de, #36c4f1, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 5s ease infinite;
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .text-gradient {
        background: linear-gradient(180deg,
                rgba(32, 181, 18, 0.29) 0%,
                rgba(228, 247, 236, 1) 0%,
                rgba(32, 181, 18, 0.13) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 500;
    }

    /* Button */
    .btn-primary {
        background: linear-gradient(90deg,
                rgba(51, 230, 60, 1) 0%,
                rgba(7, 145, 30, 1) 100%);
        border: none;
        font-weight: bold;
        padding: 1rem 2rem;
        border-radius: 50px;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        background: linear-gradient(90deg,
                rgba(51, 230, 60, 1) 0%,
                rgba(7, 145, 30, 1) 100%);
    }

    /* Particles full-screen behind content */
    #particles-js {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 2;
    }

    /* Fade-in animation */
    .reveal-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }

    .reveal-up.show {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive Text */
    @media (max-width: 768px) {
        .display-3 {
            font-size: 2.5rem;
        }

        .fs-4 {
            font-size: 1.5rem;
        }
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

<!-- MODAL WELCOME -->
<div class="modal fade modal-modern" id="welcomeModal" tabindex="-1" aria-hidden="true" aria-labelledby="welcomeTitle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-bar"></div>

            <div class="modal-header justify-content-center">
                <div class="modal-hero">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>

            <div class="modal-body text-center px-4 pb-4">
                <h5 id="welcomeTitle" class="fw-bold mb-2 text-start">
                    Selamat Datang di
                </h5>
                <h5 class="fw-bold mb-2 text-start">
                    TP PKK Kelurahan Lebak Denok
                </h5>
                <p class="text-muted mb-4 text-start">
                    Bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                </p>

                <!-- Landasan -->
                <div class="cover-judul-landasan">
                    <h5 class="fw-bold mb-2 text-center">Landasan</h5>
                </div>

                <div class="cover-paragraft-landasan">
                    <p class="text-muted mb-4 text-start">
                        1. Undang-undang Nomor 15 tentang Pembentukan Kota Madya Daerah Tingkat II Depok dan Kota Madya Daerah Tingkat II Cilegon (Lembaran Negara Tahun 1999 Nomor 49, Tambahan Lembaran Negara Nomor 3828);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        2. Undang-undang Nomor 32 Tahun 2004 tentang Pemerintah Daerah (Lembaran Negara Tahun 2004 Nomor 125, Tambahan Lembaran Negara Nomor 4437) sebagaimana telah diubah dengan undang-undang Nomor 87 tahun 2005 (Lembaran Negara Tahun Tahun 2005 Nomor 108, Tambahan Lembaran Negara Nomor 4548);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        3. Undang-undang Nomor 33 Tahun 2004 tentang perimbangan keuangan antara Pemerintah Pusat dan Daerah (Lembaran Negara Tahun 2004 Nomor 126, Tambahan Lembaran Negara Nomor 4438);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        4. Peraturan Pemerintah Nomor 58 Tahun 2005 tentang Pengelolaan Keuangan Daerah (Lembaran Negara Tahun 2005 Nomor 140, Tambahan Lembaran Negara Nomor 4578);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        5. Peraturan Pemerintah Nomor 73 Tahun 2005 tentang Kelurahan (Lembaran Negara Tahun 2005 Nomor 38, Tambahan Lembaran Negara Nomor 4493);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        6. Peraturan Pemerintah Nomor 11 Tahun 2003 tentang Pembentukan Perangkat Daerah Kota Cilegon (Lembaran Daerah Tahun 2003 Nomor 168, Tambahan Lembaran Negara Nomor 13) sebagaimana telah diubah dengan peraturan daerah Kota Cilegon Nomor 4 Tahun 2006 (Lembaran Daerah Tahun 2006 Nomor 4);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        7. Peraturan Daerah Kota Cilegon Nomor 10 Tahun 2008 tentang Organisasi dan Tata Kerja Kecamatan dan Kelurahan Kota Cilegon (Lembaran Daerah Tahun 2008 Nomor 10, Tambahan Lembaran Daerah Nomor 36);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        8. Peraturan Daerah Kota Cilegon Nomor 6 Tahun 2010 tentang Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2011 (Lembaran Daerah Tahun 2010 Nomor 1);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        9. Keputusan Menteri Dalam Negeri dan Otonomi Daerah Nomor 53 Tahun 2000 tanggal 22 Desember 2000 Tentang Gerakan Pemberdayaan dan Kesejahteraan Keluarga (PKK);
                    </p>
                    <p class="text-muted mb-4 text-start">
                        10. Keputusan Menteri Dalam Negeri Nomor 159 Tahun 2004 tentang Pedoman Organisasi Desa dan Kelurahan;
                    </p>
                    <p class="text-muted mb-4 text-start">
                        11. Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 tentang Pedoman Pengelolaan Keuangan Daerah, sebagaimana telah diubah Permendagri Nomor 59 Tahun 2007;
                    </p>
                    <p class="text-muted mb-4 text-start">
                        12. Peraturan Walikota Kota Cilegon Nomor 25 Tahun 2011 tentang Penjabaran Dokumen Pelaksanaan Anggaran Satuan Kerja Perangkat Daerah Tahun 2011;
                    </p>
                    <p class="text-muted mb-4 text-start">
                        13. Berdasarkan Hasil Rakernas IX/Tahun 2021 tentang pedoman pengelolaan Gerakan PKK;
                    </p>
                    <p class="text-muted mb-4 text-start">
                        14. Berdasarkan Keputusan Lurah Lebak Denok Nomor : 400.10.4.3/Kep.07/PPM/2025 Tentang Penetapan dan Pengesahan Susunan Pengurus Baru Tim Penggerak PKK Kelurahan Lebak Denok Kecamatan Citangkil Kota Cilegon Tahun 2025.
                    </p>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <a href="/program" class="btn btn-brand">
                        Lihat Program
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Jumbotron Modern -->
<section class="section-cover-jumbotron position-relative reveal reveal-up">
    <!-- Particles -->
    <div id="particles-js"></div>

    <!-- Konten -->
    <div class="container text-center py-5 position-relative text-white">
        <h1 class="display-3 fw-bold text-uppercase text-cutout">TP PKK Kelurahan Lebak Denok</h1>
        <p class="fs-4 mt-3 text-gradient">
            <span id="typed-container"><span id="typed"></span></span>
        </p>
        <a href="#kontak" class="btn btn-lg btn-primary mt-4 shadow-lg">Gabung Bersama Kami</a>
    </div>
</section>

<section class="section-intro py-5 py-lg-6 ">
    <div class="container">
        <div class="row align-items-center g-4">
            <!-- Gambar (muncul dulu di mobile) -->
            <div class="col-lg-6 order-1 order-lg-2 reveal">
                <div class="illustration-wrap">
                    <img
                        src="<?= base_url('assets/img/section-content.png') ?>"
                        alt="Ilustrasi kegiatan TP PKK Kelurahan Lebak Denok"
                        class="img-fluid rounded-4 shadow-sm"
                        loading="lazy">
                </div>
            </div>

            <!-- Konten teks -->
            <div class="col-lg-6 order-2 order-lg-1 reveal">
                <h2 class="section-title h2 fw-bold mb-3 mt-5">Pendahuluan</h2>
                <p class="lead text-muted mb-3">
                    Hakikat pembangunan nasional membangun manusia seutuhnya dan membangun masyarakat Indonesia seluruhnya.
                    Hakekat pembangunan nasional akan terwujud apabila kesejahteraan keluarga dan masyarakat dapat terlaksana dengan baik.
                </p>
                <p class="lead text-muted mb-4">
                    Dalam usaha untuk mencapai keluarga dan masyarakat yang sejahtera tersebut maka dilaksanakanlah 10 Program Pokok PKK.
                    10 Program Pokok PKK merupakan dasar manusia yang hendaknya dilaksanakan oleh setiap keluarga.
                </p>

                <div class="d-flex gap-2">
                    <a href="/pendahuluan" class="btn-native" aria-label="Baca selengkapnya pendahuluan"><span><i class="fa-solid fa-eye"></i></span> Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-city py-5 py-lg-6 reveal">
    <div class="container">
        <h2 class="section-title h2 fw-bold mb-4 text-center">Gambaran Kota Cilegon</h2>

        <!-- Gambar utama (hero) -->
        <div class="first-img mb-4">
            <div class="media-wrap ratio-16x9 rounded-4 shadow-sm overflow-hidden">
                <img
                    src="<?= base_url('assets/img/peta-ket-cilegon.jpg') ?>"
                    alt="Peta & gambaran wilayah Kota Cilegon"
                    class="w-100 h-100 obj-contain"
                    loading="lazy">
            </div>
        </div>

        <!-- Grid konten -->
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <div class="second-img">
                    <div class="media-wrap ratio-4x3 rounded-4 shadow-sm overflow-hidden">
                        <img
                            src="<?= base_url('assets/img/7-kelurahan.jpg') ?>"
                            alt="Peta Kecamatan Citangkil — Kota Cilegon"
                            class="w-100 h-100 obj-cover"
                            loading="lazy">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="content-second">
                    <p class="lead text-muted mb-0">
                        <strong>Letak Geografis dan Luas Wilayah.</strong>
                        Secara administratif Kecamatan Citangkil terbagi dalam 7 Kelurahan, 49 RW dan 175 Rukun RT.
                        Luas Wilayah Kecamatan Citangkil adalah 22,98 KM dan dihuni oleh 67.513 jiwa. Kelurahan di Kecamatan
                        Citangkil yang memiliki luas daerah terluas adalah Kelurahan Warnasari yaitu seluas 5,51 KM (±23,98% dari
                        total wilayah). Sedangkan yang terkecil adalah Kelurahan Citangkil dengan luas 1,55 KM (±6,74%).
                    </p>
                </div>
            </div>
            <div class="justify-content-center text-center gap-2">
                <a href="/kondisi-wilayah" class="btn-native" aria-label="Baca selengkapnya pendahuluan"><span><i class="fa-solid fa-eye"></i></span> Selengkapnya</a>
            </div>
        </div>
    </div>
</section>
<section class="section-why-pkk py-5 py-lg-6 reveal">
    <div class="container">
        <h2 class="section-title h2 fw-bold mb-4 text-center">
            Kenapa PKK penting dipahami dan diadakan?
        </h2>

        <div class="row g-4">
            <!-- 1 -->
            <div class="col-md-6 col-lg-4">
                <article class="feature-card h-100">
                    <div class="icon-wrap">
                        <img src="<?= base_url('assets/img/family.png') ?>" alt="Keluarga Sehat" class="feature-icon" loading="lazy">
                    </div>
                    <h6 class="feature-title">Menguatkan keluarga (fondasi masyarakat)</h6>
                    <p class="feature-text">
                        PKK mendorong pola asuh, gizi, kesehatan, dan pendidikan anak (pencegahan stunting, imunisasi, BKB, Posyandu).
                        Keluarga sehat → lingkungan kuat.
                    </p>
                </article>
            </div>

            <!-- 2 -->
            <div class="col-md-6 col-lg-4">
                <article class="feature-card h-100">
                    <div class="icon-wrap">
                        <img src="<?= base_url('assets/img/umkm.png') ?>" alt="Ekonomi Keluarga" class="feature-icon" loading="lazy">
                    </div>
                    <h6 class="feature-title">Meningkatkan ekonomi rumah tangga</h6>
                    <p class="feature-text">
                        Lewat UP2K/UMKM, pelatihan keterampilan, dan literasi keuangan; ibu-ibu bisa menambah penghasilan
                        dan kemandirian keluarga.
                    </p>
                </article>
            </div>

            <!-- 3 -->
            <div class="col-md-6 col-lg-4">
                <article class="feature-card h-100">
                    <div class="icon-wrap">
                        <img src="<?= base_url('assets/img/community.png') ?>" alt="Partisipasi Warga" class="feature-icon" loading="lazy">
                    </div>
                    <h6 class="feature-title">Memperkuat partisipasi & tata kelola di tingkat RT/RW</h6>
                    <p class="feature-text">
                        PKK jadi jembatan warga–kelurahan: pendataan dasawisma, musyawarah, gotong royong; program pemerintah lebih tepat sasaran.
                    </p>
                </article>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/hubungi-kami" class="btn-native" aria-label="Hubungi kami"><i class="fa-solid fa-tty me-2"></i>Hubungi Kami</a>
        </div>
    </div>
</section>


<?= $this->endSection() ?>
<?= $this->extend('templates/template_public') ?>

<?= $this->section('content_public') ?>
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
                <div class="modal-hero"><i class="fa-solid fa-heart"></i></div>
            </div>
            <div class="modal-body text-center px-4 pb-4">
                <h5 id="welcomeTitle" class="fw-bold mb-2">Selamat Datang di TP PKK Kelurahan Lebak Denok</h5>
                <p class="text-muted mb-4">
                    Bersama mewujudkan keluarga sehat, cerdas, dan sejahtera.
                </p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="#" class="btn btn-brand">Lihat Program</a>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="section-cover-jumbtron">
    <div class="p-5 mb-4 bg-body-jumbotron">
        <div class="container justify-content-center text-center py-5">
            <h3 class="display-4 text-uppercase text-cutout">tp pkk kelurahan lebak denok</h3>
            <p class="fs-4 text-gradient"><span id="typed"></span></p>
        </div>
    </div>
</section>
<section class="section-intro py-5 py-lg-6">
    <div class="container">
        <div class="row align-items-center g-4">
            <!-- Gambar (muncul dulu di mobile) -->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="illustration-wrap">
                    <img
                        src="<?= base_url('assets/img/section-content.png') ?>"
                        alt="Ilustrasi kegiatan TP PKK Kelurahan Lebak Denok"
                        class="img-fluid rounded-4 shadow-sm"
                        loading="lazy">
                </div>
            </div>

            <!-- Konten teks -->
            <div class="col-lg-6 order-2 order-lg-1">
                <h2 class="section-title h2 fw-bold mb-3 mt-3">Pendahuluan</h2>
                <p class="lead text-muted mb-3">
                    Hakikat pembangunan nasional membangun manusia seutuhnya dan membangun masyarakat Indonesia seluruhnya.
                    Hakekat pembangunan nasional akan terwujud apabila kesejahteraan keluarga dan masyarakat dapat terlaksana dengan baik.
                </p>
                <p class="lead text-muted mb-4">
                    Dalam usaha untuk mencapai keluarga dan masyarakat yang sejahtera tersebut maka dilaksanakanlah 10 Program Pokok PKK.
                    10 Program Pokok PKK merupakan dasar manusia yang hendaknya dilaksanakan oleh setiap keluarga.
                </p>

                <div class="d-flex gap-2">
                    <a href="#" class="btn-native" aria-label="Baca selengkapnya pendahuluan"><span><i class="fa-solid fa-eye"></i></span> Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-city py-5 py-lg-6">
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
                <a href="#" class="btn-native" aria-label="Baca selengkapnya pendahuluan"><span><i class="fa-solid fa-eye"></i></span> Selengkapnya</a>
            </div>
        </div>
    </div>
</section>
<section class="section-why-pkk py-5 py-lg-6">
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
            <a href="#" class="btn-native" aria-label="Hubungi kami"><i class="fa-solid fa-tty me-2"></i>Hubungi Kami</a>
        </div>
    </div>
</section>


<?= $this->endSection() ?>
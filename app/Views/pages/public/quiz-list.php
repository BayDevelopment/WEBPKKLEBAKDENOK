<?= $this->extend('templates/template_public') ?>
<?= $this->section('content_public') ?>

<?php
// --- DETEKSI MODE "SEMUA" ---
// 1) Ambil dari controller jika dikirim, contoh: return view(..., ['kategori' => 'Semua'])
$kategoriFromController = isset($kategori) ? strtolower(trim($kategori)) : '';

// 2) Ambil dari query string (?kategori=semua | all) jika ada
$req = service('request');
$kategoriFromQuery = strtolower(trim($req->getGet('kategori') ?? ''));

// 3) Putuskan apakah hanya tampilkan 1 card "Semua Kategori"
$onlyAll = in_array($kategoriFromController, ['semua', 'all'], true)
    || in_array($kategoriFromQuery, ['semua', 'all'], true);

// 4) (Opsional) coba cari baris quiz ALL di $quizzes, agar bisa pakai judul/desc/thumbnail-nya jika ada
$allQuizRow = null;
if (!empty($quizzes) && is_array($quizzes)) {
    foreach ($quizzes as $qq) {
        if (
            (isset($qq['is_virtual_all']) && (int)$qq['is_virtual_all'] === 1) ||
            (isset($qq['kategori']) && strtolower($qq['kategori']) === 'semua') ||
            (isset($qq['slug']) && strtolower($qq['slug']) === 'semua-kategori') ||
            (isset($qq['judul']) && strtolower($qq['judul']) === 'semua kategori')
        ) {
            $allQuizRow = $qq;
            break;
        }
    }
}
?>

<style>
    .hero-all {
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 14px 40px rgba(15, 23, 42, .10);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
        position: relative;
        overflow: hidden
    }

    .hero-all::before {
        content: "";
        position: absolute;
        inset: -60px -20px auto -20px;
        height: 180px;
        background:
            radial-gradient(600px 200px at 10% 0%, rgba(78, 115, 223, .10), transparent 60%),
            radial-gradient(560px 200px at 90% 0%, rgba(28, 200, 138, .10), transparent 60%);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff;
        border: 0;
        border-radius: 999px;
        padding: .6rem 1rem;
        box-shadow: 0 6px 14px rgba(78, 115, 223, .25)
    }

    .btn-gradient:hover {
        filter: saturate(1.05);
        transform: translateY(-1px)
    }

    .card-quiz {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .08);
        transition: .15s;
        overflow: hidden
    }

    .card-quiz:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .12)
    }

    .kat-pill {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .3rem .7rem;
        font-size: .75rem;
        font-weight: 600;
        border-radius: 999px;
        background: #eef7ff;
        color: #0b5ed7;
        border: 1px solid rgba(13, 110, 253, .15)
    }
</style>

<div class="container py-4 mt-4">

    <?php if ($onlyAll): ?>
        <!-- MODE SEMUA: tampilkan 1 card saja -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card card-quiz h-100">
                    <?php if (!empty($allQuizRow['thumbnail'])): ?>
                        <img src="<?= base_url('assets/uploads/quiz/' . esc($allQuizRow['thumbnail'])) ?>"
                            class="card-img-top"
                            alt="Thumbnail <?= esc($allQuizRow['judul'] ?? 'Semua Kategori') ?>"
                            style="object-fit:cover;height:180px">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height:180px">
                            <i class="fa-solid fa-layer-group text-muted"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <span class="kat-pill mb-2"><i class="fa-solid fa-tag"></i> Semua</span>
                        <h5 class="card-title fw-bold mb-1">
                            <?= esc($allQuizRow['judul'] ?? 'Semua Kategori') ?>
                        </h5>
                        <p class="card-text text-muted flex-grow-1">
                            <?= esc($allQuizRow['deskripsi'] ?? 'Kumpulan soal dari semua quiz aktif.') ?>
                        </p>

                        <a href="<?= site_url('quiz/take/all') ?>" class="btn btn-outline-primary mt-2">
                            <i class="fa-solid fa-circle-play"></i> Mulai (Semua Kategori)
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- MODE BIASA: tampilkan daftar semua quiz -->
        <h5 class="fw-bold mb-3"><i class="fa-solid fa-list"></i> Daftar Quiz</h5>
        <div class="row">
            <?php if (!empty($quizzes)): ?>
                <?php foreach ($quizzes as $q): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card card-quiz h-100">
                            <?php if (!empty($q['thumbnail'])): ?>
                                <img src="<?= base_url('assets/uploads/quiz/' . esc($q['thumbnail'])) ?>"
                                    class="card-img-top"
                                    alt="Thumbnail <?= esc($q['judul']) ?>"
                                    style="object-fit:cover;height:160px">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height:160px">
                                    <i class="fa-solid fa-image text-muted"></i>
                                </div>
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <span class="kat-pill mb-2"><i class="fa-solid fa-tag"></i> <?= esc($q['kategori']) ?></span>
                                <h5 class="card-title fw-bold mb-1"><?= esc($q['judul']) ?></h5>
                                <p class="card-text text-muted flex-grow-1"><?= esc($q['deskripsi'] ?? '—') ?></p>

                                <!-- Semua tombol diarahkan ke ALL sesuai permintaan -->
                                <a href="<?= site_url('quiz/take/all') ?>" class="btn btn-outline-primary mt-2">
                                    <i class="fa-solid fa-circle-play"></i> Mulai (Semua Kategori)
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info mb-0">Belum ada quiz tersedia.</div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
<?= $this->extend('templates/template_public') ?>
<?= $this->section('content_public') ?>

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

    <!-- MODE SEMUA: tampilkan 1 card saja -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?php if (!empty($quizzes)): ?>
                <?php foreach ($quizzes as $row): ?>
                    <div class="card card-quiz h-100 shadow-sm border-0">
                        <?php if (!empty($row['thumbnail'])): ?>
                            <img src="<?= base_url('assets/uploads/quiz/' . esc($row['thumbnail'])) ?>"
                                class="card-img-top rounded-top"
                                alt="Thumbnail <?= esc($row['judul'] ?? 'Semua Kategori') ?>"
                                style="object-fit:cover;height:180px">
                        <?php else: ?>
                            <!-- Header placeholder modern ketika tidak ada thumbnail -->
                            <div class="d-flex align-items-center justify-content-center bg-light rounded-top"
                                style="height:180px">
                                <i class="fa-solid fa-layer-group text-muted" style="font-size:38px;"></i>
                            </div>
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <span class="kat-pill mb-2"><i class="fa-solid fa-tag"></i> <?= esc($row['kategori']) ?></span>
                            <h5 class="card-title font-weight-bold mb-1">
                                <?= esc($row['judul'] ?? '-') ?>
                            </h5>
                            <p class="card-text text-muted flex-grow-1">
                                <?= esc($row['deskripsi'] ?? '-') ?>
                            </p>

                            <?php
                            $isAll = (int)($row['is_virtual_all'] ?? 0) === 1;
                            $kat   = $row['kategori'] ?? 'Semua';
                            ?>

                            <?php if ($isAll): ?>
                                <a href="<?= site_url('quiz/take/all') ?>" class="btn btn-gradient mt-2">
                                    <i class="fa-solid fa-circle-play"></i>
                                    Mulai <?= esc('(' . $kat . ')') ?>
                                </a>
                            <?php else: ?>
                                <!-- disabled -->
                                <a href="javascript:void(0)"
                                    class="btn btn-gradient mt-2 disabled"
                                    tabindex="-1" aria-disabled="true" onclick="return false;">
                                    <i class="fa-solid fa-circle-play"></i>
                                    Mulai <?= esc('(' . $kat . ')') ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty state modern saat TIDAK ADA quiz sama sekali -->
                <div class="card card-quiz h-100 shadow-sm border-0 d-flex align-items-center justify-content-center p-4">
                    <div class="text-center">
                        <img src="<?= base_url('assets/img/icons-empty.png') ?>"
                            alt="no quiz"
                            style="width:100px;opacity:.9" class="mb-3">
                        <h5 class="font-weight-bold text-muted mb-2">Belum Ada Quiz</h5>
                        <p class="text-secondary small mb-3" style="max-width:320px;margin:0 auto;">
                            Quiz untuk kategori ini belum tersedia. Silakan cek kembali nanti ya ✨
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="<?= site_url('/') ?>" class="btn btn-outline-primary rounded-pill px-3">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
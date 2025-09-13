<!-- app/Views/public/result_all.php -->
<?= $this->extend('templates/template_public') ?>
<?= $this->section('content_public') ?>

<style>
    .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid rgba(0, 0, 0, .06)
    }

    .badge-soft.ok {
        background: #e9f9ef;
        color: #198754
    }

    .badge-soft.no {
        background: #fff2f2;
        color: #dc3545
    }

    .card-modern {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08)
    }

    .src-pill {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .25rem .6rem;
        border-radius: 999px;
        background: #f1f5f9;
        font-size: .75rem
    }
</style>

<div class="container py-4">
    <div class="card card-modern mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1 fw-bold">Hasil: <?= esc($quiz['judul']) ?></h4>
                <div class="text-muted">Terima kasih atas partisipasinya!</div>
            </div>
            <div>
                <span class="badge-soft ok">Benar: <?= (int)$benar ?></span>
                <span class="badge-soft no">Salah: <?= (int)$salah ?></span>
                <span class="badge-soft">Skor: <strong><?= (int)$score ?></strong></span>
            </div>
        </div>
    </div>

    <?php $i = 1;
    foreach ($results as $r): ?>
        <div class="card card-modern mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Soal <?= $i++ ?></h6>
                    <span class="src-pill"><i class="fa-solid fa-tag"></i> <?= esc($r['kategori']) ?> • <?= esc($r['quiz_judul']) ?></span>
                </div>
                <p class="mb-2"><?= esc($r['pertanyaan']) ?></p>

                <ul class="list-unstyled mb-0">
                    <?php foreach (['A', 'B', 'C', 'D'] as $opt):
                        $field = 'opsi_' . strtolower($opt);
                        if (empty($r[$field])) continue; ?>
                        <li class="mb-1">
                            <?php if ($opt === $r['benar']): ?>
                                <strong>✔ <?= $opt ?>.</strong> <?= esc($r[$field]) ?> <span class="text-success">(kunci)</span>
                            <?php else: ?>
                                <span><?= $opt ?>.</span> <?= esc($r[$field]) ?>
                            <?php endif; ?>
                            <?php if ($opt === ($r['jawaban'] ?? '')): ?>
                                <?= $r['is_correct'] ? '<span class="text-success"> — jawabanmu benar</span>' : '<span class="text-danger"> — jawabanmu salah</span>' ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
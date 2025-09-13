<?= $this->extend('templates/template_public') ?>
<?= $this->section('content_public') ?>

<style>
    .kat-pill {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .3rem .7rem;
        font-size: .8rem;
        font-weight: 600;
        border-radius: 999px;
        background: #eef7ff;
        color: #0b5ed7;
        border: 1px solid rgba(13, 110, 253, .15)
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

    .card-q {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .08);
        margin-bottom: 1rem
    }

    .opt {
        display: flex;
        gap: .6rem;
        align-items: flex-start;
        padding: .55rem .8rem;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        cursor: pointer
    }

    .opt:hover {
        background: #f9fafb
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff;
        border: 0;
        border-radius: 999px;
        padding: .65rem 1.2rem;
        box-shadow: 0 8px 18px rgba(78, 115, 223, .25)
    }

    .progress-mini {
        height: 8px;
        background: #eef2ff;
        border-radius: 9999px;
        overflow: hidden;
        margin: .75rem 0 1rem
    }

    .progress-mini>span {
        display: block;
        height: 100%;
        background: linear-gradient(90deg, #4e73df, #36b9cc)
    }

    .quiz-hero {
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 14px 40px rgba(15, 23, 42, .10);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem
    }
</style>

<div class="container py-4 mt-4">
    <?php if (!empty($quiz) && !empty($questions)): ?>
        <!-- Header -->
        <section class="quiz-hero">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="kat-pill"><i class="fa-solid fa-layer-group"></i> Semua Kategori</span>
                <?php if ((int)($quiz['durasi_menit'] ?? 0) > 0): ?>
                    <span class="src-pill" id="pillTimer" data-min="<?= (int)$quiz['durasi_menit'] ?>">⏱ <b id="timerText"></b></span>
                <?php endif; ?>
            </div>
            <h2 class="fw-bold mb-0"><?= esc($quiz['judul']) ?></h2>
            <?php if (!empty($quiz['deskripsi'])): ?>
                <p class="text-muted mb-0"><?= esc($quiz['deskripsi']) ?></p>
            <?php endif; ?>
        </section>

        <!-- Form gabungan -->
        <form method="post" action="<?= site_url('quiz/submit-all') ?>" id="formQuiz">
            <?= csrf_field() ?>

            <!-- Progress -->
            <div class="progress-mini"><span id="barProg" style="width:0%"></span></div>

            <?php $total = count($questions);
            $no = 1;
            foreach ($questions as $q): ?>
                <div class="card card-q">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Soal <?= $no ?> dari <?= $total ?></h6>
                            <span class="src-pill"><i class="fa-solid fa-tag"></i> <?= esc($q['kategori']) ?> • <?= esc($q['quiz_judul']) ?></span>
                        </div>
                        <p class="mb-3"><?= esc($q['pertanyaan']) ?></p>
                        <?php if (!empty($q['gambar'])): ?>
                            <img src="<?= base_url('assets/uploads/quiz/' . $q['gambar']) ?>" class="img-fluid rounded mb-3" alt="gambar soal">
                        <?php endif; ?>

                        <?php foreach (['A', 'B', 'C', 'D'] as $opt):
                            $field = 'opsi_' . strtolower($opt);
                            if (empty($q[$field])) continue; ?>
                            <label class="opt w-100 mb-2">
                                <input type="radio" name="q_<?= (int)$q['id_pertanyaan'] ?>" value="<?= $opt ?>">
                                <span><b><?= $opt ?>.</b> <?= esc($q[$field]) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php $no++;
            endforeach; ?>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">Pastikan semua soal sudah dijawab.</small>
                <button type="submit" class="btn btn-gradient"><i class="fa-solid fa-paper-plane"></i> Kirim Jawaban</button>
            </div>
        </form>

        <!-- Timer & Progress -->
        <script>
            // Timer (opsional jika durasi_menit > 0)
            (function() {
                const pill = document.getElementById('pillTimer');
                if (!pill) return;
                let s = parseInt(pill.getAttribute('data-min') || '0', 10) * 60;
                const text = document.getElementById('timerText');

                function fmt(n) {
                    const m = Math.floor(n / 60),
                        ss = n % 60;
                    return `${String(m).padStart(2,'0')}:${String(ss).padStart(2,'0')}`
                }
                text.textContent = fmt(s);
                const iv = setInterval(function() {
                    s--;
                    text.textContent = fmt(Math.max(0, s));
                    if (s <= 0) {
                        clearInterval(iv);
                        document.getElementById('formQuiz').submit();
                    }
                }, 1000);
            })();

            // Progress bar
            (function() {
                const form = document.getElementById('formQuiz');
                const total = <?= (int)$total ?>;
                const bar = document.getElementById('barProg');

                function update() {
                    const answered = new Set();
                    form.querySelectorAll('input[type="radio"]:checked').forEach(i => answered.add(i.name));
                    bar.style.width = Math.round((answered.size / total) * 100) + '%';
                }
                form.addEventListener('change', update);
            })();
        </script>

    <?php else: ?>
        <div class="alert alert-info">Quiz atau pertanyaan tidak ditemukan.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
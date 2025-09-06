<?= $this->extend('templates/template_public') ?>
<?= $this->section('content_public') ?>

<div class="container py-5">
    <div id="quiz-box" class="card shadow-sm border-0 rounded-4 p-4 mx-auto" style="max-width: 700px;">
        <h3 class="fw-bold mb-3">Kuis Interaktif</h3>
        <div id="question" class="mb-3 fw-semibold"></div>
        <div id="options" class="d-grid gap-2"></div>

        <div class="d-flex justify-content-between mt-4">
            <button id="nextBtn" class="btn btn-native d-none">Soal Berikutnya</button>
            <button id="exitBtn" class="btn btn-native">Keluar</button>
        </div>
    </div>
</div>

<script>
    // ===== DATA SOAL =====
    const quizData = [{
            question: "1. Ibu kota Indonesia adalah?",
            options: ["A. Bandung", "B. Jakarta", "C. Surabaya", "D. Medan"],
            answer: 1
        },
        {
            question: "2. 2 + 2 x 2 = ?",
            options: ["A. 6", "B. 8", "C. 4", "D. 10"],
            answer: 0
        },
        {
            question: "3. Lambang unsur Oksigen adalah?",
            options: ["A. Ox", "B. Og", "C. O", "D. On"],
            answer: 2
        }
    ];

    let currentQuestion = 0;

    const questionEl = document.getElementById("question");
    const optionsEl = document.getElementById("options");
    const nextBtn = document.getElementById("nextBtn");
    const exitBtn = document.getElementById("exitBtn");

    function loadQuestion() {
        const q = quizData[currentQuestion];
        questionEl.textContent = q.question;
        optionsEl.innerHTML = "";

        q.options.forEach((opt, idx) => {
            const btn = document.createElement("button");
            btn.className = "btn btn-light border rounded text-start";
            btn.textContent = opt;
            btn.onclick = () => checkAnswer(idx, btn);
            optionsEl.appendChild(btn);
        });
        nextBtn.classList.add("d-none");
    }

    function checkAnswer(selectedIdx, btn) {
        const q = quizData[currentQuestion];
        const allBtns = optionsEl.querySelectorAll("button");

        // disable all
        allBtns.forEach(b => b.disabled = true);

        if (selectedIdx === q.answer) {
            btn.classList.remove("btn-light", "border");
            btn.classList.add("border", "border-success", "bg-success", "text-white");
        } else {
            btn.classList.remove("btn-light", "border");
            btn.classList.add("border", "border-danger", "bg-danger", "text-white");

            // highlight correct
            allBtns[q.answer].classList.add("border", "border-success", "bg-success", "text-white");
        }
        nextBtn.classList.remove("d-none");
    }

    nextBtn.addEventListener("click", () => {
        currentQuestion++;
        if (currentQuestion < quizData.length) {
            loadQuestion();
        } else {
            questionEl.textContent = "🎉 Kuis selesai! Terima kasih atas partisipasi Anda.";
            optionsEl.innerHTML = "";

            nextBtn.classList.add("d-none");

            const restartBtn = document.createElement("button");
            restartBtn.className = "btn btn-native mt-3";
            restartBtn.textContent = "Ulangi Kuis";
            restartBtn.onclick = () => {
                currentQuestion = 0;
                loadQuestion();
            };
            optionsEl.appendChild(restartBtn);
        }

    });

    exitBtn.addEventListener("click", () => {
        window.location.href = "/"; // arahkan ke beranda, ubah sesuai kebutuhan
    });

    // init
    loadQuestion();
</script>

<?= $this->endSection() ?>
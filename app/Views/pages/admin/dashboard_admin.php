<?php
if (!function_exists('slug_view')) {
    function slug_view(string $s): string
    {
        $s = strtolower(trim($s));
        $s = preg_replace('~[^\pL\d]+~u', '-', $s);
        $s = preg_replace('~[-]+~', '-', $s);
        $s = trim($s, '-');
        return $s === '' ? 'x' : $s;
    }
}
?>


<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>
<style>
    /* ====== BASE (Desktop besar) ====== */
    .sidebar .sidebar-card-illustration {
        width: 140px;
        /* default besar di desktop */
        height: auto;
        transition: width .2s ease, transform .2s ease, opacity .2s ease;
    }

    /* ====== Laptop (≤ 1199px) ====== */
    @media (max-width: 1199.98px) {
        .sidebar .sidebar-card-illustration {
            width: 120px;
        }
    }

    /* ====== Tablet (≤ 991px) ====== */
    @media (max-width: 991.98px) {
        .sidebar .sidebar-card-illustration {
            width: 100px;
        }
    }

    /* ====== Mobile (≤ 767px) ====== */
    @media (max-width: 767.98px) {

        /* Kalau mau kartu terlihat juga di mobile, hapus class d-none d-lg-flex di HTML,
     atau override:
     .sidebar .sidebar-card { display: flex !important; } */
        .sidebar .sidebar-card-illustration {
            width: 80px;
        }
    }

    /* ====== SAAT SIDEBAR DITOGGLE (DICIUTKAN) ======
   SB Admin 2 menambahkan:
   - body.sidebar-toggled
   - .sidebar.toggled
   Kaitkan dua-duanya biar aman di semua halaman.
*/
    .sidebar.toggled .sidebar-card-illustration,
    body.sidebar-toggled .sidebar .sidebar-card-illustration {
        width: 36px;
        /* kecil saat collapse */
        transform: scale(0.95);
        opacity: .95;
    }

    /* (Opsional) Sembunyikan teks & tombol saat collapse biar rapi */
    .sidebar.toggled .sidebar-card p,
    .sidebar.toggled .sidebar-card .btn,
    body.sidebar-toggled .sidebar .sidebar-card p,
    body.sidebar-toggled .sidebar .sidebar-card .btn {
        display: none !important;
    }

    /* (Opsional) rapikan tombol toggler */
    #sidebarToggle {
        cursor: pointer;
        outline: none;
    }

    /* ===== Modern Dashboard Polish (Bootstrap 4) ===== */

    /* Page title glam */
    .page-title {
        font-weight: 800;
        letter-spacing: .2px;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Gradient action button */
    .btn-gradient {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: #fff !important;
        border: none;
        box-shadow: 0 8px 18px rgba(78, 115, 223, .25);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(78, 115, 223, .35);
        filter: saturate(1.05);
    }

    /* Container backdrop */
    .dashboard-modern {
        position: relative;
    }

    .dashboard-modern::before {
        content: "";
        position: absolute;
        inset: -80px -40px 0 -40px;
        background:
            radial-gradient(600px 200px at 10% 0%, rgba(78, 115, 223, .08), transparent 60%),
            radial-gradient(560px 200px at 90% 0%, rgba(28, 200, 138, .08), transparent 60%);
        pointer-events: none;
        z-index: 0;
    }

    /* Cards */
    .card-modern {
        border: 0 !important;
        border-radius: 18px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        transition: transform .2s ease, box-shadow .2s ease;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .card-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, .12);
    }

    /* Subtle top accent line */
    .card-modern::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, rgba(78, 115, 223, .6), rgba(28, 200, 138, .6));
        opacity: .5;
    }

    /* KPI cards */
    .kpi-card {
        padding: .9rem 1rem;
    }

    .kpi-card .kpi-label {
        font-size: .72rem;
        letter-spacing: .6px;
        text-transform: uppercase;
        font-weight: 800;
        opacity: .85;
    }

    .kpi-card .kpi-value {
        font-weight: 800;
        font-size: 1.35rem;
        color: #1f2937;
    }

    /* Icon bubble */
    .kpi-icon-bubble {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(15, 23, 42, .04);
    }

    /* KPI color variants */
    .kpi-primary .kpi-icon-bubble {
        background: rgba(78, 115, 223, .12);
        color: #4e73df;
    }

    .kpi-success .kpi-icon-bubble {
        background: rgba(28, 200, 138, .12);
        color: #1cc88a;
    }

    .kpi-info .kpi-icon-bubble {
        background: rgba(54, 185, 204, .12);
        color: #36b9cc;
    }

    .kpi-warning .kpi-icon-bubble {
        background: rgba(246, 194, 62, .14);
        color: #f6c23e;
    }

    /* Card header clean */
    .card-modern .card-header {
        background: #fff;
        border: 0;
        padding: 1rem 1.25rem;
    }

    .card-modern .card-header h6 {
        font-weight: 800;
        letter-spacing: .3px;
        color: #1f2937;
    }

    /* Progress modern */
    .progress-modern {
        height: 8px;
        background: #eef2ff;
        border-radius: 9999px;
        overflow: hidden;
    }

    .progress-modern .progress-bar {
        background: linear-gradient(90deg, #4e73df, #36b9cc);
    }

    /* Chart wrapper spacing */
    .chart-area,
    .chart-pie {
        padding-top: .25rem;
    }

    /* Utilities */
    .rounded-2xl {
        border-radius: 18px !important;
    }

    .text-muted-700 {
        color: #4b5563 !important;
    }

    /* ===== Modern Sidebar Card + Clock ===== */
    .modern-sidebar-card {
        border-radius: 16px;
        padding: 1rem 1rem 1.2rem;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
        position: relative;
    }

    .modern-sidebar-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(300px 120px at 20% 0%, rgba(78, 115, 223, .08), transparent 60%),
            radial-gradient(260px 100px at 80% 0%, rgba(28, 200, 138, .08), transparent 60%);
        pointer-events: none;
        border-radius: 16px;
    }

    /* Floating container */
    .clock-float {
        position: fixed;
        right: calc(16px + env(safe-area-inset-right));
        bottom: calc(16px + env(safe-area-inset-bottom));
        z-index: 1080;
        transition: right .18s ease;
    }

    /* Saat tombol Back to Top tampil, geser clock ke kiri sejajar */
    body.has-btt .clock-float {
        /* 16px (gap) + lebar tombol back-to-top + 16px margin kanan */
        right: calc(16px + var(--btt-width, 44px) + 16px + env(safe-area-inset-right));
    }

    /* Tampilan pill modern */
    .clock-widget {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .55rem .9rem;
        background: linear-gradient(135deg, rgba(78, 115, 223, .10), rgba(28, 200, 138, .10));
        border: 1px solid rgba(78, 115, 223, .22);
        border-radius: 9999px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .12);
        backdrop-filter: blur(6px);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .clock-widget:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, .16);
    }

    .clock-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(78, 115, 223, .14);
        color: #4e73df;
    }

    .clock-time {
        font-weight: 800;
        letter-spacing: .6px;
        font-variant-numeric: tabular-nums;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        color: #1f2937;
        min-width: 92px;
        text-align: center;
        display: inline-block;
    }

    @media (max-width: 576px) {
        .clock-widget {
            padding: .45rem .75rem;
        }

        .clock-icon {
            width: 28px;
            height: 28px;
        }

        .clock-time {
            min-width: 84px;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .clock-widget,
        .clock-float {
            transition: none;
        }
    }

    .search-hit {
        outline: 3px solid rgba(78, 115, 223, .6);
        background: rgba(78, 115, 223, .08);
        border-radius: .25rem;
        transition: outline-color .6s, background-color .6s;
    }
</style>

<div class="container-fluid dashboard-modern">

    <!-- Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><?= esc($sub_judul) ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-gradient shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row (KPI) -->
    <div class="row">

        <!-- Earnings (Monthly) -->
        <div class="col-xl-6 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 card-modern kpi-card kpi-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tanaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 kpi-value"><?= esc($jumlah_tanaman) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 card-modern kpi-card kpi-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Soal</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 kpi-value"><?= esc($jumlah_soal_quiz) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-6 mb-4">
            <div class="card card-modern">
                <div class="card-header">
                    <h6 class="m-0">Top 10 Tanaman berdasarkan Jumlah</h6>
                </div>
                <div class="card-body" style="height:320px;overflow-x:auto">
                    <canvas id="chartTanamanTop" style="min-width:560px"></canvas>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-6 mb-4">
            <div class="card card-modern">
                <div class="card-header">
                    <h6 class="m-0">Kategori Quiz (Active)</h6>
                </div>
                <div class="card-body" style="height:320px;overflow-x:auto">
                    <canvas id="chartQuizAktifBar" style="min-width:560px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->

</div>
<!-- Chart.js -->
<script defer src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    window.addEventListener('load', function() {
        const tLabels = <?= json_encode($chart_tanaman['labels'] ?? []) ?>;
        const tData = <?= json_encode($chart_tanaman['data'] ?? []) ?>;

        const qLabels = <?= json_encode($chart_quiz['labels'] ?? []) ?>;
        const qData = <?= json_encode($chart_quiz['data'] ?? []) ?>;

        function genColors(n) {
            const base = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#20c997', '#6f42c1', '#fd7e14', '#0dcaf0'];
            return Array.from({
                length: n
            }, (_, i) => base[i % base.length]);
        }

        const valueLabels = {
            id: 'valueLabels',
            afterDatasetsDraw(chart) {
                const {
                    ctx
                } = chart, ds = chart.data.datasets[0], meta = chart.getDatasetMeta(0);
                ctx.save();
                ctx.fillStyle = '#111827';
                ctx.font = '12px Inter, system-ui, -apple-system, Segoe UI, Roboto, sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
                meta.data.forEach((bar, i) => {
                    const v = ds.data[i];
                    if (v != null) ctx.fillText(v, bar.x, bar.y - 4);
                });
                ctx.restore();
            }
        };

        // Bar Tanaman
        new Chart(document.getElementById('chartTanamanTop'), {
            type: 'bar',
            data: {
                labels: tLabels,
                datasets: [{
                    label: 'Jumlah',
                    data: tData,
                    backgroundColor: genColors(tData.length)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (c) => ` ${c.dataset.label}: ${c.parsed.y}`
                        }
                    }
                }
            },
            plugins: [valueLabels]
        });

        // Bar Kategori Quiz (active)
        new Chart(document.getElementById('chartQuizAktifBar'), {
            type: 'bar',
            data: {
                labels: qLabels,
                datasets: [{
                    label: 'Jumlah Soal (Active)',
                    data: qData,
                    backgroundColor: genColors(qData.length)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: (c) => ` ${c.dataset.label}: ${c.parsed.y}`
                        }
                    }
                }
            },
            plugins: [valueLabels]
        });
    });

    (function() {
        var anchor = <?= json_encode($search_target_anchor ?? '') ?>;
        var query = <?= json_encode($search_query ?? '') ?>;

        if (anchor && query) {
            var el = document.getElementById(anchor);
            if (el) {
                el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                el.classList.add('search-hit');
                setTimeout(function() {
                    el.classList.remove('search-hit');
                }, 2200);
            }
        }

        <?php if (!empty($search_query) && empty($search_target_anchor)): ?>
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Konten yang anda cari tidak ditemukan',
                    confirmButtonText: 'OK'
                });
            } else {
                // fallback alert jika sweetalert belum di-include
                alert('Konten yang anda cari tidak ditemukan');
            }
        <?php endif; ?>
    })();
</script>
<?= $this->endSection() ?>
<?= $this->extend('templates/template_admin') ?>
<?= $this->section('content_admin') ?>

<?php
// Expecting from controller:
// $sub_judul = 'Data Quiz';
// $d_quiz = [
//   ['id_quiz'=>1,'judul'=>'UTS Matematika','kategori'=>'Matematika','total_pertanyaan'=>25,'durasi_menit'=>30,'status'=>'active','thumbnail'=>'uts-mtk.jpg','created_at'=>'2025-09-01 10:00:00'],
//   ...
// ];
// $filters = ['q'=>'','kategori'=>'','status'=>''];
// $categories = ['Matematika','Bahasa Indonesia','IPS','IPA'];
// Optional for chart:
// $chart = ['labels'=>['Matematika','IPA'], 'data'=>[10,7]];
?>

<style>
    /* Elemen tambahan khusus halaman quiz */
    .chart-card {
        border: 0;
        border-radius: 18px;
        padding: 16px;
        background: #fff;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .08)
    }

    .chart-wrap {
        position: relative;
        inline-size: 100%;
        block-size: 360px
    }

    .table-modern thead th {
        white-space: nowrap;
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #f1f5f9;
        font-weight: 600;
        font-size: .85rem
    }

    .thumb {
        inline-size: 56px;
        block-size: 56px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 6px 14px rgba(15, 23, 42, .08)
    }

    .nowrap {
        white-space: nowrap;
    }
</style>

<div class="container-fluid dashboard-modern">

    <!-- Heading + Breadcrumb -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 page-title"><i class="fa-solid fa-circle-question"></i> <?= esc($sub_judul ?? 'Data Quiz') ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-white rounded-pill px-3 py-2 shadow-sm">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>"><i class="fa-solid fa-house"></i> Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($sub_judul ?? 'Data Quiz') ?></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <!-- Tabel Data Quiz -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 card-modern">

                <!-- Toolbar -->
                <div class="table-toolbar">
                    <form method="get" action="<?= site_url('admin/quiz') ?>" class="toolbar-left w-100" autocomplete="off">
                        <div class="d-flex flex-wrap gap-2 align-items-center w-100">
                            <input class="input-soft" type="text" name="q" placeholder="Cari judul…" value="<?= esc($filters['q'] ?? '') ?>">

                            <select name="kategori" class="input-soft">
                                <option value="">Semua Kategori</option>
                                <?php if (!empty($categories)) : foreach ($categories as $cat): ?>
                                        <option value="<?= esc($cat) ?>" <?= (isset($filters['kategori']) && $filters['kategori'] === $cat) ? 'selected' : '' ?>><?= esc($cat) ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>

                            <select name="status" class="input-soft">
                                <option value="">Semua Status</option>
                                <option value="active" <?= (isset($filters['status']) && $filters['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= (isset($filters['status']) && $filters['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                            </select>

                            <button class="btn btn-ghost" type="submit"><i class="fas fa-filter mr-1"></i>Filter</button>
                            <a href="<?= site_url('admin/quiz') ?>" class="btn btn-ghost"><i class="fa-solid fa-rotate"></i> Reset</a>

                            <div class="ms-auto d-flex align-items-center gap-2">
                                <a href="<?= base_url('admin/quiz/create') ?>" class="btn btn-gradient rounded-pill py-2"><i class="fa-solid fa-file-circle-plus mr-1"></i> Tambah Quiz</a>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if (!empty($d_quiz)) : ?>
                    <div class="cover-table">
                        <div class="table-responsive-modern p-3">
                            <table id="tblQuiz" class="table table-striped table-bordered nowrap table-modern" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:56px">No</th>
                                        <th class="no-export">Cover</th>
                                        <th>Judul Quiz</th>
                                        <th>Kategori</th>
                                        <th class="text-center">Total Soal</th>
                                        <th class="text-center">Durasi</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th class="no-export" style="width:120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($d_quiz as $q): ?>
                                        <?php
                                        $isActive = strtolower(trim($q['status'] ?? '')) === 'active';
                                        $thumb = !empty($q['thumbnail']) ? base_url('assets/uploads/quiz/' . esc($q['thumbnail'])) : base_url('assets/img/dumy-img.png');
                                        ?>
                                        <tr>
                                            <th class="nowrap"><?= $no++ ?>.</th>
                                            <td>
                                                <img src="<?= $thumb ?>" alt="Cover" class="thumb" loading="lazy" decoding="async">
                                            </td>
                                            <td><?= esc($q['judul'] ?? '-') ?></td>
                                            <td><span class="pill"><i class="fa-solid fa-tag"></i><?= esc($q['kategori'] ?? '-') ?></span></td>
                                            <td class="text-center nowrap"><?= (int)($q['total_pertanyaan'] ?? 0) ?> soal</td>
                                            <td class="text-center nowrap"><?= (int)($q['durasi_menit'] ?? 0) ?> menit</td>
                                            <td>
                                                <span class="badge-soft <?= $isActive ? 'active' : 'inactive' ?>"><?= $isActive ? 'Active' : 'Inactive' ?></span>
                                            </td>
                                            <td class="nowrap"><?= function_exists('indo_date') ? indo_date($q['created_at'] ?? '') : esc(date('d M Y', strtotime($q['created_at'] ?? 'now'))) ?></td>
                                            <td class="no-export">
                                                <div class="d-inline-flex">
                                                    <a href="<?= base_url('admin/quiz/detail/' . (int)($q['id_quiz'] ?? 0)) ?>" class="btn-action mr-1" title="Detail"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= base_url('admin/quiz/edit/' . (int)($q['id_quiz'] ?? 0)) ?>" class="btn-action mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <button type="button" onclick="confirmDeleteQuiz(<?= (int)($q['id_quiz'] ?? 0) ?>)" class="btn-action" title="Hapus"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="cover-empty-data">
                        <div class="empty-illustration rmbg-white">
                            <img src="<?= base_url('assets/img/img-empty.png') ?>" alt="Tidak ada data saat ini" class="img-empty-data" loading="lazy" decoding="async">
                        </div>
                        <h6 class="text-img-empty">Belum ada quiz. Mulai dengan menambahkan data terlebih dahulu.</h6>
                        <a href="<?= base_url('admin/quiz/create') ?>" class="btn-empty"><i class="fas fa-plus"></i> Tambah Quiz</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <!-- Ringkasan / Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="chart-card">
                <h6 class="mb-2 page-title">Distribusi Quiz per Kategori</h6>
                <div class="chart-wrap">
                    <canvas id="quizChart"></canvas>
                </div>
                <div class="mt-3 small text-muted">*Menunjukkan jumlah quiz pada tiap kategori.</div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables & ChartJS init -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== DataTables =====
        const tbl = $('#tblQuiz').DataTable({
            scrollX: true,
            autoWidth: false,
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            order: [
                [7, 'desc']
            ], // sort by Dibuat
            columnDefs: [{
                    targets: 'no-export',
                    visible: true,
                    orderable: false
                },
                {
                    targets: 0,
                    orderable: false
                },
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: '<i class="fa-solid fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: ':visible:not(.no-export)'
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa-solid fa-table-columns"></i> Kolom'
                }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampil _MENU_",
                info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                paginate: {
                    first: 'Awal',
                    last: 'Akhir',
                    next: '›',
                    previous: '‹'
                },
                zeroRecords: 'Tidak ditemukan data yang cocok',
                infoEmpty: 'Tidak ada data',
            }
        });

        // ===== ChartJS =====
        const ctx = document.getElementById('quizChart');
        if (ctx) {
            // Ambil dari controller bila tersedia, jika tidak, hitung cepat dari tabel PHP
            const chart = <?php
                            if (!empty($chart)) {
                                echo json_encode($chart, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                            } else {
                                // fallback: hitung kategori dari $d_quiz
                                $counts = [];
                                if (!empty($d_quiz)) {
                                    foreach ($d_quiz as $row) {
                                        $k = $row['kategori'] ?? 'Lainnya';
                                        $counts[$k] = ($counts[$k] ?? 0) + 1;
                                    }
                                }
                                $fallback = [
                                    'labels' => array_keys($counts),
                                    'data' => array_values($counts)
                                ];
                                echo json_encode($fallback, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                            }
                            ?>;

            if (chart && Array.isArray(chart.labels) && Array.isArray(chart.data)) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chart.labels,
                        datasets: [{
                            data: chart.data
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => `${context.label}: ${context.parsed}`
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
            }
        }
    });

    // ===== Helpers =====
    function confirmDeleteQuiz(id) {
        if (!id) return;
        if (confirm('Hapus quiz ini? Tindakan tidak dapat dibatalkan.')) {
            window.location.href = '<?= site_url('admin/quiz/delete/') ?>' + id;
        }
    }
</script>

<?= $this->endSection() ?>
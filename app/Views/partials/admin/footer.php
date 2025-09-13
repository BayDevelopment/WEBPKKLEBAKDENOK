<!-- Footer (selalu di bawah meski konten kosong) -->
<footer class="sticky-footer bg-white mt-auto">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kampung Programming x Unival 2025</span>
        </div>
    </div>
</footer>
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Floating Clock -->
<div class="clock-float" role="button" aria-label="Jam real-time">
    <div class="clock-widget mb-0" aria-live="polite">
        <span class="clock-icon"><i class="far fa-clock"></i></span>
        <span id="sidebarClock" class="clock-time">00:00:00</span>
    </div>
</div>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>



<!-- (Biasanya sudah ada di SB Admin 2) -->
<!-- <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a> -->

<!-- chart js -->
<!-- di <head> layout atau sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- (opsional) terjemahan Bahasa Indonesia -->
<script src="https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>


<!-- DataTables v2 (bs5 theme) + Buttons (HTML5, ColVis) + Responsive -->
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/b-3.0.2/b-html5-3.0.2/b-colvis-3.0.2/datatables.min.js"></script>

<!-- JSZip (wajib untuk export Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Flash SweetAlert (PASTIKAN DI DALAM <script>) -->
<?php if (session()->getFlashdata('sweet_success')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",
            title: "<?= session()->getFlashdata('sweet_success'); ?>"
        });
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet_error')) : ?>
    <script>
        const ToastError = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        ToastError.fire({
            icon: "error",
            title: "<?= session()->getFlashdata('sweet_error'); ?>"
        });
    </script>
<?php endif; ?>

<script>
    (function() {
        // ====== JAM (WIB atau jam laptop) ======
        const el = document.getElementById('sidebarClock');
        if (el) {
            const USE_WIB = true; // true = WIB (Asia/Jakarta), false = jam laptop
            const fmt = new Intl.DateTimeFormat(navigator.language || 'id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                ...(USE_WIB ? {
                    timeZone: 'Asia/Jakarta'
                } : {})
            });
            const tick = () => {
                el.textContent = fmt.format(new Date());
            };
            tick();
            setInterval(tick, 1000);
        }

        // ====== DETEKSI TOMBOL BACK TO TOP ======
        const btt = document.querySelector('.scroll-to-top');
        const update = () => {
            const body = document.body;
            let shown = false,
                widthPx = 44; // default
            if (btt) {
                const rect = btt.getBoundingClientRect();
                // dianggap tampil jika punya ukuran & berada di viewport bawah kanan
                shown = (rect.width > 0 && rect.height > 0 && window.scrollY > 100);
                widthPx = Math.round(rect.width || widthPx);
            }
            body.classList.toggle('has-btt', shown);
            document.documentElement.style.setProperty('--btt-width', widthPx + 'px');
        };

        update();
        document.addEventListener('scroll', update, {
            passive: true
        });
        window.addEventListener('resize', update);
    })();


    // tanamanku datatables
    document.addEventListener('DOMContentLoaded', function() {
        $('#tblTanamanku').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel me-1"></i> Ekspor ke Excel', // ikon + teks
                className: 'btn btn-success', // hijau biar “Excel vibes”
                title: 'Tanamanku',
                exportOptions: {
                    columns: ':visible:not(.no-export)' // hormati kolom no-export
                },
                attr: {
                    title: 'Ekspor ke Excel',
                    'aria-label': 'Ekspor ke Excel'
                }
            }]
        });
    });





    // delete data tanaman
    function confirmDeleteAbout(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/tanamanku/delete/') ?>" + id;
            }
        });
    }

    // chart pill
    (function() {
        // Data dari controller
        const CH = <?= json_encode($chart_pill ?? ['labels' => [], 'data' => []], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;

        const ctx = document.getElementById('pillChart');
        if (!ctx || !CH.labels || CH.labels.length === 0) {
            if (ctx) ctx.replaceWith(document.createTextNode('Belum ada data untuk grafik ini.'));
            return;
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: CH.labels,
                datasets: [{
                    label: 'Jumlah',
                    data: CH.data,
                    // bikin “pill”: horizontal + radius besar + tidak skip border
                    borderRadius: 999,
                    borderSkipped: false,
                    // opsional: tipis transparan di border
                    borderWidth: 0
                }]
            },
            options: {
                indexAxis: 'y', // horizontal bar
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    y: {
                        ticks: {
                            autoSkip: false
                        }
                    }
                },
                elements: {
                    bar: {
                        barThickness: 18, // ketebalan bar (sesuaikan)
                    }
                }
            }
        });
    })();
</script>
</body>

</html>
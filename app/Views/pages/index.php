<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= esc($title) ?></title>


    <!-- icon title -->
    <link rel="icon" href="<?= base_url('assets/img/logo-pkk-lebakdenok.jpg') ?>" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<style>
    /* ===== Layer Particles & Z-Index ===== */
    #particles-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }

    .container {
        position: relative;
        z-index: 1;
    }

    /* ===== Animated Gradient Background ===== */
    body.bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe, #1cc88a, #36b9cc);
        background-size: 400% 400%;
        animation: gradientMove 10s ease infinite;
    }

    @keyframes gradientMove {
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

    /* ===== Brand & Image Enhancements ===== */
    .bg-login-image {
        position: relative;
        overflow: hidden;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .bg-login-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(1200px 600px at 20% 10%, rgba(78, 115, 223, 0.35), transparent 60%),
            linear-gradient(135deg, rgba(28, 200, 138, 0.20), rgba(54, 185, 204, 0.15));
        mix-blend-mode: screen;
        pointer-events: none;
    }

    .img-hero {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.02);
        filter: saturate(1.08) contrast(1.03);
        transition: transform .6s ease, filter .6s ease;
    }

    .bg-login-image:hover .img-hero {
        transform: scale(1.06);
        filter: saturate(1.12) contrast(1.05);
    }

    .bg-login-image::before {
        content: "";
        position: absolute;
        right: -1px;
        top: 10%;
        bottom: 10%;
        width: 2px;
        background: linear-gradient(to bottom, rgba(78, 115, 223, 0), rgba(78, 115, 223, .35), rgba(78, 115, 223, 0));
        filter: blur(.5px);
    }

    .brand-mark {
        position: absolute;
        left: 18px;
        top: 18px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: .6rem;
        padding: .5rem .9rem;
        border-radius: 9999px;
        font-weight: 800;
        letter-spacing: .6px;
        text-transform: uppercase;
        font-size: .9rem;
        color: #fff;
        background: rgba(15, 23, 42, .22);
        border: 1px solid rgba(255, 255, 255, .25);
        backdrop-filter: blur(6px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, .18);
    }

    .brand-mobile {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .45rem .85rem;
        border-radius: 9999px;
        font-weight: 800;
        letter-spacing: .5px;
        text-transform: uppercase;
        font-size: .8rem;
        color: #0d6efd;
        background: rgba(13, 110, 253, .08);
        border: 1px solid rgba(13, 110, 253, .25);
        backdrop-filter: blur(4px);
    }

    /* ===== Form polish ===== */
    .password-wrapper {
        position: relative;
    }

    .password-wrapper .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        transition: color .2s ease, transform .2s ease;
    }

    .password-wrapper .toggle-password:hover {
        color: #4e73df;
        transform: translateY(-50%) scale(1.05);
    }

    .card {
        border-radius: 20px;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .18);
    }

    .text-center h1 {
        font-weight: 900;
        letter-spacing: .3px;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-user {
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: .6px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .btn-user:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
    }

    @media (max-width: 991.98px) {
        .bg-login-image {
            border-radius: 0;
        }
    }

    .btn-login {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: .5px;
        font-size: 1rem;
        color: #fff;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        border: none;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #1cc88a, #4e73df);
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.25);
    }

    .btn-login:active {
        transform: translateY(0);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<body class="bg-gradient-primary">

    <!-- Particles Background -->
    <div id="particles-bg"></div>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- LEFT -->
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <div class="brand-mark d-none d-lg-inline-flex">
                                    <i class="fas fa-seedling"></i> TP PKK LEBAK DENOK
                                </div>
                                <img src="<?= base_url('/assets/img/login-img-side.png') ?>"
                                    alt="PKK-Login"
                                    class="img-fluid size_img_logo img-hero"
                                    loading="lazy">
                            </div>

                            <!-- RIGHT -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center d-lg-none mb-3">
                                        <span class="brand-mobile"><i class="fas fa-seedling"></i> TP PKK LEBAK DENOK</span>
                                    </div>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="<?= site_url('auth/login') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Username.." required>
                                        </div>
                                        <div class="form-group password-wrapper">
                                            <input type="password" name="password_hash" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" required>
                                            <i class="fas fa-eye toggle-password" id="togglePassword"
                                                title="Show/Hide password" aria-label="Toggle password visibility"></i>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn-login" type="submit">
                                                <i class="fas fa-sign-in-alt me-2"></i> Log in
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- /RIGHT -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
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
    <?php if (session()->getFlashdata('flash_logout')) : ?>
        <script>
            const ToastLogout = Swal.mixin({
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

            ToastLogout.fire({
                icon: "success",
                title: "<?= session()->getFlashdata('flash_logout'); ?>"
            });
        </script>
    <?php endif; ?>
    <script>
        particlesJS("particles-bg", {
            particles: {
                number: {
                    value: 60,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#ffffff"
                },
                shape: {
                    type: "circle"
                },
                opacity: {
                    value: 0.5,
                    random: true
                },
                size: {
                    value: 3,
                    random: true
                },
                move: {
                    enable: true,
                    speed: 2
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "repulse"
                    },
                    onclick: {
                        enable: false
                    },
                    resize: true
                }
            },
            retina_detect: true
        });

        // Toggle password
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("exampleInputPassword");
        togglePassword.addEventListener("click", function() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
            this.setAttribute("title", type === "password" ? "Show password" : "Hide password");
        });
    </script>


</body>

</html>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>SPP APP</title>
    <meta name="description" content="">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }

        .menu .menu-item.active > .menu-link {
            background-color: #0d6efd;
            color: #fff;
        }

        .menu .menu-item.active > .menu-link i {
            color: #fff;
        }

        .menu .menu-link:hover {
            background-color: #e2e6ea;
            color: #0d6efd;
        }

        .menu .menu-link:hover i {
            color: #0d6efd;
        }

        .navbar {
            background: linear-gradient(45deg, #313a48, #080437);
            color: #fff;
        }

        .navbar .navbar-brand-text {
            color: #fff;
        }

        .navbar .nav-link {
            color: #fff;
        }

        .card {
            border-radius: 10px;
        }

        .card .card-body {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .navbar-nav-right {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar-nav-right .navbar-brand-text {
                margin-bottom: 1rem;
            }

            .menu-inner {
                padding: 1rem;
            }

            .content-wrapper {
                padding: 1rem;
            }

            .d-flex {
                flex-direction: column !important;
            }

            .d-flex > div {
                width: 100% !important;
                margin-bottom: 1rem;
            }

            .d-flex .form-inline {
                flex-direction: column !important;
            }
        }
    </style>

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <center>
                        <a href="{{ url('Admin/dashboard') }}" class="text-center">
                            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 50px;">
                            <span class="app-brand-text demo menu-text text-uppercase text-center fw-bolder ms-2">Spp App</span>
                        </a>
                    </center>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item {{ Request::is('Admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('Admin/dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('Admin/billings') ? 'active' : '' }}">
                        <a href="{{ url('Admin/billings') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-info-circle"></i>
                            <div data-i18n="Analytics">Data Informasi Tagihan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('Admin/payments') ? 'active' : '' }}">
                        <a href="{{ url('Admin/payments') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-wallet"></i>
                            <div data-i18n="Analytics">Data Pembayaran</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('Admin/financial-summaries') ? 'active' : '' }}">
                        <a href="{{ url('Admin/financial-summaries') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-pie-chart"></i>
                            <div data-i18n="Analytics">Data Keuangan</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <span class="navbar-brand-text text-uppercase fw-bolder">Sekolah SMP SMIP 3 Pangeran Antasari</span>
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <i class="fas fa-user-circle w-px-40 h-auto fa-2x"></i>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Log Out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        $(document).ready(function() {
            $('.layout-menu-toggle').on('click', function() {
                $('#layout-menu').toggleClass('menu-collapsed');
            });
        });
    </script>
    @yield('scripts')
</body>

</html>

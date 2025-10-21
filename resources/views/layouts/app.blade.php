<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Restaurant MIS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/backend/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/backend/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/backend/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/backend/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/backend/assets/vendors/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="/backend/assets/css/style.css">

    <link rel="shortcut icon" href="/backend/assets/images/favicon.png" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <!-- Page Content -->
    <main>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <a class="navbar-brand brand-logo me-5" href="index.html"><img src="/backend/assets/images/logo.svg"
                            class="me-2" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img
                            src="/backend/assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                    <ul class="navbar-nav mr-lg-2">
                        <li class="nav-item nav-search d-none d-lg-block">
                            <div class="input-group">
                                <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                    <span class="input-group-text" id="search">
                                        <i class="icon-search"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="navbar-search-input"
                                    placeholder="Search now" aria-label="search" aria-describedby="search">
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="icon-bell mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="ti-info-alt mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted"> Just now </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="ti-settings mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Settings</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="ti-user mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted"> 2 days ago </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                id="profileDropdown">
                                <img src="/backend/assets/images/faces/face28.jpg" alt="profile" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="ti-settings text-primary"></i> Settings </a>
                                <a class="dropdown-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <div class="flex">
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <div class="flex">
                                                    <i class="ti-power-off text-primary"></i>
                                                    <p>Logout</p>
                                                </div>
                                            </x-dropdown-link>
                                        </div>
                                    </form>
                                </a>

                            </div>
                        </li>
                        <li class="nav-item nav-settings d-none d-lg-flex">
                            <a class="nav-link" href="#">
                                <i class="icon-ellipsis"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </nav>

            <!-- partial -->
            <div class="container-fluid page-body-wrapper">

                <!-- partial:partials/_sidebar.html -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tables.index') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Tables</span>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Categories</span>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#menus" aria-expanded="false"
                                aria-controls="menus">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Menus</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="menus">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('menu.index') }}">All menu</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.index') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Reservation</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                                aria-controls="charts">
                                <i class="icon-bar-graph menu-icon"></i>
                                <span class="menu-title">Charts</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="pages/charts/chartjs.html">ChartJs</a></li>
                                </ul>
                            </div>
                        </li>


                    </ul>
                </nav>

                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="row">
                                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                        <h3 class="font-weight-bold">Welcome
                                            <strong>{{ auth()->user()->name }}</strong>
                                        </h3>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="justify-content-end d-flex">
                                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                                <button class="btn btn-sm btn-light bg-white dropdown-toggle"
                                                    type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="true">
                                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021) </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuDate2">
                                                    <a class="dropdown-item" href="#">January - March</a>
                                                    <a class="dropdown-item" href="#">March - June</a>
                                                    <a class="dropdown-item" href="#">June - August</a>
                                                    <a class="dropdown-item" href="#">August - November</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ $slot }}

                    </div>
                </div>
            </div>
        </div>
    </main>


    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.
                <a href="https://nooriallah.netlify.app" target="_blank">Nooriallah Qayoumi</a>. All rights
                reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                with <i class="ti-heart text-danger ms-1"></i></span>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="/backend/assets/vendors/js/vendor.bundle.base.js"></script>

        <script src="/backend/assets/vendors/chart.js/chart.umd.js"></script>
        <script src="/backend/assets/js/dataTables.select.min.js"></script>

        <script src="/backend/assets/js/off-canvas.js"></script>
        <script src="/backend/assets/js/template.js"></script>
        <script src="/backend/assets/js/settings.js"></script>
        <script src="/backend/assets/js/todolist.js"></script>

        <script src="/backend/assets/js/jquery.cookie.js" type="text/javascript"></script>

        {{-- Sweat alert 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="/backend/assets/js/dashboard.js"></script>



        <!-- End custom js for this page-->
    </footer>
</body>



</html>

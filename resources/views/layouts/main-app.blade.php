<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Mono - Responsive Admin & Dashboard Template')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- theme meta -->
    <meta name="theme-name" content="mono" />
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="{{ asset('assets/theme/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/theme/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('assets/theme/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/theme/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/theme/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/theme/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/theme/https://cdn.quilljs.com/1.3.6/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/theme/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}" />
    <!-- FAVICON -->
    <link href="{{ asset('storage/favicons/favicon.png') }}" rel="favicon icon" />
    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{ asset('assets/theme/plugins/nprogress/nprogress.js') }}"></script>
    <style>
        #productsTable.table-hover tbody tr:hover {
            background-color: #F2F2F2 !important;
        }

        #productsTable.table-hover tbody tr:hover td {
            color: #000000 !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>
    {{-- <div id="toaster"></div> --}}
    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/theme/images/logo.png') }}" alt="Mono">
                        <span class="brand-name">Inventory</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-left" data-simplebar style="height: 100%;">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li class="active">
                            <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="nav-text"> Dashboard</span>
                            </a>
                        </li>

                        <li class="section-title">
                            Inventory
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#category" aria-expanded="false" aria-controls="category">
                                <i class="mdi mdi-shape"></i>
                                <span class="nav-text">Guest <h5 class="badge badge-primary badge-pill">

                                    </h5>

                                </span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="category" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('guests.index') }}">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('guests.create') }}">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#brand" aria-expanded="false" aria-controls="brand">
                                <i class="mdi mdi-label"></i>
                                <span class="nav-text">Brand <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="brand" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#product" aria-expanded="false" aria-controls="product">
                                <i class="mdi mdi-palette"></i>
                                <span class="nav-text">Product <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="product" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#supplier" aria-expanded="false" aria-controls="supplier">
                                <i class="mdi mdi-package-variant"></i>
                                <span class="nav-text">Supplier <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="supplier" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#customer" aria-expanded="false" aria-controls="customer">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="nav-text">Customer <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="customer" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#status" aria-expanded="false" aria-controls="status">
                                <i class="mdi mdi-clock-outline"></i>
                                <span class="nav-text">Status <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="status" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#purchase" aria-expanded="false" aria-controls="purchase">
                                <i class="mdi mdi-cart"></i>
                                <span class="nav-text">Purchase <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="purchase" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#purchase_item" aria-expanded="false" aria-controls="purchase_item">
                                <i class="mdi mdi-cart-plus"></i>
                                <span class="nav-text">Purchase Item <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="purchase_item" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#sale" aria-expanded="false" aria-controls="sale">
                                <i class="mdi mdi-chart-line"></i>
                                <span class="nav-text">Sale <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="sale" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#saleItem" aria-expanded="false" aria-controls="saleItem">
                                <i class="mdi mdi-cart-plus"></i>
                                <span class="nav-text">Sale Item <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="saleItem" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>

                </div>

        </aside>

        <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            <header class="main-header" id="header">
                <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    @php
                        $segment = request()->segment(1);
                        $title = Str::singular($segment);
                    @endphp
                    <span class="page-title">{{ $title ?? '' }}</span>

                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">

                            <li class="dropdown user-menu">
                                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{ asset('storage/banners/default_image.png') }}"
                                        class="user-image rounded-circle" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">{{ Auth::user()->name ?? '' }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">

                                    <li class="dropdown-footer">
                                        <a id="logout" class="dropdown-link-item" href="{{ route('logout') }}">
                                            <i class="mdi mdi-logout"></i> Log Out </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>


            </header>

            <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
            <div class="content-wrapper">
                <div class="content">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year"></span> Copyright Mono Dashboard Bootstrap Template by <a
                            class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>

    <!-- Card Offcanvas -->
    <div class="card card-offcanvas" id="contact-off">
        <div class="card-header">
            <h2>Contacts</h2>
            <a href="#" class="btn btn-primary btn-pill px-4">Add New</a>
        </div>
        <div class="card-body">

            <div class="mb-4">
                <input type="text" class="form-control form-control-lg form-control-secondary rounded-0"
                    placeholder="Search contacts...">
            </div>

            <div class="media media-sm">
                <div class="media-sm-wrapper">
                    <a href="user-profile.html">
                        <img src="images/user/user-sm-01.jpg" alt="User Image">
                        <span class="active bg-primary"></span>
                    </a>
                </div>
                <div class="media-body">
                    <a href="user-profile.html">
                        <span class="title">Selena Wagner</span>
                        <span class="discribe">Designer</span>
                    </a>
                </div>
            </div>

            <div class="media media-sm">
                <div class="media-sm-wrapper">
                    <a href="user-profile.html">
                        <img src="images/user/user-sm-02.jpg" alt="User Image">
                        <span class="active bg-primary"></span>
                    </a>
                </div>
                <div class="media-body">
                    <a href="user-profile.html">
                        <span class="title">Walter Reuter</span>
                        <span>Developer</span>
                    </a>
                </div>
            </div>

            <div class="media media-sm">
                <div class="media-sm-wrapper">
                    <a href="user-profile.html">
                        <img src="images/user/user-sm-03.jpg" alt="User Image">
                    </a>
                </div>
                <div class="media-body">
                    <a href="user-profile.html">
                        <span class="title">Larissa Gebhardt</span>
                        <span>Cyber Punk</span>
                    </a>
                </div>
            </div>

            <div class="media media-sm">
                <div class="media-sm-wrapper">
                    <a href="user-profile.html">
                        <img src="images/user/user-sm-04.jpg" alt="User Image">
                    </a>

                </div>
                <div class="media-body">
                    <a href="user-profile.html">
                        <span class="title">Albrecht Straub</span>
                        <span>Photographer</span>
                    </a>
                </div>
            </div>

            <div class="media media-sm">
                <div class="media-sm-wrapper">
                    <a href="user-profile.html">
                        <img src="images/user/user-sm-05.jpg" alt="User Image">
                        <span class="active bg-danger"></span>
                    </a>
                </div>
                <div class="media-body">
                    <a href="user-profile.html">
                        <span class="title">Leopold Ebert</span>
                        <span>Fashion Designer</span>
                    </a>
                </div>
            </div>

            <div class="media media-sm">
                <div class="media-sm-wrapper">
                    <a href="user-profile.html">
                        <img src="images/user/user-sm-06.jpg" alt="User Image">
                        <span class="active bg-primary"></span>
                    </a>
                </div>
                <div class="media-body">
                    <a href="user-profile.html">
                        <span class="title">Selena Wagner</span>
                        <span>Photographer</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('assets/theme/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/theme/https://unpkg.com/hotkeys-js/dist/hotkeys.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
                jQuery(this).val('');
            });
        });
    </script>
    <script src="{{ asset('assets/theme/https://cdn.quilljs.com/1.3.6/quill.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/toaster/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/theme/js/mono.js') }}"></script>
    <script src="{{ asset('assets/theme/js/chart.js') }}"></script>
    <script src="{{ asset('assets/theme/js/map.js') }}"></script>
    <script src="{{ asset('assets/theme/js/custom.js') }}"></script>
    <script src="{{ asset('assets/theme/js/custom-js/action-button.js') }}"></script>

    <script>
        const logout = document.querySelector('#logout');
        if (logout) {
            logout.addEventListener('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('logout') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = "{{ url('/') }}";
                    },
                    error: function(xhr) {
                        alert('Logout failed. Please try again.');
                    }
                });
            });
        }
    </script>
    <script>
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-bottom-center', 
            preventDuplicates: false,
            showDuration: 100,
            hideDuration: 1000,
            timeOut: 5000,
            extendedTimeOut: 1000,
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };

       
        
    </script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Email copied: " + text);
            }).catch(() => {
                alert("Failed to copy email.");
            });
        }
    </script>

    <script>
        function handleResponsiveLayout() {
            console.log(window.innerWidth <= 768 ? "Mobile view" : "Desktop view");
        }

        function debounce(func, timeout = 100) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }
        document.addEventListener('DOMContentLoaded', function() {
            handleResponsiveLayout();
            window.addEventListener('resize', debounce(handleResponsiveLayout));
        });
    </script>

</body>

</html>






















































































































































































{{-- <x-app-layout>
 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}

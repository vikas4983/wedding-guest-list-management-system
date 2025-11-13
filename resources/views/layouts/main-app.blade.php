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
    <link href="{{ asset('assets/theme/images/favicon-new.png') }}" rel="favicon icon" />
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
                        <span class="brand-name">Weeding GLMS</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-left" data-simplebar style="height: 100%;">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li class="active">
                            <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                                <i class="mdi mdi-home-heart"></i>
                                <span class="nav-text"> Dashboard</span>
                            </a>
                        </li>

                        <li class="section-title">
                            Weeding
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#category" aria-expanded="false" aria-controls="category">
                                <i class="mdi mdi-account-group-outline"></i>
                                <span class="nav-text">Guest <h5 class="badge badge-primary badge-pill">
                                        {{ $count['guests'] ?? '' }}
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
                                <i class="mdi mdi-animation"></i>
                                <span class="nav-text">Event <h5 class="badge badge-primary badge-pill">
                                        {{ $count['events'] ?? '' }}

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="brand" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('events.index') }}">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('events.create') }}">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#card" aria-expanded="false" aria-controls="card">
                                <i class="mdi mdi-credit-card-plus"></i>
                                <span class="nav-text">Card <h5 class="badge badge-primary badge-pill">
                                        {{ $count['cards'] ?? '' }}

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="card" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('cards.index') }}">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('cards.create') }}">
                                            <span class="nav-text">Create</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#contact" aria-expanded="false" aria-controls="contact">
                                <i class="mdi mdi-contact-mail"></i>
                                <span class="nav-text">Contact <h5 class="badge badge-primary badge-pill">
                                        {{ $count['contacts'] ?? '' }}

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="contact" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('contacts.index') }}">
                                            <span class="nav-text">List</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('contacts.create') }}">
                                            <span class="nav-text">Upload File</span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#product" aria-expanded="false" aria-controls="product">
                                <i class="mdi mdi-email-check"></i>
                                <span class="nav-text">Invited <h5 class="badge badge-primary badge-pill">
                                        {{ $count['invited'] ?? '' }}

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="product" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="{{ route('invited') }}">
                                            <span class="nav-text">Sent</span>

                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Send</span>

                                        </a>
                                    </li> --}}
                                </div>
                            </ul>
                        </li>
                        {{-- <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#supplier" aria-expanded="false" aria-controls="supplier">
                                <i class="mdi mdi-package-variant"></i>
                                <span class="nav-text">Filter <h5 class="badge badge-primary badge-pill">

                                    </h5></span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="supplier" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">User 1</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">User 2</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">By Event</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Budget </span>

                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li> --}}

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
                                    <img src="{{ asset('assets/theme/images/default_image.png') }}"
                                        class="user-image rounded-circle" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">{{ ucfirst(Auth::user()->name ?? '') }}</span>
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
    <script src="{{ asset('assets/theme/js/custom-js/copy-data.js') }}"></script>

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
    <script>
        //  @if (session('success'))
        //         toastr.success("{{ session('success') }}", "Success");
        //     @endif

        //     @if (session('error'))
        //         toastr.error("{{ session('error') }}", "Error");
        //     @endif

        //     @if (session('warning'))
        //         toastr.warning("{{ session('warning') }}", "Warning");
        //     @endif

        //     @if (session('info'))
        //         toastr.info("{{ session('info') }}", "Info");
        //     @endif
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

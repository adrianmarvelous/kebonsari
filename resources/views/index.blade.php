    {{-- <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Kebonsari</title>
    </head>
    <body>
                      
        @if (Route::current()->getName() == 'index')
        
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('web.layanan.index') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama">
                                <label class="mt-3" for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
        <div class="p-3 m-3">
            
            <p class="text-center" style="margin-top: 100px;font-size:3rem">Kelurahan Kebonsari</p>
            <h4 class="text-center">Pemerintah Kota Surabaya</h4>

            <div class="position-fixed bottom-0 start-0 end-0 bg-white p-3 shadow">
                <div class="d-flex flex-column">
                    
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Pelayanan
                </button>

                    <a href="{{ route('web.informasi_umum') }}" class="btn btn-primary mt-3 mb-2">Informasi Umum</a>
                </div>
            </div>
        </div>
        @endif
        @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchBox').on('keyup', function () {
                let query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: "{{ route('web.layanan.search') }}",
                        type: "GET",
                        data: { q: query },
                        success: function (data) {
                            $('#suggestions').empty();
                            if (data.length > 0) {
                                data.forEach(item => {
                                    $('#suggestions').append(
                                        `<li class="list-group-item suggestion-item" 
                                            data-id="${item.id}" 
                                            data-name="${item.nama_layanan}">
                                            ${item.nama_layanan} <small class="text-muted">(${item.sektor})</small>
                                        </li>`
                                    );
                                });
                            } else {
                                $('#suggestions').append('<li class="list-group-item text-muted">Tidak ditemukan</li>');
                            }
                        }
                    });
                } else {
                    $('#suggestions').empty();
                }
            });

            // Click suggestion → redirect to detail page
            $(document).on('click', '.suggestion-item', function () {
                let id = $(this).data('id');
                let url = "{{ route('web.layanan.detail', ':id') }}"; // route helper
                url = url.replace(':id', id); // replace placeholder with real id
                window.location.href = url;
            });
        });
    </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    </html> --}}
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Dashboard</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
        <link rel="icon" href="{{ asset('templetes/kaiadmin-lite/assets/img/kaiadmin/favicon.ico') }}"
            type="image/x-icon" />

        <!-- Fonts and icons -->
        <script src="{{ asset('templetes/kaiadmin-lite/assets/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
            WebFont.load({
                google: {
                    families: ["Public Sans:300,400,500,600,700"]
                },
                custom: {
                    families: [
                        "Font Awesome 5 Solid",
                        "Font Awesome 5 Regular",
                        "Font Awesome 5 Brands",
                        "simple-line-icons",
                    ],
                    urls: ["{{ asset('templetes/kaiadmin-lite/assets/css/fonts.min.css') }}"],
                },
                active: function() {
                    sessionStorage.fonts = true;
                },
            });
        </script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('templetes/kaiadmin-lite/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('templetes/kaiadmin-lite/assets/css/plugins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('templetes/kaiadmin-lite/assets/css/kaiadmin.min.css') }}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->

        <link rel="stylesheet" href="{{ asset('templetes/kaiadmin-lite/assets/css/demo.css') }}" />
    </head>

    <body>

        <div class="wrapper">
            <!-- Sidebar -->
            <div class="sidebar sidebar-style-2" data-background-color="dark">
                <div class="sidebar-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('index') }}" class="logo">
                            <h1 class="text-white">Kebonsari</h1>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <ul class="nav nav-secondary">
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="dashboard">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="../demo1/index.html">
                                                <span class="sub-item">Dashboard 1</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Menu</h4>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="main-header">
                    <div class="main-header-logo">
                        <!-- Logo Header -->
                        <div class="logo-header" data-background-color="dark">
                            <a href="index.html" class="logo">
                                <img src="{{ asset('templetes/kaiadmin-lite/assets/img/kaiadmin/logo_light.svg') }}"
                                    alt="navbar brand" class="navbar-brand" height="20" />
                            </a>
                            <div class="nav-toggle">
                                <button class="btn btn-toggle toggle-sidebar">
                                    <i class="gg-menu-right"></i>
                                </button>
                                <button class="btn btn-toggle sidenav-toggler">
                                    <i class="gg-menu-left"></i>
                                </button>
                            </div>
                            <button class="topbar-toggler more">
                                <i class="gg-more-vertical-alt"></i>
                            </button>
                        </div>
                        <!-- End Logo Header -->
                    </div>
                    <!-- Navbar Header -->
                    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                        <div class="container-fluid">
                            

                            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            </ul>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>

                <div class="container">
                    <div class="page-inner">


                        @if (Route::current()->getName() == 'index')
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('web.layanan.index') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <label for="">Nama</label>
                                                <input type="text" class="form-control" name="nama">
                                                <label class="mt-3" for="">Alamat</label>
                                                <input type="text" class="form-control" name="alamat">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 m-3 card">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="text-center" style="margin-top: 100px;font-size:3rem">Kelurahan Kebonsari
                                        </p>
                                        <h4 class="text-center">Pemerintah Kota Surabaya</h4>
                                    </div>
                                    <div style="margin-top: 10rem">
                                        <div class="d-flex flex-column">

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Pelayanan
                                            </button>

                                            <a href="{{ route('web.informasi_umum') }}"
                                                class="btn btn-primary mt-3 mb-2">Informasi Umum</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <nav class="pull-left">
                            {{-- <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul> --}}
                        </nav>
                        <div class="copyright">
                            Kelurahan Kebonsari
                            {{-- 2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a> --}}
                        </div>
                        <div>
                            {{-- Distributed by
                        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>. --}}
                        </div>
                    </div>
                </footer>
            </div>

        </div>

        <!--   Core JS Files   -->
        <script src="{{ asset('templetes/kaiadmin-lite/assets/js/core/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('templetes/kaiadmin-lite/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('templetes/kaiadmin-lite/assets/js/core/bootstrap.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{ asset('templetes/kaiadmin-lite/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

        <!-- Kaiadmin JS -->
        <script src="{{ asset('templetes/kaiadmin-lite/assets/js/kaiadmin.min.js') }}"></script>
        
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script>
            $(document).ready(function() {
                $('#searchBox').on('keyup', function() {
                    let query = $(this).val();
                    if (query.length > 1) {
                        $.ajax({
                            url: "{{ route('web.layanan.search') }}",
                            type: "GET",
                            data: {
                                q: query
                            },
                            success: function(data) {
                                $('#suggestions').empty();
                                if (data.length > 0) {
                                    data.forEach(item => {
                                        $('#suggestions').append(
                                            `<li class="list-group-item suggestion-item" 
                                            data-id="${item.id}" 
                                            data-name="${item.nama_layanan}">
                                            ${item.nama_layanan} <small class="text-muted">(${item.sektor})</small>
                                        </li>`
                                        );
                                    });
                                } else {
                                    $('#suggestions').append(
                                        '<li class="list-group-item text-muted">Tidak ditemukan</li>'
                                        );
                                }
                            }
                        });
                    } else {
                        $('#suggestions').empty();
                    }
                });

                // Click suggestion → redirect to detail page
                $(document).on('click', '.suggestion-item', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('web.layanan.detail', ':id') }}"; // route helper
                    url = url.replace(':id', id); // replace placeholder with real id
                    window.location.href = url;
                });
            });
        </script>
    </body>

    </html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Rs_app' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Select2 Bootstrap 4-->
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@6.14.1/ol.css">
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/ol@6.14.1/dist/ol.js"></script>



    <style>
        .theme-switch-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: auto;
            /* Center vertically */
        }

        .theme-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .theme-switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "\f185";
            /* FontAwesome sun icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
            content: "\f186";
            /* FontAwesome moon icon */
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="initMap()">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="border: none; padding: 0; margin: 0;">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="options" autocomplete="off" checked>
                            <i class="fa-regular fa-sun"></i>
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" autocomplete="off">
                            <i class="fa-solid fa-moon"></i>
                        </label>
                    </div> --}}

                    <div class="theme-switch-wrapper  ">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>


                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-lightblue elevation-4">
            <!-- Brand Logo -->
            @php
                // Mengambil data menggunakan model Webset
                $setweb = App\Models\setweb::first(); // Anda bisa sesuaikan query ini dengan kebutuhan Anda
            @endphp
            <a href="#" class="brand-link">
                <img src="{{ asset('webset/' . $setweb->logo_app) }}" alt="Webset Logo"
                    class="brand-image img-circle elevation-4" style="opacity: .9">
                <span class="brand-text font-weight-light">{{ $setweb->name_app }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('storage/' . Auth::user()->profile) }}" class="img-circle elevation-2"
                            alt="Profile Photo">
                    </div>
                    <div class="info">
                        @if (Auth::check())
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        @endif
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('superadmin') }}"
                                class="nav-link {{ \Route::is('superadmin') ? 'active' : '' }}">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kendaraan') }}"
                                class="nav-link {{ \Route::is('kendaraan') ? 'active' : '' }}">
                                <i class="fas fa-fw fa-car-side"></i>
                                <p>Kendaraan</p>
                            </a>
                        </li>

                        <li class="nav-item {{ \Route::is('mkendaraan') || 'pemilik' ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ \Route::is('mkendaraan') || 'pemilik' ? 'active' : '' }}">
                                <i class="fas fa-fw fa-database"></i>
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('mkendaraan') }}"
                                        class="nav-link {{ \Route::is('mkendaraan') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>Merek Kendaraan</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('pemilik') }}"
                                        class="nav-link {{ \Route::is('pemilik') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>Pemilik Kendaraan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('setweb') }}"
                                class="nav-link {{ \Route::is('setweb') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Web Seting
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        @yield('content')




        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?></strong>

        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- {{-- ChartJS --}} -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- <script src="{{ asset('plugins/select2/js/select2.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script> -->



    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "lengthChange": true,
                "language": {
                    "lengthMenu": "Tampil  _MENU_",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                    "search": "Cari :", // Custom text for the search input
                    "paginate": {
                        "previous": "Sebelumnya", // Custom text for the previous button
                        "next": "Berikutnya" // Custom text for the next button
                    }
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "lengthChange": false,
                "bPaginate": false,
                "bInfo": false,
                "language": {
                    "search": "Cari :", // Custom text for the search input
                }
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

            $("#example4").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "lengthChange": false,
                "bPaginate": false,
                "bInfo": false,
                "language": {
                    "search": "Cari :", // Custom text for the search input
                }
            }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');

            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "lengthChange": false,
                "bPaginate": false,
                "bInfo": false,
                "language": {
                    "search": "Cari :", // Custom text for the search input
                }
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

            $("#example5").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "lengthChange": false,
                "bPaginate": false,
                "bInfo": false,
                "language": {
                    "search": "Cari :", // Custom text for the search input
                }
            }).buttons().container().appendTo('#example5_wrapper .col-md-6:eq(0)');
        });


        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true
        });

        // Saat halaman dimuat, cek apakah ada pesan sukses atau error dari server dan tampilkan SweetAlert sesuai.
        document.addEventListener('DOMContentLoaded', function() {
            if ("{{ session('success') }}") {
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            }

            if ("{{ session('error') }}") {
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            }
        });

        $(function() {
            $('#tahunBuat, #tanggalPajak, #tanggalStnk').datetimepicker({
                format: 'L'
            });
        });

        // Menerapkan preferensi dark mode saat halaman dimuat
        $(document).ready(function() {

            // Memeriksa apakah ada preferensi tema yang disimpan di local storage
            var darkMode = localStorage.getItem('darkMode');

            // Jika tidak ada preferensi tema yang disimpan, menggunakan tema terang sebagai default
            if (!darkMode) {
                $('body').removeClass('dark-mode');
                $('.navbar').removeClass('dark-mode'); // Menghapus tema gelap dari navbar
                $('.main-sidebar').removeClass(
                    'sidebar-dark-lightblue dark-mode'); // Menghapus tema gelap dari sidebar
            } else if (darkMode === 'enabled') {
                // Jika preferensi tema adalah mode gelap, aktifkan mode gelap
                $('body').addClass('dark-mode');
                $('.navbar').addClass('dark-mode'); // Menambahkan tema gelap ke navbar
                $('.main-sidebar').addClass(
                    'sidebar-dark-lightblue dark-mode'); // Menambahkan tema gelap ke sidebar
                $('#checkbox').prop('checked', true);
            }

            // Event listener untuk perubahan mode
            $('.theme-switch input').on('change', function() {
                // Menghapus kelas 'active' dari semua label
                $('.theme-switch input').removeClass('active');

                // Menambahkan kelas 'active' ke label yang diklik
                $(this).addClass('active');

                // Memeriksa apakah label yang diklik adalah label pertama (mode terang)
                if ($(this).is(':checked')) {
                    $('body').addClass('dark-mode');
                    $('.navbar').addClass('dark-mode'); // Menambahkan tema gelap ke navbar
                    $('.main-sidebar').addClass(
                        'sidebar-dark-lightblue dark-mode'); // Menambahkan tema gelap ke sidebar
                    localStorage.setItem('darkMode',
                        'enabled'); // Menyimpan preferensi dark mode pada local storage
                } else {
                    $('body').removeClass('dark-mode');
                    $('.navbar').removeClass('dark-mode'); // Menghapus tema gelap dari navbar
                    $('.main-sidebar').removeClass(
                        'sidebar-dark-lightblue dark-mode'); // Menghapus tema gelap dari sidebar
                    localStorage.setItem('darkMode',
                        'disabled'); // Menyimpan preferensi light mode pada local storage
                }
            });


            $('#addKendaraan-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addModal').modal('hide');
                        toastr.success(response.message);

                        var table = $('#example1').DataTable();
                        table.ajax.reload();
                        $('#addForm')[0].reset();
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan saat menyimpan kendaraan.');
                    }
                });
            });

            $(document).on('click', '.edit-data', function() {
                var id = $(this).data('id');
                var no_pol = $(this).data('no-pol');
                var nama_pem = $(this).data('nama-pem');
                var merek = $(this).data('merek');
                var model = $(this).data('model');
                var kode_merek = $(this).data('kode-merek');
                var tgl_buat = $(this).data('tgl-buat');
                var tgl_pajak = $(this).data('tgl-pajak');
                var tgl_stnk = $(this).data('tgl-stnk');

                $('#editId').val(id);
                $('#editNoPol').val(no_pol);
                $('#editNamaPem').val(nama_pem);
                $('#editMerek').val(merek);
                $('#editModel').val(model);
                $('#editKodeMerek').val(kode_merek);
                $('#editTglBuat').val(tgl_buat);
                $('#editTglPajak').val(tgl_pajak);
                $('#editTglStnk').val(tgl_stnk);
            });

            $(document).on('click', '.delete-data', function() {
                var id = $(this).data('id');
                var no_pol = $(this).data('no-pol');
                var nama_pem = $(this).data('nama-pem');

                $('#deleteId').val(id);
                $('#deleteText').html(
                    "<span>Apa anda yakin ingin menghapus kendaraan dengan No.Polisi <b>" + no_pol +
                    "</b> a/n <b>" + nama_pem + "</b></span>");

            });

            $(document).on('click', '.edit-mdata', function() {
                var id = $(this).data('id');
                var merek = $(this).data('merek');
                var model = $(this).data('model');
                var kode_merek = $(this).data('kode-merek');
                var tgl_buat = $(this).data('tgl-buat');

                $('#meditId').val(id);
                $('#meditMerek').val(merek);
                $('#meditModel').val(model);
                $('#meditKodeMerek').val(kode_merek);
                $('#meditTglBuat').val(tgl_buat);
            });

            $('#editKendaraan-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addModal').modal('hide');
                        toastr.success(response.message);

                        var table = $('#example1').DataTable();
                        table.ajax.reload();
                        $('#addForm')[0].reset();
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan saat menyimpan kendaraan.');
                    }
                });
            });

            $('#deleteKendaraan-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        toastr.success(response.message);

                        var table = $('#example1').DataTable();
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        toastr.error('Terjadi kesalahan saat menyimpan kendaraan.');
                    }
                });
            });


            $(document).on('click', '.delete-mdata', function() {
                var id = $(this).data('id');
                var merek = $(this).data('merek');
                var kode_merek = $(this).data('kode-merek');

                $('#deleteId').val(id);
                $('#deleteText').html(
                    "<span>Apa anda yakin ingin menghapus kendaraan dengan No.Polisi <b>" + merek +
                    "</b> a/n <b>" + kode_merek + "</b></span>");

            });

            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%',
                dropdownParent: "#addPemilikModal"
            });

            $.ajax({
                url: `{{ url('api/provinsi') }}`,
                method: 'GET',
                success: function(response) {
                    var provinsiSelect = $('#provinsi');
                    response.data.forEach(function(provinsi) {
                        provinsiSelect.append(new Option(provinsi.name, provinsi.kode));
                    });
                }
            });

            $('#provinsi').on('change', function() {
                var kodeProvinsi = $(this).val();
                $('#kabupaten').empty().append(new Option('Pilih Kabupaten', ''));
                $('#kecamatan').empty().append(new Option('Pilih Kecamatan', ''));
                $('#desa').empty().append(new Option('Pilih Desa', ''));

                if (kodeProvinsi) {
                    $.ajax({
                        url: `{{ url('api/kabupaten') }}/${kodeProvinsi}`,
                        method: 'GET',
                        success: function(response) {
                            var kabupatenSelect = $('#kabupaten');
                            response.data.forEach(function(kabupaten) {
                                kabupatenSelect.append(new Option(kabupaten.name,
                                    kabupaten.kode));
                            });
                        }
                    });
                }
            });

            $('#kabupaten').on('change', function() {
                var kodeKabupaten = $(this).val();
                $('#kecamatan').empty().append(new Option('Pilih Kecamatan', ''));
                $('#desa').empty().append(new Option('Pilih Desa', ''));

                if (kodeKabupaten) {
                    $.ajax({
                        url: `{{ url('api/kecamatan') }}/${kodeKabupaten}`,
                        method: 'GET',
                        success: function(response) {
                            var kecamatanSelect = $('#kecamatan');
                            response.data.forEach(function(kecamatan) {
                                kecamatanSelect.append(new Option(kecamatan.name,
                                    kecamatan.kode));
                            });
                        }
                    });
                }
            });

            $('#kecamatan').on('change', function() {
                var kodeKecamatan = $(this).val();
                $('#desa').empty().append(new Option('Pilih Desa', ''));

                if (kodeKecamatan) {
                    $.ajax({
                        url: `{{ url('api/desa') }}/${kodeKecamatan}`,
                        method: 'GET',
                        success: function(response) {
                            var desaSelect = $('#desa');
                            response.data.forEach(function(desa) {
                                desaSelect.append(new Option(desa.name, desa.kode));
                            });
                        }
                    });
                }
            });

        });
    </script>

    <script>
        function showWarningForId(id) {
            // Functionality can be added here if needed
        }

        function loadDataAndCheckExpired(callback) {
            var currentDate = new Date().toISOString().split('T')[0];
            var kendaraan = {!! json_encode($kendaraan) !!};
            if (!Array.isArray(kendaraan)) {
                kendaraan = [kendaraan];
            }

            var kendaraanIdJatuhTempo = [];
            kendaraan.forEach(function(k) {
                if (k.tgl_pajak <= currentDate) {
                    kendaraanIdJatuhTempo.push(k.id);
                }
            });

            console.log('Jumlah kendaraan yang sudah jatuh tempo: ' + kendaraanIdJatuhTempo.length);

            function showWarningsSequentially(id) {
                if (id < kendaraanIdJatuhTempo.length) {
                    showWarningForId(kendaraanIdJatuhTempo[id]);
                    var noPolisi = kendaraan.find(k => k.id === kendaraanIdJatuhTempo[id]).no_pol;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Kendaraan dengan nomor polisi ' + noPolisi +
                            ' memiliki PAJAK yang sudah jatuh tempo!',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showWarningsSequentially(id + 1);
                        }
                    });
                } else if (callback) {
                    callback();
                }
            }
            showWarningsSequentially(0);
        }

        function loadDataAndCheckExpired1(callback) {
            var currentDate = new Date().toISOString().split('T')[0];
            var kendaraan = {!! json_encode($kendaraan) !!};
            if (!Array.isArray(kendaraan)) {
                kendaraan = [kendaraan];
            }

            var kendaraanIdJatuhTempo = [];
            kendaraan.forEach(function(k) {
                if (k.tgl_stnk <= currentDate) {
                    kendaraanIdJatuhTempo.push(k.id);
                }
            });

            console.log('Jumlah kendaraan yang sudah jatuh tempo: ' + kendaraanIdJatuhTempo.length);

            function showWarningsSequentially(id) {
                if (id < kendaraanIdJatuhTempo.length) {
                    showWarningForId(kendaraanIdJatuhTempo[id]);
                    var noPolisi = kendaraan.find(k => k.id === kendaraanIdJatuhTempo[id]).no_pol;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Kendaraan dengan nomor polisi ' + noPolisi +
                            ' memiliki STNK yang sudah jatuh tempo!',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showWarningsSequentially(id + 1);
                        }
                    });
                } else if (callback) {
                    callback();
                }
            }
            showWarningsSequentially(0);
        }

        document.addEventListener('DOMContentLoaded', function() {
            function checkWarnings() {
                var warningsEnabled = localStorage.getItem('warningsEnabled') === 'true';
                var warningsEnabled1 = localStorage.getItem('warningsEnabled1') === 'true';

                if (warningsEnabled && warningsEnabled1) {
                    loadDataAndCheckExpired(function() {
                        loadDataAndCheckExpired1();
                    });
                } else if (warningsEnabled) {
                    loadDataAndCheckExpired();
                } else if (warningsEnabled1) {
                    loadDataAndCheckExpired1();
                }
            }

            function runAtSpecificTime(hour, minute, callback) {
                var now = new Date();
                var then = new Date();

                then.setHours(hour);
                then.setMinutes(minute);
                then.setSeconds(0);

                if (then <= now) {
                    then.setDate(then.getDate() + 1);
                }

                var timeout = then.getTime() - now.getTime();
                setTimeout(function() {
                    callback();
                    setInterval(callback, 24 * 60 * 60 * 1000);
                }, timeout);
            }

            var reminderTime = localStorage.getItem('reminderTime') || '08:00';
            var timeParts = reminderTime.split(':');
            var hour = parseInt(timeParts[0], 10);
            var minute = parseInt(timeParts[1], 10);

            // Jalankan checkWarnings saat halaman dimuat
            if (window.location.pathname === '/superadmin') {
                checkWarnings();

                // Jalankan checkWarnings pada waktu yang ditentukan
                runAtSpecificTime(hour, minute, checkWarnings);
            }
        });
    </script>

    <script>
        $(function() {
            // Get context with jQuery - using jQuery's .get() method.
            var lineChartCanvas = $('#lineChart');

            // Fetch data from the database using AJAX
            $.ajax({
                url: `{{ url('api/fetch-data') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var data = response.data;

                    var labels = data.map(function(item) {
                        return item.no_pol; // Assuming 'no_pol' is the label field
                    });

                    var tgl_pajak = data.map(function(item) {
                        return new Date(item.tgl_pajak) < new Date() ? 1 : 0;
                    });

                    var tgl_stnk = data.map(function(item) {
                        return new Date(item.tgl_stnk) < new Date() ? 1 : 0;
                    });

                    var akan_jatuh_tempo_pajak = data.map(function(item) {
                        var tgl_pajak = new Date(item.tgl_pajak);
                        tgl_pajak.setDate(tgl_pajak.getDate() - 7);
                        return new Date() > tgl_pajak ? 1 : 0;
                    });

                    var akan_jatuh_tempo_stnk = data.map(function(item) {
                        var tgl_stnk = new Date(item.tgl_stnk);
                        tgl_stnk.setDate(tgl_stnk.getDate() - 7);
                        return new Date() > tgl_stnk ? 1 : 0;
                    });

                    var lineChartData = {
                        labels: labels,
                        datasets: [{
                                label: 'Tgl Pajak',
                                data: tgl_pajak,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Tgl STNK',
                                data: tgl_stnk,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Akan Jatuh Tempo Pajak',
                                data: akan_jatuh_tempo_pajak,
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Akan Jatuh Tempo STNK',
                                data: akan_jatuh_tempo_stnk,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }
                        ]
                    };

                    var lineChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }]
                        }
                    };

                    // This will get the first returned node in the jQuery collection.
                    new Chart(lineChartCanvas, {
                        type: 'line',
                        data: lineChartData,
                        options: lineChartOptions
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>


    <script>
        function getCoordinates() {
            var apiKey =
                'AhQXcTxku41cvwtxg1VIrHx3YcM_hi_7r7peMHPYQht_1tf98FMY-WHW-q6FogCr'; // Replace with your Bing Maps API key
            var address = 'Jl. Bungur Nn 09, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat, Indonesia';
            var url = 'http://dev.virtualearth.net/REST/v1/Locations?query=' + encodeURIComponent(address) +
                '&key=' + apiKey;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.resourceSets.length > 0 && data.resourceSets[0].resources.length > 0) {
                        var coordinates = data.resourceSets[0].resources[0].point.coordinates;
                        var latitude = coordinates[0];
                        var longitude = coordinates[1];
                        console.log('Latitude: ' + latitude);
                        console.log('Longitude: ' + longitude);
                    } else {
                        console.log('No results found for the given address.');
                    }
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>

    <script>
        function initMap() {
            var latitude = -6.882127;
            var longitude = 107.594617;

            console.log('Initializing map with coordinates:', latitude, longitude);

            var map = new ol.Map({
                target: 'map',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    center: ol.proj.fromLonLat([longitude, latitude]),
                    zoom: 15
                })
            });

            console.log('Map initialized.');

            var markerElement = document.createElement('div');
            markerElement.style.backgroundImage = 'url(https://openlayers.org/en/v4.6.5/examples/data/icon.png)';
            markerElement.style.backgroundSize = 'contain';
            markerElement.style.width = '32px';
            markerElement.style.height = '32px';
            markerElement.style.cursor = 'pointer'; // Make the cursor indicate clickable
            markerElement.title = 'Click to open Google Maps'; // Tooltip for extra user info

            console.log('Marker element created.');

            var marker = new ol.Overlay({
                position: ol.proj.fromLonLat([longitude, latitude]),
                positioning: 'center-center',
                element: markerElement,
                stopEvent: false
            });

            markerElement.addEventListener('click', function() {
                window.open('https://www.google.com/maps/@-6.882127,107.594617,20z?entry=ttu', '_blank');
            });

            console.log('Marker created at:', longitude, latitude);

            map.addOverlay(marker);

            console.log('Marker added to map.');
        }
    </script>
</body>

</html>

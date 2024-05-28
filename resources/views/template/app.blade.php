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

<body class="hold-transition sidebar-mini layout-fixed">
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

                        <li class="nav-item">
                            <a href="#" class="nav-link">
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

        });
    </script>

    <script>
        // Fungsi untuk menampilkan popup berdasarkan nomor polisi
        function showWarningForId(id) {
            // Functionality can be added here if needed
        }

        function loadDataAndCheckExpired() {
            // Mendapatkan tanggal sekarang dalam format YYYY-MM-DD
            var currentDate = new Date().toISOString().split('T')[0];

            // Mendapatkan data kendaraan dari database (diasumsikan telah dimuat sebelumnya)
            var kendaraan = {!! json_encode($kendaraan) !!};

            // Mengonversi data kendaraan menjadi array jika tidak sudah dalam bentuk array
            if (!Array.isArray(kendaraan)) {
                kendaraan = [kendaraan];
            }

            // Inisialisasi array untuk menyimpan ID kendaraan yang memiliki tanggal pajak yang sudah jatuh tempo
            var kendaraanIdJatuhTempo = [];

            // Perulangan untuk setiap kendaraan
            kendaraan.forEach(function(k) {
                // Cek apakah tgl_pajak jatuh tempo hari ini atau sebelumnya
                if (k.tgl_pajak <= currentDate) {
                    // Simpan ID kendaraan yang memiliki STNK yang sudah jatuh tempo
                    kendaraanIdJatuhTempo.push(k.id);
                }
            });

            // Tampilkan jumlah kendaraan yang sudah jatuh tempo
            console.log('Jumlah kendaraan yang sudah jatuh tempo: ' + kendaraanIdJatuhTempo.length);

            // Panggil fungsi showWarningForId untuk setiap ID kendaraan yang memiliki STNK yang sudah jatuh tempo
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
                }
            }

            showWarningsSequentially(0);
        }

        // Periksa URL saat halaman dimuat dan panggil fungsi loadDataAndCheckExpired jika berada di /superadmin
        document.addEventListener('DOMContentLoaded', function() {
            var currentUrl = window.location.pathname;
            if (currentUrl === '/superadmin') {
                loadDataAndCheckExpired();
            }
        });
    </script>

</body>

</html>

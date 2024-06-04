@extends('template.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Kendaraan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addModalKendaraan">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                    use Carbon\Carbon;
                                    Carbon::setLocale('id');
                                @endphp
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Polisi</th>
                                            <th>Nama Pemilik</th>
                                            <th>Merek</th>
                                            <th>Model</th>
                                            <th>Tanggal Pajak</th>
                                            <th class="text-center">Status Pajak</th>
                                            <th>Tanggal STNK</th>
                                            <th class="text-center">Status STNK</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index = 1; @endphp
                                        @foreach ($kendaraan as $kendaraan)
                                            @php
                                                $tglPajakFormatted = Carbon::parse(
                                                    $kendaraan->tgl_pajak,
                                                )->translatedFormat('d F Y');
                                                $tglStnkFormatted = Carbon::parse(
                                                    $kendaraan->tgl_stnk,
                                                )->translatedFormat('d F Y');
                                                $tglPajak = Carbon::parse($kendaraan->tgl_pajak);
                                                $tglStnk = Carbon::parse($kendaraan->tgl_stnk);
                                                $today = Carbon::now();
                                                $oneMonthFromNow = $today->copy()->addMonth();

                                                // if ($tglPajak->isPast()) {
                                                //     $pajakStatus =
                                                //         '<span class="badge badge-danger">Terlambat</span>
//     <br>
//     <a href="' .
                                                //         route('download-pdf', $kendaraan->id) .
                                                //         '">
//     <i class="fa fa-file-pdf text-secondary"></i></a>';
                                                // } elseif ($tglPajak->lessThanOrEqualTo($oneMonthFromNow)) {
                                                //     $pajakStatus =
                                                //         '<span class="badge badge-warning">Akan jatuh tempo</span>';
                                                // } else {
                                                //     $pajakStatus =
                                                //         '<span class="badge badge-success">Pembayaran Masih Lama</span>';
                                                // }

                                                if ($tglStnk->isPast()) {
                                                    $stnkStatus = '<span class="badge badge-danger">Terlambat</span>';
                                                } elseif ($tglStnk->lessThanOrEqualTo($oneMonthFromNow)) {
                                                    $stnkStatus =
                                                        '<span class="badge badge-warning">Akan jatuh tempo</span>';
                                                } else {
                                                    $stnkStatus =
                                                        '<span class="badge badge-success">Pembayaran Masih Lama</span>';
                                                }
                                            @endphp

                                            <?php
                                            // Contoh variabel tanggal
                                            $tglStnk = new DateTime('2024-05-01'); // Ganti dengan tanggal STNK yang sesungguhnya
                                            $oneMonthFromNow = (new DateTime())->modify('+1 month');
                                            
                                            // Menentukan status berdasarkan tanggal STNK
                                            if ($tglStnk < new DateTime()) {
                                                $currentStatus = 'late';
                                            } elseif ($tglStnk <= $oneMonthFromNow) {
                                                $currentStatus = 'dueSoon';
                                            } else {
                                                $currentStatus = 'longTime';
                                            }
                                            
                                            // Mengubah status berdasarkan input form (jika ada)
                                            if (isset($_POST['status'])) {
                                                $currentStatus = $_POST['status'];
                                            }
                                            
                                            ?>
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $kendaraan->pemilikRelation->no_polisi }}</td>
                                                <td>{{ $kendaraan->pemilikRelation->nama_pemilik }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->merek }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->model }}</td>
                                                <td>{{ $tglPajakFormatted }}</td>
                                                <td class="text-center">
                                                    <div class="status-select-container">
                                                        <div id="statusSelectDisplay" class="status-select-display">
                                                            <span class="status-badge status-<?php echo $currentStatus; ?>">
                                                                <?php
                                                                if ($currentStatus == 'late') {
                                                                    echo 'Terlambat';
                                                                } elseif ($currentStatus == 'dueSoon') {
                                                                    echo 'Akan jatuh tempo';
                                                                } else {
                                                                    echo 'Pembayaran Masih Lama';
                                                                }
                                                                ?>
                                                            </span>
                                                            <span>&#9662;</span> <!-- Down arrow symbol -->
                                                        </div>
                                                        <div id="statusOptions" class="status-options">
                                                            <div class="status-badge status-late" data-value="late">
                                                                Terlambat</div>
                                                            <div class="status-badge status-dueSoon" data-value="dueSoon">
                                                                Akan jatuh tempo</div>
                                                            <div class="status-badge status-longTime" data-value="longTime">
                                                                Pembayaran Masih Lama</div>
                                                        </div>
                                                        <select name="status" id="statusSelect" class="status-select">
                                                            <option value="late" <?php if ($currentStatus == 'late') {
                                                                echo 'selected';
                                                            } ?>>Terlambat</option>
                                                            <option value="dueSoon" <?php if ($currentStatus == 'dueSoon') {
                                                                echo 'selected';
                                                            } ?>>Akan jatuh tempo
                                                            </option>
                                                            <option value="longTime" <?php if ($currentStatus == 'longTime') {
                                                                echo 'selected';
                                                            } ?>>Pembayaran Masih
                                                                Lama</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $tglStnkFormatted }}</td>
                                                <td class="text-center">{!! $stnkStatus !!}</td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#editModalKendaraan"
                                                        data-id="{{ $kendaraan->id }}"
                                                        data-pemilik-id="{{ $kendaraan->pemilikRelation->id }}"
                                                        data-merek-kendaraan-id="{{ $kendaraan->merekKendaraanRelation->id }}"
                                                        data-tgl-pajak="{{ $kendaraan->tgl_pajak }}"
                                                        data-tgl-stnk="{{ $kendaraan->tgl_stnk }}"
                                                        class="edit-data-kendaraan">
                                                        <i class="fa fa-edit text-secondary"></i></a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#deleteModalKendaraan" data-id="{{ $kendaraan->id }}"
                                                        data-no-pol="{{ $kendaraan->pemilikRelation->no_polisi }}"
                                                        data-nama-pem="{{ $kendaraan->pemilikRelation->nama_pemilik }}"
                                                        class="delete-data">
                                                        <i class="fa fa-trash-can text-secondary"></i></a>
                                                </td>
                                            </tr>
                                            @php $index++; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="addModalKendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addFormKendaraan" action="{{ route('kendaraan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="addPemilikKendaraan" class="form-label">Pemilik Kendaraan</label>
                                    <select class="form-control select2" name="addPemilikKendaraan"
                                        id="addPemilikKendaraan">
                                        <option value="">Pilih Pemilik Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="addModelKendaraan" class="form-label">Model Kendaraan</label>
                                    <select class="form-control select2" name="addModelKendaraan" id="addModelKendaraan">
                                        <option value="">Pilih Model Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Pajak</label>
                                    <input type="date" class="form-control" name="addTanggalPajak"
                                        id="addTanggalPajak" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <input type="date" class="form-control" name="addTanggalStnk"
                                        id="addTanggalStnk" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button> <!-- Submit button -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalKendaraan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editFormKendaraan" action="{{ route('kendaraan.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" hidden>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="editPemilikKendaraan" class="form-label">ID</label>
                                    <input type="text" class="form-control" name="editIdKendaraan"
                                        id="editIdKendaraan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editPemilikKendaraan" class="form-label">Pemilik Kendaraan</label>
                                    <select class="form-control select2" name="editPemilikKendaraan"
                                        id="editPemilikKendaraan">
                                        <option value="">Pilih Pemilik Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editModelKendaraan" class="form-label">Model Kendaraan</label>
                                    <select class="form-control select2" name="editModelKendaraan"
                                        id="editModelKendaraan">
                                        <option value="">Pilih Model Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Pajak</label>
                                    <input type="date" class="form-control" name="editTanggalPajak"
                                        id="editTanggalPajak" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <input type="date" class="form-control" name="editTanggalStnk"
                                        id="editTanggalStnk" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button> <!-- Submit button -->
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModalKendaraan" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Hapus Data Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" action="{{ route('kendaraan.destroy') }}" method="POST">
                        @csrf
                        <input type="hidden" id="deleteId" name="deleteId">
                        <div id="deleteText"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button> <!-- Submit button -->
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var statusSelect = document.getElementById('statusSelect');
            var statusSelectDisplay = document.getElementById('statusSelectDisplay');
            var statusOptions = document.getElementById('statusOptions');

            statusSelectDisplay.addEventListener('click', function() {
                statusOptions.style.display = statusOptions.style.display === 'block' ? 'none' : 'block';
            });

            statusOptions.addEventListener('click', function(e) {
                if (e.target && e.target.matches('div[data-value]')) {
                    var value = e.target.getAttribute('data-value');
                    var text = e.target.textContent;
                    statusSelect.value = value;

                    statusSelectDisplay.innerHTML = '<span class="status-badge status-' + value + '">' +
                        text + '</span>' + '<span>&#9662;</span>';
                    statusOptions.style.display = 'none';
                }
            });

            // Set initial display
            var initialValue = statusSelect.value;
            var initialText = statusSelect.options[statusSelect.selectedIndex].text;
            statusSelectDisplay.innerHTML = '<span class="status-badge status-' + initialValue + '">' +
                initialText + '</span>' + '<span>&#9662;</span>';
        });

        // Hide options if click outside of the dropdown
        document.addEventListener('click', function(event) {
            var isClickInside = document.querySelector('.status-select-container').contains(event.target);
            if (!isClickInside) {
                document.getElementById('statusOptions').style.display = 'none';
            }
        });
    </script>
@endsection

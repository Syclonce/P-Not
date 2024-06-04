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
                                            <th>Kode Merek</th>
                                            <th>Tahun Pembuatan</th>
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
                                                $tanggalBuatFormatted = Carbon::parse($kendaraan->tgl_buat)->translatedFormat('Y');
                                                $tglPajakFormatted = Carbon::parse($kendaraan->tgl_pajak)->translatedFormat('d F Y');
                                                $tglStnkFormatted = Carbon::parse($kendaraan->tgl_stnk)->translatedFormat('d F Y');
                                                $tglPajak = Carbon::parse($kendaraan->tgl_pajak);
                                                $tglStnk = Carbon::parse($kendaraan->tgl_stnk);
                                                $today = Carbon::now();
                                                $oneMonthFromNow = $today->copy()->addMonth();
                                                
                                                if ($tglPajak->isPast()) {
                                                    $pajakStatus = '<span class="badge badge-danger">Terlambat</span>
                                                    <br>
                                                    <a href="' . route('download-pdf', $kendaraan->id) . '">
                                                    <i class="fa fa-file-pdf text-secondary"></i></a>';
                                                } elseif ($tglPajak->lessThanOrEqualTo($oneMonthFromNow)) {
                                                    $pajakStatus = '<span class="badge badge-warning">Akan jatuh tempo</span>';
                                                } else {
                                                    $pajakStatus = '<span class="badge badge-success">Pembayaran Masih Lama</span>';
                                                }

                                                if ($tglStnk->isPast()) {
                                                    $stnkStatus = '<span class="badge badge-danger">Terlambat</span>';
                                                } elseif ($tglStnk->lessThanOrEqualTo($oneMonthFromNow)) {
                                                    $stnkStatus= '<span class="badge badge-warning">Akan jatuh tempo</span>';
                                                } else {
                                                    $stnkStatus= '<span class="badge badge-success">Pembayaran Masih Lama</span>';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $kendaraan->no_pol }}</td>
                                                <td>{{ $kendaraan->nama_pem }}</td>
                                                <td>{{ $kendaraan->merek }}</td>
                                                <td>{{ $kendaraan->model }}</td>
                                                <td>{{ $kendaraan->kode_merek }}</td>
                                                <td>{{ $tanggalBuatFormatted}}</td>
                                                <td>{{ $tglPajakFormatted }}</td>
                                                <td class="text-center">{!! $pajakStatus !!}</td>
                                                <td>{{ $tglStnkFormatted }}</td>
                                                <td class="text-center">{!! $stnkStatus !!}</td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $kendaraan->id }}"
                                                        data-no-pol="{{ $kendaraan->no_pol }}"
                                                        data-nama-pem="{{ $kendaraan->nama_pem }}"
                                                        data-merek="{{ $kendaraan->merek }}"
                                                        data-model="{{ $kendaraan->model }}"
                                                        data-kode-merek="{{ $kendaraan->kode_merek }}"
                                                        data-tgl-buat="{{ $kendaraan->tgl_buat }}"
                                                        data-tgl-pajak="{{ $kendaraan->tgl_pajak }}"
                                                        data-tgl-stnk="{{ $kendaraan->tgl_stnk }}" class="edit-data">
                                                    <i class="fa fa-edit text-secondary"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                        data-id="{{ $kendaraan->id }}"
                                                        data-no-pol="{{ $kendaraan->no_pol }}"
                                                        data-nama-pem="{{ $kendaraan->nama_pem }}"
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
                                    <select class="form-control select2" name="addPemilikKendaraan" id="addPemilikKendaraan">
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
                                    <div class="input-group date" id="tanggalPajak" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#tanggalPajak" name="tanggalPajak" />
                                        <div class="input-group-append" data-target="#tanggalPajak"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <div class="input-group date" id="tanggalStnk" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#tanggalStnk" name="tanggalStnk" />
                                        <div class="input-group-append" data-target="#tanggalStnk"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('kendaraan.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="editId" name="editId">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editNoPol">No Polisi</label>
                                    <input type="text" class="form-control" id="editNoPol" name="no_pol" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editNamaPem">Nama Pemilik</label>
                                    <input type="text" class="form-control" id="editNamaPem" name="nama_pem"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editMerek">Merek</label>
                                    <input type="text" class="form-control" id="editMerek" name="merek" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editModel">Model</label>
                                    <input type="text" class="form-control" id="editModel" name="model" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editKodeMerek">Kode Merek</label>
                                    <input type="text" class="form-control" id="editKodeMerek" name="kode_merek"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editTglBuat">Tanggal Buat</label>
                                    <input type="date" class="form-control" id="editTglBuat" name="tgl_buat"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editTglPajak">Tanggal Pajak</label>
                                    <input type="date" class="form-control" id="editTglPajak" name="tgl_pajak"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editTglStnk">Tanggal STNK</label>
                                    <input type="date" class="form-control" id="editTglStnk" name="tgl_stnk"
                                        required>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
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
@endsection

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
                                                $tanggalBuatFormatted = Carbon::parse($kendaraan->merekKendaraanRelation->tgl_buat)->translatedFormat('Y');
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
                                                <td>{{ $kendaraan->pemilikRelation->no_polisi }}</td>
                                                <td>{{ $kendaraan->pemilikRelation->nama_pemilik }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->merek }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->model }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->kode_merek }}</td>
                                                <td class="text-center">{{ $tanggalBuatFormatted}}</td>
                                                <td>{{ $tglPajakFormatted }}</td>
                                                <td class="text-center">{!! $pajakStatus !!}</td>
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
                                                    <a href="#" data-toggle="modal" data-target="#deleteModalKendaraan"
                                                        data-id="{{ $kendaraan->id }}"
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
                                    <input type="date" class="form-control" name="addTanggalPajak" id="addTanggalPajak" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <input type="date" class="form-control" name="addTanggalStnk" id="addTanggalStnk" />
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

    <div class="modal fade" id="editModalKendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" class="form-control" name="editIdKendaraan" id="editIdKendaraan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editPemilikKendaraan" class="form-label">Pemilik Kendaraan</label>
                                    <select class="form-control select2" name="editPemilikKendaraan" id="editPemilikKendaraan">
                                        <option value="">Pilih Pemilik Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editModelKendaraan" class="form-label">Model Kendaraan</label>
                                    <select class="form-control select2" name="editModelKendaraan" id="editModelKendaraan">
                                        <option value="">Pilih Model Kendaraan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Pajak</label>
                                    <input type="date" class="form-control" name="editTanggalPajak" id="editTanggalPajak" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <input type="date" class="form-control" name="editTanggalStnk" id="editTanggalStnk" />
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
@endsection

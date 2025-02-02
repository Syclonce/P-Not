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
                                        data-target="#addModal">
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
                                            <th>Merek</th>
                                            <th>Model</th>
                                            <th>Kode Merek</th>
                                            <th>Tahun Pembuatan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index = 1; @endphp
                                        @foreach ($kendaraan as $kendaraan)
                                            @php
                                                $tanggalBuatFormatted = Carbon::parse(
                                                    $kendaraan->tgl_buat,
                                                )->translatedFormat('Y');
                                            @endphp
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $kendaraan->merek }}</td>
                                                <td>{{ $kendaraan->model }}</td>
                                                <td>{{ $kendaraan->kode_merek }}</td>
                                                <td>{{ $tanggalBuatFormatted }}</td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $kendaraan->id }}" data-merek="{{ $kendaraan->merek }}"
                                                        data-model="{{ $kendaraan->model }}"
                                                        data-kode-merek="{{ $kendaraan->kode_merek }}"
                                                        data-tgl-buat="{{ $kendaraan->tgl_buat }}"class="edit-mdata">
                                                        <i class="fa fa-edit text-secondary"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                        data-id="{{ $kendaraan->id }}"
                                                        data-merek="{{ $kendaraan->merek }}"
                                                        data-model="{{ $kendaraan->model }}"
                                                        data-kode-merek="{{ $kendaraan->kode_merek }}"
                                                        data-tgl-buat="{{ $kendaraan->tgl_buat }}" class="delete-mdata">
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

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addForm" action="{{ route('mkendaraan.store') }}" method="POST">
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
                                    <label>Nama Merk Kendaraan</label>
                                    <input type="text" class="form-control" name="namaMerk">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Model Kendaraan</label>
                                    <input type="text" class="form-control" name="namaModel">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kode Merk Kendaraan</label>
                                    <input type="text" class="form-control" name="kodeMerk">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tahun Buatan Kendaraan</label>
                                    <div class="input-group date" id="tahunBuat" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#tahunBuat" name="tahunBuat" />
                                        <div class="input-group-append" data-target="#tahunBuat"
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
                    <form id="editForm" action="{{ route('mkendaraan.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="meditId" name="editId">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Merk Kendaraan</label>
                                    <input type="text" class="form-control" id="meditMerek" name="namaMerk">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Model Kendaraan</label>
                                    <input type="text" class="form-control" id="meditModel" name="namaModel">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kode Merk Kendaraan</label>
                                    <input type="text" class="form-control" id="meditKodeMerek" name="kodeMerk">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tahun Buatan Kendaraan</label>
                                    <div class="input-group date" id="tahunBuat" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#tahunBuat" name="tahunBuat" id="meditTglBuat" />
                                        <div class="input-group-append" data-target="#tahunBuat"
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
                    <form id="deleteForm" action="{{ route('mkendaraan.destroy') }}" method="POST">
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

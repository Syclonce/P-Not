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
                                <h3 class="card-title">Data Pemilik Kendaraan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addPemilikModal">
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
                                <table id="pemilikTable" class="table table-bordered table-striped">
                                    
                                <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Polisi</th>
                                            <th>Nama Pemilik</th>
                                            <th>Alamat</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Kel/Desa</th>   
                                            <th>Kecamatan</th> 
                                            <th>Kota/Kab</th>     
                                            <th>Provinsi</th>   
                                            <th>Kode Pos</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index = 1; @endphp
                                        @foreach ($pemilik as $owner)
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $owner->no_polisi }}</td>
                                                <td>{{ $owner->nama_pemilik }}</td>
                                                <td>{{ $owner->alamat }} </td>
                                                <td>{{ $owner->rt }} </td>
                                                <td>{{ $owner->rw }} </td>
                                                <td>{{ $owner->desaRelation->name }}</td>
                                                <td>{{ $owner->kecamatanRelation->name }}</td>
                                                <td>{{ $owner->kabupatenRelation->name }}</td>
                                                <td>{{ $owner->provinsiRelation->name }}</td>
                                                <td>{{ $owner->kode_pos }}</td>                                                                    
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#editPemilikModal"
                                                        class="edit-data-pemilik"
                                                        data-id="{{ $owner->id }}"
                                                        data-no-polisi="{{ $owner->no_polisi }}"
                                                        data-nama-pemilik="{{ $owner->nama_pemilik }}"
                                                        data-alamat="{{ $owner->alamat }}"
                                                        data-rt="{{ $owner->rt }}"
                                                        data-rw="{{ $owner->rw }}"
                                                        data-desa="{{ $owner->desaRelation->kode }}"
                                                        data-kecamatan="{{ $owner->kecamatanRelation->kode }}"
                                                        data-kabupaten="{{ $owner->kabupatenRelation->kode }}"
                                                        data-provinsi="{{ $owner->provinsiRelation->kode }}"
                                                        data-kode-pos="{{ $owner->kode_pos }}">
                                                    <i class="fa fa-edit text-secondary"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deletePemilikModal"
                                                        data-id="{{ $owner->id }}"
                                                        data-no-polisi="{{ $owner->no_polisi }}"
                                                        data-nama-pemilik="{{ $owner->nama_pemilik }}"
                                                       class="delete-data-pemilik">
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

    <div class="modal fade" id="addPemilikModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addFormPemilik" action="{{ route('pemilik.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pemilik Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="noPol" class="form-label">No.Polisi</label>
                                    <input type="text" class="form-control" name="noPol">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="namaPemilik" class="form-label">Nama Pemilik</label>
                                    <input type="text" class="form-control" name="namaPemilik">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">RT</label>
                                    <input type="text" class="form-control" name="rt">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">RW</label>
                                    <input type="text" class="form-control" name="rw">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select id="provinsi" class="form-control select2" name="provinsi">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">Kota/Kabupaten</label>
                                    <select id="kabupaten" class="form-control select2" name="kabupaten">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select id="kecamatan" class="form-control select2" name="kecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="desa" class="form-label">Kelurahan/Desa</label>
                                    <select id="desa" class="form-control select2" name="desa">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="kodePos">                             
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPemilikModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editFormPemilik" action="{{ route('pemilik.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pemilik Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" hidden>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="id" class="form-label">ID Pemilik</label>
                                    <input type="text" class="form-control" name="editIdPemilik" id="editIdPemilik">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="noPol" class="form-label">No.Polisi</label>
                                    <input type="text" class="form-control" name="editNoPol" id="editNoPol">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="namaPemilik" class="form-label">Nama Pemilik</label>
                                    <input type="text" class="form-control" name="editnamaPemilik" id="editnamaPemilik">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control" name="editAlamat" id="editAlamat"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">RT</label>
                                    <input type="text" class="form-control" name="editRt" id="editRt">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">RW</label>
                                    <input type="text" class="form-control" name="editRw" id="editRw">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-control select2" name="editProvinsi" id="editProvinsi">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">Kota/Kabupaten</label>
                                    <select class="form-control select2" name="editKabupaten" id="editKabupaten">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select class="form-control select2" name="editKecamatan" id="editKecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="desa" class="form-label">Kelurahan/Desa</label>
                                    <select class="form-control select2" name="editDesa" id="editDesa">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kabupaten" class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="editKodePos" id="editKodePos">                             
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePemilikModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteFormPemilik" action="{{ route('pemilik.destroy') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Hapus Data Pemilik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @csrf
                        <input type="hidden" id="pemilikId" name="pemilikId">
                        <div id="deleteTextPemilik"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
   
@endsection

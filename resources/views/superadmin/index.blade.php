@extends('template.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalKendaraan }} Unit</h3>

                                <p>Jumlah Kendaraan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalUsers }} User</h3>
                                <p>Jumlah User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $countKadaluarsa }} Unit</h3>

                                <p>Terlambat Pajak</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $countKadaluarsap }} Unit</h3>

                                <p>Terlambat Pajak STNK</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">daftar Jatuht Tempo kendaran Bulan ini</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Polisi</th>
                                            <th>Model</th>
                                            <th>Tanggal Pajak</th>
                                            <th>Tanggal STNK</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($kendaraans as $data)
                                            <tr>
                                                <td>{{ $data->no_pol }}</td>
                                                <td>{{ $data->merek }} - {{ $data->model }}</td>
                                                <td>{{ $data->tgl_pajak }}</td>
                                                <td>{{ $data->tgl_stnk }}</td>
                                                <td style="background-color: rgb(252, 228, 19); color: black;">Akan jatoh
                                                    tempo
                                                </td>
                                                <td class="text-center">
                                                    <a><i class="fa fa-trash-can text-secondary"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <br>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">daftar Jatuht Tempo kendaran Bulan ini</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Polisi</th>
                                            <th>Model</th>
                                            <th>Tanggal Pajak</th>
                                            <th>Tanggal STNK</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($kendaraanss as $data)
                                            <tr>
                                                <td>{{ $data->no_pol }}</td>
                                                <td>{{ $data->merek }} - {{ $data->model }}</td>
                                                <td>{{ $data->tgl_pajak }}</td>
                                                <td>{{ $data->tgl_stnk }}</td>
                                                <td style="background-color: red; color: black;">Terlambat</td>
                                                <td class="text-center">
                                                    <a><i class="fa fa-trash-can text-secondary"></i></a>
                                                </td>
                                            </tr>
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
@endsection

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
                                <h3>{{ $countKadaluarsap }} Unit</h3>
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
                                <h3>{{ $countKadaluarsa }} Unit</h3>

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
                    <div class="col-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Jatuh Tempo Pajak Bulan ini</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                    use Carbon\Carbon;
                                    Carbon::setLocale('id');
                                @endphp
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Polisi</th>
                                            <th>Model</th>
                                            <th>Tanggal Pajak</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($kendaraans as $data)
                                            @php
                                                $tglPajakFormatted = Carbon::parse($data->tgl_pajak)->translatedFormat(
                                                    'd F Y',
                                                );
                                            @endphp
                                            <tr>
                                                <td>{{ $data->no_pol }}</td>
                                                <td>{{ $data->merek }} - {{ $data->model }}</td>
                                                <td>{{ $tglPajakFormatted }}</td>
                                                <td> <span class="badge badge-warning">Akan jatuh tempo</span>
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
                    <div class="col-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Jatuh Tempo STNK Bulan ini</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Polisi</th>
                                            <th>Model</th>
                                            <th>Tanggal STNK</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kendaraansss as $data)
                                            @php
                                                $tglStnkFormatted = Carbon::parse($data->tgl_stnk)->translatedFormat(
                                                    'd F Y',
                                                );
                                            @endphp
                                            <tr>
                                                <td>{{ $data->no_pol }}</td>
                                                <td>{{ $data->merek }} - {{ $data->model }}</td>
                                                <td>{{ $tglStnkFormatted }}</td>
                                                <td> <span class="badge badge-warning">Akan jatuh tempo</span>
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
                    <div class="col-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Lewat Jatuh Tempo Pajak </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Polisi</th>
                                            <th>Model</th>
                                            <th>Tanggal Pajak</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kendaraa as $data)
                                            @php
                                                $tglPajakFormatted = Carbon::parse($data->tgl_pajak)->translatedFormat(
                                                    'd F Y',
                                                );
                                            @endphp
                                            <tr>
                                                <td>{{ $data->no_pol }}</td>
                                                <td>{{ $data->merek }} - {{ $data->model }}</td>
                                                <td>{{ $tglPajakFormatted }}</td>
                                                <td><span class="badge badge-danger">Terlambat</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Lewat Jatuh Tempo STNK </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example5" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Polisi</th>
                                            <th>Model</th>
                                            <th>Tanggal STNK</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kendaraanss as $data)
                                            @php
                                                $tglStnkFormatted = Carbon::parse($data->tgl_stnk)->translatedFormat(
                                                    'd F Y',
                                                );
                                            @endphp
                                            <tr>
                                                <td>{{ $data->no_pol }}</td>
                                                <td>{{ $data->merek }} - {{ $data->model }}</td>
                                                <td>{{ $tglStnkFormatted }}</td>
                                                <td><span class="badge badge-danger">Terlambat</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Line Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
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

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
                                            <th class="text-center">Thn Pembuatan</th>
                                            <th class="text-center">Tanggal Pajak</th>
                                            <th class="text-center" style="width:30%">Status Pajak</th>
                                            <th>Tanggal STNK</th>
                                            <th class="text-center" style="width:30%">Status STNK</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index = 1; @endphp
                                        @foreach ($kendaraan as $kendaraan)
                                            @php

                                                $now = Carbon::now();
                                                $tglPajakFormatted = Carbon::parse(
                                                    $kendaraan->tgl_pajak,
                                                )->translatedFormat('d F Y');
                                                $tglStnkFormatted = Carbon::parse(
                                                    $kendaraan->tgl_stnk,
                                                )->translatedFormat('d F Y');

                                                $tglBuat = Carbon::parse(
                                                    $kendaraan->merekKendaraanRelation->tgl_buat,
                                                )->translatedFormat('Y');

                                                $tglPajak = Carbon::parse($kendaraan->tgl_pajak);
                                                $tglStnk = Carbon::parse($kendaraan->tgl_stnk);

                                                $currentDate = Carbon::parse($now);

                                                $daysDifference = $tglPajak->diffInDays($currentDate, false);
                                                $daysDifferenceStnk = $tglStnk->diffInDays($currentDate, false);


                                                $downloadLink = route('download-pdf', ['id' => $kendaraan->id]);
                                                $downloadLinks = route('download-pdfs', ['id' => $kendaraan->id]);



                                                if ($daysDifference > 30) {
                                                    $pajakState = '
                                                    <div class="btn-group">
                                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="dropdown" aria-expanded="false"><b>PENANGGUHAN PEMBAYARAN</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="paid"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="suspend"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-pause text-secondary"></i>&nbsp;
                                                                            Penangguhan Pembayaran
                                                                        </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="' . $downloadLink . '" target="_blank">
                                                                        <i class="fa fa-print text-secondary"></i>&nbsp;Cetak Surat Penagihan
                                                                    </a>
                                                                    </div>
                                                                </div>';
                                                } else if ($daysDifference <= 30 && $daysDifference >= 0 && $kendaraan->status_bayar_pajak == '4' ) {
                                                    $pajakState = '
                                                    <div class="btn-group">
                                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="dropdown" aria-expanded="false"><b>PENANGGUHAN PEMBAYARAN</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="paid"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="suspend"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-pause text-secondary"></i>&nbsp;
                                                                            Penangguhan Pembayaran
                                                                        </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="' . $downloadLink . '" target="_blank">
                                                                        <i class="fa fa-print text-secondary"></i>&nbsp;Cetak Surat Penagihan
                                                                    </a>
                                                                    </div>
                                                                </div>';

                                                } elseif ($daysDifference <= 30 && $daysDifference >= 0) {
                                                    $pajakState = '
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn bg-orange btn-xs" data-toggle="dropdown" aria-expanded="false"><b>MENUNGGU PEMBAYARAN</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="paid"
                                                                            data-current-state="3"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="suspend"
                                                                            data-current-state="3"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-pause text-secondary"></i>&nbsp;
                                                                            Penangguhan Pembayaran
                                                                        </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="' . $downloadLink . '" target="_blank">
                                                                        <i class="fa fa-print text-secondary"></i>&nbsp;Cetak Surat Penagihan
                                                                    </a>
                                                                    </div>
                                                                </div>';
                                                } elseif ($daysDifference >= -30 && $daysDifference < 0) {
                                                    $pajakState = '
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="dropdown" aria-expanded="false"><b>SEGERA JATUH TEMPO</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="paid"
                                                                            data-current-state="2"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                    </div>
                                                                </div>';
                                                } elseif ($daysDifference < -30) {
                                                    $pajakState = '
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-success btn-xs" data-toggle="dropdown" aria-expanded="false"><b>SUDAH DIBAYAR</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_pajak  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_pajak . '"
                                                                            data-status="paid"
                                                                            data-current-state="1"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="pajak">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                    </div>
                                                                </div>';
                                                };

                                                if ($daysDifferenceStnk > 30) {
                                                    $stnkState = '
                                                    <div class="btn-group">
                                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="dropdown" aria-expanded="false"><b>PENANGGUHAN PEMBAYARAN</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="paid"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="suspend"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-pause text-secondary"></i>&nbsp;
                                                                            Penangguhan Pembayaran
                                                                        </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="' . $downloadLinks . '" target="_blank">
                                                                        <i class="fa fa-print text-secondary"></i>&nbsp;Cetak Surat Penagihan
                                                                    </a>
                                                                    </div>
                                                                </div>';
                                                    } else if ($daysDifferenceStnk <= 30 && $daysDifferenceStnk >= 0 && $kendaraan->status_bayar_stnk == '4' ) {
                                                    $stnkState = '
                                                    <div class="btn-group">
                                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="dropdown" aria-expanded="false"><b>PENANGGUHAN PEMBAYARAN</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="paid"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="suspend"
                                                                            data-current-state="4"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-pause text-secondary"></i>&nbsp;
                                                                            Penangguhan Pembayaran
                                                                        </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="' . $downloadLinks . '" target="_blank">
                                                                        <i class="fa fa-print text-secondary"></i>&nbsp;Cetak Surat Penagihan
                                                                    </a>
                                                                    </div>
                                                                </div>';

                                                } elseif ($daysDifferenceStnk <= 30 && $daysDifferenceStnk >= 0) {
                                                    $stnkState = '
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn bg-orange btn-xs" data-toggle="dropdown" aria-expanded="false"><b>MENUNGGU PEMBAYARAN</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="paid"
                                                                            data-current-state="3"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="suspend"
                                                                            data-current-state="3"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-pause text-secondary"></i>&nbsp;
                                                                            Penangguhan Pembayaran
                                                                        </a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="' . $downloadLinks . '" target="_blank">
                                                                        <i class="fa fa-print text-secondary"></i>&nbsp;Cetak Surat Penagihan
                                                                    </a>
                                                                    </div>
                                                                </div>';
                                                } elseif ($daysDifferenceStnk >= -30 && $daysDifferenceStnk < 0) {
                                                    $stnkState = '
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="dropdown" aria-expanded="false"><b>SEGERA JATUH TEMPO</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="paid"
                                                                            data-current-state="2"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                    </div>
                                                                </div>';
                                                } elseif ($daysDifferenceStnk < -30) {
                                                    $stnkState = '
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-success btn-xs" data-toggle="dropdown" aria-expanded="false"><b>SUDAH DIBAYAR</b></button>
                                                                    <span class="sr-only">Toggle Dropdown</span></button>
                                                                    <div class="dropdown-menu" role="menu">
                                                                        <a class="dropdown-item" id="setPaid" href="#" data-toggle="modal" data-target="#paidStatusModal"
                                                                            data-id="' . $kendaraan->id . '"
                                                                            data-tgl-akhir="' . $kendaraan->tgl_stnk  . '"
                                                                            data-tgl-bayar="' . $kendaraan->tgl_bayar_stnk . '"
                                                                            data-status="paid"
                                                                            data-current-state="1"
                                                                            data-owner-nopol= "' . $kendaraan->pemilikRelation->no_polisi. '"
                                                                            data-owner-nama= "' . $kendaraan->pemilikRelation->nama_pemilik. '"
                                                                            data-jenis-pajak="stnk">
                                                                            <i class="fa fa-circle-check text-success"></i>&nbsp;
                                                                            Pembayaran
                                                                        </a>
                                                                    </div>
                                                                </div>';
                                                };

                                                $mapsUrl = "https://maps.google.com/?q=" . $kendaraan->pemilikRelation->latitude . ',' . $kendaraan->pemilikRelation->longitude;


                                            @endphp
                                            <tr>
                                                <td>{{ $index }}</td>
                                                <td>{{ $kendaraan->pemilikRelation->no_polisi }}</td>
                                                <td>{{ $kendaraan->pemilikRelation->nama_pemilik }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->merek }}</td>
                                                <td>{{ $kendaraan->merekKendaraanRelation->model }}</td>
                                                <td class="text-center">{{ $tglBuat }}</td>
                                                <td class="text-center">{{ $tglPajakFormatted }}</td>
                                                <td class="text-center" style="width:30%">{!! $pajakState !!}</td>
                                                <td class="text-center">{{ $tglStnkFormatted }}</td>
                                                <td class="text-center" style="width:30%">{!! $stnkState !!}</td>
                                                <td class="text-center">
                                                    <a href='{{ $mapsUrl }}' target="_blank"><i class="fa-solid fa-location-dot text-secondary"></i></a>
                                                    <!-- <a href='#' data-toggle="modal" data-target="#openMaps" data-longitude="{{ $kendaraan->pemilikRelation->longitude }}" data-latitude="{{ $kendaraan->pemilikRelation->latitude }}" class="open-maps" ><i class="fa-solid fa-location-dot text-secondary"></i></a> -->
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
                                    <div class="invalid-feedback" id="addPemilikKendaraanError"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="addModelKendaraan" class="form-label">Model Kendaraan</label>
                                    <select class="form-control select2" name="addModelKendaraan" id="addModelKendaraan">
                                        <option value="">Pilih Model Kendaraan</option>
                                    </select>
                                    <div class="invalid-feedback" id="addModelKendaraanError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Pajak</label>
                                    <input type="date" class="form-control" name="addTanggalPajak"
                                        id="addTanggalPajak" />
                                        <div class="invalid-feedback" id="addTanggalPajakError"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <input type="date" class="form-control" name="addTanggalStnk"
                                        id="addTanggalStnk" />
                                    <div class="invalid-feedback" id="addTanggalStnkError"></div>
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
                                    <div class="invalid-feedback" id="editPemilikKendaraanError"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editModelKendaraan" class="form-label">Model Kendaraan</label>
                                    <select class="form-control select2" name="editModelKendaraan"
                                        id="editModelKendaraan">
                                        <option value="">Pilih Model Kendaraan</option>
                                    </select>
                                    <div class="invalid-feedback" id="editModelKendaraanError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Pajak</label>
                                    <input type="date" class="form-control" name="editTanggalPajak"
                                        id="editTanggalPajak" />
                                        <div class="invalid-feedback" id="editTanggalPajakError"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir STNK</label>
                                    <input type="date" class="form-control" name="editTanggalStnk"
                                        id="editTanggalStnk" />
                                    <div class="invalid-feedback" id="editTanggalStnkError"></div>
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

    <div class="modal fade" id="paidStatusModal" tabindex="-1" role="dialog" aria-labelledby="paidStatusModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paidStatusHeader"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="setPaidForm" action="{{ route('update-paid-status') }}" method="POST">
                        @csrf
                        <div class="row" hidden>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" class="form-control" name="setPaidId" id="setPaidId" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jenis Pajak</label>
                                    <input type="text" class="form-control" name="setPaidJenis" id="setPaidJenis" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" name="setPaidStatus" id="setPaidStatus" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir Pajak</label>
                                    <input type="date" class="form-control" name="setPaidTanggalPajak" id="setPaidTanggalPajak" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Bayar Pajak</label>
                                    <input type="date" class="form-control" name="setPaidBayarPajak"  id="setPaidBayarPajak" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                            <div class="info-box bg-white">
                                <div class="info-box-content">
                                <span class="info-box-number text-center text-muted mb-0" id="setPaidOwnerPlat"></span>
                                <span class="info-box-number text-center text-muted mb-0 small" id="setPaidOwnerName"></span>
                                </div>
                            </div>
                            </div>
                            <div class="col-12 col-sm-6">
                            <div class="info-box bg-white">
                                <div class="info-box-content">
                                <span class="info-box-number text-center text-muted mb-0 small" id="setPaidCurrentStatus"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                         <label id="paidLabel"></label>
                         <div class="row" id="checkBoxTanggalBayarRow" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="7" checked="">
                                        <label for="customRadio1" class="custom-control-label">7 Hari Kedepan</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" value="14">
                                        <label for="customRadio2" class="custom-control-label">14 Hari Kedepan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio" value="30">
                                        <label for="customRadio3" class="custom-control-label">30 Hari Kedepan</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio" value="0">
                                        <label for="customRadio4" class="custom-control-label">Pilih Tanggal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="statusTanggalBayarRow" style="display: none;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="statusTanggalBayar" id="statusTanggalBayar" />
                                    <small id="tanggalBayarHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="openMaps" tabindex="-1" role="dialog" aria-labelledby="openMaps"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Peta Lokasi Pemilik Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                    <iframe
                        id="mapIframe"
                        class="embed-responsive-item"
                        src=""
                        frameborder="0"
                        style="border:0;"
                        allowfullscreen=""
                        aria-hidden="false"
                        tabindex="0">
                    </iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>





@endsection

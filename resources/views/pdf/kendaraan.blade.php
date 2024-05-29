<!DOCTYPE html>
<html>
<head>
    <title>Detail Kendaraan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Detail Kendaraan</h2>
    <table>
        <tr>
            <th>No Polisi</th>
            <td>{{ $kendaraan->no_pol }}</td>
        </tr>
        <tr>
            <th>Nama Pemilik</th>
            <td>{{ $kendaraan->nama_pem }}</td>
        </tr>
        <tr>
            <th>Merek</th>
            <td>{{ $kendaraan->merek }}</td>
        </tr>
        <tr>
            <th>Model</th>
            <td>{{ $kendaraan->model }}</td>
        </tr>
        <tr>
            <th>Kode Merek</th>
            <td>{{ $kendaraan->kode_merek }}</td>
        </tr>
        <tr>
            <th>Tahun Buat</th>
            <td>{{ $kendaraan->tgl_buat }}</td>
        </tr>
        <tr>
            <th>Tanggal Pajak</th>
            <td>{{ \Carbon\Carbon::parse($kendaraan->tgl_pajak)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Tanggal STNK</th>
            <td>{{ \Carbon\Carbon::parse($kendaraan->tgl_stnk)->translatedFormat('d F Y') }}</td>
        </tr>
    </table>
</body>
</html>

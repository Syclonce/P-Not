<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Surat Penagihan STNK</title>
    <style>
     
        .header {
            width: 100%;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
            overflow: auto;
        }

        .logo-section {
            float: left;
            width: 45%;
            text-align: center;
            margin-right: 5%;
            font-family: Calibri, sans-serif; /* Added font-family property */
            font-size: 14px;
        }

        .logo-section img {
            width: 55px;
            height: auto;
            margin: 0 auto;
            display: block;
        }

        .code-box {
            float: right;
            font-family: Calibri, sans-serif; /* Added font-family property */
            font-size: 13px;
            width: 50%;
            padding: 10px;
            background-color: #3c9fe1;
            text-align: center;
            margin-bottom: 12px;
        }

        .additional-text {
            clear: both;
            padding: 10px;
            margin-top: 12px;
            text-align: center;
            width: 45%;
            float: right;
            font-size: 15px;
            font-family: Cambria38, serif;

        }
        .additional-text p {
            margin: 0;
        }

        .custom-text {
            width: 100%;
            text-align: left;
            margin-top: 12px;
            font-size: 15px;
            font-family: Cambria38;
        }

        table {
        width: 80%; /* Adjust width as needed */
        }
        th, td {
            padding: 0px; /* Adjust general padding as needed */
            padding-left: 0px; /* Specific left padding */
            text-align: left; /* Adjust alignment as needed */
        }

        
        .custom-text p {
            text-align: left;
            margin: 5px 0;
        }

        .blanko-section {
            clear: both;
            padding: 10px;
            margin-top: 12px;
            text-align: center;
            width: 45%;
            float: right;
            font-size: 14px;
        }

        .left-info {
            clear: both;
            padding: 10px;
            margin-top: 12px;
            text-align: left;
            width: 45%;
            float: left;
            font-size: 15px;
        }

        .right-info {
            clear: both;
            padding: 10px;
            margin-top: 12px;
            text-align: left;
            width: 45%;
            float: right;
            font-size: 15px;
        }

        .square {
        width: 12px; /* Adjust width as needed */
        height: 12px; /* Adjust height as needed */
        border: 1px solid black; /* Border style */
        display: inline-block;
        vertical-align: middle; /* Aligns the square vertically */
        }

        @media screen and (min-width: 768px) {
         

            .code-box p {
                font-weight: normal; /* Regular font weight */
            }

            .code-box b {
                font-weight: 500; /* Regular font weight */
            }

            .logo-section p {
                font-weight: normal; /* Regular font weight */
            }

            .logo-section b {
                font-weight: 500; /* Regular font weight */
            }

            .custom-text {
                font-size: 16px;
            }

            .custom-text p {
                margin: 5px 0;
            }

            .blanko-section {
                clear: both;
                padding: 10px;
                margin-top: 12px;
                text-align: center;
                width: 45%;
                float: left;
                font-size: 14px;
            }

            .left-info {
                clear: both;
                padding: 10px;
                margin-top: 12px;
                text-align: center;
                width: 45%;
                float: left;
                font-size: 14px;
            }

         
            .bold-text {
                font-weight: 500;
            }
            .regular-text {
                font-weight: 100;
            }

            .square {
                width: 20px;
                height: 20px;
                background-color: black;
            }

                       
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo-section">
            <img src="https://www.smkn1surade.sch.id/upload/picture/8838943512px-coatofarmsofwestjava.svg.png"
                alt="Logo Provinsi" width="55">
            <p><b>PEMERINTAH PROVINSI JAWA BARAT</b><br>
            BADAN PENDAPATAN DAERAH</p>
        </div>
        <div class="code-box">
            <b>SURAT PEMBERITAHUAN KEWAJIBAN PEMBAYARAN</b>
            <b>PAJAK KENDARAAN BERMOTOR (SPKP2KB)</b>
            <p>Nomor: 973/SPKP2KB/23-Kota Banjar/III/2024</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="additional-text">
        <p>Kepada Yth. Bpk/Ibu/</p><br>
        <p>{{ $kendaraan->pemilikRelation->nama_pemilik }}</p>
        <p>{{ $kendaraan->pemilikRelation->alamat }}</p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="custom-text" style="text-align: justify;">
        <p>Dengan ini diberitahukan bahwa berdasarkan administrasi data kendaraan pada kantor Bersama Samsat, kendaraan
            milik saudara :</p>
        <br>
        @php
        use Carbon\Carbon;
        @endphp
        <table>
        <tr>
            <td>Nomor Registrasi</td>
            <td>:</td>
            <td> {{ $kendaraan->pemilikRelation->no_polisi }}</td>
        </tr>
        
        <tr>
            <td>Tahun/CC</td>
            <td>:</td>
            <td> {{ Carbon::parse($kendaraan->merekKendaraanRelation->tgl_buat)->translatedFormat('Y'); }}</td>
        </tr>
        
        <tr>
            <td>Merk Type</td>
            <td>:</td>
            <td> {{ $kendaraan->merekKendaraanRelation->merek . " - ".  $kendaraan->merekKendaraanRelation->model }}</td>
        </tr>
        <tr>
            <td>Masa pajak berakhir pada tanggal</td>
            <td>:</td>
            <td> {{ Carbon::parse($kendaraan->tgl_stnk)->translatedFormat('d F Y'); }}</td>
        </tr>
        </table>
      
        <br>
        <p style="text-align: justify;">Sehubungan dengan hal tersebut agar Saudara melakukan pendaftaran dan pembayaran Pajak Kendaraan Bermotor
            (PKB) pada kantor Bersama SAMSAT setempat, Keterlambatan melakukan pembayaran pada tanggal yang dimaksud
            akan dikenakan sanksi administratif sesuai perda nomor 13 Tahun 2011.</p>
        <p style="text-align: justify;">Bilamana kendaraan bermotor saudara telah berubah data kepemilikan/penguasaan objek dan subjek kendaraan, 
            maka diminta segera melapor dengan cara mengisi dan mengirimkan Kembali blanko yang tersedia dibawah ini berupa informasi status kendaraan.</p>
    </div>
  
    <div class="left-info">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>Nopol: {{ $kendaraan->pemilikRelation->no_polisi }}</p>
        <p>Nama: {{ $kendaraan->pemilikRelation->nama_pemilik }}</p>
    </div>
    <div class="blanko-section">
        <p>Banjar, <?= date('d M Y'); ?> </p>
        <p> PUSAT PENGELOLAAN PENDAPATAN DAERAH 
        <br> WILAYAH KOTA BANJAR </p>
        <br>
        <br>
        <br>
        <p> BENNY SURANATA, S.E., M.M <br>
        NIP 10680507 198903 1 006 </p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="left-info">    
        <p><div class="square"></div> Kendaraan hilang tidak melapor ke polisi<br>
        <div class="square"></div> Kendaraan ditarik leasing/penjamin<br>
        <div class="square"></div> Kendaraan sudah dipindah tangankan<br>
        <div class="square"></div> Kendaraan rusak berat</p>
    </div>
    <div class="right-info">    
        <p><div class="square"></div> Alamat tidak dikenal/ tidak sesuai<br>
        <div class="square"></div> Wajib pajak tidak merasa memiliki kendaraan<br>
        <div class="square"></div> Alasan lainnya .......</p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="blanko-section">
        <p>Yang Menerangkan/Wajib Pajak.. </p>
        <br>
        <br>
        <p>…………………………………………………..</p>
        <p>No HP :..........................................</p>
    </div>
</body>

</html>

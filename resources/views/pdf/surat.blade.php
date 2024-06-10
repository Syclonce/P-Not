<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Kop Surat</title>
    <style>
        .header {
            width: 100%;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
            overflow: auto;
            /* Menambahkan overflow auto untuk menghindari keterlaluanan float */
        }

        .logo-section {
            float: left;
            width: 45%;
            /* Mengurangi lebar untuk memberikan ruang */
            text-align: center;
            margin-right: 5%;
            /* Menambahkan margin kanan */
        }

        .logo-section img {
            width: 55px;
            height: auto;
            margin: 0 auto;
            display: block;
        }

        .logo-section p {
            margin-top: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .code-box {
            float: right;
            /* Mengatur float ke kanan */
            width: 45%;
            /* Mengurangi lebar untuk memberikan ruang */
            padding: 10px;
            background-color: lightblue;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 12px;
            /* Menambahkan margin bawah untuk memberikan ruang antara .code-box dan .additional-text */
        }

        .additional-text {
            clear: both;
            /* Membersihkan float */
            padding: 10px;
            margin-top: 12px;
            /* Menambahkan margin atas */
            text-align: center;
            /* Mengatur posisi teks ke tengah */
            width: 45%;
            /* Mengurangi lebar untuk memberikan ruang */
            float: right;
            /* Mengatur float ke kanan */
            font-size: 12px;
            /* Menyesuaikan ukuran teks dengan code-box */
        }

        .additional-text p {
            margin: 0;
            /* Menghapus margin bawaan paragraf */
        }

        .custom-text {
            width: 100%;
            /* Lebar 100% agar teks terletak di bawah */
            text-align: left;
            /* Posisi teks ke kiri */
            margin-top: 12px;
            /* Menambahkan margin atas */
            font-size: 12px;
            /* Ukuran teks */
        }

        .custom-text p {
            text-align: left;
            /* Posisi titik dua ke kanan */
            margin: 5px 0;
            /* Menambahkan margin atas dan bawah pada setiap paragraf */
        }

        .blanko-section {
            clear: both;
            /* Membersihkan float */
            padding: 10px;
            margin-top: 12px;
            /* Menambahkan margin atas */
            text-align: center;
            /* Mengatur posisi teks ke tengah */
            width: 45%;
            /* Mengurangi lebar untuk memberikan ruang */
            float: right;
            /* Mengatur float ke kanan */
            font-size: 12px;
            /* Menyesuaikan ukuran teks dengan code-box */
        }

        .left-info {
            clear: both;
            /* Membersihkan float */
            padding: 10px;
            margin-top: 12px;
            /* Menambahkan margin atas */
            text-align: center;
            /* Mengatur posisi teks ke tengah */
            width: 45%;
            /* Mengurangi lebar untuk memberikan ruang */
            float: left;
            /* Mengatur float ke kiri */
            font-size: 12px;
            /* Menyesuaikan ukuran teks dengan code-box */
        }

        @media screen and (min-width: 768px) {
            .logo-section p {
                font-size: 16px;
            }

            .code-box p {
                font-size: 16px;
            }

            .additional-text {
                font-size: 16px;
                /* Menyesuaikan ukuran teks dengan code-box */
            }

            .custom-text {
                font-size: 16px;
                /* Menyesuaikan ukuran teks dengan code-box */
            }

            .custom-text p {
                margin: 5px 0;
                /* Menambahkan margin atas dan bawah pada setiap paragraf */
            }

            .blanko-section {
                clear: both;
                /* Membersihkan float */
                padding: 10px;
                margin-top: 12px;
                /* Menambahkan margin atas */
                text-align: center;
                /* Mengatur posisi teks ke tengah */
                width: 45%;
                /* Mengurangi lebar untuk memberikan ruang */
                float: left;
                /* Mengatur float ke kiri */
                font-size: 12px;
                /* Menyesuaikan ukuran teks dengan code-box */
            }

            .left-info {
                clear: both;
                /* Membersihkan float */
                padding: 10px;
                margin-top: 12px;
                /* Menambahkan margin atas */
                text-align: center;
                /* Mengatur posisi teks ke tengah */
                width: 45%;
                /* Mengurangi lebar untuk memberikan ruang */
                float: left;
                /* Mengatur float ke kiri */
                font-size: 12px;
                /* Menyesuaikan ukuran teks dengan code-box */
            }
            .option-column {
        flex: 1 1 50%; /* 50% lebar di layar medium (md) */
    }
        }

        .options {
            padding: 10px;
            margin-top: 12px;

            width: 100%;
            font-size: 12px;

        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo-section">
            <img src="https://www.smkn1surade.sch.id/upload/picture/8838943512px-coatofarmsofwestjava.svg.png"
                alt="Logo Provinsi" width="55">
            <p>PEMERINTAH PROVINSI JAWA BARAT</p>
            <p>BADAN PENDAPATAN DAERAH</p>
        </div>
        <div class="code-box">
            <P>SURAT PEMBERITAHUAN KEWAJIBAN PEMBAYARAN</P>
            <p>PAJAK KENDARAAN BERMOTOR (SPKP2KB)</p>
            <p>Nomor: 973/SPKP2KB/23-Kota Banjar/III/2024</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="additional-text">
        <p>Kepada Yth. Bpk/Ibu/</p>
        <p>ADING ACHMAD SJAFJUDIN</p>
        <p>WARGAMULIA RT 019 RW 009 PURWAHARJA KOTA BANJAR</p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="custom-text">
        <p>Dengan ini diberitahukan bahwa berdasarkan administrasi data kendaraan pada kantor Bersama Samsat, kendaraan
            milik saudara :</p>
        <br>
        <p><span class="text-label">Nomor Registrasi</span> : <span class="text-value">ZYH 1723</span></p>
        <p><span class="text-label">Tahun/CC</span> : <span class="text-value">2008</span></p>
        <p><span class="text-label">Merk Type</span> : <span class="text-value">23</span></p>
        <p><span class="text-label">Masa pajak berakhir pada tanggal</span> : <span class="text-value">27 September
                2023</span></p>
        <br>
        <p>Sehubungan dengan hal tersebut agar Saudara melakukan pendaftaran dan pembayaran Pajak Kendaraan Bermotor
            (PKB) pada kantor Bersama SAMSAT setempat, Keterlambatan melakukan pembayaran pada tanggal yang dimaksud
            akan dikenakan sanksi administratif sesuai perda nomor 13 Tahun 2011.</p>
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
        <p>Nopol: Z YH 1723</p>
        <p>Nama: ADING ACHMAD SJAFJUDIN</p>
    </div>
    <div class="blanko-section">
        <p>Banjar, 18 Maret 2024 </p>
        <p> PUSAT PENGELOLAAN PENDAPATAN DAERAH </p>
        <p> WILAYAH KOTA BANJAR </p>
        <br>
        <br>
        <br>
        <p> BENNY SURANATA, S.E., M.M </p>
        <p> NIP 10680507 198903 1 006 </p>
    </div>
    <div style="display: flex; justify-content: space-between;">
        <div class="options" style="flex: 1;">
            <p> Kendaraan hilang tidak melapor ke polisi1</p>
            <p>Kendaraan hilang tidak melapor ke polisi2</p>
            <p> Kendaraan hilang tidak melapor ke polisi3</p>
            <p> Kendaraan hilang tidak melapor ke polisi4</p>
        </div>

        <div class="options" style="float: ring;">
            <p> Kendaraan hilang tidak melapor ke polisi5</p>
            <p> Kendaraan hilang tidak melapor ke polisi6</p>
            <p> Kendaraan hilang tidak melapor ke polisi7</p>
        </div>
    </div>




</body>

</html>

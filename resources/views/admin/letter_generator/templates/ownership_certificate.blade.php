<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kepemilikan Hewan - {{ $nomor_surat }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            margin: 0;
            padding: 30px;
            font-size: 11pt;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h3 {
            margin: 0;
            font-size: 14pt;
        }

        .header p {
            margin: 0;
            font-size: 10pt;
        }

        .header .line {
            border-bottom: 2px solid #000;
            width: 80%;
            margin: 5px auto 15px auto;
        }

        .content {
            margin-bottom: 30px;
        }

        .content p {
            text-align: justify;
            margin-bottom: 10px;
        }

        .content .indent {
            text-indent: 40px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .details-table td {
            padding: 5px;
            vertical-align: top;
        }

        .details-table td:first-child {
            width: 150px;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }

        .signature div {
            text-align: center;
            width: 250px;
        }

        .signature .name {
            margin-top: 70px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            font-weight: bold;
        }

        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .kop-surat td {
            vertical-align: middle;
            padding: 0;
        }

        .kop-surat .logo {
            width: 80px;
            text-align: center;
        }

        .kop-surat .logo img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .kop-surat .text {
            text-align: center;
        }

        .kop-surat .text h2 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
        }

        .kop-surat .text h3 {
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .kop-surat .text p {
            margin: 0;
            font-size: 10pt;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="kop-surat">
            <tr>
                <td class="logo">
                    {{-- Logo Desa --}}
                    <img src="{{ asset('images/logo-desa-orakeri.png') }}" alt="Logo Desa"> {{-- Sesuaikan path logo --}}
                </td>
                <td class="text">
                    <h2>PEMERINTAH KABUPATEN [NAMA KABUPATEN]</h2>
                    <h3>KECAMATAN [NAMA KECAMATAN]</h3>
                    <h2>DESA ORAKERI</h2>
                    <p>Jl. Raya Orakeri No. 123, Kode Pos: XXXX</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="line"></div>
                </td>
            </tr>
        </table>

        <div class="header">
            <h3>SURAT KETERANGAN KEPEMILIKAN HEWAN</h3>
            <p>Nomor: {{ $nomor_surat }}</p>
        </div>

        <div class="content">
            <p class="indent">Yang bertanda tangan di bawah ini Kepala Desa Orakeri, menerangkan bahwa:</p>
            <table class="details-table">
                <tr>
                    <td>Nama</td>
                    <td>: {{ $nama_pemilik }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{ $nik_pemilik }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $alamat_pemilik }}</td>
                </tr>
            </table>

            <p class="indent">Benar-benar memiliki hewan dengan keterangan sebagai berikut:</p>
            <table class="details-table">
                <tr>
                    <td>Jenis Hewan</td>
                    <td>: {{ $jenis_hewan }}</td>
                </tr>
                <tr>
                    <td>Jumlah Hewan</td>
                    <td>: {{ $jumlah_hewan }} ekor</td>
                </tr>
                <tr>
                    <td>Ciri-ciri</td>
                    <td>: {{ $ciri_hewan }}</td>
                </tr>
            </table>

            @if ($catatan_tambahan)
                <p class="indent">Dengan catatan: {{ $catatan_tambahan }}</p>
            @endif

            <p class="indent">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan
                sebagaimana mestinya.</p>
        </div>

        <div class="signature">
            <div>
                Orakeri, {{ $tanggal_surat }}<br>
                {{ $jabatan_kepala_desa }}<br>
                <br><br><br><br>
                <div class="name">{{ $kepala_desa }}</div>
            </div>
        </div>
    </div>
</body>

</html>

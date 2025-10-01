<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $surat->jenis->nama }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .kop {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .content {
            margin: 0 40px;
            line-height: 1.6;
        }

        .ttd {
            margin-top: 60px;
            text-align: right;
            margin-right: 60px;
        }
    </style>
</head>

<body>
    <div class="kop">
        <h2>PEMERINTAH DESA MAJU JAYA</h2>
        <p>Jl. Raya Desa No. 123, Kecamatan Contoh, Kabupaten Indonesia</p>
    </div>

    <div class="content">
        <h3 style="text-align:center; text-decoration: underline;">
            {{ strtoupper($surat->jenis->nama) }}
        </h3>
        <p style="text-align:center;">Nomor: {{ $surat->kode_tracking }}</p>

        <p>Yang bertanda tangan di bawah ini, Kepala Desa Maju Jaya, menerangkan bahwa:</p>

        <table style="margin:20px 0;">
            <tr>
                <td width="150">Nama</td>
                <td>: {{ $surat->nama_pemohon }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $surat->nik }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $surat->alamat }}</td>
            </tr>
        </table>

        <p>
            Dengan ini menerangkan bahwa yang bersangkutan adalah benar warga Desa Maju Jaya
            dan surat ini dibuat untuk keperluan <strong>{{ $surat->keperluan }}</strong>.
        </p>

        <p>Demikian surat ini dibuat agar dipergunakan sebagaimana mestinya.</p>

        <div class="ttd">
            <p>Maju Jaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Kepala Desa</p>
            <br><br><br>
            <p><strong>(Nama Kepala Desa)</strong></p>
        </div>
    </div>

    <div style="text-align:center; margin-top:40px;">
        <a href="{{ route('surat.cetak', $surat->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Cetak PDF
        </a>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Kelakuan Baik</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 794px;
            /* A4 portrait width in px (~210mm) */
            height: 1123px;
            /* A4 portrait height in px (~297mm) */
            padding: 40px;
            box-sizing: border-box;
        }

        .kop {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop img {
            width: 80px;
            height: auto;
            display: block;
            margin: 0 auto 5px;
        }

        .content h3 {
            text-align: center;
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .content p {
            margin: 10px 0;
            line-height: 1.5;
        }

        table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
        }

        td {
            padding: 2px 0;
            vertical-align: top;
        }

        .ttd {
            margin-top: 80px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="kop">
            <table width="100%">
                <tr>
                    {{-- <td width="120" style="vertical-align: top;">
                        @if ($siteLogo && $siteLogo->content)
                            <img src="{{ storage_path('app/public/' . $siteLogo->content) }}"
                                style="width:100px; height:auto; object-fit: contain;" alt="Logo Desa">
                        @endif
                    </td> --}}
                    <td style="text-align: center; vertical-align: top;">
                        <h2 style="margin:0;">{{ $villageName->content ?? 'PEMERINTAH DESA' }}</h2>
                        <p style="margin:0;">{{ $contactAddress->content ?? 'Alamat Desa belum diisi' }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <h3>SURAT REKOMENDASI KELAKUAN BAIK</h3>
            <p style="text-align:center;">Nomor: {{ $surat->kode_tracking }}</p>

            <p>Yang bertanda tangan di bawah ini, Kepala Desa {{ $villageName->value ?? '' }}, menerangkan bahwa:</p>

            <table>
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
                Berdasarkan data dan pengamatan kami, yang bersangkutan adalah benar penduduk Desa
                {{ $villageName->value ?? '' }},
                dan selama ini dikenal berkelakuan baik, tidak pernah terlibat perbuatan melanggar hukum maupun
                mengganggu ketertiban masyarakat.
            </p>

            <p>
                Surat rekomendasi ini dibuat untuk keperluan: <strong>{{ $surat->keperluan }}</strong>.
            </p>

            <p>Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>

            <div class="ttd" style="margin-top:60px; text-align:right; margin-right:60px;">
                <p>{{ $villageName->content ?? '' }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Kepala Desa</p>
                <br><br>
                <!-- Garis tanda tangan -->
                <div style="border-bottom:1px solid #000; width:200px; margin-left:auto; margin-right:0;"></div>
                <!-- Nama Kepala Desa di bawah garis -->
                <p><strong>{{ $profileKepalaDesa->content ?? 'Nama Kepala Desa' }}</strong></p>
            </div>

        </div>
    </div>
</body>

</html>

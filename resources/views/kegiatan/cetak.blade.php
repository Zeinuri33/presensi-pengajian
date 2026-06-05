<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Hadir</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h3, h4 {
            text-align: center;
            margin: 4px 0;
        }
        .info-table {
            width: 100%;
            font-size: 13px;
            margin-top: 10px;
        }
        .info-table td {
            padding: 4px 2px;
            vertical-align: top;
        }
        .info-table td:first-child {
            width: 15%;
        }
        .info-table td:nth-child(2) {
            width: 1%;
        }

        .data-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        .data-table th, .data-table td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
        .data-table th {
            background-color: #eee;
        }

        .ttd {
            margin-top: 40px;
        }

        .footer {
            margin-top: 15px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    @php
        $pesertaLabel = strtoupper($kegiatan->peserta);
        if (request('jabatan')) {
            $pesertaLabel = strtoupper(request('jabatan'));
        }
    @endphp

    <h3>DAFTAR HADIR {{ $pesertaLabel }}</h3>
    <h3>PONDOK PESANTREN SALAFIYAH SYAFI'IYAH SUKOREJO</h3>
    <h3>{{ strtoupper($kegiatan->kegiatan) }}</h3>
    <br>
    <br>

    <table class="info-table">
        <tr>
            <td>Hari, Tanggal</td>
            <td></td>
            <td>: {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td></td>
            <td>: {{ $kegiatan->tempat }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td></td>
            <td>: {{ $kegiatan->kegiatan }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th>NAMA</th>
                <th>ASRAMA</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekapDaftarHadir as $row)
                <tr>
                    <td>{{ $row['no'] }}</td>
                    <td>{{ $row['nis'] }}</td>
                    <td style="text-align: left">Ust. {{ $row['nama'] }}</td>
                    <td>{{ $row['asrama'] }} ({{ $row['kode'] }})</td>
                    <td style="color: {{ $row['status'] == 'Hadir' ? 'green' : 'red' }}">{{ $row['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p style="font-style: italic;">Jumlah yang hadir: <strong>{{ $jumlahHadir }}</strong></p>
        <p style="font-style: italic;">Jumlah yang tidak hadir: <strong>{{ $jumlahTidakHadir }}</strong></p>
    </div>

    <table class="ttd" style="width: 100%; margin-top: 40px; margin-bottom: 30px;">
        <tr>
            <td style="width: 50%; text-align: left; vertical-align: bottom;">
                @php
                    $url = $url ?? url()->full();
                    $qr = base64_encode(QrCode::format('svg')->size(100)->generate($url));
                @endphp

                <img src="data:image/svg+xml;base64, {!! $qr !!}" width="70" alt="QR Code"><br>
                <small style="font-size: 8px; line-height: 1.3;">
                    Dokumen ini dicetak dari Sistem Absensi Kegiatan<br>
                    Sub Bag. Asrama Putra P2S3.<br>
                    Scan QR untuk membuka halaman ini.
                </small>
            </td>
            <td style="width: 50%; text-align: left; vertical-align: top; padding-left: 150px;">
                Sukorejo, {{ now()->translatedFormat('d F Y') }}<br>
                Mengetahui,<br>
                Kasubag. Asrama,<br>
                <img src="{{ public_path('assets/media/ibrahimy/ttd.png') }}" alt="Tanda Tangan" width="150"><br>
                <b style="font-weight: bold;">Mun'em, M.Pd.I</b>
            </td>
        </tr>
    </table>


</body>
</html>

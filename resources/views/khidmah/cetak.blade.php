<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h3 { text-align: center; margin: 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th { background: #f2f2f2; }
        .ttd td {
            border: none; /* hapus border di bagian ttd */
            padding: 5px;
        }
    </style>
</head>
<body>

<h2>JADWAL KHIDMAT KETUA KAMAR DAN WAKIL</h2>
<h3>DI PENDOPO PENGASUH</h3>
<h3>BIDANG KEPESANTRENAN</h3>
<h3>Bulan {{ $bulanTahun }}</h3>

<table>
    <thead>
        <tr>
            <th>TANGGAL</th>
            <th>PAGI</th>
            <th>SIANG</th>
            <th>MALAM</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jadwal as $tanggal => $shift)
        <tr>
            <td>{{ $tanggal }}</td>
            <td>{{ $shift['Pagi'] }}</td>
            <td>{{ $shift['Siang'] }}</td>
            <td>{{ $shift['Malam'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Bagian TTD -->
<table class="ttd" style="width: 100%; margin-top: 27px; margin-bottom: 45px;">
    <tr>
        <td style="width: 50%; text-align: left; vertical-align: bottom;">
            @php
                $url = $url ?? url()->full(); // dari controller atau default url saat ini
                $qr = base64_encode(QrCode::format('svg')->size(100)->generate($url));
            @endphp

            <img src="data:image/svg+xml;base64, {!! $qr !!}" width="70" alt="QR Code"><br>
            <small style="font-size: 8px; line-height: 1.2;">
                Dokumen ini dicetak dari Sistem Absensi Pengajian<br>
                Sub Bag. Asrama Putra P2S3.<br>
                Scan QR untuk membuka halaman ini
            </small>
        </td>
        <td style="width: 50%; vertical-align: top; text-align: left; padding-left: 50px;">
            Sukorejo, {{ now()->translatedFormat('d F Y') }}<br><br>
            Kasubag. Asrama,<br>
            <img src="{{ public_path('assets/media/ibrahimy/ttd.png') }}" alt="Tanda Tangan" width="110"><br>
            <b>Mun'em, M.Pd.I</b>
        </td>
    </tr>
</table>

</body>
</html>

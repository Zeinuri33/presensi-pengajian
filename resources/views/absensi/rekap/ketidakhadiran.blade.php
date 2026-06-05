<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Ketidakhadiran Pengajian Pengasuh {{ strtoupper(\Carbon\Carbon::create()->month($bulan)->translatedFormat('F')) }} {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        h3 {
            text-align: center;
            line-height: 1.5;
        }
        .highlight {
            background-color: rgb(248, 112, 112);
        }
    </style>
</head>
<body>

    <h3>
        DATA {{ strtoupper($request->jabatan ?? 'KEPALA KAMAR / WAKIL') }} YANG TIDAK HADIR PENGAJIAN PENGASUH<br>
        PONDOK PESANTREN SALAFIYAH SYAFI'IYAH SUKOREJO<br>
        BULAN {{ strtoupper(\Carbon\Carbon::create()->month($bulan)->translatedFormat('F')) }} {{ $tahun }}
    </h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kamar</th>
                <th>Jml. Tidak Hadir</th>
                <th>Pembinaan</th>
                <th>Sisa Pembinaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
                <tr @if($row->sisa_pembinaan >= 10) class="highlight" @endif>
                    <td>{{ $i + 1 }}</td>
                    <td style="text-align: left;">{{ $row->nama }}</td>
                    <td>{{ $row->asrama->kode }}</td>
                    <td>{{ $row->jumlah_tidak_hadir }}</td>
                    <td>{{ $row->jumlah_pembinaan }}</td>
                    <td>{{ $row->sisa_pembinaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @php
        $url = $url ?? url()->full(); // atau bisa dikirim dari controller
        $qr = base64_encode(QrCode::format('svg')->size(100)->generate($url));
    @endphp

    <div style="text-align: right; margin-top: 10px;">
        <strong>Dokumen ini dicetak dari Sistem Absensi Pengajian Sub Bag. Asrama Putra P2S3.<br>Scan QR untuk membuka halaman ini:</strong><br>
        <img src="data:image/svg+xml;base64, {!! $qr !!}" width="80" alt="QR Code">
        <br>
        <small>{{ $url }}</small>
    </div>

</body>
</html>

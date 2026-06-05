<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Presensi Khidmat</title>

    <style>
        @page {
            margin: 40px 40px; /* default semua halaman */
        }

        @page :first {
            margin-top: 5px;   /* khusus halaman pertama */
            margin-bottom: 15px;
            margin-left: 40px;
            margin-right: 40px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
        }
        th {
            text-align: center;
            font-weight: bold;
        }
        .center {
            text-align: center;
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 3px;
            font-size: 14px;
        }
        .subheader {
            text-align: center;
            margin-bottom: 5px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

<div class="header">
    DAFTAR HADIR KHIDMAH DI PENDOPO PENGASUH<br>
    KETUA & WAKIL KAMAR
</div>
<div class="subheader">
    Bulan {{ $bulanTahun }}
</div>

@php
    $no = 1;                 // nomor baris (lanjut terus)
    $ttdNo = 1;              // nomor tanda tangan (lanjut terus)
    $hariKe = 0;
    $tanggalSebelumnya = null;
@endphp

<table>
<thead>
<tr>
    <th width="4%">No</th>
    <th width="35%">Nama</th>
    <th width="8%">Asrama</th>
    <th width="5%">Shift</th>
    <th width="7%">Tanggal</th>
    <th colspan="2" width="38%">Tanda Tangan</th>
</tr>
</thead>
<tbody>

@foreach($jadwal as $item)

    @php
        // DETEKSI PERGANTIAN HARI
        if ($tanggalSebelumnya !== $item['tanggal']) {
            $hariKe++;
            $tanggalSebelumnya = $item['tanggal'];
        }
    @endphp

    {{-- PAGE BREAK SETIAP 3 HARI (DI SHIFT PAGI) --}}
    @if($hariKe > 1 && ($hariKe - 1) % 4 == 0 && $item['shift'] === 'Pagi')
        </tbody>
        </table>

        <div class="page-break"></div>

        <table>
        <thead>
        <tr>
            <th width="4%">No</th>
            <th width="35%">Nama</th>
            <th width="8%">Asrama</th>
            <th width="5%">Shift</th>
            <th width="7%">Tanggal</th>
            <th colspan="2" width="38%">Tanda Tangan</th>
        </tr>
        </thead>
        <tbody>
    @endif

    @php
        $tanggal = $item['tanggal'];
        $shift   = $item['shift'];

        $p1 = $item['pair1'];
        $p2 = $item['pair2'];

        $kode1 = $p1['asrama'];
        $kode2 = $p2['asrama'];

        $baris = [
            optional($p1['kepala'])->nama ?? '-',
            optional($p1['wakil'])->nama  ?? '-',
            optional($p2['kepala'])->nama ?? '-',
            optional($p2['wakil'])->nama  ?? '-',
        ];
    @endphp

    @for($i = 0; $i < 4; $i++)
    <tr>
        {{-- NO --}}
        <td class="center">{{ $no++ }}</td>

        {{-- NAMA --}}
        <td>{{ $baris[$i] }}</td>

        {{-- ASRAMA --}}
        @if($i == 0)
            <td class="center" rowspan="2">{{ $kode1 }}</td>
        @elseif($i == 2)
            <td class="center" rowspan="2">{{ $kode2 }}</td>
        @endif

        {{-- SHIFT (VERTIKAL) --}}
        @if($i == 0)
        <td class="center" rowspan="4" style="vertical-align: middle;">
            <div style="transform: rotate(-90deg); white-space: nowrap;">
                {{ $shift }}
            </div>
        </td>
        @endif

        {{-- TANGGAL (VERTIKAL, 1x PER HARI) --}}
        @if($i == 0 && $shift === 'Pagi')
        <td class="center" rowspan="12" style="vertical-align: middle;">
            <div style="transform: rotate(-90deg); white-space: nowrap; font-weight: bold;">
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
            </div>
        </td>
        @endif

        {{-- TANDA TANGAN (2 KOLOM, MERGE KE BAWAH) --}}
        @if($i == 0 || $i == 2)
            <td rowspan="2" style="vertical-align: bottom; padding-bottom: 4px;">
                {{ $ttdNo++ }}.
            </td>
            <td rowspan="2" style="vertical-align: bottom; padding-bottom: 4px;">
                {{ $ttdNo++ }}.
            </td>
        @endif

    </tr>
    @endfor

@endforeach

</tbody>
</table>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    @php
        $bulanNama = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F');
        $jabatan = $request->jabatan ?? 'Kepala Kamar/Wakil';
        $daerah = $request->daerah ?? 'Semua Daerah';
    @endphp
    <title>Rekap Absen Kepala Kamar {{ $jabatan }} daerah {{ $bulanNama }} {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 3px; text-align: center; }
        th { background-color: #f2f2f2; }
        .gray { background-color: #767676; }     /* Selasa & Jumat */
        .blue { background-color: #B3D9FF; }     /* Hari libur */
        .kuning { background-color: #FFE599; }   /* Tanggal masa depan */
        .hijau { background-color: #90EE90; }    /* Pembinaan */
        .merah {
            background-color: red !important;
            color: white; /* supaya teksnya terlihat jelas */
        }
    </style>
</head>
<body>



    <h2 style="text-align: center; margin-bottom: 0;">
        Rekapitulasi Kehadiran Pengajian Pengasuh
    </h2>
    <h2 style="text-align: center; margin-top: 2px;">
        Pondok Pesantren Salafiyah Syafi'iyah Sukorejo
    </h2>
    <h3 style="text-align: center; margin-top: -10px; font-weight: bold;">
        {{ $jabatan }} Daerah {{ $daerah }}<br>
        Bulan {{ $bulanNama }} {{ $tahun }}
    </h3>


    <!-- Tabel Rekap Kehadiran -->
    <table>
        <thead>
            <!-- Header Gabungan -->
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Asrama</th>
                <th colspan="{{ count($tanggalHari) }}">Tanggal</th>
                <th colspan="6">Jumlah</th>
            </tr>
            <!-- Header Tanggal -->
            <tr>
                @foreach ($tanggalHari as $tgl)
                    @php
                        $carbon = \Carbon\Carbon::parse($tgl);
                    @endphp
                    <th>{{ $carbon->format('d') }}</th>
                @endforeach
                <th>H</th>
                <th>I</th>
                <th>A</th>
                <th>P</th>
                <th>SP</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kepalaKamar as $i => $kk)
                @php
                    $jumlahH = 0;
                    $jumlahI = 0;
                    $jumlahA = 0;
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="text-align: left;">{{ $kk->nama }}</td>
                    <td style="text-align: center;">{{ $kk->asrama->kode }}</td>
                    @php
                        $jumlahPembinaan = 0; // hitungan pembinaan untuk kepala kamar ini
                    @endphp
                    @foreach ($tanggalHari as $tgl)
                        @php
                            $carbon = \Carbon\Carbon::parse($tgl);
                            $hari = $carbon->dayOfWeek;
                            $isLibur = in_array($tgl, $tanggalLibur ?? []);
                            $isGray = in_array($hari, [2, 5]);
                            $isFuture = $carbon->isFuture();

                            $isPembinaan = isset($blokHijau[$kk->id][$tgl]);
                            if ($isPembinaan) {
                                $jumlahPembinaan++; // tambahkan hitungan pembinaan
                            }

                            // Urutan prioritas warna
                            if ($isPembinaan) {
                                $kelas = 'hijau';
                            } elseif ($isLibur) {
                                $kelas = 'blue';
                            } elseif ($isGray) {
                                $kelas = 'gray';
                            } elseif ($isFuture) {
                                $kelas = 'kuning';
                            } else {
                                $kelas = '';
                            }

                            $value = $kk->rekap[$tgl] ?? '';
                            if ($value === 'H') $jumlahH++;
                            if ($value === 'I') $jumlahI++;
                            if ($value === 'A') {
                                $jumlahA++;
                                if (!$isPembinaan) { // ⬅️ mencegah merah jika pembinaan
                                    $kelas .= ' merah';
                                }
                            }
                        @endphp
                        <td class="{{ $kelas }}">
                            @if (!($isLibur || $isGray || $isFuture))
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach

                    <td>{{ $jumlahH }}</td>
                    <td>{{ $jumlahI }}</td>
                    <td>{{ $jumlahA }}</td>
                    <td>{{ $jumlahPembinaan }}x</td>
                    <td>{{ $jumlahA - $jumlahPembinaan }}</td>
                    <td>{{ $kk->persentase }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @php
        $url = $url ?? url()->full(); // atau bisa dikirim dari controller
        $qr = base64_encode(QrCode::format('svg')->size(100)->generate($url));
    @endphp

    <table width="100%" border="0" style="margin-top: 10px;">
        <tr>
            <!-- Kolom kiri: keterangan -->
            <td valign="top" style="text-align: left; font-size: 10px; border: none;">
                <div style="text-align: left;">
                    <strong>Keterangan:</strong>
                    <table style="border-collapse: collapse; margin-top: 5px; text-align: left;">
                        <tr>
                            <td style="padding: 2px">H</td>
                            <td>Hadir</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px">A</td>
                            <td>Absen</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px">I</td>
                            <td>Izin</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px">P</td>
                            <td>Pembinaan</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px">SP</td>
                            <td>Sisa Pembinaan</td>
                        </tr>
                    </table>
                </div>
            </td>

            <!-- Kolom kanan: QR code -->
            <td valign="top" style="text-align: right; font-size: 12px; border: none;">
                <strong>Dokumen ini dicetak dari Sistem Absensi Pengajian Sub Bag. Asrama Putra P2S3.</strong><br>
                Scan QR untuk membuka halaman ini:<br>
                <img src="data:image/svg+xml;base64, {!! $qr !!}" width="80" alt="QR Code"><br>
                <small>{{ $url }}</small>
            </td>
        </tr>
    </table>






</body>
</html>

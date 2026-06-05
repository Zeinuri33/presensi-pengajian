<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Aktif Pengajian</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            line-height: 1.5;
        }

        .kop {
            text-align: center;
            line-height: 1.1; /* lebih rapat */
            margin-bottom: 5px;
        }

        .logo {
            margin-top: 0pt;
            margin-bottom: 0pt;
        }

        .logo img {
            width: 141px;
        }

        .pondok {
            font-size: 13px;
            font-weight: bold;
            margin-top: 4pt;
            margin-bottom: 0pt;
        }

        .bidang {
            font-size: 19px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 0pt;
            margin-bottom: 0pt;
        }
        .sub {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 0pt;
            margin-bottom: 0pt;
        }

        .alamat {
            font-size: 12px;
            font-weight: bold;
            margin-top: 0pt;
            margin-bottom: 0pt;
        }

        .akte {
            font-size: 12px;
            margin-top: 0pt;
            margin-bottom: 0pt;
        }

        hr {
            border: 1px solid #000;
            margin: 4px 0 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 0px;
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .nomor {
            font-weight: normal;   /* nomor tidak tebal */
            text-align: center;
            margin-top: 0pt;
            margin-bottom: 0pt;
        }



        table {
            width: 100%;
        }


        .section {
            margin-top: 15px;
        }

        .ttd {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    @php
        // pastikan $kepalakamar selalu berupa array/collection
        $listKepalaKamar = $kepalakamar instanceof \Illuminate\Support\Collection || is_array($kepalakamar)
            ? $kepalakamar
            : collect([$kepalakamar]);
    @endphp

    @foreach($listKepalaKamar as $kk)
    {{-- KOP SURAT --}}
    <div class="kop">
        <p class="logo">
            <img src="{{ public_path('assets/media/logos/logo-p2s3-hitam.png') }}" alt="Logo">
        </p>
        <p class="pondok">PONDOK PESANTREN "SALAFIYAH SYAFI'IYAH" SUKOREJO</p>
        <p class="bidang">BIDANG KEPESANTRENAN</p>
        <p class="sub">SUB BAGIAN ASRAMA PUTRA</p>
        <p class="alamat">SUMBEREJO BANYUPUTIH SITUBONDO JAWA TIMUR</p>
        <p class="akte">Akte Notaris No. 4/25.08.1970 & No. 3/05.07.2001</p>
    </div>
    <hr>
    
        <div class="header">
            SURAT KETERANGAN AKTIF PENGAJIAN
        </div>
        <div class="nomor">0828/08/ASR/B.a.1/I/2026</div>


        <p>Yang bertanda tangan di bawah ini Kasubag. Asrama Putra <br> PP. Salafiyah Syafi'iyah Sukorejo menerangkan bahwa:</p>

        <table style="margin-left:20px; margin-bottom:15px;">
            <tr>
                <td>Nama</td>
                <td>: {{ $kk->nama }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>: {{ $kk->nis }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: {{ $kk->jabatan == 'Wakil Kamar' ? 'Wakil Kepala Kamar' : $kk->jabatan }}</td>
            </tr>
            <tr>
                <td>Asrama</td>
                <td>: {{ $kk->asrama->asrama }}({{ $kk->asrama->kode }})</td>
            </tr>
        </table>

        <p>
            Adalah benar-benar <b>aktif</b> mengikuti mengikuti pengajian sesuai ketentuan yang berlaku pada Semester {{ $semester->semester . ' Tahun Ajaran ' .  $semester->tapel }}.
        </p>

        <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

        <table class="ttd" style="width: 100%; margin-top: 20px; margin-bottom: 30px;">
        <tr>
            <td style="width: 50%; text-align: left; vertical-align: bottom;">
                @php
                    // buat URL manual tapi id-nya ambil dari $kk->id
                    $url = 'http://subbagasramaputra-p2s3.com/ket/cetak/' . $kk->id;

                    $qr = base64_encode(
                        QrCode::format('svg')
                            ->size(100)
                            ->generate($url)
                    );
                @endphp

                <img src="data:image/svg+xml;base64, {!! $qr !!}" width="70" alt="QR Code"><br>


                <small style="font-size: 8px; line-height: 1.2;">
                    Dokumen ini dicetak dari Sistem Absensi Pengajian<br>
                    Sub Bag. Asrama Putra P2S3.<br>
                    Scan QR untuk membuka halaman ini:<br>
                </small>
            </td>
            <td style="width: 70%; vertical-align: top; text-align: left; padding-left: 50px;">
                Sukorejo, {{ now()->translatedFormat('d F Y') }}<br>
                Kasubag. Asrama,
                <img src="{{ public_path('assets/media/ibrahimy/ttd.png') }}" alt="Tanda Tangan" width="110"><br>
                <b style="font-weight: bold;">Mun'em, M.Pd.I</b>
            </td>


        </tr>
    </table>
    <hr>
    <div style="width: 100%; text-align: center; font-size: 8px; line-height: 0;">
            PO BOX 2 Telp (0338) 452666 Fax (0338) 452707 KP. 68374 e-mail: sukorejo1908@gmail.com. Homepage: www.sukorejo.com
    </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>

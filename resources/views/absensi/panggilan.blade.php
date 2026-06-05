<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pembinaan {{ $data['nama'] }} {{ $data['kode'] }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 10pt;
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
            margin-bottom: 15px;
            font-size: 8pt;
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
        <h2 style="letter-spacing: 2px; text-decoration: underline; margin-top: 8pt; margin-bottom: 0pt;">SURAT PEMBINAAN</h2>
        <p style="margin-top: 0pt; margin-bottom: 0pt; ">Nomor: 0828/__/A/B.a1/__/{{ \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('Y') }}</p>
    </div>

    <p style="margin-bottom: 0pt; margin-top: 0pt;">Kepada</p>
    <p style="margin-bottom: 0pt; margin-top: 0pt; font-weight: bold;">Yth. Ust. {{ $data['nama'] }}</p>
    <p style="margin-bottom: 0pt; margin-top: 0pt; font-weight: bold; font-style: italic">({{ $data['jabatan'] }} {{ $data['asrama'] }} - {{ $data['kode'] }})</p>
    <p style="margin-bottom: 0pt; margin-top: 0pt;">di-</p>
    <p style="margin-bottom: 0pt; margin-top: 0pt; margin-left: 25pt;">Sukorejo</p>

    <p style="margin-bottom: 0pt; margin-top: 10pt; margin-left: 25pt; font-weight: bold; font-style: italic;">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
    <p style="margin-bottom: 0pt; margin-top: 0pt; margin-left: 25pt;">Mengharap kehadiran Ustad untuk melaksanakan pembinaan:</p>

    <div style="margin-bottom: 0pt; margin-top: 5pt; margin-left: 23pt;">
        <table>
            <tr>
                <td width="120px">Jenis Pelanggaran</td>
                <td>: Tidak Mengaji Tafsir</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>Tempat Pembinaan</td>
                <td>: Pendopo Pengasuh</td>
            </tr>
            <tr>
                <td>Pukul</td>
                <td>: 10:00 WIB</td>
            </tr>
        </table>
    </div>


    <p style="margin-bottom: 0pt; margin-top: 10pt; margin-left: 25pt;">Atas perhatiannya, Jazakumullah Khoiron.</p>
    <p style="margin-top: 0pt; margin-bottom: 10pt; margin-left: 25pt; font-weight: bold; font-style: italic;">Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>


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
                    Scan QR untuk membuka halaman ini:<br>
                </small>
            </td>
            <td style="width: 50%; vertical-align: top; text-align: left; padding-left: 50px;">
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

</body>
</html>

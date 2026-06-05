<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <h2 class="text-center" style="margin: 0; line-height: 1.3;">
    Data Kepala Kamar
        @if(request('wilayah'))
            Asrama {{ request('wilayah') }}
        @endif
    </h2>

    @if(request('daerah'))
        <h2 class="text-center" style="margin: 0; line-height: 1.3;">
            Asrama {{ request('daerah') }}
        </h2>
    @endif

    <h3 class="text-center" style="margin: 0; line-height: 1.3;">
        Pondok Pesantren Salafiyah Syafi'iyah Sukorejo
    </h3>




    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">NIS</th>
                <th>Nama</th>
                <th width="15%">Kamar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kepalakamar as $i => $kk)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center">{{ $kk->nis }}</td>
                    <td>{{ $kk->nama }}</td>
                    <td class="text-center">
                        {{ optional($kk->asrama)->kode }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

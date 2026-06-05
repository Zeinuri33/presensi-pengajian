<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\Pembinaan;
use Illuminate\Http\Request;

class AsramaController extends Controller
{
    //
    public function index()
    {
        $asrama = Asrama::orderByRaw("
                CASE 
                    WHEN wilayah = 'Pusat' THEN 1
                    WHEN wilayah = 'Cabang' THEN 2
                    ELSE 3
                END
            ")
            // -- urut huruf kodenya (A, B, C)
            ->orderByRaw("REGEXP_REPLACE(kode, '[0-9]', '') ASC")
            // -- urut angka di dalam kode (1,2,10)
            ->orderByRaw("CAST(REGEXP_REPLACE(kode, '[^0-9]', '') AS UNSIGNED) ASC")
            ->get();

        $daerah = [
            'Sunan Maulana Malik Ibrahim' => 'A',
            'Sunan Ampel' => 'A',
            'Sunan Bonang' => 'A',
            'Sunan Giri' => 'B',
            'Sunan Drajat' => 'C',
            'Sunan Kalijogo' => 'D',
            'Sunan Kudus' => 'E',
            'Sunan Muria' => 'F',
            'Sunan Gunung Jati(Unit I)' => 'G',
            'Sunan Gunung Jati(Unit II Bawah)' => 'G',
            'Sunan Gunung Jati(Unit II Atas)' => 'F',
            "I'dadiyah" => 'I',
            'Nurul Qoni' => 'NQ',
            "Ma'hadul Qur'an" => 'MQ',
            "Tahfidzul Qur'an" => 'THF',
            "Az-Zainiyah" => 'AZZ',
            "Abbasiyah Masjid" => 'ABS',
            "Nurul Makkiyah" => 'NM',
            "Al-Khoiriyah" => 'A-KH',
            "Nurul Ihsan" => 'NI',
        ];

        return view('asrama.index', compact('asrama', 'daerah'));
    }




    public function store(Request $request)
    {
        // Mapping kode untuk tiap daerah
        $kodeDaerah = [
            'Sunan Maulana Malik Ibrahim' => 'A',
            'Sunan Ampel' => 'A',
            'Sunan Bonang' => 'A',
            'Sunan Giri' => 'B',
            'Sunan Drajat' => 'C',
            'Sunan Kalijogo' => 'D',
            'Sunan Kudus' => 'E',
            'Sunan Muria' => 'F',
            'Sunan Gunung Jati(Unit I)' => 'G',
            'Sunan Gunung Jati(Unit II Bawah)' => 'G',
            'Sunan Gunung Jati(Unit II Atas)' => 'F',
            "I'dadiyah" => 'I',
            'Nurul Qoni' => 'NQ',
            "Ma'hadul Qur'an" => 'MQ',
            "Tahfidzul Qur'an" => 'THF',
            "Az-Zainiyah" => 'AZZ',
            "Abbasiyah Masjid" => 'ABS',
            "Nurul Makkiyah" => 'NM',
            "Al-Khoiriyah" => 'A-KH',
            "Nurul Ihsan" => 'NI',
        ];

        $daerah = $request->daerah;
        $nomor = $request->nomor;
        $wilayah = $request->wilayah;

        // Ambil kode berdasarkan nama daerah
        $kode = isset($kodeDaerah[$daerah]) ? $kodeDaerah[$daerah] : 'X'; // fallback ke 'X' jika tidak dikenali

        $namaAsrama = $daerah . ' No.' . $nomor;
        $kodeAsrama = $kode . '.' . $nomor;

        Asrama::create([
            'asrama' => $namaAsrama,
            'kode' => $kodeAsrama,
            'daerah' => $daerah,
            'wilayah' => $wilayah,
        ]);

        return back()->with('success', 'Data berhasil disimpan');
    }


    public function update(Request $request, $id)
    {
        // Mapping kode untuk tiap daerah
        $kodeDaerah = [
            'Sunan Maulana Malik Ibrahim' => 'A',
            'Sunan Ampel' => 'A',
            'Sunan Bonang' => 'A',
            'Sunan Giri' => 'B',
            'Sunan Drajat' => 'C',
            'Sunan Kalijogo' => 'D',
            'Sunan Kudus' => 'E',
            'Sunan Muria' => 'F',
            'Sunan Gunung Jati(Unit I)' => 'G',
            'Sunan Gunung Jati(Unit II Bawah)' => 'G',
            'Sunan Gunung Jati(Unit II Atas)' => 'F',
            'Idadiyah' => 'I',
        ];

        $daerah = $request->daerah;
        $nomor = $request->nomor;

        $kode = isset($kodeDaerah[$daerah]) ? $kodeDaerah[$daerah] : 'X';

        $namaAsrama = $daerah . ' no.' . $nomor;
        $kodeAsrama = $kode . '.' . $nomor;

        $asrama = Asrama::findOrFail($id);

        $asrama->update([
            'asrama' => $namaAsrama,
            'kode' => $kodeAsrama,
            'daerah' => $daerah,
        ]);

        return back()->with('success', 'Data berhasil diperbarui');
    }


    public function hapus($id)
    {
        $asrama = Asrama::findOrFail($id);

        $asrama->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function pembinaan()
    {
        $pembinaan = Pembinaan::latest()->get();

        return view('absensi.pembinaan.index', compact('pembinaan'));
    }
}

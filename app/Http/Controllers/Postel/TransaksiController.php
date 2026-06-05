<?php

namespace App\Http\Controllers\Postel;

use App\Http\Controllers\Controller;
use App\Models\Postel\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {
        // Bulan terpilih (default bulan ini)
        $bulan = $request->bulan ?? now()->format('Y-m');

        $tahun = substr($bulan, 0, 4);
        $bulanAngka = substr($bulan, 5, 2);

        // Data transaksi sesuai bulan
        $transaksi = Transaksi::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulanAngka)
            ->latest()
            ->get();

        // ✅ Total pendapatan bulan terpilih
        $totalBulan = Transaksi::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulanAngka)
            ->sum('total');

        // ✅ Total pendapatan hari ini
        $totalHariIni = Transaksi::whereDate('created_at', today())
            ->sum('total');

        return view('postel.transaksi.index', compact(
            'transaksi',
            'bulan',
            'totalBulan',
            'totalHariIni'
        ));
    }

    public function store(Request $request)
    {
        $tarif = 1000;
        $now   = Carbon::now();
        $jam   = $now->format('H:i');

        $shift = null;

        // ================= SHIFT PAGI =================
        if ($now->isFriday()) {
            // Jumat: pagi khusus
            if ($jam >= '07:00' && $jam <= '10:30') {
                $shift = 'Pagi';
            }
        } else {
            // Hari biasa: pagi normal
            if (
                ($jam >= '05:30' && $jam <= '07:30') ||
                ($jam >= '10:00' && $jam <= '12:00')
            ) {
                $shift = 'Pagi';
            }
        }

        // ================= SHIFT SIANG (SEMUA HARI) =================
        if (
            !$shift &&
            (
                ($jam >= '12:45' && $jam <= '14:30') ||
                ($jam >= '15:30' && $jam <= '17:30')
            )
        ) {
            $shift = 'Siang';
        }

        // ================= SHIFT MALAM (SEMUA HARI) =================
        if (
            !$shift &&
            ($jam >= '20:30' && $jam <= '23:30')
        ) {
            $shift = 'Malam';
        }

        // ❌ Di luar jam shift
        if (!$shift) {
            return back()->with(
                'error',
                'Transaksi hanya dapat dilakukan pada jam shift yang ditentukan.'
            );
        }

        // ================= TRANSAKSI =================
        $durasi = $request->durasi;
        $total  = $durasi * $tarif;
        $bayar  = $request->bayar;

        if ($bayar < $total) {
            return back()->with('error', 'Uang yang dibayarkan kurang.');
        }

        $kembali = $bayar - $total;

        Transaksi::create([
            'kepalakamar_id' => $request->kepalakamar_id,
            'durasi'         => $durasi,
            'total'          => $total,
            'bayar'          => $bayar,
            'kembali'        => $kembali,
            'shift'          => $shift,
            'petugas'        => $request->petugas,
        ]);

        return back()->with('success', "Transaksi berhasil disimpan (Shift {$shift}).");
    }


    public function update(Request $request, $id)
    {
        $tarif = 1000;

        $request->validate([
            'durasi' => 'required|integer|min:1',
            'bayar'  => 'required|integer|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $durasi = $request->durasi;
        $total  = $durasi * $tarif;
        $bayar  = $request->bayar;

        if ($bayar < $total) {
            return back()->with('error', 'Uang yang dibayarkan kurang.');
        }

        $kembali = $bayar - $total;

        $transaksi->update([
            'durasi'  => $durasi,
            'total'   => $total,
            'bayar'   => $bayar,
            'kembali' => $kembali,
            'petugas' => $request->petugas,
            'shift' => $request->shift,
        ]);

        return back()->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus');
    }

}

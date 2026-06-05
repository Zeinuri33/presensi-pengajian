@extends('layout.sidebar')
@section('konten')





@php
    use Carbon\Carbon;

    $bulan  = request('bulan', now()->month);
    $tahun  = request('tahun', now()->year);
    $minggu = request('minggu', now()->weekOfMonth);

    $firstDayMonth = Carbon::create($tahun, $bulan, 1);
    $startOfWeek = $firstDayMonth->copy()->addWeeks($minggu - 1)->startOfWeek(Carbon::MONDAY);
    $endOfWeek   = $startOfWeek->copy()->endOfWeek(Carbon::SUNDAY);

    $jadwalPerTanggal = collect($jadwal)->groupBy('tanggal');
@endphp


<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-white">Jadwal Kepala & Wakil Kamar di Pendopo Pengasuh</span>
                <span class="text-muted mt-1 fw-semibold fs-6">
                    {{ $startOfWeek->translatedFormat('d F Y') }}
                    –
                    {{ $endOfWeek->translatedFormat('d F Y') }}
                </span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <!--begin::Add product-->
        <form method="GET">
            <div class="card-toolbar flex-row-fluid justify-content-end gap-2">
                {{-- BULAN --}}
                <div class="w-150px">
                    <select name="bulan"
                        class="form-select form-select-sm form-select-solid"
                        data-control="select2"
                        data-hide-search="true">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}"
                                {{ request('bulan', now()->month) == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                {{-- TAHUN --}}
                <div class="w-120px">
                    <select name="tahun"
                        class="form-select form-select-sm form-select-solid"
                        data-control="select2"
                        data-hide-search="true">
                        @for ($y = now()->year - 1; $y <= now()->year + 1; $y++)
                            <option value="{{ $y }}"
                                {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                {{-- MINGGU --}}
                <div class="w-150px">
                    <select name="minggu"
                        class="form-select form-select-sm form-select-solid"
                        data-control="select2"
                        data-hide-search="true">
                        @for ($w = 1; $w <= 6; $w++)
                            <option value="{{ $w }}"
                                {{ request('minggu', now()->weekOfMonth) == $w ? 'selected' : '' }}>
                                Minggu ke-{{ $w }}
                            </option>
                        @endfor
                    </select>
                </div>
                {{-- BUTTON FILTER --}}
                <button type="submit" class="btn btn-sm btn-primary">
                    Tampilkan
                </button>
                {{-- CETAK PDF --}}
                @can('khidmah-cetak')
                <a href="{{ route('jadwal.cetak', request()->only(['bulan','tahun'])) }}"
                target="_blank"
                class="btn btn-sm btn-danger">
                    Jadwal
                </a>
                @endcan
                @can('khidmah-absen')
                <a
                    href="{{ route('presensi.cetak', request()->only(['bulan','tahun'])) }}"
                    target="_blank"
                    class="btn btn-sm btn-warning"
                >
                    Presensi
                </a>
                @endcan
            </div>
        </form>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
    <!--begin::Table-->
    <div class="table-responsive" style="overflow-x:auto;">
        <table class="table align-middle table-striped fs-6 gy-4"
               style="min-width:900px;">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-center text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="rounded-start">Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                    <th class="rounded-end">Ahad</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $shifts = ['Pagi', 'Siang', 'Malam'];
                @endphp

                {{-- HEADER TANGGAL --}}
                <tr>
                    @for ($i = 0; $i < 7; $i++)
                        @php $tanggal = $startOfWeek->copy()->addDays($i); @endphp
                        <th class="text-center fw-bold text-blue fs-3"
                            style="{{ $i < 6 ? 'border-right:1px solid #e4e6ef' : '' }}">
                            {{ $tanggal->translatedFormat('d') }}
                        </th>
                    @endfor
                </tr>

                {{-- BARIS SHIFT --}}
                @foreach ($shifts as $namaShift)
                <tr>
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $tanggal = $startOfWeek->copy()->addDays($i);
                            $key = $tanggal->format('Y-m-d');

                            $shift = collect($jadwalPerTanggal[$key] ?? [])
                                        ->firstWhere('shift', $namaShift);
                        @endphp

                        <td valign="top"
                            style="font-size:12px; {{ $i < 6 ? 'border-right:1px solid #e4e6ef' : '' }}">
                            @if ($shift)
                                <strong>{{ $namaShift }}</strong>
                                <hr class="my-1">

                                <div>
                                    <div class="fw-bold">{{ $shift['pair1']['asrama']->kode ?? '-' }}</div>
                                    <span class="badge badge-light-primary mb-1">
                                        {{ $shift['pair1']['kepala']->nama ?? 'Tidak ada kepala' }}
                                    </span>
                                    <br>
                                    <span class="badge badge-light-warning">
                                        {{ $shift['pair1']['wakil']->nama ?? 'Tidak ada wakil' }}
                                    </span>
                                </div>

                                <div class="mt-2">
                                    <span class="fw-bold">{{ $shift['pair2']['asrama']->kode ?? '-' }}</span>
                                    <br>
                                    <span class="badge badge-light-primary mb-1">
                                        {{ $shift['pair2']['kepala']->nama ?? 'Tidak ada kepala' }}
                                    </span>
                                    <br>
                                    <span class="badge badge-light-warning mb-1">
                                        {{ $shift['pair2']['wakil']->nama ?? 'Tidak ada kepala' }}
                                    </span>
                                </div>
                            @endif
                        </td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Table-->
</div>

    <!--end::Card body-->
</div>





@endsection
@extends('layout.sidebar')
@section('konten')

<!--begin::Navbar-->
<div class="card mb-5 mb-xl-10">
	<div class="card-body pt-9 pb-0">
		<!--begin::Details-->
		<div class="d-flex flex-wrap flex-sm-nowrap">
			<!--begin: Pic-->
			<div class="me-7 mb-8">
				<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    @if($kk->foto == null )
                    <img src="assets/media/avatars/blank.png"/>
                    @else
                    <img src="{{ asset('/storage/kepalakamar/' . $kk->foto) }}" alt="{{ $kk->foto }}"/>
                    @endif
                    @if($kk->nokartu)
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                    @endif
				</div>
			</div>
			<!--end::Pic-->
            @php
                $previousUrl = url()->previous();
                $breadcrumbUrl = '/kepalakamar';
                $breadcrumbLabel = 'Kepala Kamar';

                if (Str::contains($previousUrl, '/wakilkamar')) {
                    $breadcrumbUrl = '/wakilkamar';
                    $breadcrumbLabel = 'Wakil Kepala Kamar';
                }
            @endphp
			<!--begin::Info-->
			<div class="flex-grow-1">
				<!--begin::Title-->
				<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
					<!--begin::User-->
					<div class="d-flex flex-column">
						<!--begin::Name-->
						<div class="d-flex align-items-center mb-2">
							<div class="text-gray-900 fs-2 fw-bold me-1">{{ $kk->nama }}</div>
							@if($kk->nokartu)
                            <i class="ki-outline ki-verify fs-1 text-primary"></i>
                            @endif    
						</div>
						<!--end::Name-->
						<!--begin::Info-->
						<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
							<div class="d-flex align-items-center text-gray-500 me-5 mb-2">
							    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $breadcrumbLabel }}
                            </div>
							<div class="d-flex align-items-center text-gray-500 me-5 mb-2">
							    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $kk->asrama->asrama .' - '. $kk->asrama->kode }}
                            </div>
						</div>
						<!--end::Info-->
					</div>
					<!--end::User-->
					<!--begin::Actions-->
					<div class="d-flex align-items-center gap-2">
						<form method="GET" class="d-flex align-items-center gap-2">
							<select name="semester_id" class="form-select form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Pilih Semester">
								@foreach($semesters as $s)
									<option value="{{ $s->id }}"
										{{ $semester && $semester->id == $s->id ? 'selected' : '' }}>
										Semester {{ $s->semester }} - {{ $s->tapel }}
									</option>
								@endforeach
							</select>
							<button type="submit" class="btn btn-sm btn-primary">Filter</button>
						</form>
						{{-- Tombol cetak hanya muncul jika semua hari hadir --}}
						@if ($hadir === $totalHari)
							<a href="{{ route('absensi.ket.cetak.perkk', $kk->id) }}" target="_blank" class="btn btn-sm btn-light-primary">
								<i class="ki-outline ki-file-up fs-2"></i> Cetak
							</a>
						@endif

					</div>
					<!--end::Actions-->
				</div>
				<!--end::Title-->
				<!--begin::Stats-->
				<div class="d-flex flex-wrap flex-stack">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column flex-grow-1 pe-8">
						<!--begin::Stats-->
						<div class="d-flex flex-wrap">
							<!--begin::Stat-->
							<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
								<!--begin::Label-->
								<div class="fw-semibold fs-6 text-gray-500">Hadir</div>
								<!--end::Label-->
                                <!--begin::Number-->
								<div class="d-flex align-items-center">
									<i class="ki-outline ki-check-circle fs-3 text-success me-2"></i>
									<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $hadir }}" data-kt-countup-prefix="">0</div><span class="fs-2 ms-1">x</span>
								</div>
								<!--end::Number-->
							</div>
							<!--end::Stat-->
							<!--begin::Stat-->
							<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
								<!--begin::Label-->
								<div class="fw-semibold fs-6 text-gray-500">Tidak Hadir</div>
								<!--end::Label-->
                                <!--begin::Number-->
								<div class="d-flex align-items-center">
									<i class="ki-outline ki-cross-circle fs-3 text-danger me-2"></i>
									<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $tidakHadir }}" data-kt-countup-prefix="">0</div><span class="fs-2 ms-1">x</span>
								</div>
								<!--end::Number-->
							</div>
							<!--end::Stat-->
							<!--begin::Stat-->
							<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
								<!--begin::Label-->
								<div class="fw-semibold fs-6 text-gray-500">Pembinaan</div>
								<!--end::Label-->
                                <!--begin::Number-->
								<div class="d-flex align-items-center">
									<i class="ki-outline ki-double-check-circle fs-3 text-primary me-2"></i>
									<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $pembinaan }}" data-kt-countup-prefix="">0</div><span class="fs-2 ms-1">x</span>
								</div>
								<!--end::Number-->
							</div>
							<!--end::Stat-->
							<!--begin::Stat-->
							<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
								<!--begin::Label-->
								<div class="fw-semibold fs-6 text-gray-500">Sisa Pembinaan</div>
								<!--end::Label-->
                                <!--begin::Number-->
								<div class="d-flex align-items-center">
									<i class="ki-outline ki-minus-circle fs-3 text-warning me-2"></i>
									<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $tidakHadir - $pembinaan }}" data-kt-countup-prefix="">0</div><span class="fs-2 ms-1">x</span>
								</div>
								<!--end::Number-->
							</div>
							<!--end::Stat-->
							
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Progress-->
					<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
						<div class="d-flex justify-content-between w-100 mt-auto mb-2">
							<span class="fw-semibold fs-6 text-gray-500">Persentase Kehadiran</span>
							<span class="fw-bold fs-6">{{ $persentase }}%</span>
						</div>
						<div class="h-5px mx-3 w-100 bg-light mb-3">
							<div class="bg-success rounded h-5px" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<!--end::Progress-->
				</div>
				<!--end::Stats-->
			</div>
			<!--end::Info-->
		</div>
		<!--end::Details-->
	</div>
</div>
<!--end::Navbar-->

<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
	<!--begin::Card header-->
	<div class="card-header cursor-pointer" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
		<!--begin::Card title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-danger">Tanggal Tidak Hadir Pengajian</span>
			<span class="text-muted mt-1 fw-semibold fs-6">
				Semester {{ $semester->semester . ' - Tahun Ajaran ' . $semester->tapel }}
				({{ \Carbon\Carbon::parse($semester->dari_tgl)->translatedFormat('d F Y') }}
				s/d
				{{ \Carbon\Carbon::parse($semester->sampai_tgl)->translatedFormat('d F Y') }})
			</span>
        </h3>
        <!--end::Card title-->
		<!--begin::Action-->
		{{-- <a href="#" class="btn btn-sm btn-primary align-self-center">Edit Profile</a> --}}
		<!--end::Action-->
	</div>
	<!--begin::Card header-->
	<!--begin::Card body-->
	<div class="card-body p-9">
		<!--begin::Notice-->
		@if(count($tanggalTidakHadir))
		@foreach(collect($tanggalTidakHadir)->sortDesc() as $tgl)
			@php
				// cek apakah tanggal ini ada di pembinaans kepala kamar
				$sudahPembinaan = $kk->pembinaan->where('tanggal', $tgl)->isNotEmpty();
			@endphp
			<div class="notice d-flex rounded border border-dashed mb-4 p-4 {{ $sudahPembinaan ? 'bg-light-primary border-primary' : 'bg-light-danger border-danger' }}">
				<!--begin::Icon-->
				<div class="symbol symbol me-5">
					<div class="symbol-label fs-3 {{ $sudahPembinaan ? 'bg-primary' : 'bg-danger' }} text-light">
						{{ \Carbon\Carbon::parse($tgl)->translatedFormat('d') }}
					</div>
				</div>
				<!--end::Icon-->

				<!--begin::Wrapper-->
				<div class="d-flex flex-stack flex-grow-1">
					<!--begin::Content-->
					<div class="fw-semibold">
						<h4 class="text-gray-900 fw-bold">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('l') }}</h4>
						<div class="fs-6 text-gray-700">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('d F Y') }}</div>
					</div>
					<!--end::Content-->

					<!--begin::Actions-->
					<div>
						@php
							// cek apakah tanggal ini ada di pembinaans kepala kamar
							$sudahPembinaan = $kk->pembinaan->where('tanggal', $tgl)->isNotEmpty();
						@endphp

						@if($sudahPembinaan)
							<span class="badge py-3 px-4 fs-7 badge-primary">Selesai Pembinaan</span>
						@else
							<form action="{{ route('absensi.tandai_pembinaan', ['id' => $kk->id]) }}" method="POST">
								@csrf
								<input type="hidden" name="tanggal" value="{{ $tgl }}">
								<button type="submit" class="btn btn-sm btn-danger hover-scale">
									Belum Pembinaan
								</button>
							</form>
						@endif
						<!--end::Actions-->
					</div>
				</div>
				<!--end::Wrapper-->
			</div>
		@endforeach

		@else
			<div class="alert alert-success d-flex align-items-center p-3">
				<i class="ki-outline ki-information text-success fs-2 me-2"></i>
				<div>Tidak ada ketidakhadiran</div>
			</div>
		@endif
		<!--end::Notice-->
	</div>
	<!--end::Card body-->
</div>
<!--end::details View-->
<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
	<!--begin::Card header-->
	<div class="card-header cursor-pointer" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
		<!--begin::Card title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-white">Riwayat Pembinaan Pengajian</span>
            <span class="text-muted mt-1 fw-semibold fs-6">
				Semester {{ $semester->semester . ' - Tahun Ajaran ' . $semester->tapel }}
				({{ \Carbon\Carbon::parse($semester->dari_tgl)->translatedFormat('d F Y') }}
				s/d
				{{ \Carbon\Carbon::parse($semester->sampai_tgl)->translatedFormat('d F Y') }})
			</span>
        </h3>
        <!--end::Card title-->
		<!--begin::Acprimarytion-->
		{{-- <a href="#" class="btn btn-sm btn-primary align-self-center">Edit Profile</a> --}}
		<!--end::Action-->
	</div>
	<!--begin::Card header-->
	<!--begin::Card body-->
	<div class="card-body p-9">
		<!--begin::Notice-->
   		@if(count($tanggalPembinaan))
        @foreach(collect($tanggalPembinaan)->sortDesc() as $tgl)
		@php
			$pembinaanId = optional($kk->pembinaan->where('tanggal', $tgl)->first())->id;
		@endphp

		<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-4 p-4">
			<!--begin::Icon-->
			<div class="symbol symbol me-5">
				<div class="symbol-label fs-3 bg-primary text-light">
					{{ \Carbon\Carbon::parse($tgl)->translatedFormat('d') }}
				</div>
			</div>
			<!--end::Icon-->

			<!--begin::Wrapper-->
			<div class="d-flex flex-stack flex-grow-1">
				<!--begin::Content-->
				<div class="fw-semibold">
					<h4 class="text-gray-900 fw-bold">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('l') }}</h4>
					<div class="fs-6 text-gray-700">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('d F Y') }}</div>
				</div>
				<!--end::Content-->

				<a href="{{ route('hapus.pembinaan', $pembinaanId) }}" class="btn btn-sm btn-danger hover-scale delete-button">Hapus</a>
			</div>
			<!--end::Wrapper-->
		</div>
		@endforeach
		@else
			<div class="alert alert-primary d-flex align-items-center p-3">
				<i class="ki-outline ki-information text-primary fs-2 me-2"></i>
				<div>Tidak ada pembinaan</div>
			</div>
		@endif
		<!--end::Notice-->
	</div>
	<!--end::Card body-->
</div>
<!--end::details View-->

@endsection
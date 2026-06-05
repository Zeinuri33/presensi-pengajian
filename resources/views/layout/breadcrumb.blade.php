@if(request()->is('/'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Beranda</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Beranda</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('pengguna'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Pengguna</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Pengguna</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('asrama'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Asrama</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Asrama</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('hakakses'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Hak Akses Sistem</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Hak Akses</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('izin'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Izin</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Izin</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('libur'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Hari Libur</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Izin</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('kepalakamar'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Kepala Kamar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Kepala Kamar</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('wakilkamar'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Wakil Kepala Kamar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Wakil Kepala Kamar</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('hakakses/*'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">{{ $role->name }}</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
    <!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
    <a href="/hakakses">
        <li class="breadcrumb-item text-gray-600 text-hover-primary fw-bold lh-1 ms-2">Hak Akses</li>
    </a>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Detail</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('kepalawakilkamar=*'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">{{ $kepalakamar->nama }}</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
    <!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	@php
        $previousUrl = url()->previous();
        $breadcrumbUrl = '/kepalakamar';
        $breadcrumbLabel = 'Kepala Kamar';

        if (Str::contains($previousUrl, '/wakilkamar')) {
            $breadcrumbUrl = '/wakilkamar';
            $breadcrumbLabel = 'Wakil Kepala Kamar';
        }
    @endphp

    <!--begin::Item-->
    <a href="{{ $breadcrumbUrl }}">
        <li class="breadcrumb-item text-gray-600 text-hover-primary fw-bold lh-1 ms-2">
            {{ $breadcrumbLabel }}
        </li>
    </a>
    <!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Edit</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('kepalawakilkamar-kehadiran=*'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">{{ $kk->nama }}</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
    <!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	@php
        $previousUrl = url()->previous();
        $breadcrumbUrl = '/kepalakamar';
        $breadcrumbLabel = 'Kepala Kamar';

        if (Str::contains($previousUrl, '/wakilkamar')) {
            $breadcrumbUrl = '/wakilkamar';
            $breadcrumbLabel = 'Wakil Kepala Kamar';
        }
    @endphp

    <!--begin::Item-->
    <a href="{{ $breadcrumbUrl }}">
        <li class="breadcrumb-item text-gray-600 text-hover-primary fw-bold lh-1 ms-2">
            {{ $breadcrumbLabel }}
        </li>
    </a>
    <!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Detail</li>
	<!--end::Item-->
</ul>

@elseif(Route::is('absen.kepala'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Kehadiran Kepala Kamar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Presensi Kepala Kamar</li>
	<!--end::Item-->
</ul>

@elseif(Route::is('laporan.tidak-hadir'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Ketidakhadiran</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Ketidakhadiran</li>
	<!--end::Item-->
</ul>
@elseif(Route::is('absen.wakil'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Kehadiran Wakil Kepala Kamar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Presensi Wakil Kepala Kamar</li>
	<!--end::Item-->
</ul>
@elseif(Route::is('absen.pembinaan'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Riwayat Pembinaan</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Pembinaan</li>
	<!--end::Item-->
</ul>
@elseif(Route::is('absen.ket'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Keterangan Aktif</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Ket. Aktif</li>
	<!--end::Item-->
</ul>

@elseif(Route::is('kegiatan.detail'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">{{ $kegiatan->kegiatan }}</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
    <a href="/kegiatan">
        <li class="breadcrumb-item text-gray-600 text-hover-primary fw-bold lh-1 ms-2">kegiatan</li>
    </a>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">{{ $kegiatan->kegiatan }}</li>
	<!--end::Item-->
</ul>


@elseif(request()->is('kegiatan'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Kegiatan</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Kegiatan</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('semester'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Data Semester</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Semester</li>
	<!--end::Item-->
</ul>

@elseif(request()->is('suratmasuk'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Arsip Surat Masuk</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Surat Masuk</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('suratkeluar'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Arsip Surat Keluar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Surat Keluar</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('khidmah'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Khidmah di Pendopo Pengasuh</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Jadwal Khidmah</li>
	<!--end::Item-->
</ul>
</ul>
@elseif(request()->is('kepalawakilkamar-verifikasi'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Cek Kepala Kamar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Verifikasi</li>
	<!--end::Item-->
</ul>
@elseif(request()->is('postel-transaksi'))
<h1 class="fs-2 text-gray-900 fw-bold m-0">Transaksi Wartel Kepala/Wakil Kepala Kamar</h1>
<!--end::Title-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">
		<a href="/" class="text-gray-700 text-hover-primary me-1">
			<i class="ki-outline ki-home text-gray-500 fs-7"></i>
		</a>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item">
		<i class="ki-outline ki-right fs-7 text-gray-500 mx-n1"></i>
	</li>
	<!--end::Item-->
	<!--begin::Item-->
	<li class="breadcrumb-item text-gray-600 fw-bold lh-1">Transaksi</li>
	<!--end::Item-->
</ul>
@endif

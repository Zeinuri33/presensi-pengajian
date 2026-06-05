@extends('layout.sidebar')
@section('konten')


<!--begin::Chart widget 20-->
<div class="card card-flush mb-5 mb-lg-10">
	<!--begin::Header-->
	<div class="card-header py-5">
		<!--begin::Title-->
		<h3 class="card-title fw-bold text-gray-800">Rekap Pendapatan Wartel Kepala/Wakil Kepala Kamar</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
			<div class="btn btn-sm btn-light d-flex align-items-center px-4">
                {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}
				<i class="ki-outline ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0"></i>
			</div>
			<!--end::Daterangepicker-->
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Card body-->
	<div class="card-body d-flex justify-content-between flex-column pb-0 px-0 pt-1">
		<!--begin::Items-->
		<div class="d-flex flex-wrap d-grid gap-5 px-9 mb-10">
			
			<!--begin::Item-->
			<div class="me-md-5">
				<!--begin::Statistics-->
				<div class="d-flex mb-2">
					<span class="fs-4 fw-semibold text-gray-500 me-1">Rp.</span>
					<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($totalBulan, 0, ',', '.') }}</span>
				</div>
				<!--end::Statistics-->
				<!--begin::Description-->
				<span class="fs-6 fw-semibold text-gray-500">Pendapatan Bulan ini ({{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }})</span>
				<!--end::Description-->
			</div>
			<!--end::Item-->
            <!--begin::Item-->
			<div class="me-md-2 ">
				<!--begin::Statistics-->
				<div class="d-flex mb-2">
					<span class="fs-4 fw-semibold text-gray-500 me-1">Rp.</span>
					<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($totalHariIni, 0, ',', '.') }}</span>
				</div>
				<!--end::Statistics-->
				<!--begin::Description-->
				<span class="fs-6 fw-semibold text-gray-500">Pendapatan Hari ini</span>
				<!--end::Description-->
			</div>
			<!--end::Item-->
		</div>
		<!--end::Items-->
		<!--begin::Chart-->
		<!--end::Chart-->
	</div>
	<!--end::Card body-->
</div>
<!--end::Chart widget 20-->


<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <form method="GET"
                action="{{ route('postel-transaksi.index') }}"
                class="d-flex flex-wrap align-items-end gap-3">
                <!-- Filter Bulan -->
                <div>
                    <input
                        type="month"
                        name="bulan"
                        class="form-control form-control-sm"
                        value="{{ request('bulan', now()->format('Y-m')) }}">
                </div>

                <!-- Button -->
                <div class="d-flex gap-2">
                    <button class="btn btn-light-primary btn-sm" type="submit">
                        <i class="ki-outline ki-filter fs-3 me-1"></i> Filter
                    </button>

                    <a href="{{ route('postel-transaksi.index') }}" class="btn btn-primary btn-sm">
                        <i class="ki-outline ki-chart fs-3 me-1"></i> Reset
                    </a>
                </div>

            </form>
        </div>
        <!--end::Card toolbar-->

    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Jabatan</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                    <th>Petugas</th>
                    <th class="text-end rounded-end pe-4">Keterangan</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($transaksi as $item)
                <tr>
                    <td class="ps-4"><span class="badge badge py-3 px-4 badge-light-primary fs-7">{{ $item->created_at->translatedFormat('d F Y - H:i') }}</span></td>
                    <td class="d-flex align-items-center">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-40px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->kepalakamar->foto == null )
                                <img src="{{ asset('assets/media/avatars/blank.png') }}" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item->kepalakamar->foto ) }}" alt="{{ $item->kepalakamar->nama }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <!--end::Foto-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">{{ $item->kepalakamar->nama }}</div>
                            <span>{{ $item->kepalakamar->nis }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>
                        <div class="text-gray-900 mb-1 fs-6">
                            {{ $item->kepalakamar->jabatan == 'Wakil Kamar' ? 'Wakil Kepala Kamar' : $item->kepalakamar->jabatan }}
                            <span class="badge badge-success">{{ $item->kepalakamar->asrama->kode }}</span>
                        </div>
                        <div class="text-muted fw-semibold fs-7 d-none d-md-block">
                            {{ $item->kepalakamar->asrama->asrama }}
                        </div>
                    </td>
                    <td>
                        <div class="text-gray-900 mb-1 fs-6">Rp. {{ number_format($item->total, 0, ',', '.') }}</div>
                        <div class="text-muted fw-semibold fs-7 d-none d-md-block">{{ $item->durasi }} Menit</div>
                    </td>
                    <td class="text-dark">Rp. {{ number_format($item->bayar, 0, ',', '.') }}</td>
                    <td class="text-dark">Rp. {{ number_format($item->kembali, 0, ',', '.') }}</td>
                    <td class="text-dark">{{ $item->petugas }}</td>
                    <td class="pe-4 text-end">
                        <button class="btn btn-sm btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </button>
                        <!--begin::Menu-->          
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('transaksi postel-edit')
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit{{ $item->id }}">Edit</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('transaksi postel-hapus')
                            <div class="menu-item px-3">
                                <a href="{{ asset('postel-transaksi/'.$item->id.'/hapus') }}" class="menu-link px-3 delete-button">Hapus</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
                    </td>
                </tr>
                @include('postel.transaksi.edit')
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Products-->


<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>


@endsection
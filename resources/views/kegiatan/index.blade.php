@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses1.png') }}'); background-size: cover; background-position: center;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Cari Kegiatan" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <!--begin::Add product-->
            @can('kegiatan-tambah')
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    @include('kegiatan.tambah')
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-success">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Kegiatan</th>
                    <th>Peserta</th>
                    <th>Lokasi</th>
                    <th>Hadir</th>
                    <th></th>
                    <th>Tidak Hadir</th>
                    <th>Persentase</th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($kegiatan as $item)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex flex-column">
                            <div class="position-relative ps-6 pe-3 py-2">
                                <div class="position-absolute start-0 top-0 w-4px h-100 rounded-2 bg-success"></div>
                                <div class="text-gray-800 mb-1 fw-bold text-truncate">
                                    {{ \Illuminate\Support\Str::words($item->kegiatan, 4, '...') }}
                                </div>
                                <span>{{ Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($item->peserta == 'Kepala Kamar')
                        <div class="text-gray-900 mb-1 fs-6">Kepala Kamar</div>
                        @elseif ($item->peserta == 'Wakil Kamar')
                        <div class="text-gray-900 mb-1 fs-6">Wakil Kepala Kamar</div>
                        @else
                        <div class="text-gray-900 mb-1 fs-6">Kepala & Wakil Kepala Kamar</div>
                        @endif
                        <div class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->lingkup }}</div>
                    </td>
                    <td>{{ $item->tempat }}</td>
                    <td>
                        <div class="text-gray-900 mb-1 fs-5">{{ $item->hadir }}</div>
                        @if ($item->peserta == 'Kepala Kamar')
                        <span class="text-muted fw-semibold text-muted d-block fs-7">Kepala Kamar</span>
                        @elseif ($item->peserta == 'Wakil Kamar')
                        <span class="text-muted fw-semibold text-muted d-block fs-7">Wakil Kepala Kamar</span>
                        @else
                        <div class="text-muted fw-semibold text-muted d-block fs-7">Kepala & Wakil</div>
                        @endif
                    </td>
                    <td></td>
                    <td>
                        <div class="text-gray-900 mb-1 fs-5">{{ $item->tidak_hadir }}</div>
                        @if ($item->peserta == 'Kepala Kamar')
                        <span class="text-muted fw-semibold text-muted d-block fs-7">Kepala Kamar</span>
                        @elseif ($item->peserta == 'Wakil Kamar')
                        <span class="text-muted fw-semibold text-muted d-block fs-7">Wakil Kepala Kamar</span>
                        @else
                        <div class="text-muted fw-semibold text-muted d-block fs-7">Kepala & Wakil</div>
                        @endif
                    </td>
                    <td>
                        <div class="badge badge py-3 px-4 fs-7 badge-light-warning">{{ $item->persentase }}%</div>
                    </td>
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-light-success" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </button>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="{{ asset('kegiatan/'.$item->id.'/presensi') }}" class="menu-link px-3">Presensi</a>
                            </div>
                            <!--begin::Menu item-->
                            @can('kegiatan-detail')
                            <div class="menu-item px-3">
                                <a href="{{ route('kegiatan.detail', $item->id) }}" class="menu-link px-3">Detail</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('kegiatan-edit')
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit{{ $item->id }}">Edit</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('kegiatan-hapus')
                            <div class="menu-item px-3">
                                <a href="{{ asset('kegiatan/'.$item->id.'/hapus') }}" class="menu-link px-3 delete-button">Hapus</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                @include('kegiatan.edit')
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
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/ecommerce/catalog/products.js"></script>
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<!--end::Custom Javascript-->

@endsection

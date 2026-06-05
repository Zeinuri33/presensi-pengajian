@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses3.png') }}'); background-size: cover; background-position: center;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Cari" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <!--begin::Add product-->
            @can('surat masuk-tambah')
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    @include('arsip.suratmasuk.tambah')
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-info">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">No. Surat</th>
                    <th>Perihal</th>
                    <th>Pengirim</th>
                    <th>Tanggal Masuk</th>
                    <th></th>
                    <th>File</th>
                    <th></th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($masuk as $item)
                <tr>
                    <td class="ps-2">
                        <div class="badge badge py-3 px-4 fs-7 badge-light-info">{{ $item->nomor }}</div>
                    </td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->pengirim }}</td>
                    <td>{{ Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td></td>
                    <td>
                        @if($item->file)
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                <img alt="" class="w-35px hover-scale" src="{{ asset('assets/media/svg/files/doc.svg') }}">
                            </a>
                        @endif
                    </td>
                    <td></td>
                    <td class="text-end pe-2">
                        <button class="btn btn-sm btn-light-info" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </button>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('surat masuk-edit')
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit{{ $item->id }}">Edit</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('surat masuk-hapus')
                            <div class="menu-item px-3">
                                <a href="{{ asset('suratmasuk/'.$item->id.'/hapus') }}" class="menu-link px-3 delete-button">Hapus</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                @include('arsip.suratmasuk.edit')
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

@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari Izin" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            {{-- <div class="w-100 mw-150px">
                <!--begin::Select2-->
                <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Jabatan" data-kt-ecommerce-product-filter="status">
                    <option></option>
                    <option value="all">Semua</option>
                    <option value="Kepala Kamar">Kepala Kamar</option>
                    <option value="Wakil Kamar">Wakil Kamar</option>
                </select>
                <!--end::Select2-->
            </div> --}}
            <!--begin::Add product-->
            <form method="GET" class="row">
                <div class="col-auto">
                    <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ $tanggal }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </form>
            @can('izin-tambah')
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    @include('absensi.izin.tambah')
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Tanggal</th>
                    <th>Umana'</th>
                    <th>Asrama</th>
                    <th></th>
                    <th></th>
                    <th>Jabatan</th>
                    <th>Keterangan</th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($izin as $item)
                <tr>
                    <td class="ps-2"><div class="badge badge py-3 px-4 fs-7 badge-light-primary">{{ Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</div></td>
                    <td class="d-flex align-items-center">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->foto == null )
                                <img src="assets/media/avatars/blank.png" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item->kepalakamar->foto) }}" alt="{{ $item->kepalakamar->foto }}" class="w-100" />
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
                    <td>{{ $item->kepalakamar->asrama->asrama }}
                        <span class="badge badge-lg fs-7 badge-success">{{ $item->kepalakamar->asrama->kode }}</span>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        @if ($item->kepalakamar->jabatan == 'Kepala Kamar')
                        <div class="badge badge py-3 px-4 fs-7 badge-light-success">{{ $item->kepalakamar->jabatan }}</div>
                        @else
                        <div class="badge badge py-3 px-4 fs-7 badge-light-warning">{{ $item->kepalakamar->jabatan }}</div>
                        @endif
                    </td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-end pe-2">
                        <button class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </button>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('izin-edit')
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit{{ $item->id }}">Edit</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('izin-hapus')
                            <div class="menu-item px-3">
                                <a href="{{ asset('izin/'.$item->id.'/hapus') }}" class="menu-link px-3 delete-button">Hapus</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                    @include('absensi.izin.edit')
                </tr>
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

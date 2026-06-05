@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Cari Pengguna" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            {{-- <div class="w-100 mw-150px">
                <!--begin::Select2-->
                <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                    <option></option>
                    <option value="all">All</option>
                    <option value="published">Published</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="inactive">Inactive</option>
                </select>
                <!--end::Select2-->
            </div> --}}
            <!--begin::Add product-->
            @can('pengguna-tambah')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah Pengguna
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
        @include('user.user.tambah')
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Pengguna</th>
                    <th></th>
                    <th>Jabatan</th>
                    <th>Role</th>
                    <th></th>
                    <th>Username</th>
                    <th>Dibuat</th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($user as $item)
                <tr>
                    <td class="d-flex align-items-center">
                        <!--begin:: Avatar -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->avatar == null )
                                <img src="assets/media/avatars/blank.png" alt="{{ $item->avatar }}" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/avatars/' . $item->avatar) }}" alt="{{ $item->avatar }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">{{ $item->name }}</div>
                            <span>{{ $item->username }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td></td>
                    <td>{{ $item->jabatan }}</td>
                    <td><div class="badge px-4 py-3 badge-light-primary fs-7">{{ $item->getRoleNames()->implode(', ') }}</div></td>
                    <td></td>
                    <td>{{ $item->username }}</td>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </button>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('pengguna-edit')
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit{{ $item->id }}">Edit</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('pengguna-hapus')
                            <div class="menu-item px-3">
                                <a href="{{ asset('pengguna/'.$item->id.'/hapus') }}" class="menu-link px-3 delete-button">Hapus</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                    @include('user.user.edit')
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
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
@endsection

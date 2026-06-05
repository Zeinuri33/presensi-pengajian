@extends('layout.sidebar')
@section('konten')

<div class="card card-flush h-xl-100">
    <!--begin::Heading-->
    <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('{{ asset('assets/media/ibrahimy/akses.png') }}" data-bs-theme="light">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column text-white pt-15">
            <span class="fw-bold fs-2x mb-3">{{ $role->name }}</span>
            <div class="fs-4 text-white">
                <span class="opacity-75">Peran ini memiliki {{ $role->permissions->count() }} Hak Akses</span>
            </div>
        </h3>
        <!--end::Title-->
    </div>
    <!--en\d::Heading-->
    <!--begin::Body-->
    <div class="card-body mt-n20">
        <!--begin::Stats-->
        <div class="mt-n20 position-relative">
            <!--begin::Items-->
            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-2 py-5">
                <!--begin::Form-->
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <!--begin::Symbol-->
                    <div class="card-header border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Edit Akses</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">pada role {{ $role->name }}</span>
                        </h3>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <a class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_akses"><i class="ki-outline ki-message-add fs-2"></i>Tambah Akses</a>
                            <button type="submit" class="btn btn-primary"></i>Simpan</button>
                            <!--end::Add product-->
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">Nama Role</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" placeholder="Masukkan Nama Role/Peran" name="name" id="name" value="{{ $role->name }}"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">
                                            <!--begin::Table row-->
                                            <!--begin::Table row: Select All-->
                                            <tr>
                                                <td class="text-gray-800">
                                                    Hak Akses
                                                    <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Memungkinkan akses penuh ke sistem">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    <label class="form-check form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                        <span class="form-check-label" for="kt_roles_select_all">Full Akses</span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <!--end::Table row-->
                                            <!--end::Table row-->
                                            @php
                                                $groupedPermissions = collect($permissions)->groupBy(function($permission) {
                                                    return explode('-', $permission->name)[0]; // grup berdasarkan prefix (misalnya 'user_management')
                                                });
                                            @endphp
                                            <!--begin::Table row-->
                                            @foreach ($groupedPermissions as $group => $perms)
                                            <tr>
                                                <td class="text-gray-800 text-capitalize">{{ str_replace('-', ' ', $group) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @foreach ($perms as $permission)
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }} />
                                                                <span class="form-check-label">
                                                                    {{ ucfirst(str_replace($group . '-', '', $permission->name)) }}
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <!--end::Table row-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--begin::Body-->
                </form>
                <!--end::Form-->
            </div>
            @include('user.role.tambahakses')
            <!--end::Items-->
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Body-->
</div>



@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectAll = document.getElementById('kt_roles_select_all');
        const checkboxes = document.querySelectorAll('.permission-checkbox');

        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                // If any checkbox is unchecked, uncheck "Select All"
                if (!this.checked) {
                    selectAll.checked = false;
                } else {
                    // If all checkboxes are checked, set "Select All"
                    const allChecked = Array.from(checkboxes).every(c => c.checked);
                    selectAll.checked = allChecked;
                }
            });
        });
    });
</script>

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>


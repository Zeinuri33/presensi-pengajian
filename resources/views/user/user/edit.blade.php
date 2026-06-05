<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
        <div class="modal-header pb-0 border-0 justify-content-end">
            <!--begin::Close-->
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <i class="ki-outline ki-cross fs-1">
                </i>
            </div>
            <!--end::Close-->
        </div>
        <!--begin::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body scroll-y px-15 px-lg-15 pt-0 pb-15">
            <!--begin:Form-->
            <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="{{ route('pengguna.update', $item->id) }}">
                @csrf
                @method('PUT')
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">{{ $item->name }}</h1>
                    <div class="text-muted fw-semibold fs-5">Edit akun pengguna pengelola website.</div>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <!--begin::Input group-->
                <div class="text-center fv-row mb-7">
                    <!--begin::Label-->
                    <label class="d-block fw-semibold fs-6 mb-5">Foto Profil</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                    <!--end::Image placeholder-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->
                        @if($item->avatar == null)
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/blank.png);"></div>
                        @else
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('/storage/avatars/' . $item->avatar) }});"></div>
                        @endif
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload Foto">
                            <i class="ki-outline ki-pencil fs-7">
                            </i>
                            <!--begin::Inputs-->
                            <input type="file" name="avatar" id="avatar" value="blank.png" accept=".png, .jpg, .jpeg">
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Foto">
                            <i class="ki-outline ki-cross fs-2">
                            </i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus foto">
                            <i class="ki-outline ki-cross fs-2">
                            </i>
                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">File memiliki format: png, jpg, jpeg.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Nama Pengguna</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name" value="{{ $item->name }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Pengguna" required/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Jabatan</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="jabatan" value="{{ $item->jabatan }}" class="form-control mb-3 mb-lg-0" placeholder="Jabatan Instansi" required/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Username</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="username" value="{{ $item->username }}" class="form-control mb-3 mb-lg-0" placeholder="Username" required/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Role</label>
                    <!--end::Label-->
                    <select class="form-select" name="role" data-control="select2" data-hide-search="true" data-placeholder="Pilih Peran/Role">
                        @foreach ($role as $roles)
                            <option value="{{ $roles->name }}"
                                {{ $item->hasRole($roles->name) ? 'selected' : '' }}>
                                {{ ucfirst($roles->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row mb-14">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Password</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" id="password" name="password" class="form-control mb-3 mb-lg-0" placeholder="Password"/>
                    <!--end::Input-->
                </div>
                <div class="form-text">Biarkan kosong jika tidak ingin diubah.</div>
                <div class="text-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    {{--  <button class="btn btn-primary" >  --}}
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
            <!--end:Form-->
        </div>
        <!--end::Modal body-->

            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Update user details-->

<script src="admin/assets/plugins/global/plugins.bundle.js"></script>


<script>
    $("#kt_datepicker_2").flatpickr({
        dateFormat: "j F Y",
    });

</script>

<script src="admin/assets/js/custom/utilities/modals/bidding.js"></script>


{{-- @include('sweetalert::alert') --}}

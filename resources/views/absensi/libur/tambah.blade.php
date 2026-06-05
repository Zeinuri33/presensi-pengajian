<!--begin::Modal - Add permissions-->
<div class="modal fade" id="kt_modal_tambah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header border-0 justify-content-end">
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
                <!--begin::Form-->
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('libur.store') }}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Tambah Hari Libur Pengajian</h1>
                        <div class="text-muted fw-semibold fs-5">PP.Salafiyah Syafi'iyah Sukorejo</div>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Dari Tanggal</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" name="mulai" class="form-control" value="{{ now()->toDateString() }}" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Sampai Tanggal</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" name="sampai" class="form-control" value="{{ now()->toDateString() }}" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Keterangan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
                         <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    {{--  <button class="btn btn-primary" >  --}}
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add permissions-->


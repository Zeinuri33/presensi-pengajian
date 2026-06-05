<!--begin::Modal - Add permissions-->
<div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('suratmasuk.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{ $item->nomor }}</h1>
                        <div class="text-muted fw-semibold fs-5">Edit Surat Masuk</div>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="fv-row mb-8">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">No.Surat</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="nomor" placeholder="Nomor Surat" value="{{ $item->nomor }}" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="fw-row mb-8">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Perihal</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="perihal" placeholder="Perihal Surat" value="{{ $item->perihal }}" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--begin::Actions-->
                    <!--end::Input group-->
                    <div class="fw-row mb-8">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Pengirim</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="pengirim" placeholder="Pengirim Surat" value="{{ $item->pengirim }}" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--begin::Actions-->
                    <!--end::Input group-->
                    <div class="fw-row mb-8">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Tanggal Surat Keluar</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--begin::Actions-->
                    <!--end::Input group-->
                    <div class="fw-row mb-8">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 ">File</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="file" name="file" class="form-control" placeholder="Masukkan File">
                        <!--end::Input-->
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    {{--  <button class="btn btn-primary" >  --}}
                    <button type="submit" class="btn btn-info">Simpan</button>
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

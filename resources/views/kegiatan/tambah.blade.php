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
                <form class="form" method="POST" enctype="multipart/form-data" action="/kegiatan">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Tambah Kegiatan</h1>
                        <div class="text-muted fw-semibold fs-5">PP.Salafiyah Syafi'iyah Sukorejo</div>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Kegiatan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="kegiatan" placeholder="Nama Kegiatan" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Tempat</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="tempat" placeholder="Tempat Kegiatan" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Lingkup Peserta</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="lingkup" data-control="select2" data-hide-search="true" data-placeholder="Pilih Lingkup" required>
                            <option></option>
                            <option value="Pusat" {{ old('lingkup', $item->lingkup ?? '') == 'Pusat' ? 'selected' : '' }}>Pusat</option>
                            <option value="Cabang" {{ old('lingkup', $item->lingkup ?? '') == 'Cabang' ? 'selected' : '' }}>Cabang</option>
                            <option value="Pusat dan Cabang" {{ old('lingkup', $item->lingkup ?? '') == 'Pusat dan Cabang' ? 'selected' : '' }}>Pusat dan Cabang</option>
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Peserta</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="peserta" data-control="select2" data-hide-search="true" data-placeholder="Pilih Peserta" required>
                            <option></option>
                            <option value="Kepala Kamar" {{ old('peserta', $item->peserta ?? '') == 'Kepala Kamar' ? 'selected' : '' }}>Kepala Kamar</option>
                            <option value="Wakil Kamar" {{ old('peserta', $item->peserta ?? '') == 'Wakil Kamar' ? 'selected' : '' }}>Wakil Kepala Kamar</option>
                            <option value="Kepala dan Wakil" {{ old('peserta', $item->peserta ?? '') == 'Kepala dan Wakil' ? 'selected' : '' }}>Kepala dan Wakil Kamar</option>
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Tanggal</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" name="tanggal" placeholder="Tempat Kegiatan" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Waktu</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="time" name="waktu" placeholder="Waktu Kegiatan" class="form-control" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Batas Absen</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="time" name="batasabsen" placeholder="Batas Absen Kegiatan" class="form-control" required>
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

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
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('semester.update', $item->id) }}">
                    @csrf
                    @method('PUT')

                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Edit Semester</h1>
                        <div class="text-muted fw-semibold fs-5">PP. Salafiyah Syafi'iyah Sukorejo</div>
                    </div>
                    <!--end::Heading-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                        <label class="fw-semibold fs-6 mb-2">Semester</label>
                        <select class="form-select" name="semester" data-control="select2" data-hide-search="true" data-placeholder="Pilih Semester" required>
                            <option value="Ganjil" {{ $item->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ $item->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Tahun Ajaran</label>
                        <select name="tapel" class="form-control" data-control="select2" data-hide-search="true" data-placeholder="Pilih Tahun Ajaran" required>
                            @php
                                $currentYear = date('Y');
                                $startYear = $currentYear - 5; // 5 tahun ke belakang
                                $endYear = $currentYear + 5;   // 5 tahun ke depan
                            @endphp

                            @for ($year = $endYear; $year >= $startYear; $year--)
                                <option value="{{ $year - 1 }}/{{ $year }}"
                                    {{ request('tahun') == $year - 1 . '/' . $year ? 'selected' : '' }}>
                                    {{ $year - 1 }}/{{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Dari Tanggal</label>
                        <input type="date" name="dari_tgl" class="form-control" value="{{ $item->dari_tgl }}" required>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Sampai Tanggal</label>
                        <input type="date" name="sampai_tgl" class="form-control" value="{{ $item->sampai_tgl }}" required>
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


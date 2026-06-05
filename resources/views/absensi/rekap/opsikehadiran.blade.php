<!--begin::Modal - Add permissions-->
<div class="modal fade" id="kt_modal_rekap" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
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
                <form class="form" action="{{ route('rekap.kehadiran') }}" method="GET">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Cetak Rekap Kehadiran</h1>
                        @if(Route::is('absen.kepala'))
                        <div class="text-muted fw-semibold fs-5">Kepala Kamar PP.Salafiyah Syafi'iyah Sukorejo</div>
                        @elseif(Route::is('absen.wakil'))
                        <div class="text-muted fw-semibold fs-5">Wakil Kepala Kamar PP.Salafiyah Syafi'iyah Sukorejo</div>
                        @endif
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-6">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Tahun</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="tahun" data-control="select2" data-hide-search="true" data-placeholder="Pilih Tahun">
                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : (now()->year == $i ? 'selected' : '') }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-6">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Bulan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="bulan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Bulan">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : (now()->month == $i ? 'selected' : '') }}>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-6">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Daerah</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="daerah" data-control="select2" data-hide-search="true" data-placeholder="Pilih Daerah">
                            @foreach($daerahList as $daerah)
                                <option></option>
                                <option value="{{ $daerah }}" {{ request('daerah') == $daerah ? 'selected' : '' }}>
                                    {{ $daerah }}
                                </option>
                            @endforeach
                        </select>
                        <!--end::Input-->
                        <div class="form-text">Pilih daerah jika ingin mencetak rekap daerah tertentu.</div>
                    </div>
                    <!--end::Input group-->
                    @if(Route::is('absen.kepala'))
                    <input type="hidden" name="jabatan" class="form-control" value="Kepala Kamar" required>
                    @elseif(Route::is('absen.wakil'))
                    <input type="hidden" name="jabatan" class="form-control" value="Wakil Kamar" required>
                    @endif

                    <!--begin::Actions-->
                    <div class="text-center pt-12">
                    {{--  <button class="btn btn-primary" >  --}}
                    <button type="submit" class="btn btn-light-warning">
                        <span class="indicator-label">Tampilkan</span>
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


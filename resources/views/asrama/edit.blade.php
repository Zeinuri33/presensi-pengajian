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
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('asrama.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{ $item->asrama }}</h1>
                        <div class="text-muted fw-semibold fs-5">PP.Salafiyah Syafi'iyah Sukorejo</div>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Pilih Wilayah</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="wilayah" data-control="select2" data-hide-search="true" data-placeholder="Pilih Wilayah" required>
                            <option value="Pusat" {{ old('wilayah', $item->wilayah) == 'Pusat' ? 'selected' : '' }}>
                                Pusat
                            </option>
                            <option value="Cabang" {{ old('wilayah', $item->wilayah) == 'Cabang' ? 'selected' : '' }}>
                                Cabang
                            </option>
                        </select>

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Pilih Daerah</label>
                        <!--end::Label-->
                        @php
                            $daerahOptions = [
                                'Sunan Maulana Malik Ibrahim',
                                'Sunan Ampel',
                                'Sunan Bonang',
                                'Sunan Giri',
                                'Sunan Drajat',
                                'Sunan Kalijogo',
                                'Sunan Kudus',
                                'Sunan Muria',
                                'Sunan Gunung Jati(Unit I)',
                                'Sunan Gunung Jati(Unit II Bawah)',
                                'Sunan Gunung Jati(Unit II Atas)',
                                "I'dadiyah", // ✅ ini sudah aman
                                "Nurul Qoni'", 
                                "Ma'hadul Qur'an",
                                "Tahfidzul Qur'an",
                                "Az-Zainiyah",
                                "Abbasiyah Masjid",
                                "Nurul Makkiyah",
                                "Al-Khoiriyah",
                                "Nurul Ihsan"
                            ];
                        @endphp
                        <!--begin::Input-->
                        <select class="form-select" name="daerah" data-control="select2" data-hide-search="true" data-placeholder="Pilih Daerah">
                            @foreach ($daerahOptions as $option)
                                <option value="{{ $option }}" {{ old('daerah', $item->daerah ?? '') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Input group-->
                    @php
                        // Misal kode = 'A.1' atau 'ID.10'
                        $kode = $item->kode ?? '';
                        $nomor = explode('.', $kode)[1] ?? '';
                    @endphp
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2 ">Nomor Asrama</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" name="nomor" min="1" value="{{ old('nomor', $nomor) }}" placeholder="Nomor Asrama" class="form-control" required>
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

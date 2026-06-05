<!--begin::Modal - Filter Rekap Ketidakhadiran-->
<div class="modal fade" id="kt_modal_rekap" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <div class="modal-header border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body scroll-y px-15 px-lg-15 pt-0 pb-15">
                <form class="form" action="{{ route('rekap.ketidakhadiran') }}" method="GET">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Cetak Rekap Ketidakhadiran</h1>
                        <div class="text-muted fw-semibold fs-5">
                            Kepala Kamar dan Wakil PP. Salafiyah Syafi'iyah Sukorejo
                        </div>
                    </div>

                    <!-- Tahun -->
                    <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6 mb-2">Tahun</label>
                        <select class="form-select" name="tahun" data-control="select2" data-hide-search="true" data-placeholder="Pilih Tahun">
                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                <option value="{{ $i }}" {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Bulan -->
                    <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6 mb-2">Bulan</label>
                        <select class="form-select" name="bulan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Bulan">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Jabatan -->
                    <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6 mb-2">Jabatan</label>
                        <select class="form-select" name="jabatan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jabatan" required>
                            <option value="Kepala Kamar" {{ request('jabatan') == 'Kepala Kamar' ? 'selected' : '' }}>Kepala Kamar</option>
                            <option value="Wakil Kamar" {{ request('jabatan') == 'Wakil Kamar' ? 'selected' : '' }}>Wakil Kepala Kamar</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="text-center pt-12">
                        <button type="submit" class="btn btn-light-warning">
                            <span class="indicator-label">Tampilkan</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

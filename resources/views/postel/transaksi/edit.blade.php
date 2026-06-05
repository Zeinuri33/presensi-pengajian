<!--begin::Modal - Add permissions-->
<div class="modal fade text-start" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('postel-transaksi.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Edit Transaksi</h1>
                        <div class="text-muted fw-semibold fs-5">{{ $item->kepalakamar->nama }} - {{ $item->kepalakamar->jabatan === 'Wakil Kamar' ? 'Wakil Kepala Kamar' : $item->kepalakamar->jabatan }} Asrama {{ $item->kepalakamar->asrama->kode }}</div>
                        <!--end::Title-->
                    </div>
                    <input type="hidden" name="kepalakamar_id" value="{{ $item->kepalakamar->id }}">
                    <!--end::Heading-->
                    <div class="row">
                        <!-- Durasi -->
                        <div class="col-md-6 fv-row">
                            <label class="required fw-semibold fs-6 mb-2">Durasi(Menit)</label>
                            <div class="input-group">
                                <input type="number" name="durasi" id="durasi" class="form-control" value="{{ $item->durasi }}" placeholder="Durasi" required>
                                <span class="input-group-text">Menit</span>
                            </div>
                        </div>
                        <!-- Harga -->
                        <div class="col-md-6 fv-row">
                            <label class="required fw-semibold fs-6 mb-2">Harga</label>
                            <div class="input-group mb-5">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" name="total" id="harga" placeholder="Harga" readonly
                                />
                            </div>
                        </div>
                    </div>
                    <!-- Bayar -->
                    <div class="fv-row mb-6">
                        <label class="required fw-semibold fs-6 mb-2">Bayar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" name="bayar" id="bayar" class="form-control" value="{{ $item->bayar }}" placeholder="Jumlah Bayar" min="500" required>
                        </div>
                    </div>

                    <!-- Kembalian -->
                    <div class="fv-row mb-6">
                        <label class="fw-semibold fs-6 mb-2">Kembalian</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input  type="number"  name="kembali"  id="kembali"  class="form-control" value="{{ $item->kembali }}"  placeholder="Kembalian" min="0"  readonly>
                        </div>
                    </div>

                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                    <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 ">Kasir</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="petugas" class="form-control" value="{{ $item->petugas }}" placeholder="Petugas/Kasir">
                        <!--end::Input-->
                        <div class="form-text">boleh diisi atau tidak</div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Shift</label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select name="shift" class="form-select">
                            <option value="Pagi" {{ old('shift') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                            <option value="Siang" {{ old('shift') == 'Siang' ? 'selected' : '' }}>Siang</option>
                            <option value="Malam" {{ old('shift') == 'Malam' ? 'selected' : '' }}>Malam</option>
                        </select>
                        <!--end::Select-->
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

<script>
    const TARIF = 1000;

    function formatRupiah(angka) {
        return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    document.getElementById('durasi').addEventListener('input', function () {
        const menit = parseInt(this.value) || 0;
        const total = menit * TARIF;

        document.getElementById('harga').value = total;
        document.getElementById('harga_view').value = formatRupiah(total);
    });
</script>
<script>
    document.getElementById('bayar').addEventListener('input', function () {
        const bayar = parseInt(this.value) || 0;
        const harga = parseInt(document.getElementById('harga').value) || 0;

        const kembali = bayar - harga;

        document.getElementById('kembali').value = kembali > 0 ? kembali : 0;
    });
</script>

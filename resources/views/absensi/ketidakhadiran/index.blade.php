@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
       <!--begin::Card title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-white">List Ketidakhadiran Kepala Kamar & Wakil Kepala Kamar</span>
            <span class="text-muted mt-1 fw-semibold fs-6">{{ Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</span>
        </h3>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari" />
            </div>
            <!--begin::Add product-->
            <form method="GET" class="row">
                <div class="col-auto">
                    <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ $tanggal }}"  max="{{ now()->toDateString() }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </form>
            @can('absen-panggilan')
            <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_rekap">
                <i class="ki-duotone ki-plus fs-2"></i>Rekap
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    @include('absensi.rekap.opsiketidakhadiran')
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        @if(isset($message))
        <div class="alert alert-info">{{ $message }}</div>
        @elseif($tidakhadir->isEmpty())
        <div class="alert alert-success">Semua Kepala Kamar dan Wakil sudah absen atau izin.</div>
        @else
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-warning">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Umana'</th>
                    <th>Asrama</th>
                    <th>Daerah</th>
                    <th></th>
                    <th></th>
                    <th>Jabatan</th>
                    <th>Pembinaan</th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Ket.</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($tidakhadir as $item)
                <tr>
                    <td class="d-flex align-items-center ps-4">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->foto == null )
                                <img src="assets/media/avatars/blank.png" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item->foto) }}" alt="{{ $item->foto }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <!--end::Foto-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">{{ $item->nama }}</div>
                            <span>{{ $item->nis }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>{{ $item->asrama->asrama }}
                        <span class="badge badge-lg fs-7 badge-success">{{ $item->asrama->kode }}</span>
                    </td>
                    <td>
                        <div class="badge badge py-3 px-4 fs-7 badge-light-info">{{ $item->asrama->daerah }}</div>
                    </td>
                    <td></td>
                    <td></td>

                    <td>
                        @if ($item->jabatan == 'Kepala Kamar')
                        <div class="badge badge py-3 px-4 fs-7 badge-light-success">{{ $item->jabatan }}</div>
                        @else
                        <div class="badge badge py-3 px-4 fs-7 badge-light-warning">{{ $item->jabatan }}</div>
                        @endif
                    </td>
                    <td>
                        @if($item->pembinaan->isNotEmpty())
                            <span class="badge badge py-3 px-4 fs-7 badge-success">Selesai Pembinaan</span>
                        @else
                            <form action="{{ route('absensi.tandai_pembinaan', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                <button type="submit" class="btn btn-sm btn-light-danger hover-scale">Belum Pembinaan</button>
                            </form>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        @if($item->pembinaan->isNotEmpty())
                        <a class="btn btn-sm btn-icon btn-primary"><i class="ki-outline ki-check-circle fs-2"></i></a>
                        @else
                        <a href="{{ route('panggilan.perhari', ['id' => $item->id, 'tanggal' => $tanggal]) }}" class="btn btn-sm btn-info hover-scale"><i class="ki-outline ki-document fs-3"></i>Panggilan</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
        @endif
    </div>
    <!--end::Card body-->
</div>
<!--end::Products-->


<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/ecommerce/catalog/products.js"></script>
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<!--end::Custom Javascript-->

@endsection

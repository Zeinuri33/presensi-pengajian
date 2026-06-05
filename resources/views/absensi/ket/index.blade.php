@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
        <!--begin::Card title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-white">List Kepala Kamar dan Wakil Kepala Kamar yg Aktif</span>
            <span class="text-muted mt-1 fw-semibold fs-6">pada Pengajian Pengasuh</span>
        </h3>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-3">
            <div class="d-flex align-items-center position-relative">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari Kepala Kamar" />
            </div>
            <!--begin::Add product-->
            <form method="GET" class="row g-2">
                <div class="col-auto">
                    <select name="semester_id" class="form-select form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Pilih Semester">
                        @foreach($semesters as $s)
                            <option value="{{ $s->id }}" {{ $semester->id == $s->id ? 'selected' : '' }}>
                                Semester {{ $s->semester }} - {{ $s->tapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select name="filter" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="hadir" {{ request('filter','hadir') == 'hadir' ? 'selected' : '' }}>Yang Aktif</option>
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </form>

            <a href="{{ route('absensi.ket.cetak') }}" target="_blank" type="button" class="btn btn-sm btn-light-primary">
                <i class="ki-outline ki-file-up fs-2"></i>Cetak
            </a>
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Nama</th>
                    <th>Asrama</th>
                    <th>Daerah</th>
                    <th>Jabatan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($kepalakamar as $item)
                <tr>
                    <td class="d-flex align-items-center ps-2">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->foto == null )
                                <img src="assets/media/avatars/blank.png" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-100" />
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
                    <td><div class="badge badge py-3 px-4 fs-7 badge-light-primary">{{ $item->asrama->daerah }}</div></td>
                    <td>
                        <div class="badge py-3 px-4 fs-7 {{ $item->jabatan == 'Kepala Kamar' ? 'badge-light-success' : 'badge-light-warning' }}">
                            {{ $item->jabatan }}
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end pe-4">
                        @php
                            $hadirAbsens = $item->absens->pluck('tanggal')->toArray();
                            $hadirPembinaan = $item->pembinaan->pluck('tanggal')->toArray();

                            $totalHadir = collect($hadirAbsens)
                                ->merge($hadirPembinaan)
                                ->unique()
                                ->values()
                                ->toArray();
                        @endphp

                        @if (count($totalHadir) === count($dates))
                            <a href="{{ route('absensi.ket.cetak.perkk', $item->id) }}" target="_blank" class="btn btn-sm btn-light-primary me-2 hover-scale">Ket.Aktif</a>
                        @endif
                        <a href="{{ asset('kepalawakilkamar-kehadiran='.$item->id) }}" class="btn btn-sm btn-primary hover-scale">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
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

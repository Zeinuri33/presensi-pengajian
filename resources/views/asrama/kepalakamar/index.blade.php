@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Cari Kepala Kamar" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <form method="GET" action="{{ route('kepalakamar.cetak') }}" target="_blank" class="row">
                {{-- SELECT WILAYAH --}}
                <div class="col-md-4">
                    <select name="wilayah" id="wilayah" class="form-select" >
                        <option value="">Pilih Wilayah</option>
                        <option value="Pusat">Pusat</option>
                        <option value="Cabang">Cabang</option>
                    </select>
                </div>

                {{-- SELECT DAERAH --}}
                <div class="col-md-4">
                    <select name="daerah" id="daerah" class="form-select" >
                        <option value="">Pilih Daerah</option>
                        @foreach ($asrama->pluck('daerah')->unique() as $d)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-danger" type="submit">
                        Cetak PDF
                    </button>
                </div>
            </form>

            <!--begin::Add product-->
            @can('kepala kamar-tambah')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    @include('asrama.kepalakamar.tambah')
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Kepala Kamar</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Asrama</th>
                    <th>Daerah</th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($kepalakamar as $item)
                @if ($item->jabatan == 'Kepala Kamar')
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
                            <div class="text-gray-800 fw-bold mb-1">{{ $item->nama }}
                                @if($item->nokartu == null)
                                @else
                                <i class="ms-1 ki-outline ki-verify fs-4 text-primary"></i>
                                @endif
                            </div>
                            <span>{{ $item->nis }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="text-gray-900 mb-1 fs-6">{{ $item->asrama->kode }}</div>
                        <span class="text-muted fw-semibold text-muted d-block fs-7">Asrama {{ $item->asrama->asrama }}</span>
                    </td>
                    <td>
                        <div class="badge badge py-3 px-4 badge-light-primary fs-7">{{ $item->asrama->daerah }}</div>
                    </td>
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                        </button>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            @can('kepala kamar-detail')
                            <div class="menu-item px-3">
                                <a href="{{ asset('kepalawakilkamar-kehadiran='.$item->id) }}" class="menu-link px-3">Detail</a>
                            </div>
                            @endcan
                            @can('kepala kamar-edit')
                            <div class="menu-item px-3">
                                <a href="{{ asset('kepalawakilkamar='.$item->id) }}" class="menu-link px-3">Edit</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            @can('kepala kamar-hapus')
                            <div class="menu-item px-3">
                                <a href="{{ asset('kepalakamar/'.$item->id.'/hapus') }}" class="delete-button menu-link px-3">Hapus</a>
                            </div>
                            @endcan
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Products-->

<script>
    const wilayah = document.getElementById('wilayah');
    const daerah  = document.getElementById('daerah');

    wilayah.addEventListener('change', function () {
        if (this.value !== '') {
            daerah.value = '';
        }
    });

    daerah.addEventListener('change', function () {
        if (this.value !== '') {
            wilayah.value = '';
        }
    });
</script>



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

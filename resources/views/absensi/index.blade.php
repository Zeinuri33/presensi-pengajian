@extends('layout.sidebar')
@section('konten')

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
        <!--begin::Card title-->
        <h3 class="card-title align-items-start flex-column">
            @if(Route::is('absen.kepala'))
            <span class="card-label fw-bold text-white">Presensi Kepala Kamar</span>
            @elseif(Route::is('absen.wakil'))
            <span class="card-label fw-bold text-white">Presensi Wakil Kepala Kamar</span>
            @endif
            <span class="text-muted mt-1 fw-semibold fs-6">{{ Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</span>
        </h3>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-3">
            <div class="d-flex align-items-center position-relative">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                @if(Route::is('absen.kepala'))
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari Kepala Kamar" />
                @elseif(Route::is('absen.wakil'))
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari Wakil Kepala Kamar" />
                @endif
            </div>
            <!--begin::Add product-->
            <form method="GET" class="row">
                <div class="col-auto">
                    <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ $tanggal }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </form>
            @can('absen-tambah')
            <button type="button" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">
                <i class="ki-duotone ki-plus fs-2"></i>
            </button>
            @endcan
            @can('absen-rekap')
            <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_rekap">
                <i class="ki-outline ki-file-up fs-2"></i>Rekap
            </button>
            @endcan
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    @include('absensi.tambah')
    @include('absensi.rekap.opsikehadiran')
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-primary">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Kepala Kamar</th>
                    <th>Asrama</th>
                    <th>Daerah</th>
                    <th>Jam Absen</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-end min-w-70px pe-4 rounded-end">Opsi</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @if(Route::is('absen.kepala'))
                @foreach ($kepalakamar as $item)
                <tr>
                    <td class="d-flex align-items-center">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->foto == null )
                                <img src="assets/media/avatars/blank.png" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item->kepalakamar->foto) }}" alt="{{ $item->kepalakamar->foto }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <!--end::Foto-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">{{ $item->kepalakamar->nama }}</div>
                            <span>{{ $item->kepalakamar->nis }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>{{ $item->kepalakamar->asrama->asrama }}
                        <span class="badge badge-lg fs-7 badge-success">{{ $item->kepalakamar->asrama->kode }}</span>
                    </td>
                    <td><div class="badge badge py-3 px-4 fs-7 badge-light-primary">{{ $item->kepalakamar->asrama->daerah }}</div></td>
                    <td><div class="badge badge py-3 px-4 fs-7 badge-light-success">{{ Carbon\Carbon::parse($item->jam)->format('H:i') }}</div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end pe-4">
                        <a href="{{ route('absen.hapus', $item->id) }}" class="delete-absen btn btn-sm btn-icon btn-light-danger hover-scale"><i class="ki-outline ki-trash fs-1"></i></a>
                    </td>
                </tr>
                @endforeach
                @elseif(Route::is('absen.wakil'))
                @foreach ($wakilkamar as $item)
                <tr>
                    <td class="d-flex align-items-center">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item->foto == null )
                                <img src="assets/media/avatars/blank.png" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item->kepalakamar->foto) }}" alt="{{ $item->kepalakamar->foto }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <!--end::Foto-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">{{ $item->kepalakamar->nama }}</div>
                            <span>{{ $item->kepalakamar->nis }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>{{ $item->kepalakamar->asrama->asrama }}
                        <span class="badge badge-lg fs-7 badge-success">{{ $item->kepalakamar->asrama->kode }}</span>
                    </td>
                    <td><div class="badge badge py-3 px-4 fs-7 badge-light-primary">{{ $item->kepalakamar->asrama->daerah }}</div></td>
                    <td><div class="badge badge py-3 px-4 fs-7 badge-light-success">{{ Carbon\Carbon::parse($item->jam)->format('H:i') }}</div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-end pe-4">
                        @can('absen-hapus')
                        <a href="{{ route('absen.hapus', $item->id) }}" class="delete-absen btn btn-sm btn-icon btn-light-danger hover-scale"><i class="ki-outline ki-trash fs-1"></i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
                @endif
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-absen').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href'); // Ambil URL dari atribut href
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Presensi akan dihapus, apakah yang bersangkutan benar-benar tidak hadir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger', // Gaya tombol
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL untuk menghapus data
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>

@endsection

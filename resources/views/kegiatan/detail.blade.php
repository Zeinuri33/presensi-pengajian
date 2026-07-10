@extends('layout.sidebar')
@section('konten')


<div class="card mb-5 mb-xxl-8">
	<div class="card-body pt-9 pb-0">
		<!--begin::Details-->
		<div class="d-flex flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="flex-grow-1">
				<!--begin::Title-->
				<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
					<!--begin::User-->
					<div class="d-flex flex-column">
						<!--begin::Name-->
						<div class="d-flex align-items-center mb-2">
							<div class="text-success fs-2 fw-bold me-1">{{ $kegiatan->kegiatan }}</div>
						</div>
						<!--end::Name-->
						<!--begin::Info-->
						<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
							<div class="d-flex align-items-center text-gray-800 me-5 mb-2">
							    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $kegiatan->peserta }} {{ $kegiatan->lingkup }}
                            </div>
							<div class="d-flex align-items-center text-gray-800 me-5 mb-2">
							    <i class="ki-outline ki-geolocation fs-4 me-1"></i>{{ $kegiatan->tempat }}
                            </div>
							<div class="d-flex align-items-center text-gray-800 me-5 mb-2">
							    <i class="ki-outline ki-calendar fs-4 me-1"></i>{{ Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }} - {{ $kegiatan->waktu }}
                            </div>
						</div>
						<!--end::Info-->
					</div>
					<!--end::User-->
                    @can('kegiatan-cetak')
                    <form method="GET" action="{{ route('kegiatan.cetak', $kegiatan->id) }}" class="d-flex flex-wrap align-items-end gap-3 mb-5 w-25" onsubmit="return validateCetakForm(this)">
                        <div class="flex-grow-1">
                            <select name="daerah" class="form-select form-select-sm" data-control="select2" data-hide-search="false" data-placeholder="Pilih Daerah">
                                <option value="">Semua</option>
                                @foreach($daerahList as $daerah)
                                    <option value="{{ $daerah }}" {{ request('daerah') == $daerah ? 'selected' : '' }}>
                                        {{ $daerah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if($kegiatan->peserta === 'Kepala dan Wakil')
                            <div class="flex-grow-1">
                                <select name="jabatan" class="form-select form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jabatan">
                                    <option value="">Semua</option>
                                    @foreach($filterableJabatan as $jabatan)
                                        <option value="{{ $jabatan }}" {{ request('jabatan') == $jabatan ? 'selected' : '' }}>
                                            {{ $jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="jabatan" value="{{ $filterableJabatan[0] }}">
                        @endif

                        <div>
                            <button class="btn btn-light-primary btn-sm" type="submit" target="_blank">
                                <i class="ki-outline ki-printer fs-3"></i> Cetak PDF
                            </button>
                        </div>
                    </form>
                    @endcan


				</div>
				<!--end::Title-->
				<!--begin::Stats-->
				<div class="d-flex flex-wrap flex-stack">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column flex-grow-1 pe-8">
						<!--begin::Stats-->
						<div class="d-flex flex-wrap mb-8">
							<!--begin::Stat-->
							<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Label-->
								<div class="fw-semibold fs-7 text-gray-900">Jumlah Keseluruhan<br>Peserta</div>
								<!--end::Label-->
								<!--begin::Number-->
								<div class="d-flex align-items-center">
									<i class="ki-outline ki-profile-circle fs-3 text-primary me-2"></i>
									<div class="fs-2 fw-bold">{{ $jumlahPeserta }}</div>
								</div>
								<!--end::Number-->
							</div>
							<!--end::Stat-->
							<!--begin::Stat Group-->
                            <div class="d-flex flex-wrap">
                                <!-- Kepala Kamar Hadir -->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-7 text-gray-900">Kepala Kamar<br>Hadir</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-tablet-ok fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold">
                                            {{ $rekapJabatan['Kepala Kamar']['hadir'] ?? 0 }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Kepala Kamar Tidak Hadir -->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-7 text-gray-900">Kepala Kamar<br>Tidak Hadir</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-tablet-delete fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold">
                                            {{ $rekapJabatan['Kepala Kamar']['tidak_hadir'] ?? 0 }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Wakil Kamar Hadir -->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-7 text-gray-900">Wakil Kepala Kamar<br>Hadir</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-tablet-ok fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold">
                                            {{ $rekapJabatan['Wakil Kamar']['hadir'] ?? 0 }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Wakil Kamar Tidak Hadir -->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fw-semibold fs-7 text-gray-900">Wakil Kepala Kamar<br>Tidak Hadir</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-tablet-delete fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold">
                                            {{ $rekapJabatan['Wakil Kamar']['tidak_hadir'] ?? 0 }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Stat Group-->
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Progress-->
					<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
						<div class="d-flex justify-content-between w-100 mt-auto mb-2">
							<span class="fw-semibold fs-6 text-gray-500">Persentase Kehadiran</span>
							<span class="fw-bold fs-6">{{ $persentase }}%</span>
						</div>
						<div class="h-5px mx-3 w-100 bg-light mb-3">
							<div class="bg-success rounded h-5px" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<!--end::Progress-->
				</div>
				<!--end::Stats-->
			</div>
			<!--end::Info-->
		</div>
		<!--end::Details-->

	</div>
</div>

<!--begin::Products-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses1.png') }}'); background-size: cover; background-position: center;">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari" />
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
		<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <form method="GET" action="{{ route('kegiatan.detail', $kegiatan->id) }}" class="d-flex flex-wrap align-items-end gap-3 mb-5">
                <div>
                    <label class="form-label text-white fw-semibold">Daerah:</label>
                    <select name="daerah" class="form-select form-select-sm" data-control="select2" data-hide-search="false" data-placeholder="Pilih Daerah">
                        <option value="">Semua</option>
                        @foreach($daerahList as $daerah)
                            <option value="{{ $daerah }}" {{ request('daerah') == $daerah ? 'selected' : '' }}>{{ $daerah }}</option>
                        @endforeach
                    </select>
                </div>

                @if($kegiatan->peserta === 'Kepala dan Wakil')
                    <div>
                        <label class="form-label text-white fw-semibold">Jabatan:</label>
                        <select name="jabatan" class="form-select form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jabatan">
                            <option value="">Semua</option>
                            @foreach($filterableJabatan as $jabatan)
                                <option value="{{ $jabatan }}" {{ request('jabatan') == $jabatan ? 'selected' : '' }}>
                                    {{ $jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="jabatan" value="{{ $filterableJabatan[0] }}">
                @endif

                <div>
                    <label class="form-label fw-semibold text-white">Status:</label>
                    <select name="status" class="form-select form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Pilih Status">
                        <option value="">Semua</option>
                        <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="Tidak Hadir" {{ request('status') == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-light-success btn-sm" type="submit">
                        <i class="ki-outline ki-filter fs-3 me-1"></i> Filter
                    </button>
                    <a href="{{ route('kegiatan.detail', $kegiatan->id) }}" class="btn btn-success btn-sm">
                        <i class="ki-outline ki-chart fs-3 me-1"></i> Reset
                    </a>
                </div>
            </form>

		</div>
		<!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
            <thead class="fw-bold fs-5 bg-success">
                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px rounded-start ps-4">Nama</th>
                    <th>Jabatan</th>
                    <th>Asrama</th>
                    <th>Daerah</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-end rounded-end pe-4">Keterangan</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                @foreach ($semuaPeserta as $item)
                <tr>
                    <td class="d-flex align-items-center ps-4">
                        <!--begin:: Foto -->
                        <div class="symbol symbol-50px overflow-hidden me-3">
                            <div class="symbol-label">
                                @if($item['foto'] == null )
                                <img src="{{ asset('assets/media/avatars/blank.png') }}" class="w-100" />
                                @else
                                <img src="{{ asset('/storage/kepalakamar/' . $item['foto']) }}" alt="{{ $item['nama'] }}" class="w-100" />
                                @endif
                            </div>
                        </div>
                        <!--end::Foto-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">{{ $item['nama'] }}</div>
                            <span>{{ $item['nis'] }}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>
                        @if ($item['jabatan'] == 'Kepala Kamar')
                        <div class="badge badge py-3 px-4 fs-7 badge-light-primary">Kepala Kamar</div>
                        @elseif ($item['jabatan'] == 'Wakil Kamar')
                        <div class="badge badge py-3 px-4 fs-7 badge-light-success">Wakil Kepala Kamar</div>
                        @endif
                    </td>
                    <td>{{ $item['asrama'] }}
                        <span class="badge badge-lg fs-7 badge-success">{{ $item['kode'] }}</span>
                    </td>
                    <td>
                        <div class="badge badge py-3 px-4 fs-7 badge-light-primary">{{ $item['daerah'] }}</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="pe-4 text-end">
                        @if ($item['status'] == 'Hadir')
                            <div class="badge badge py-3 px-4 fs-7 badge-info">{{ $item['status'] }}</div>
                        @elseif ($item['status'] == 'Tidak Hadir')
                            <div class="badge badge py-3 px-4 fs-7 badge-danger">{{ $item['status'] }}</div>
                        @endif
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
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>

<script>
    function validateCetakForm(form) {
        const daerah = form.querySelector('select[name="daerah"]').value;
        const jabatan = form.querySelector('select[name="jabatan"]')?.value; // aman jika tidak ada

        if (!daerah) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Daerah',
                text: 'Silakan pilih daerah terlebih dahulu sebelum mencetak PDF.',
                confirmButtonText: 'Oke',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
            return false;
        }

        // Validasi jabatan hanya jika elemen jabatan ada (kegiatan->peserta === 'Kepala dan Wakil')
        if (jabatan === '' && form.querySelector('select[name="jabatan"]')) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Jabatan',
                text: 'Silakan pilih jabatan jika peserta adalah Kepala dan Wakil.',
                confirmButtonText: 'Oke',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
            return false;
        }

        return true;
    }
</script>

<!--end::Custom Javascript-->

@endsection

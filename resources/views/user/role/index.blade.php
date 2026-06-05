@extends('layout.sidebar')
@section('konten')
<!--begin::Row-->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
	<!--begin::Col-->
    @foreach ($roles as $item)
	<div class="col-md-4">
		<!--begin::Card-->
		<div class="card card-flush h-md-100">
			<!--begin::Heading-->
			<div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('assets/media/ibrahimy/akses.png" data-bs-theme="light">
				<!--begin::Title-->
				<h3 class="card-title align-items-start flex-column text-white pt-15">
					<span class="fw-bold fs-2x mb-3">{{ $item->name }}</span>
					<div class="fs-4 text-white">
						<to class="opacity-75">Memiliki {{ $item->permissions->count() }} akses sistem</span>
					</div>
				</h3>
			</div>
			<!--end::Heading-->
			<!--begin::Body-->
			<div class="card-body mt-n20">
				<!--begin::Stats-->
				<div class="mt-n20 position-relative">
				    <!--begin::Items-->
				    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-2">
				    	<!--begin::Card body-->
						<div class="card-body">
							<!--begin::Permissions-->
							<div class="d-flex flex-column text-gray-600">
                                @foreach ($item->permissions->take(5) as $permission)
								<div class="d-flex align-items-center py-2">
								<span class="bullet bg-primary me-3"></span>{{ $permission->name }}</div>
                                @endforeach
								<div class='d-flex align-items-center py-2'>
									<span class='bullet bg-primary me-3'></span>
									<em>dan {{ $item->permissions->count() - 5 }} lainnya...</em>
								</div>
							</div>
							<!--end::Permissions-->
						</div>
						<!--end::Card body-->
						<!--begin::Card footer-->
						<div class="card-footer flex-wrap pt-0">
							<a href="{{ asset('hakakses/'.$item->id.'/edit') }}" class="btn btn-light-primary my-1">Edit Role</a>
						</div>
						<!--end::Card footer-->
				    </div>
				    <!--end::Items-->
				</div>
				<!--end::Stats-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Card-->
	</div>
    @endforeach
	<!--end::Col-->
	<!--begin::Add new card-->
	<div class="ol-md-4">
		<!--begin::Card-->
		<div class="card h-md-100">
			<!--begin::Card body-->
			<div class="card-body d-flex flex-center">
				<!--begin::Button-->
				<button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
					<!--begin::Illustration-->
					<img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
					<!--end::Illustration-->
					<!--begin::Label-->
					<div class="fw-bold fs-3 text-gray-600 text-hover-primary">Tambah</div>
					<!--end::Label-->
				</button>
				<!--begin::Button-->
			</div>
			<!--begin::Card body-->
		</div>
		<!--begin::Card-->
	</div>
	<!--begin::Add new card-->
</div>
<!--end::Row-->

@endsection

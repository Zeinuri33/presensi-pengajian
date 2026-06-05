@extends('layout.sidebar')
@section('konten')

<!--begin::Card-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0 text-white">Edit Identitas</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div class="collapse show">
        <!--begin::Form-->
        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" method="POST" enctype="multipart/form-data" action="{{ route('kepalakamar.update', $kepalakamar->id) }}">
            @csrf
            @method('PUT')
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <!--begin::Image placeholder-->
                        <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                        <!--end::Image placeholder-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            @if($kepalakamar->foto == null)
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/blank.png);"></div>
                            @else
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('/storage/kepalakamar/' . $kepalakamar->foto) }});"></div>
                            @endif
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload Foto">
                                <i class="ki-outline ki-pencil fs-7">
                                </i>
                                <!--begin::Inputs-->
                                <input type="file" name="foto" id="foto" value="blank.png" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Foto">
                                <i class="ki-outline ki-cross fs-2">
                                </i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus foto">
                                <i class="ki-outline ki-cross fs-2">
                                </i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">File memiliki format: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">NO. KTS(El-Santri)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nokartu" class="form-control" placeholder="Nomor Kartu Tanda Santri" value="{{ $kepalakamar->nokartu }}" autofocus/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Nomor Induk Santri(NIS)</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nis" class="form-control" placeholder="Nomor Induk Santri(NIS)" value="{{ $kepalakamar->nis }}" maxlength="10" required/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Nama</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Kepala Kamar" value="{{ $kepalakamar->nama }}" required/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Jabatan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select class="form-select" name="jabatan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jabatan">
                            <option value="Kepala Kamar" {{ old('jabatan', $kepalakamar->jabatan) == 'Kepala Kamar' ? 'selected' : '' }}>
                                Kepala Kamar
                            </option>
                            <option value="Wakil Kamar" {{ old('jabatan', $kepalakamar->jabatan) == 'Wakil Kamar' ? 'selected' : '' }}>
                                Wakil Kepala Kamar
                            </option>
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Asrama</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select class="form-select" name="asrama_id" data-control="select2" data-hide-search="false" data-placeholder="Pilih Asrama">
                            <option></option>
                            @foreach ($asrama as $kamar)
                                <option value="{{ $kamar->id }}"
                                    {{ old('asrama_id', $kepalakamar->asrama_id) == $kamar->id ? 'selected' : '' }}>
                                    {{ $kamar->asrama . '-' . $kamar->kode }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
            @php
                $previousUrl = url()->previous();
                $breadcrumbUrl = '/kepalakamar';
                $breadcrumbLabel = 'Kepala Kamar';

                if (Str::contains($previousUrl, '/wakilkamar')) {
                    $breadcrumbUrl = '/wakilkamar';
                    $breadcrumbLabel = 'Wakil Kepala Kamar';
                }
            @endphp
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ $breadcrumbUrl }}" class="btn btn-light-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            <!--end::Actions-->
        <input type="hidden"></form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Card-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>


@endsection



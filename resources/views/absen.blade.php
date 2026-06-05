<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
<base href="../../../" />
		<title>PENGAJIAN - Subbag. Asrama Putra PP. Salafiyah Syafi'iyah Sukorejo</title>
		<meta charset="utf-8" />
		<meta name="description" content="Subbag. Asrama Putra PP. Salafiyah Syafi'iyah Sukorejo" />
		<meta name="keywords" content="Subbag. Asrama Putra PP. Salafiyah Syafi'iyah Sukorejo" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Subbag. Asrama Putra PP. Salafiyah Syafi'iyah Sukorejo" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="http://preview.keenthemes.comdashboards/projects.html" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/logo.png') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
							<form class="form w-100" method="POST" novalidate="novalidate" action="{{ route('absen.store') }}">
								@csrf
                                <!--begin::Heading-->
								<div class="text-center mb-11">
                                    <img alt="Logo" src="assets/media/logos/logo-p2s3.png" class="h-60px mb-7" />
									<!--begin::Title-->
									<h1 class="text-gray-900 fw-bolder mb-3">Presensi Kehadiran<br>Pengajian Pengasuh</h1>
									<!--end::Title-->
									<!--begin::Subtitle-->
									<div class="text-gray-500 fw-semibold fs-6">Tempelkan KTS ke scanner untuk absen!</div>
									<!--end::Subtitle=-->
								</div>
								<!--begin::Heading-->
								<!--begin::Separator-->
								<div class="separator separator-content my-14">
									<span class="w-125px text-gray-500 fw-semibold fs-7">Form Absen </span>
								</div>
								<!--end::Separator-->
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
									<input type="password" placeholder="Nomor Absen" name="nokartu" class="form-control bg-transparent" autofocus/>
									<!--end::Email-->
								</div>
								<!--begin::Submit button-->
								<div class="d-grid mb-4">
									<button type="submit" class="btn btn-primary">Absen</button>
								</div>
								<!--end::Submit button-->
							</form>
                            @php
                                $today = Carbon\Carbon::today();
                                $liburs = App\Models\Harilibur::whereDate('mulai', '<=', $today)
                                            ->whereDate('sampai', '>=', $today)
                                            ->orderBy('mulai')
                                            ->get();
                            @endphp

                            @if($liburs->count())
                                @foreach($liburs as $libur)
                                <div class="alert alert-info d-flex align-items-center p-5">
                                    <!--begin::Icon-->
                                    <i class="ki-outline ki-information-4 fs-2hx text-info me-4"></i>
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <h4 class="mb-1 text-dark">
                                            Libur
                                            @if($libur->keterangan)
                                                — <em>{{ $libur->keterangan }}</em>
                                            @endif
                                        </h4>
                                        <!--end::Title-->
                                        <!--begin::Content-->
                                        <span>
                                            {{ \Carbon\Carbon::parse($libur->mulai)->translatedFormat('l, d F Y') }}
                                            @if($libur->mulai !== $libur->sampai)
                                                s.d. {{ \Carbon\Carbon::parse($libur->sampai)->translatedFormat('l, d F Y') }}
                                            @endif
                                        </span>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                @endforeach
                            @endif

                            <!--end::Alert-->
                            <div class="d-flex flex-stack">
                                <div class="me-10">
                                    <span data-kt-element="current-lang-name" class="me-1">@Zeinuri - 2025</span>
                                </div>
                            </div>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Body-->
				<!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 position-relative" style="background-image: url(assets/media/ibrahimy/akses.png)">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        @php
                            $hari = Carbon\Carbon::now()->isoFormat('dddd,  D MMMM Y');
                        @endphp
                        <!--begin::Title-->
                        <h2 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-4">
                            <div class="badge badge-light py-3 px-4 fs-3 mb-3">
                                <label id="clock">Memuat...</label>
                            </div><br>
							<label>{{ $hari }}</label>
                        </h2>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="d-none d-lg-block text-white fs-base text-center mb-5">
                            Kehadiran <span class="text-warning fw-bold">5 Kepala Kamar dan Wakil Kepala Kamar</span><br>terakhir ditampilkan di sini.
                        </div>
                        <!--end::Text-->
                        @foreach ($latestAbsens as $absen)
                        <div class="card mb-3" style="width: 320px;">
                            <!--begin::Body-->
                            <div class="card-body p-4">
                                <!--begin::User-->
                                <div class="d-flex align-items-center flex-grow-1">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-45px me-5">
                                        @if ($absen->kepalakamar->foto == null)
                                        <img src="assets/media/avatars/blank.png" alt="{{ $absen->kepalakamar->foto }}" class="w-100" />
                                        @else
                                        <img src="{{ asset('/storage/kepalakamar/' . $absen->kepalakamar->foto) }}" alt="">
                                        @endif
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <div class="text-gray-900 fs-6 fw-bold">Ust.{{ $absen->kepalakamar->nama }}</div>
                                        <span class="text-gray-500 fw-bold">{{ $absen->kepalakamar->jabatan }} {{ $absen->kepalakamar->asrama->asrama  ?? 'Tidak Berasrama' }}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Body-->
						</div>
                        @endforeach
                    </div>

                    <!-- ✅ Fixed Position Image in Bottom Right -->
                    <img class="d-none d-lg-block position-absolute" style="right: 0px; bottom: 0px; width: 240px;" src="assets/media/ibrahimy/wisma.png" alt="" />
                    <!--end::Image-->
                    <!--end::Content-->
                </div>
                <!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
        <script>
            function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const time = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = time;
            }
            // Update the clock every second
            setInterval(updateClock, 1000);
            // Initialize clock on page load
            updateClock();
        </script>


        @if (session('success'))
        <script>
            Swal.fire({
            title: 'Alhamdulillah!',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });
        </script>
        @endif
        @if (session('error'))
        <script>
            Swal.fire({
                title: 'Astaghfirullah!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        </script>
        @endif

		<!--end::Custom Javascript-->

		<!--end::Javascript-->

	</body>
	<!--end::Body-->
</html>

<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
        <base href="../../../" />
		<title>Verifikasi identitas Kepala atau Wakil Kepala Kamar - Kepesatrenan P2S3</title>
		<meta charset="utf-8" />
		<meta name="description" content="Aplikasi Laporan Harian Santri Pondok Pesantren Salafiyah Syafi'iyah Sukorejo Situbondo" />
		<meta name="keywords" content="Aplikasi Laporan Harian Santri Pondok Pesantren Salafiyah Syafi'iyah Sukorejo Situbondo" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Aplikasi Pengajian PP. Salafiyah Syafi'iyah Sukorejo/>
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/fancy/sign-in.html" />
		<link rel="shortcut icon" href="assets/media/logos/logo.png" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--end::Logo-->
				<!--begin::Root-->
                <div class="d-flex flex-column flex-root min-vh-100 bgi-no-repeat" style="background-image: url(assets/media/ibrahimy/menara.png); background-size: 35%; background-position: right bottom; ">
                    {{-- ================= DISPLAY NOKARTU ================= --}}
                    {{-- <div class="text-center mb-4">
                        <div class="fs-6 text-muted">No Kartu</div>
                        <div id="display-nokartu"
                            class="fs-2 fw-bold text-primary">
                            —————
                        </div>
                    </div> --}}
                    <!-- ===== LIVE JAM & SHIFT ===== -->
                    <div class="text-center mb-6">
                        <div class="fs-2 fw-bold text-gray-900" id="live-jam">00:00:00</div>
                        <div class="fs-5 fw-semibold">
                            Shift Aktif :
                            <span id="live-shift" class="badge badge-light-secondary">Di luar jam</span>
                        </div>
                    </div>

                    @php
                        $kepalakamar = session('kepalakamar');
                    @endphp
                    {{-- ================= FORM TERSEMBUNYI ================= --}}
                    <form method="POST"
                        action="{{ route('postel.verifikasi.cari') }}"
                        id="form-verifikasi"
                        class="d-none">
                        @csrf
                        <input type="text" name="nokartu" id="nokartu" autocomplete="off">
                    </form>

                    <!--begin::Aside-->
                    <div class="d-flex flex-column flex-column-fluid flex-center w-100">
                        <!--begin::Wrapper-->
                        <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px p-10">
                            <!--begin::Header-->
                            <div class="d-flex flex-stack py-2">
                                <div class="me-2"></div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="py-20">
                                <div class="card-body">
                                    <!--begin::Logo-->
                                    <div class="mb-7 text-center">
                                        <img alt="Logo" src="assets/media/logos/logo-p2s3.png" class="theme-light-show h-55px mb-3" />
                                        <img alt="Logo" src="assets/media/logos/logo-p2s3.png" class="theme-dark-show h-55px mb-3" />
                                    </div>

                                    <!--end::Logo-->
                                    @if ($kepalakamar)
                                    <div class="text-center mb-10">
                                        <img src="{{ optional($kepalakamar)->foto     ? asset('storage/kepalakamar/' . $kepalakamar->foto)     : asset('assets/media/avatars/blank.png') }}" class="rounded-circle mb-3" width="140" height="140" style="object-fit: cover;">
                                        <div class="text-gray-900 fw-bold fs-1">{{ $kepalakamar->nama }}</div>
                                        <div class="text-muted fs-4 mb-5">{{ $kepalakamar->nis }}</div>
                                        <!--begin::Info Boxes-->
                                        <div class="d-flex justify-content-center mb-5">

                                            <!--begin::Jabatan-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-4 me-7 text-center"
                                                style="width: 500px;">
                                                <div class="fs-6 text-gray-800 fw-bold">Jabatan</div>
                                                <div class="fw-semibold text-gray-700">
                                                    {{ $kepalakamar->jabatan === 'Wakil Kamar' ? 'Wakil Kepala Kamar' : $kepalakamar->jabatan }}
                                                </div>
                                            </div>
                                            <!--end::Jabatan-->

                                            <!--begin::Asrama-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-4 text-center"
                                                style="width: 500px;">
                                                <div class="fs-6 text-gray-800 fw-bold">Asrama</div>
                                                <div class="fw-semibold text-gray-700">
                                                    {{ $kepalakamar->asrama->asrama }} - {{ $kepalakamar->asrama->kode }}
                                                </div>
                                            </div>
                                            <!--end::Asrama-->

                                        </div>
                                        <!--end::Info Boxes-->
                                        @include('postel.transaksi.tambah')
                                    </div>
                                    @else

                                    <!--begin::Heading-->
                                    <div class="text-center mb-10">
                                        <h1 class="text-gray-900 mb-3 fs-1">Verifikasi <br> Kepala & Wakil Kepala Kamar</h1>
                                        <div class="text-gray-500 fw-semibold fs-6">
                                            Tempelkan KTS/El-Santri ke scanner untuk memverifikasi identitas kepala kamar atau wakil kepala kamar P2S3.
                                        </div>
                                    </div>
                                    <!--end::Heading-->
                                    @endif
                                </div>
                               <div class="text-center">
                                    @if($kepalakamar)
                                    <button type="button" class="btn btn-warning me-2" style="min-width:110px" data-bs-toggle="modal" data-bs-target="#kt_modal_transaksi">Transaksi</button>
                                    @endif
                                    <a href="/" class="btn btn-primary" style="min-width:110px">Kembali</a>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="m-0 text-center">@Zeinuri - 2025</div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Aside-->

                </div>
                <!--end::Root-->
				<!--begin::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
	</body>
	<!--end::Body-->
</html>

<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

@if (session('success'))
<script>
    Swal.fire({
        title: 'Alhamdulillah!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
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
{{-- ================= JS SCANNER HANDLER ================= --}}
<script>
    let buffer = '';
    let timer  = null;
    const display = document.getElementById('display-nokartu');

    document.addEventListener('keydown', function (e) {
        if (e.key.length > 1 && e.key !== 'Enter') return;

        if (e.key === 'Enter') {
            submitNokartu();
            return;
        }

        buffer += e.key;
        display.textContent = buffer;

        clearTimeout(timer);
        timer = setTimeout(() => {
            buffer = '';
            display.textContent = '—————';
        }, 500);
    });

    function submitNokartu() {
        if (!buffer) return;

        document.getElementById('nokartu').value = buffer;
        document.getElementById('form-verifikasi').submit();

        buffer = '';
        display.textContent = '—————';
    }

    window.onload = () => document.body.focus();
</script>

<script>
    function updateJamDanShift() {
        const now = new Date();

        const jam = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        const hari = now.getDay(); // 0=Ahad, 5=Jumat
        const waktu = now.getHours() * 60 + now.getMinutes();

        let shift = 'Di luar jam';
        let badge = 'badge-light-secondary';

        const isBetween = (start, end) => waktu >= start && waktu <= end;

        // ================= PAGI =================
        if (hari === 5) {
            // Jumat (khusus pagi)
            if (isBetween(7 * 60, 10 * 60 + 30)) {
                shift = 'Pagi';
                badge = 'badge-light-success';
            }
        } else {
            // Hari selain Jumat
            if (
                isBetween(5 * 60 + 30, 7 * 60 + 30) ||
                isBetween(10 * 60, 12 * 60)
            ) {
                shift = 'Pagi';
                badge = 'badge-light-success';
            }
        }

        // ================= SIANG (SEMUA HARI) =================
        if (
            isBetween(12 * 60 + 45, 14 * 60 + 30) ||
            isBetween(15 * 60 + 30, 17 * 60 + 30)
        ) {
            shift = 'Siang';
            badge = 'badge-light-warning';
        }

        // ================= MALAM (SEMUA HARI) =================
        if (isBetween(20 * 60 + 30, 23 * 60 + 30)) {
            shift = 'Malam';
            badge = 'badge-light-primary';
        }

        document.getElementById('live-jam').innerText = jam;
        document.getElementById('live-shift').innerText = shift;
        document.getElementById('live-shift').className = `badge ${badge}`;
    }

    setInterval(updateJamDanShift, 1000);
    updateJamDanShift();
</script>


<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
<base href="../" />
		<title>Subbag. Asrama Putra PP. Salafiyah Syafi'iyah Sukorejo</title>
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
	<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
					<!--begin::Header container-->
					<div class="app-container container-fluid d-flex flex-stack" id="kt_app_header_container">
						<!--begin::Header logo-->
						<div class="d-flex d-lg-none align-items-center me-lg-20 gap-1 gap-lg-2">
							<!--begin::Mobile toggle-->
							<div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px d-flex d-lg-none" id="kt_app_sidebar_toggle">
								<i class="ki-outline ki-abstract-14 lh-0 fs-1"></i>
							</div>
							<!--end::Mobile toggle-->
							<!--begin::Logo image-->
							<a href="/">
								<img alt="Logo" src="{{ asset('assets/media/logos/logo-p2s3.png') }}" class="h-25px theme-light-show" />
								<img alt="Logo" src="{{ asset('assets/media/logos/logo-p2s3.png') }}" class="h-25px theme-dark-show" />
							</a>
							<!--end::Logo image-->
						</div>
						<!--end::Header logo-->
						<!--begin::Header wrapper-->
						<div class="d-flex flex-stack flex-lg-row-fluid" id="kt_app_header_wrapper">
							<!--begin::Page title-->
							<div class="app-page-title d-flex flex-column gap-1 me-3 mb-5 mb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}">
								<!--begin::Title-->
                                @include('layout.breadcrumb')
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title-->
							<!--begin::Navbar-->
							<div class="app-navbar flex-shrink-0 gap-2 gap-lg-4">
                                <!--begin::Menu wrapper-->
                                    @php
                                        $hari = Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y');
                                    @endphp
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">
										<span class="bullet bullet-dot bg-primary h-6px w-6px animation-blink me-2"></span>
										<label class="">{{ $hari }} - </label>
                                        <label id="clock" class="ms-1">Memuat...</label>
                                    </span>
								<!--end::Menu wrapper-->
                                <div class="app-navbar-item">
                                    <!--begin::Menu toggle-->
									<a href="#" class="btn btn-icon rounded-circle w-35px h-35px bg-light-primary border border-primary-clarity" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<i class="ki-outline ki-night-day theme-light-show text-primary fs-1"></i>
										<i class="ki-outline ki-moon theme-dark-show text-primary fs-1"></i>
									</a>
                                    <!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-outline ki-night-day fs-2"></i>
												</span>
												<span class="menu-title">Terang</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-outline ki-moon fs-2"></i>
												</span>
												<span class="menu-title">Gelap</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-outline ki-screen fs-2"></i>
												</span>
												<span class="menu-title">Sistem</span>
											</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
									<!--begin::Menu toggle-->
								</div>
								<!--begin::User menu-->
								<div class="app-navbar-item ms-lg-5" id="kt_header_user_menu_toggle">
									<!--begin::Menu wrapper-->
									<div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<!--begin:Info-->
										<div class="text-end d-none d-sm-flex flex-column justify-content-center me-3">
											<span class="text-gray-500 fs-8 fw-bold">Ahlan Wa Sahlan</span>
											<div class="text-gray-800 text-hover-primary fs-7 fw-bold d-block">{{ auth()->user()->name }}</div>
										</div>
										<!--end:Info-->
										<!--begin::User-->
										<div class="cursor-pointer symbol symbol symbol-circle symbol-35px symbol-md-40px">
                                            @if (auth()->user()->avatar == null)
											<img class="" src="{{ asset('assets/media/avatars/blank.png') }}" alt="user" />
                                            @else
											<img class="" src="{{ asset('/storage/avatars/' . auth()->user()->avatar) }}" alt="user" />
                                            @endif
											<div class="position-absolute translate-middle bottom-0 mb-1 start-100 ms-n1 bg-success rounded-circle h-8px w-8px"></div>
										</div>
										<!--end::User-->
									</div>
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													@if (auth()->user()->avatar == null)
                                                    <img class="" src="{{ asset('assets/media/avatars/blank.png') }}" alt="user" />
                                                    @else
                                                    <img class="" src="{{ asset('/storage/avatars/' . auth()->user()->avatar) }}" alt="user" />
                                                    @endif
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}
													<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Aktif</span></div>
													<a class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->jabatan }}</a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="/logout" class="menu-link px-5">Keluar</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::User menu-->
								<!--begin::Sidebar menu toggle-->
								<!--end::Sidebar menu toggle-->
							</div>
							<!--end::Navbar-->
						</div>
						<!--end::Header wrapper-->
					</div>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
						<!--begin::Header-->
						<div class="d-none d-lg-flex flex-center px-6 pt-10 pb-10" id="kt_app_sidebar_header">
							<a href="/">
								<img alt="Logo" src="{{ asset('assets/media/logos/logo-p2s3.png') }}" class="h-40px" />
							</a>
						</div>
						<!--end::Header-->
						<div class="flex-grow-1">
							<div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-y" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer" data-kt-scroll-offset="20px">
								<div class="app-sidebar-navs-default px-5 mb-10">
									<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="menu menu-column menu-rounded menu-sub-indention">
                                        <!--end::Menu Item-->

										<div class="separator mb-4 mx-4"></div>
                                        <!--begin::Menu Item-->
										<div class="menu-item">
											<!--begin::Menu link-->
											<a class="menu-link {{ request()->is('/') ? 'active' : ''}}" href="/">
												<span class="menu-icon">
                                                    <i class="ki-outline ki-home fs-2"></i>
                                                </span>
												<!--begin::Title-->
												<span class="menu-title">Beranda</span>
												<!--end::Title-->
											</a>
											<!--end::Menu link-->
										</div>
                                        <!--end::Menu Item-->
                                        <div class="menu-item pb-0 pt-0">
											<div class="menu-content">
												<span class="menu-heading">Aplikasi</span>
											</div>
										</div>
                                        @php
                                            $user = Auth::user();
                                        @endphp
                                        <!--begin:Menu item-->
                                        @if($user->can('absen-lihat') || $user->can('izin-lihat') || $user->can('libur-lihat') || $user->can('absen-tidak hadir') || $user->can('absen-pembinaan') || $user->can('absen-ket'))
                                        @if(request()->is('presensi-kepalakamar') || request()->is('presensi-wakilkamar') || request()->is('presensi-tidakhadir') || request()->is('presensi-pembinaan') || request()->is('presensi-ket'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(request()->is('izin'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(request()->is('libur'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @else
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        @endif
											<!--begin:Menu link-->
											<span class="menu-link">
                                                <!--begin::Bullet-->
												<span class="menu-icon">
                                                    <i class="ki-outline ki-book-open fs-2"></i>
                                                </span>
												<!--end::Bullet-->
												<span class="menu-title">Pengajian</span>
												<span class="menu-arrow"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-accordion">
												<!--begin:Menu item-->
                                                @can('absen-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('presensi-kepalakamar') ? 'active' : ''}}" href="/presensi-kepalakamar">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Kepala Kamar</span>
													</a>
													<!--end:Menu link-->
												</div>
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('presensi-wakilkamar') ? 'active' : ''}}" href="/presensi-wakilkamar">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Wakil Kepala Kamar</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
                                                @can('izin-lihat')
                                                <div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('izin') ? 'active' : ''}}" href="/izin">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Izin</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
                                                @can('libur-lihat')
                                                <div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('libur') ? 'active' : ''}}" href="/libur">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Libur</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
                                                @can('absen-tidak hadir')
                                                <div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('presensi-tidakhadir') ? 'active' : ''}}" href="/presensi-tidakhadir">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Ketidakhadiran</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
                                                @can('absen-pembinaan')
                                                <div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('presensi-pembinaan') ? 'active' : ''}}" href="/presensi-pembinaan">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Pembinaan</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
                                                @can('absen-ket')
                                                <div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('presensi-ket') ? 'active' : ''}}" href="/presensi-ket">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Ket. Aktif</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
											</div>
											<!--end:Menu sub-->
										</div>
										<!--end:Menu item-->
                                        @endif
                                        <!--begin::Menu Item-->
                                        @can('kegiatan-lihat')
										<div class="menu-item">
											<!--begin::Menu link-->
											<a class="menu-link {{ request()->is('kegiatan') || request()->is('kegiatan/*') ? 'active' : ''}}" href="/kegiatan">
												<span class="menu-icon">
                                                    <i class="ki-outline ki-calendar-8 fs-2"></i>
                                                </span>
												<!--begin::Title-->
												<span class="menu-title">Kegiatan</span>
												<!--end::Title-->
											</a>
											<!--end::Menu link-->
										</div>
										@endcan
                                        @can('khidmah-lihat')
										<div class="menu-item">
											<!--begin::Menu link-->
											<a class="menu-link {{ request()->is('khidmah') ? 'active' : ''}}" href="/khidmah">
												<span class="menu-icon">
                                                    <i class="ki-outline ki-burger-menu fs-2"></i>
                                                </span>
												<!--begin::Title-->
												<span class="menu-title">Khidmah</span>
												<!--end::Title-->
											</a>
											<!--end::Menu link-->
										</div>
										@endcan
                                        <!--end::Menu Item-->
                                        <!--begin:Menu item-->
                                        @if($user->can('surat masuk-lihat') || $user->can('surat keluar-lihat'))
                                        @if(request()->is('suratmasuk') || request()->is('suratkeluar'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @else
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        @endif
											<!--begin:Menu link-->
											<span class="menu-link">
                                                <span class="menu-icon">
                                                    <i class="ki-outline ki-folder-added fs-2"></i>
                                                </span>
												<span class="menu-title">Arsip</span>
												<span class="menu-arrow"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-accordion">
												<!--begin:Menu item-->
                                                @can('surat masuk-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('suratmasuk') ? 'active' : ''}}" href="/suratmasuk">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Surat Masuk</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
                                                @can('surat keluar-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('suratkeluar') ? 'active' : ''}}" href="/suratkeluar">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Surat Keluar</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
											</div>
											<!--end:Menu sub-->
										</div>
                                        <!--end::Menu Item-->
                                        @endif
                                        <!--begin:Menu item-->
                                        <!--begin:Menu item-->
                                        @if(
                                            $user->can('kepala kamar-verifikasi') ||
                                            $user->can('transaksi poste-lihat')
                                        )
                                        @if(
                                            request()->is('kepalawakilkamar-verifikasi') ||
                                            request()->is('postel-transaksi') 
                                        )
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @else
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        @endif
											<!--begin:Menu link-->
											<span class="menu-link">
                                                <span class="menu-icon">
                                                    <i class="ki-outline ki-call fs-2"></i>
                                                </span>
												<span class="menu-title">Wartel</span>
												<span class="menu-arrow"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-accordion">
												<!--begin:Menu item-->
                                                @can('kepala kamar-verifikasi')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('kepalawakilkamar-verifikasi') ? 'active' : ''}}" href="/kepalawakilkamar-verifikasi">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Verifikasi</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
                                                @can('transaksi postel-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('postel-transaksi') ? 'active' : ''}}" href="/postel-transaksi">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Transaksi</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
											</div>
											<!--end:Menu sub-->
										</div>
                                        <!--end::Menu Item-->
                                        @endif
                                        <div class="menu-item pb-0 pt-0">
											<div class="menu-content">
												<span class="menu-heading">Data</span>
											</div>
										</div>
										<div class="separator mb-4 mx-4"></div>
                                        <!--begin:Menu item-->
                                        @if($user->can('ketua kamar-lihat') || $user->can('wakil kamar-lihat') || $user->can('asrama-lihat'))
                                        @if(request()->is('asrama'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(request()->is('kepalakamar') || request()->is('kepalawakilkamar=*') || request()->is('kepalawakilkamar-kehadiran=*'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(request()->is('wakilkamar'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @else
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        @endif
											<!--begin:Menu link-->
											<span class="menu-link">
                                                <span class="menu-icon">
                                                    <i class="ki-outline ki-bank fs-2"></i>
                                                </span>
												<span class="menu-title">Asrama</span>
												<span class="menu-arrow"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-accordion">
												<!--begin:Menu item-->
                                                @can('asrama-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('asrama') ? 'active' : ''}}" href="/asrama">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Asrama</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
												<!--begin:Menu item-->
                                                @can('kepala kamar-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('kepalakamar') ? 'active' : ''}}" href="/kepalakamar">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Kepala Kamar</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
												<!--begin:Menu item-->
                                                @can('wakil kamar-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('wakilkamar') ? 'active' : ''}}" href="/wakilkamar">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Wakil Kepala Kamar</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
											</div>
											<!--end:Menu sub-->
										</div>
										<!--end:Menu item-->
                                        @endif
										@can('semester-lihat')
										<div class="menu-item">
											<!--begin::Menu link-->
											<a class="menu-link {{ request()->is('semester') ? 'active' : ''}}" href="/semester">
												<span class="menu-icon">
                                                    <i class="ki-outline ki-calendar fs-2"></i>
                                                </span>
												<!--begin::Title-->
												<span class="menu-title">Semester</span>
												<!--end::Title-->
											</a>
											<!--end::Menu link-->
										</div>
										@endcan
										<!--begin:Menu item-->
                                        @if($user->can('pengguna-lihat') || $user->can('peran-lihat') || $user->can('akses-lihat'))
                                        @if(request()->is('pengguna'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(Route::is('pengguna.detail'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(request()->is('hakakses'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @elseif(request()->is('hakakses/*'))
										<div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                                        @else
										<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                        @endif
											<!--begin:Menu link-->
											<span class="menu-link">
                                                <span class="menu-icon">
                                                    <i class="ki-outline ki-profile-circle fs-2"></i>
                                                </span>
												<span class="menu-title">Pengguna</span>
												<span class="menu-arrow"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-accordion">
												<!--begin:Menu item-->
                                                @can('pengguna-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('pengguna') || Route::is('pengguna.detail') ? 'active' : ''}}" href="/pengguna">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Pengguna</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
												<!--begin:Menu item-->
                                                @can('hak akses-lihat')
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link {{ request()->is('hakakses') || request()->is('hakakses/*') ? 'active' : ''}}" href="/hakakses">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span class="menu-title">Hak Akses</span>
													</a>
													<!--end:Menu link-->
												</div>
                                                @endcan
												<!--end:Menu item-->
											</div>
											<!--end:Menu sub-->
										</div>
										<!--end:Menu item-->
                                        @endif
									</div>
								</div>
							</div>
						</div>
						{{-- <!--begin::Footer-->
						<div class="d-flex flex-stack px-10 px-lg-15 pb-8" id="kt_app_sidebar_footer">
							<span class="d-flex flex-center gap-1 text-white theme-light-show fs-5 px-0">
							<i class="ki-outline ki-night-day text-gray-500 fs-2"></i>Dark Mode</span>
							<span class="d-flex flex-center gap-1 text-white theme-dark-show fs-5 px-0">
							<i class="ki-outline ki-moon text-gray-500 fs-2"></i>Light Mode</span>
							<div data-bs-theme="dark">
								<div class="form-check form-switch form-check-custom form-check-solid">
									<input class="form-check-input h-25px w-45px" type="checkbox" value="1" id="kt_sidebar_theme_mode_toggle" />
								</div>
							</div>
						</div>
						<!--end::Footer--> --}}
					</div>
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
									<!--begin::Row-->
                                    @yield('konten')
									<!--end::Row-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						<div id="kt_app_footer" class="app-footer">
							<!--begin::Footer container-->
							<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-gray-900 order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2025&copy;</span>
									<div class="text-gray-800">Zeinuri</div>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->
								<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
									<div class="text-gray-800">IT Support Perpustakaan Ibrahimy</div>
								</ul>
								<!--end::Menu-->
							</div>
							<!--end::Footer container-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>

		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>

<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>


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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-button').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href'); // Ambil URL dari atribut href
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus dan tidak dapat dikembalikan!",
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
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

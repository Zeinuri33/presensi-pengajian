@extends('layout.sidebar')
@section('konten')

<div class="card card-flush mb-5 mb-lg-10">
										<!--begin::Header-->
										<div class="card-header py-5">
											<!--begin::Title-->
											<h3 class="card-title fw-bold text-gray-800">Monthly Targets</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
												<div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">
													<!--begin::Display range-->
													<div class="text-gray-600 fw-bold">23 Dec 2025 - 21 Jan 2026</div>
													<!--end::Display range-->
													<i class="ki-outline ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0"></i>
												</div>
												<!--end::Daterangepicker-->
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Card body-->
										<div class="card-body d-flex justify-content-between flex-column pb-0 px-0 pt-1">
											<!--begin::Items-->
											<div class="d-flex flex-wrap d-grid gap-5 px-9 mb-5">
												<!--begin::Item-->
												<div class="me-md-2">
													<!--begin::Statistics-->
													<div class="d-flex mb-2">
														<span class="fs-4 fw-semibold text-gray-500 me-1">$</span>
														<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">12,706</span>
													</div>
													<!--end::Statistics-->
													<!--begin::Description-->
													<span class="fs-6 fw-semibold text-gray-500">Targets for April</span>
													<!--end::Description-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="border-start-dashed border-end-dashed border-start border-end border-gray-300 px-5 ps-md-10 pe-md-7 me-md-5">
													<!--begin::Statistics-->
													<div class="d-flex mb-2">
														<span class="fs-4 fw-semibold text-gray-500 me-1">$</span>
														<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">8,035</span>
													</div>
													<!--end::Statistics-->
													<!--begin::Description-->
													<span class="fs-6 fw-semibold text-gray-500">Actual for April</span>
													<!--end::Description-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="m-0">
													<!--begin::Statistics-->
													<div class="d-flex align-items-center mb-2">
														<!--begin::Currency-->
														<span class="fs-4 fw-semibold text-gray-500 align-self-start me-1">$</span>
														<!--end::Currency-->
														<!--begin::Value-->
														<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">4,684</span>
														<!--end::Value-->
														<!--begin::Label-->
														<span class="badge badge-light-success fs-base">
														<i class="ki-outline ki-black-up fs-7 text-success ms-n1"></i>4.5%</span>
														<!--end::Label-->
													</div>
													<!--end::Statistics-->
													<!--begin::Description-->
													<span class="fs-6 fw-semibold text-gray-500">GAP</span>
													<!--end::Description-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Items-->
											<!--begin::Chart-->
											<div id="kt_charts_widget_20" class="min-h-auto ps-4 pe-6" data-kt-chart-info="Sales" style="height: 300px; min-height: 315px;"><div id="apexchartsykq6treh" class="apexcharts-canvas apexchartsykq6treh apexcharts-theme-" style="width: 425.5px; height: 300px;"><svg id="SvgjsSvg1193" width="425.5" height="300" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)"><foreignObject x="0" y="0" width="425.5" height="300"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 150px;"></div><style type="text/css">
      .apexcharts-flip-y {
        transform: scaleY(-1) translateY(-100%);
        transform-origin: top;
        transform-box: fill-box;
      }
      .apexcharts-flip-x {
        transform: scaleX(-1);
        transform-origin: center;
        transform-box: fill-box;
      }
      .apexcharts-legend {
        display: flex;
        overflow: auto;
        padding: 0 10px;
      }
      .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
        flex-wrap: wrap
      }
      .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
        flex-direction: column;
        bottom: 0;
      }
      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
        justify-content: flex-start;
      }
      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
        justify-content: center;
      }
      .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
        justify-content: flex-end;
      }
      .apexcharts-legend-series {
        cursor: pointer;
        line-height: normal;
        display: flex;
        align-items: center;
      }
      .apexcharts-legend-text {
        position: relative;
        font-size: 14px;
      }
      .apexcharts-legend-text *, .apexcharts-legend-marker * {
        pointer-events: none;
      }
      .apexcharts-legend-marker {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-right: 1px;
      }

      .apexcharts-legend-series.apexcharts-no-click {
        cursor: auto;
      }
      .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
        display: none !important;
      }
      .apexcharts-inactive-legend {
        opacity: 0.45;
      }</style></foreignObject><g id="SvgjsG1202" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><g id="SvgjsG1203" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g><rect id="SvgjsRect1227" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1290" class="apexcharts-yaxis" rel="0" transform="translate(26.96875, 0)"><g id="SvgjsG1291" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1293" font-family="inherit" x="20" y="34" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1294">$363</tspan><title>$363</title></text><text id="SvgjsText1296" font-family="inherit" x="20" y="70.97" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1297">$357</tspan><title>$357</title></text><text id="SvgjsText1299" font-family="inherit" x="20" y="107.94" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1300">$352</tspan><title>$352</title></text><text id="SvgjsText1302" font-family="inherit" x="20" y="144.91" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1303">$346</tspan><title>$346</title></text><text id="SvgjsText1305" font-family="inherit" x="20" y="181.88" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1306">$341</tspan><title>$341</title></text><text id="SvgjsText1308" font-family="inherit" x="20" y="218.85" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1309">$335</tspan><title>$335</title></text><text id="SvgjsText1311" font-family="inherit" x="20" y="255.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-yaxis-label " style="font-family: inherit;"><tspan id="SvgjsTspan1312">$330</tspan><title>$330</title></text></g></g><g id="SvgjsG1195" class="apexcharts-inner apexcharts-graphical" transform="translate(56.96875, 30)"><defs id="SvgjsDefs1194"><clipPath id="gridRectMaskykq6treh"><rect id="SvgjsRect1199" width="358.53125" height="221.82" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectBarMaskykq6treh"><rect id="SvgjsRect1200" width="365.53125" height="228.82" x="-3.5" y="-3.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskykq6treh"><rect id="SvgjsRect1201" width="358.53125" height="221.82" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskykq6treh"></clipPath><clipPath id="nonForecastMaskykq6treh"></clipPath><linearGradient id="SvgjsLinearGradient1208" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1209" stop-opacity="0.4" stop-color="rgba(248,40,90,0.4)" offset="0"></stop><stop id="SvgjsStop1210" stop-opacity="0" stop-color="rgba(255,255,255,0)" offset="0.8"></stop><stop id="SvgjsStop1211" stop-opacity="0" stop-color="rgba(255,255,255,0)" offset="1"></stop></linearGradient></defs><g id="SvgjsG1214" class="apexcharts-grid"><g id="SvgjsG1215" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1219" x1="0" y1="36.97" x2="358.53125" y2="36.97" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1220" x1="0" y1="73.94" x2="358.53125" y2="73.94" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1221" x1="0" y1="110.91" x2="358.53125" y2="110.91" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1222" x1="0" y1="147.88" x2="358.53125" y2="147.88" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1223" x1="0" y1="184.85" x2="358.53125" y2="184.85" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1216" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1226" x1="0" y1="221.82" x2="358.53125" y2="221.82" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1225" x1="0" y1="1" x2="0" y2="221.82" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1217" class="apexcharts-grid-borders"><line id="SvgjsLine1218" x1="0" y1="0" x2="358.53125" y2="0" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1224" x1="0" y1="221.82" x2="358.53125" y2="221.82" stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1204" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1205" class="apexcharts-series" zIndex="0" seriesName="Sales" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1212" d="M 0 120.99272727272773C 6.971440972222222 120.99272727272773 12.946961805555556 120.99272727272773 19.91840277777778 120.99272727272773C 26.88984375 120.99272727272773 32.86536458333333 87.38363636363647 39.83680555555556 87.38363636363647C 46.808246527777776 87.38363636363647 52.78376736111111 87.38363636363647 59.75520833333333 87.38363636363647C 66.72664930555555 87.38363636363647 72.70217013888889 53.77454545454566 79.67361111111111 53.77454545454566C 86.64505208333334 53.77454545454566 92.62057291666666 53.77454545454566 99.59201388888889 53.77454545454566C 106.56345486111111 53.77454545454566 112.53897569444443 87.38363636363647 119.51041666666666 87.38363636363647C 126.48185763888888 87.38363636363647 132.45737847222222 87.38363636363647 139.42881944444443 87.38363636363647C 146.40026041666667 87.38363636363647 152.37578125 53.77454545454566 159.34722222222223 53.77454545454566C 166.31866319444444 53.77454545454566 172.2941840277778 53.77454545454566 179.265625 53.77454545454566C 186.2370659722222 53.77454545454566 192.21258680555556 87.38363636363647 199.18402777777777 87.38363636363647C 206.15546874999998 87.38363636363647 212.13098958333333 87.38363636363647 219.10243055555554 87.38363636363647C 226.07387152777775 87.38363636363647 232.0493923611111 120.99272727272773 239.02083333333331 120.99272727272773C 245.99227430555553 120.99272727272773 251.96779513888887 120.99272727272773 258.9392361111111 120.99272727272773C 265.9106770833333 120.99272727272773 271.8861979166666 87.38363636363647 278.85763888888886 87.38363636363647C 285.8290798611111 87.38363636363647 291.80460069444445 87.38363636363647 298.7760416666667 87.38363636363647C 305.7474826388889 87.38363636363647 311.7230034722222 60.496363636364094 318.69444444444446 60.496363636364094C 325.6658854166667 60.496363636364094 331.64140625 60.496363636364094 338.61284722222223 60.496363636364094C 345.58428819444447 60.496363636364094 351.55980902777776 87.38363636363647 358.53125 87.38363636363647C 358.53125 87.38363636363647 358.53125 87.38363636363647 358.53125 221.82 L 0 221.82z" fill="url(#SvgjsLinearGradient1208)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskykq6treh)" pathTo="M 0 120.99272727272773C 6.971440972222222 120.99272727272773 12.946961805555556 120.99272727272773 19.91840277777778 120.99272727272773C 26.88984375 120.99272727272773 32.86536458333333 87.38363636363647 39.83680555555556 87.38363636363647C 46.808246527777776 87.38363636363647 52.78376736111111 87.38363636363647 59.75520833333333 87.38363636363647C 66.72664930555555 87.38363636363647 72.70217013888889 53.77454545454566 79.67361111111111 53.77454545454566C 86.64505208333334 53.77454545454566 92.62057291666666 53.77454545454566 99.59201388888889 53.77454545454566C 106.56345486111111 53.77454545454566 112.53897569444443 87.38363636363647 119.51041666666666 87.38363636363647C 126.48185763888888 87.38363636363647 132.45737847222222 87.38363636363647 139.42881944444443 87.38363636363647C 146.40026041666667 87.38363636363647 152.37578125 53.77454545454566 159.34722222222223 53.77454545454566C 166.31866319444444 53.77454545454566 172.2941840277778 53.77454545454566 179.265625 53.77454545454566C 186.2370659722222 53.77454545454566 192.21258680555556 87.38363636363647 199.18402777777777 87.38363636363647C 206.15546874999998 87.38363636363647 212.13098958333333 87.38363636363647 219.10243055555554 87.38363636363647C 226.07387152777775 87.38363636363647 232.0493923611111 120.99272727272773 239.02083333333331 120.99272727272773C 245.99227430555553 120.99272727272773 251.96779513888887 120.99272727272773 258.9392361111111 120.99272727272773C 265.9106770833333 120.99272727272773 271.8861979166666 87.38363636363647 278.85763888888886 87.38363636363647C 285.8290798611111 87.38363636363647 291.80460069444445 87.38363636363647 298.7760416666667 87.38363636363647C 305.7474826388889 87.38363636363647 311.7230034722222 60.496363636364094 318.69444444444446 60.496363636364094C 325.6658854166667 60.496363636364094 331.64140625 60.496363636364094 338.61284722222223 60.496363636364094C 345.58428819444447 60.496363636364094 351.55980902777776 87.38363636363647 358.53125 87.38363636363647C 358.53125 87.38363636363647 358.53125 87.38363636363647 358.53125 221.82 L 0 221.82z" pathFrom="M 0 2440.0200000000023 L 0 2440.0200000000023 L 19.91840277777778 2440.0200000000023 L 39.83680555555556 2440.0200000000023 L 59.75520833333333 2440.0200000000023 L 79.67361111111111 2440.0200000000023 L 99.59201388888889 2440.0200000000023 L 119.51041666666666 2440.0200000000023 L 139.42881944444443 2440.0200000000023 L 159.34722222222223 2440.0200000000023 L 179.265625 2440.0200000000023 L 199.18402777777777 2440.0200000000023 L 219.10243055555554 2440.0200000000023 L 239.02083333333331 2440.0200000000023 L 258.9392361111111 2440.0200000000023 L 278.85763888888886 2440.0200000000023 L 298.7760416666667 2440.0200000000023 L 318.69444444444446 2440.0200000000023 L 338.61284722222223 2440.0200000000023 L 358.53125 2440.0200000000023z"></path><path id="SvgjsPath1213" d="M 0 120.99272727272773C 6.971440972222222 120.99272727272773 12.946961805555556 120.99272727272773 19.91840277777778 120.99272727272773C 26.88984375 120.99272727272773 32.86536458333333 87.38363636363647 39.83680555555556 87.38363636363647C 46.808246527777776 87.38363636363647 52.78376736111111 87.38363636363647 59.75520833333333 87.38363636363647C 66.72664930555555 87.38363636363647 72.70217013888889 53.77454545454566 79.67361111111111 53.77454545454566C 86.64505208333334 53.77454545454566 92.62057291666666 53.77454545454566 99.59201388888889 53.77454545454566C 106.56345486111111 53.77454545454566 112.53897569444443 87.38363636363647 119.51041666666666 87.38363636363647C 126.48185763888888 87.38363636363647 132.45737847222222 87.38363636363647 139.42881944444443 87.38363636363647C 146.40026041666667 87.38363636363647 152.37578125 53.77454545454566 159.34722222222223 53.77454545454566C 166.31866319444444 53.77454545454566 172.2941840277778 53.77454545454566 179.265625 53.77454545454566C 186.2370659722222 53.77454545454566 192.21258680555556 87.38363636363647 199.18402777777777 87.38363636363647C 206.15546874999998 87.38363636363647 212.13098958333333 87.38363636363647 219.10243055555554 87.38363636363647C 226.07387152777775 87.38363636363647 232.0493923611111 120.99272727272773 239.02083333333331 120.99272727272773C 245.99227430555553 120.99272727272773 251.96779513888887 120.99272727272773 258.9392361111111 120.99272727272773C 265.9106770833333 120.99272727272773 271.8861979166666 87.38363636363647 278.85763888888886 87.38363636363647C 285.8290798611111 87.38363636363647 291.80460069444445 87.38363636363647 298.7760416666667 87.38363636363647C 305.7474826388889 87.38363636363647 311.7230034722222 60.496363636364094 318.69444444444446 60.496363636364094C 325.6658854166667 60.496363636364094 331.64140625 60.496363636364094 338.61284722222223 60.496363636364094C 345.58428819444447 60.496363636364094 351.55980902777776 87.38363636363647 358.53125 87.38363636363647" fill="none" fill-opacity="1" stroke="#f8285a" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskykq6treh)" pathTo="M 0 120.99272727272773C 6.971440972222222 120.99272727272773 12.946961805555556 120.99272727272773 19.91840277777778 120.99272727272773C 26.88984375 120.99272727272773 32.86536458333333 87.38363636363647 39.83680555555556 87.38363636363647C 46.808246527777776 87.38363636363647 52.78376736111111 87.38363636363647 59.75520833333333 87.38363636363647C 66.72664930555555 87.38363636363647 72.70217013888889 53.77454545454566 79.67361111111111 53.77454545454566C 86.64505208333334 53.77454545454566 92.62057291666666 53.77454545454566 99.59201388888889 53.77454545454566C 106.56345486111111 53.77454545454566 112.53897569444443 87.38363636363647 119.51041666666666 87.38363636363647C 126.48185763888888 87.38363636363647 132.45737847222222 87.38363636363647 139.42881944444443 87.38363636363647C 146.40026041666667 87.38363636363647 152.37578125 53.77454545454566 159.34722222222223 53.77454545454566C 166.31866319444444 53.77454545454566 172.2941840277778 53.77454545454566 179.265625 53.77454545454566C 186.2370659722222 53.77454545454566 192.21258680555556 87.38363636363647 199.18402777777777 87.38363636363647C 206.15546874999998 87.38363636363647 212.13098958333333 87.38363636363647 219.10243055555554 87.38363636363647C 226.07387152777775 87.38363636363647 232.0493923611111 120.99272727272773 239.02083333333331 120.99272727272773C 245.99227430555553 120.99272727272773 251.96779513888887 120.99272727272773 258.9392361111111 120.99272727272773C 265.9106770833333 120.99272727272773 271.8861979166666 87.38363636363647 278.85763888888886 87.38363636363647C 285.8290798611111 87.38363636363647 291.80460069444445 87.38363636363647 298.7760416666667 87.38363636363647C 305.7474826388889 87.38363636363647 311.7230034722222 60.496363636364094 318.69444444444446 60.496363636364094C 325.6658854166667 60.496363636364094 331.64140625 60.496363636364094 338.61284722222223 60.496363636364094C 345.58428819444447 60.496363636364094 351.55980902777776 87.38363636363647 358.53125 87.38363636363647" pathFrom="M 0 2440.0200000000023 L 0 2440.0200000000023 L 19.91840277777778 2440.0200000000023 L 39.83680555555556 2440.0200000000023 L 59.75520833333333 2440.0200000000023 L 79.67361111111111 2440.0200000000023 L 99.59201388888889 2440.0200000000023 L 119.51041666666666 2440.0200000000023 L 139.42881944444443 2440.0200000000023 L 159.34722222222223 2440.0200000000023 L 179.265625 2440.0200000000023 L 199.18402777777777 2440.0200000000023 L 219.10243055555554 2440.0200000000023 L 239.02083333333331 2440.0200000000023 L 258.9392361111111 2440.0200000000023 L 278.85763888888886 2440.0200000000023 L 298.7760416666667 2440.0200000000023 L 318.69444444444446 2440.0200000000023 L 338.61284722222223 2440.0200000000023 L 358.53125 2440.0200000000023" fill-rule="evenodd"></path><g id="SvgjsG1206" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><path id="SvgjsPath1316" d="M 358.53125, 0 
           m -0, 0 
           a 0,0 0 1,0 0,0 
           a 0,0 0 1,0 -0,0" fill="#f8285a" fill-opacity="1" stroke="#f8285a" stroke-opacity="0.9" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" cx="358.53125" cy="0" shape="circle" class="apexcharts-marker wixggsb4s no-pointer-events" default-marker-size="0"></path></g></g></g><g id="SvgjsG1207" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1228" x1="358.03125" y1="0" x2="358.03125" y2="221.82" stroke="#f8285a" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="358.03125" y="0" width="1" height="221.82" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><line id="SvgjsLine1229" x1="0" y1="0" x2="358.53125" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1230" x1="0" y1="0" x2="358.53125" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1231" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1232" class="apexcharts-xaxis-texts-g" transform="translate(0, -10)"><text id="SvgjsText1234" font-family="inherit" x="0" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1235"></tspan><title></title></text><text id="SvgjsText1237" font-family="inherit" x="19.91840277777778" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1238"></tspan><title></title></text><text id="SvgjsText1240" font-family="inherit" x="39.83680555555556" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1241"></tspan><title></title></text><text id="SvgjsText1243" font-family="inherit" x="59.75520833333334" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 60.878257751464844 238.32000732421875)"><tspan id="SvgjsTspan1244">Apr 04</tspan><title>Apr 04</title></text><text id="SvgjsText1246" font-family="inherit" x="79.67361111111111" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1247"></tspan><title></title></text><text id="SvgjsText1249" font-family="inherit" x="99.59201388888889" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1250"></tspan><title></title></text><text id="SvgjsText1252" font-family="inherit" x="119.51041666666666" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 120.61003112792969 238.32000732421875)"><tspan id="SvgjsTspan1253">Apr 07</tspan><title>Apr 07</title></text><text id="SvgjsText1255" font-family="inherit" x="139.42881944444443" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1256"></tspan><title></title></text><text id="SvgjsText1258" font-family="inherit" x="159.3472222222222" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1259"></tspan><title></title></text><text id="SvgjsText1261" font-family="inherit" x="179.26562499999997" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 180.4736328125 238.32000732421875)"><tspan id="SvgjsTspan1262">Apr 10</tspan><title>Apr 10</title></text><text id="SvgjsText1264" font-family="inherit" x="199.18402777777774" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1265"></tspan><title></title></text><text id="SvgjsText1267" font-family="inherit" x="219.10243055555551" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1268"></tspan><title></title></text><text id="SvgjsText1270" font-family="inherit" x="239.0208333333333" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 240.02084350585938 238.32000732421875)"><tspan id="SvgjsTspan1271">Apr 13</tspan><title>Apr 13</title></text><text id="SvgjsText1273" font-family="inherit" x="258.93923611111103" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1274"></tspan><title></title></text><text id="SvgjsText1276" font-family="inherit" x="278.8576388888888" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1277"></tspan><title></title></text><text id="SvgjsText1279" font-family="inherit" x="298.7760416666666" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 299.7760314941406 238.32000732421875)"><tspan id="SvgjsTspan1280">Apr 18</tspan><title>Apr 18</title></text><text id="SvgjsText1282" font-family="inherit" x="318.69444444444434" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1283"></tspan><title></title></text><text id="SvgjsText1285" font-family="inherit" x="338.6128472222221" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1286"></tspan><title></title></text><text id="SvgjsText1288" font-family="inherit" x="358.5312499999999" y="243.82" text-anchor="end" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#99a1b7" class="apexcharts-text apexcharts-xaxis-label " style="font-family: inherit;" transform="rotate(0 1 -1)"><tspan id="SvgjsTspan1289"></tspan><title></title></text></g></g><g id="SvgjsG1313" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1314" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1315" class="apexcharts-point-annotations"></g><rect id="SvgjsRect1317" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect1318" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light" style="left: 300.281px; top: 90.3836px;"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0 apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(248, 40, 90);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Sales: </span><span class="apexcharts-tooltip-text-y-value">$350</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 405px; top: 253.82px;"><div class="apexcharts-xaxistooltip-text" style="font-family: inherit; font-size: 12px; min-width: 0px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
											<!--end::Chart-->
										</div>
										<!--end::Card body-->
									</div>

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

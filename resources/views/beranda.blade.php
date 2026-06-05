@extends('layout.sidebar')
@section('konten')


<div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
	<!--end::Col-->
    <div class="col-xl-12">
        <!--begin::Card-->
        <div class="card card-flush mb-6">
            <div class="card-header p-5" style="background-image: url('{{ asset('assets/media/ibrahimy/akses.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">
                <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-white">Grafik Kehadiran Kepala Kamar dan Wakil Kepala Kamar</span>
                        <span class="text-muted mt-1 fw-semibold fs-6">Pengajian Pengasuh Pondok Pesantren Salafiyah Syafi'iyah Sukorejo</span>
                </h3>
            </div>
            <div class="card-body">
                <canvas id="grafikKehadiran" style="height: 250px;"></canvas>
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>



<!--end::App-->
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('grafikKehadiran').getContext('2d');

    // Gradient area bawah garis
    const gradient = ctx.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(13, 110, 253, 0.3)');  // biru muda transparan
    gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');    // transparan penuh

    const data = {
        labels: {!! json_encode(array_column($persentase, 'bulan')) !!},
        datasets: [{
            label: 'Persentase Kehadiran',
            data: {!! json_encode(array_column($persentase, 'persen')) !!},
            fill: true,
            backgroundColor: gradient,
            borderColor: '#3835dc', // Merah
            tension: 0.5, // Lengkungkan garis
            pointRadius: 3,
            pointBackgroundColor: '#3835dc',
            pointHoverRadius: 6
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: value => value + '%'
                    },
                    title: {
                        display: true,
                        text: 'Persentase Kehadiran (%)'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 0,
                        minRotation: 0
                    }
                }

            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: (context) => context.parsed.y + '%'
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
});
</script>

@endsection

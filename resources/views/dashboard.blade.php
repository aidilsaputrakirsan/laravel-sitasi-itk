@extends('layouts.app')
@section('title', 'Dashboard')

<style>

    .card-bimbingan {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: url('../assets/img/db-bimbingan.png');
        background-size: cover;
        background-position: right;
        background-repeat: no-repeat;
        opacity: 0.2; /* Adjust the opacity for a smoother look */
        transition: opacity 0.5s ease; /* Smooth transition */
    }

    .card-sempro {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: url('../assets/img/db-sempro.png');
        background-size: cover;
        background-position: right;
        background-repeat: no-repeat;
        opacity: 0.2; /* Adjust the opacity for a smoother look */
        transition: opacity 0.5s ease; /* Smooth transition */
    }

    .card-sidang {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: url('../assets/img/db-sidang.png');
        background-size: cover;
        background-position: right;
        background-repeat: no-repeat;
        opacity: 0.2; /* Adjust the opacity for a smoother look */
        transition: opacity 0.5s ease; /* Smooth transition */
    }

</style>

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Peserta Tugas Akhir</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $mahasiswa }} Mahasiswa 
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Seminar Proposal</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $sempro }} Mahasiswa 
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sidang Tugas Akhir</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $sidang }} Mahasiswa 
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Dosen</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $dosen }} Dosen
                                    <span class="text-success text-sm font-weight-bolder"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="mb-2 mt-0"> Selamat Datang di SITASI ITK,
        <span>{{ auth()->user()->name }}. </span>
    </h3>
    <p class="mb-0 mt-2"> Periode tugas akhir sekarang:
        <span style="color: #0033ff;">
            @if($periodeTA)
                {{ $periodeTA->semester }} {{ $periodeTA->periode }}
            @else 
                Tidak ada periode yang aktif saat ini.
            @endif
        </span>
    </p>

    <div class="row mt-4">
        <div class="col-4">
            <a href="{{ route('ta:bimbingan') }}" class="card bg-primary border-primary text-white-50" style="position: relative; overflow: hidden;">
                <div class="card-body" style="position: relative; z-index: 1;">
                    <h3 class="mb-4 text-white"><i class="fas fa-book me-3"></i>Bimbingan</h3>
                    <p class="card-text text-light">Masukkan hasil bimbingan dengan Dosen Pembimbing Anda di sini!</p>
                </div>
                <div class="card-bimbingan"></div>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('ta:sempro') }}" class="card bg-danger border-danger text-white-50" style="position: relative; overflow: hidden;">
                <div class="card-body" style="position: relative; z-index: 1;">
                    <h3 class="mb-4 text-white"><i class="fas fa-book-reader me-3"></i>Seminar Proposal</h3>
                    <p class="card-text text-light">Sudah diizinkan seminar, nih? Daftar Seminar Proposal di sini!</p>
                </div>
                <div class="card-sempro"></div>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('ta:sidang-ta') }}" class="card bg-success border-success text-white-50" style="position: relative; overflow: hidden;">
                <div class="card-body" style="position: relative; z-index: 1;">
                    <h3 class="mb-4 text-white"><i class="fas fa-user-graduate me-3"></i>Sidang TA</h3>
                    <p class="card-text text-light">Wow, kamu sudah di tahap ini. Ayo, maju ke Sidang Tugas Akhir!</p>
                </div>
                <div class="card-sidang"></div>
            </a>
        </div>
    </div>
    <!-- Datatable Layanan -->
    <h4 class="mb-2 mt-4"> Referensi Topik Tugas Akhir
    </h4>
    <div class="card my-3">
        <div class="card-content ">
            <div class="card-datatable table-responsive pt-0">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bidang Minat</th>
                            <th>Judul/Topik</th>
                            <th>Dosen Pembimbing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($referensis as $referensi)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $referensi->bidang_minat }}</td>
                            <td>{{ $referensi->judul }}</td>
                            <td>{{ $referensi->user->name }}</td>
                        </tr>
                        @empty 
                        <tr>
                            <td colspan="6">Belum ada data</td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('dashboard')
    <script>
        window.onload = function() {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: false
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: "Mobile apps",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                            maxBarThickness: 6

                        },
                        {
                            label: "Websites",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#3A416F",
                            borderWidth: 3,
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endpush

<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="?filter=today">Today</a></li>
                                        <li><a class="dropdown-item" href="?filter=month">This Month</a></li>
                                        <li><a class="dropdown-item" href="?filter=year">This Year</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Pelamar </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-lines-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalPelamar }}</h6>
                                            <span class="text-success small pt-1 fw-bold">
                                                @if ($filter === 'today')
                                                    Pelamar Hari Ini
                                                @elseif($filter === 'month')
                                                    Pelamar Bulan Ini
                                                @elseif($filter === 'year')
                                                    Pelamar Tahun Ini
                                                @else
                                                    Total Pelamar
                                                @endif
                                            </span>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">


                                <div class="card-body">
                                    <h5 class="card-title">Data Alternatif Belum Diisi </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-exclamation"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalAlternatifBelumDiisi }}</h6>
                                            <span class="text-success small pt-1 fw-bold">Pelamar</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">



                                <div class="card-body">
                                    <h5 class="card-title">Alternatif Sudah Diisi </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalAlternatifDiisi }}</h6>
                                            <span class="text-success small pt-1 fw-bold">Pelamar</span>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->


                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Total User </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalUser }}</h6>
                                            <span class="text-success small pt-1 fw-bold">Pengguna</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->


                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Pelamar Terbaru </h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Pelamar</th>
                                                <th scope="col">Tanggal Lahir</th>
                                                <th scope="col">Usia</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">No Hp</th>
                                                <th scope="col">Email</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Tanggal Melamar</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentApplicant as $applicant)
                                                <tr>
                                                    <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                                    <td>{{ $applicant->user->name }}</td>
                                                    <td>{{ $applicant->tanggal_lahir }} </td>
                                                    <td>{{ \Carbon\Carbon::parse($applicant->tanggal_lahir)->age }}
                                                    </td>
                                                    <td>{{ $applicant->alamat }} </td>
                                                    <td>{{ $applicant->no_hp }} </td>
                                                    <td>{{ $applicant->user->email }} </td>
                                                    <td>{{ $applicant->created_at }} </td>
                                                    <td>{{ $applicant->status }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->



                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Grafik Kelulusan Pelamar </h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    // Data status dari controller
                                    const statusCounts = @json($statusCounts);

                                    // Ubah data menjadi format yang sesuai untuk grafik
                                    const chartData = Object.keys(statusCounts).map(key => ({
                                        value: statusCounts[key],
                                        name: key.charAt(0).toUpperCase() + key.slice(1).replace('_', ' ')
                                    }));

                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Status Pelamar',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: chartData
                                        }]
                                    });
                                });
                            </script>
                        </div>
                    </div><!-- End Website Traffic -->

                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Grafik Alternatif Pelamar</h5>

                            <div id="trafficChart2" style="min-height: 400px;" class="echart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    // Data dari controller
                                    const totalAlternatifBelumDiisi = {{ $totalAlternatifBelumDiisi }};
                                    const totalAlternatifDiisi = {{ $totalAlternatifDiisi }};

                                    // Data untuk grafik
                                    const chartData = [{
                                            value: totalAlternatifBelumDiisi,
                                            name: 'Belum Diisi'
                                        },
                                        {
                                            value: totalAlternatifDiisi,
                                            name: 'Sudah Diisi'
                                        }
                                    ];

                                    // Render grafik menggunakan ECharts
                                    echarts.init(document.querySelector("#trafficChart2")).setOption({
                                        tooltip: {
                                            trigger: 'item'
                                        },
                                        legend: {
                                            top: '5%',
                                            left: 'center'
                                        },
                                        series: [{
                                            name: 'Status Alternatif',
                                            type: 'pie',
                                            radius: ['40%', '70%'],
                                            avoidLabelOverlap: false,
                                            label: {
                                                show: false,
                                                position: 'center'
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: false
                                            },
                                            data: chartData
                                        }]
                                    });
                                });
                            </script>
                        </div>

                    </div>


                </div>





            </div>
        </section>
    </main>
</x-admin.layout.layout>

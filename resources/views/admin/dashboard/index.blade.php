<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-6 ms-auto mt-xl-0 ">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-primary"><span id="status1"
                                        countto="{{ $Terbit->count() }}">{{ $Terbit->count() }}</span> <span
                                        class="text-lg ms-n2"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Terbit</h6>
                                <p class="opacity-8 mb-0 text-sm">Jumlah Data</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 ">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-primary"> <span id="status2"
                                        countto="{{ $Permohonan->count() }}">{{ $Permohonan->count() }}</span> <span
                                        class="text-lg ms-n1"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Permohonan</h6>
                                <p class="opacity-8 mb-0 text-sm">Jumlah Data</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-primary"><span id="status3"
                                        countto="{{ $Perizinan->count() }}">{{ $Perizinan->count() }}</span> <span
                                        class="text-lg ms-n2"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Jenis Perizinan</h6>
                                <p class="opacity-8 mb-0 text-sm">Jumlah Data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 card ms-auto">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Terbit & Permohonan</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="See the consumption per room">
                            <i class="fas fa-info"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3 " height="900">
                    <div class="row pb-5" style="padding-bottom: 900px">
                        <div class="col-5 text-center">
                            <div class="chart">
                                <canvas id="chart-consumption" class="chart-canvas" height="197"></canvas>
                            </div>
                            <h4 class="font-weight-bold mt-n8">
                                <span>{{ $Terbit->count() + $Permohonan->count() }}</span>
                                <span class="d-block text-body text-sm">Jumlah Data <br> </span>
                            </h4>
                        </div>
                        <div class="col-7">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-0">
                                                    <span class="badge bg-gradient-primary me-3"> </span>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Terbit</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $Terbit->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-0">
                                                    <span class="badge bg-gradient-secondary me-3"> </span>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Permohonan</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $Permohonan->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row  mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex pb-0 p-3">
                        <h6 class="my-auto">Data Terakhir</h6>
                        <div class="nav-wrapper position-relative ms-auto w-50">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#cam1"
                                        role="tab" aria-controls="cam1" aria-selected="true">
                                        Permohonan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#cam2" role="tab"
                                        aria-controls="cam2" aria-selected="false">
                                        Terbit
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-3 mt-2">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show position-relative active height-400 border-radius-lg"
                                id="cam1" role="tabpanel" aria-labelledby="cam1">
                                <div class="row mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-flush" id="datatable-search">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Izin</th>
                                                    <th>Jumlah</th>
                                                    <th>Tanggal</th>
                                                    <th>Tanggal Dibuat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Permohonan1 as $item)
                                                    <tr>
                                                        <td class="text-sm font-weight-normal">{{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">
                                                            {{ $item->Perizinan->nama_izin }}</td>
                                                        <td class="text-sm font-weight-normal">{{ $item->jumlah }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">{{ $item->tanggal }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">
                                                            {{ $item->created_at }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show position-relative  height-400 border-radius-lg" id="cam2"
                                role="tabpanel" aria-labelledby="cam2">
                                <div class="row mt-4">
                                    {{-- <div class="table-responsive"> --}}
                                    <table class="table table-flush" id="datatable-search1">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Izin</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal</th>
                                                <th>Tanggal Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Terbit1 as $item)
                                                <tr>
                                                    <td class="text-sm font-weight-normal">{{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-sm font-weight-normal">
                                                        {{ $item->Perizinan->nama_izin }}</td>
                                                    <td class="text-sm font-weight-normal">{{ $item->jumlah }}
                                                    </td>
                                                    <td class="text-sm font-weight-normal">{{ $item->tanggal }}
                                                    </td>
                                                    <td class="text-sm font-weight-normal">
                                                        {{ $item->created_at }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                // Rounded slider
                const setValue = function(value, active) {
                    document.querySelectorAll("round-slider").forEach(function(el) {
                        if (el.value === undefined) return;
                        el.value = value;
                    });
                    const span = document.querySelector("#value");
                    span.innerHTML = value;
                    if (active)
                        span.style.color = 'red';
                    else
                        span.style.color = 'black';
                }

                document.querySelectorAll("round-slider").forEach(function(el) {
                    el.addEventListener('value-changed', function(ev) {
                        if (ev.detail.value !== undefined)
                            setValue(ev.detail.value, false);
                        else if (ev.detail.low !== undefined)
                            setLow(ev.detail.low, false);
                        else if (ev.detail.high !== undefined)
                            setHigh(ev.detail.high, false);
                    });

                    el.addEventListener('value-changing', function(ev) {
                        if (ev.detail.value !== undefined)
                            setValue(ev.detail.value, true);
                        else if (ev.detail.low !== undefined)
                            setLow(ev.detail.low, true);
                        else if (ev.detail.high !== undefined)
                            setHigh(ev.detail.high, true);
                    });
                });

                // Count To
                if (document.getElementById('status1')) {
                    const countUp = new CountUp('status1', document.getElementById("status1").getAttribute("countTo"));
                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error(countUp.error);
                    }
                }
                if (document.getElementById('status2')) {
                    const countUp = new CountUp('status2', document.getElementById("status2").getAttribute("countTo"));
                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error(countUp.error);
                    }
                }
                if (document.getElementById('status3')) {
                    const countUp = new CountUp('status3', document.getElementById("status3").getAttribute("countTo"));
                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error(countUp.error);
                    }
                }
                if (document.getElementById('status4')) {
                    const countUp = new CountUp('status4', document.getElementById("status4").getAttribute("countTo"));
                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error(countUp.error);
                    }
                }
                if (document.getElementById('status5')) {
                    const countUp = new CountUp('status5', document.getElementById("status5").getAttribute("countTo"));
                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error(countUp.error);
                    }
                }
                if (document.getElementById('status6')) {
                    const countUp = new CountUp('status6', document.getElementById("status6").getAttribute("countTo"));
                    if (!countUp.error) {
                        countUp.start();
                    } else {
                        console.error(countUp.error);
                    }
                }

                // Chart Doughnut Consumption by room
                var ctx1 = document.getElementById("chart-consumption").getContext("2d");

                var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

                gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                new Chart(ctx1, {
                    type: "doughnut",
                    data: {
                        labels: ['Terbit', 'Permohonan', ],
                        datasets: [{
                            label: "Permohonan & Terbit",
                            weight: 9,
                            cutout: 90,
                            tension: 0.9,
                            pointRadius: 2,
                            borderWidth: 2,
                            backgroundColor: ['#FF0080', '#A8B8D8', ],
                            data: [{{ $Terbit->count() }}, {{ $Permohonan->count() }}, ],
                            fill: false
                        }],
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
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                },
                                ticks: {
                                    display: false,
                                }
                            },
                        },
                    },

                });
            </script>
            <script>
                const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                    searchable: true,
                    fixedHeight: true
                });
                const dataTableSearch1 = new simpleDatatables.DataTable("#datatable-search1", {
                    searchable: true,
                    fixedHeight: true
                });
            </script>
        @endpush
</x-app-layout>

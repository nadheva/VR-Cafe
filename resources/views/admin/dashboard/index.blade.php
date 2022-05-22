<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-6 ms-auto mt-xl-0 ">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="card card-background card-background-mask-info" data-tilt="" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1);">
                            <div class="card-body  text-center">
                                <h1 class="text-gradient text-dark"><span
                                        >{{ $pending->count() }}</span> <span
                                        class="text-lg ms-n2"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Transaksi Pending</h6>
                                <p class="opacity-8 mb-0 text-sm">Perlu Dibayar:</p>
                                <span class="badge badge-lg d-block bg-gradient-primary mb-2 up">Rp. @money($pending->sum('grand_total'))</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 ">
                        <div class="card card-background card-background-mask-success" data-tilt="" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1);">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-dark"> <span
                                        >{{ $success->count() }}</span> <span
                                        class="text-lg ms-n1"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Transaksi Berhasil</h6>
                                <p class="opacity-8 mb-0 text-sm">Terbayar: </p>
                                <span class="badge badge-lg d-block bg-gradient-warning mb-2 up">Rp. @money($success->sum('grand_total'))</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card card-background card-background-mask-warning" data-tilt="" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1);">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-dark"><span
                                        >{{ $denda->count() }}</span> <span
                                        class="text-lg ms-n2"></span></h1>
                                <h6 class="mb-0 font-weight-bolder">Denda</h6>
                                <p class="opacity-8 mb-0 text-sm">Perlu Dibayar: </p>
                                <span class="badge badge-lg d-block bg-gradient-dark mb-2 up">Rp. @money($denda->with('payment')->where('status', '=', 'pending')->sum('grand_total'))</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 card ms-auto" >
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Sedang Disewa</h6>
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
                                <span>{{ $studio->count() + $perangkat->count() }}</span>
                                <span class="d-block text-body text-sm">Jumlah Disewa <br> </span>
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
                                                        <h6 class="mb-0 text-sm">Perangkat VR</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $perangkat->count() }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-0">
                                                    <span class="badge bg-gradient-dark me-3"> </span>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Studio</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{ $studio->count() }}
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
                        <h6 class="my-auto">Data Transaksi</h6>
                        <div class="nav-wrapper position-relative ms-auto w-50">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#cam1"
                                        role="tab" aria-controls="cam1" aria-selected="true">
                                        Belum Terbayar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#cam2" role="tab"
                                        aria-controls="cam2" aria-selected="false">
                                        Terbayar
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
                                                    <th>Invoice</th>
                                                    <th>Penyewa</th>
                                                    <th>Tanggal</th>
                                                    <th>Jenis</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksi->latest()->where('status', '=', 'pending')->get() as $i)
                                                    <tr>
                                                        <td class="text-sm font-weight-normal">{{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">
                                                            {{ $i->invoice }}</td>
                                                        <td class="text-sm font-weight-normal">{{ $i->user->name }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">{{$i->created_at->format('d.m.Y')}}
                                                        </td>
                                                        @if(is_null($i->sewa_perangkat_id) && is_null($i->denda_id))
                                                        <td  class="text-xs font-weight-bold">
                                                          <span class="badge badge-dark badge-sm">Studio</span>
                                                        </td>
                                                        @elseif(is_null($i->sewa_studio_id) && is_null($i->denda_id))
                                                        <td  class="text-xs font-weight-bold">
                                                          <span class="badge badge-primary badge-sm">Perangkat VR</span>
                                                        </td>
                                                        @elseif(is_null($i->sewa_studio_id) && is_null($i->sewa_perangkat_id))
                                                        <td  class="text-xs font-weight-bold">
                                                          <span class="badge badge-danger badge-sm">Denda</span>
                                                        </td>
                                                        @endif
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
                                                    <th>Invoice</th>
                                                    <th>Penyewa</th>
                                                    <th>Tanggal</th>
                                                    <th>Jenis</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksi->latest()->where('status', '=', 'success')->get() as $i)
                                                    <tr>
                                                        <td class="text-sm font-weight-normal">{{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">
                                                            {{ $i->invoice }}</td>
                                                        <td class="text-sm font-weight-normal">{{ $i->user->name }}
                                                        </td>
                                                        <td class="text-sm font-weight-normal">{{$i->created_at->format('d.m.Y')}}
                                                        </td>
                                                        @if(is_null($i->sewa_perangkat_id) && is_null($i->denda_id))
                                                        <td  class="text-xs font-weight-bold">
                                                          <span class="badge badge-dark badge-sm">Studio</span>
                                                        </td>
                                                        @elseif(is_null($i->sewa_studio_id) && is_null($i->denda_id))
                                                        <td  class="text-xs font-weight-bold">
                                                          <span class="badge badge-primary badge-sm">Perangkat VR</span>
                                                        </td>
                                                        @elseif(is_null($i->sewa_studio_id) && is_null($i->sewa_perangkat_id))
                                                        <td  class="text-xs font-weight-bold">
                                                          <span class="badge badge-danger badge-sm">Denda</span>
                                                        </td>
                                                        @endif
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
                        labels: ['Perangkat VR', 'Studio', ],
                        datasets: [{
                            label: "Perangkat VR & Studio",
                            weight: 9,
                            cutout: 90,
                            tension: 0.9,
                            pointRadius: 2,
                            borderWidth: 2,
                            backgroundColor: ['#FF0080', '#A8B8D8', ],
                            data: [{{ $perangkat->count() }}, {{ $studio->count() }}, ],
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

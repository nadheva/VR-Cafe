<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-lg-8 col-12">
            <div class="row">
              <div class="col-lg-4 col-12">
                <div class="card card-background card-background-mask-info h-100 tilt" data-tilt="" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1);">
                  <div class="full-background" style="background-image: url('{{asset('tadmin/assets/img/curved-images/white-curved.jpeg')}}');"></div>
                  <div class="card-body pt-4 text-center">
                    <h2 class="text-white mb-0 mt-2 up">Pengeluaran</h2>
                    <h1 class="text-white mb-0 up">Rp. @money($total)</h1>
                    <span class="badge badge-lg d-block bg-gradient-warning mb-2 up">pengeluaran perbulan</span>
                    {{-- <a href="javascript:;" class="btn btn-outline-white mb-2 px-5 up">View more</a> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="d-flex">
                      <div>
                        <div class="icon icon-shape bg-gradient-success text-center border-radius-md">
                          <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="ms-3">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitaize font-weight-bold">Sewa Perangkat VR</p>
                          <h5 class="font-weight-bolder mb-0">
                            Rp. @money($perangkat)
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mt-4">
                  <div class="card-body p-3">
                    <div class="d-flex">
                      <div>
                        <div class="icon icon-shape bg-gradient-success text-center border-radius-md">
                          <i class="ni ni-planet text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="ms-3">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">Sewa Studio</p>
                          <h5 class="font-weight-bolder mb-0">
                            Rp. @money($studio)
                            {{-- <span class="text-success text-sm font-weight-bolder">+15%</span> --}}
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="d-flex">
                      <div>
                        <div class="icon icon-shape bg-gradient-success text-center border-radius-md">
                          <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="ms-3">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">Denda</p>
                          <h5 class="font-weight-bolder mb-0">
                            Rp. @money($denda)
                            {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mt-4">
                  <div class="card-body p-3">
                    <div class="d-flex">
                      <div>
                        <div class="icon icon-shape bg-gradient-success text-center border-radius-md">
                          <i class="ni ni-shop text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="ms-3">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi</p>
                          <h5 class="font-weight-bolder mb-0">
                            {{$transaksi}}
                            {{-- <span class="text-success text-sm font-weight-bolder">+12%</span> --}}
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12 mt-4 mt-lg-0">
            <div class="card">
              <div class="card-header p-3 pb-0">
                <div class="row">
                  <div class="col-8 d-flex">
                    <div>
                        @if(empty($user->profile->foto))
                        <img src="{{asset('tadmin/assets/img/avatar.webp')}}" class="avatar avatar-sm me-2" alt="avatar image">
                        @else
                      <img src="{{asset($user->profile->foto)}}" class="avatar avatar-sm me-2" alt="avatar image">
                      @endif
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                      {{-- <p class="text-xs">{{$user->}}</p> --}}
                    </div>
                  </div>
                  <div class="col-4">
                    <span class="badge bg-gradient-warning ms-auto float-end">{{$user->email}}</span>
                  </div>
                </div>
              </div>
              <div class="card-body p-3 pt-1">
                @if(empty($user->profile->alamat))
                <span class="badge badge-lg d-block bg-gradient-danger mb-2 up">Profil Belum Diisi!</span>
                @else
                <h6>Alamat:</h6>
                <p class="text-sm">{{$user->profile->alamat}}</p>
                @endif
                <div class="d-flex bg-gray-100 border-radius-lg p-3">
                  <h4 class="my-auto">
                    {{-- <span class="text-secondary text-sm me-1">$</span>3,000<span class="text-secondary text-sm ms-1">/ month </span> --}}
                  </h4>
                  @if(empty($user->profile))
                  <a href="{{route('profil.create')}}" class="btn btn-outline-dark mb-0 ms-auto">Lengkapi Profil</a>
                  @else
                  <a href="{{route('profil.index')}}" class="btn btn-outline-dark mb-0 ms-auto">Lihat Profil</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-header p-3">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mb-0">Riwayat Pembayaran</h6>
                  </div>
                  <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <small></small>
                  </div>
                </div>
                <hr class="horizontal dark mb-0">
              </div>
              @if(empty($payment))
              <div class="card-body p-3 pt-0">
              <span>Belum ada transaksi</span>
              </div>
              @else
              <div class="card-body p-3 pt-0">
                <ul class="list-group list-group-flush" data-toggle="checklist">
                @foreach($payment as $i)
                  <li class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3">
                    @if($i->status == "pending")
                    <div class="checklist-item checklist-item-info ps-2 ms-3">
                    @elseif($i->status == "success")
                    <div class="checklist-item checklist-item-success ps-2 ms-3">
                    @elseif($i->status == "failed")
                    <div class="checklist-item checklist-item-danger ps-2 ms-3">
                    @elseif($i->status == "expired")
                    <div class="checklist-item checklist-item-warning ps-2 ms-3">
                    @endif
                      <div class="d-flex align-items-center">
                        <h6 class="mb-0 text-dark font-weight-bold text-sm">{{$i->invoice}}</h6>
                        <div class="dropstart float-lg-end ms-auto pe-0">
                          <a href="javascript:;" class="cursor-pointer" id="dropdownTable2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-h text-secondary" aria-hidden="true"></i>
                          </a>
                          <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable2" style="">
                            @if(is_null($i->sewa_perangkat_id) && is_null($i->denda_id))
                            <li><a class="dropdown-item border-radius-md" href="{{route('user-transaksi-studio.show', $i->sewa_ruang->id)}}">Lihat Selengkapnya</a></li>
                            @elseif(is_null($i->sewa_perangkat_id) && is_null($i->sewa_ruang_id))
                            <li><a class="dropdown-item border-radius-md" href="{{route('user-denda.show', $i->denda->id)}}">Lihat Selengkapnya</a></li>
                            @elseif(is_null($i->sewa_denda_id) && is_null($i->sewa_ruang_id))
                            <li><a class="dropdown-item border-radius-md" href="{{route('user-transaksi-perangkat.show', $i->sewa_perangkat->id)}}">Lihat Selengkapnya</a></li>
                        @endif
                            </ul>
                        </div>
                      </div>
                      <div class="d-flex align-items-center ms-4 mt-3 ps-1">
                        <div>
                          <p class="text-xs mb-0 text-secondary font-weight-bold">Jenis</p>
                          @if(is_null($i->sewa_perangkat_id) && is_null($i->denda_id))
                          <span class="text-xs font-weight-bolder badge badge-warning badge-sm">Studio</span>
                          @elseif(is_null($i->sewa_ruang_id) && is_null($i->denda_id))
                          <span class="text-xs font-weight-bolder badge badge-info badge-sm">Perangkat VR</span>
                          @elseif(is_null($i->sewa_ruang_id) && is_null($i->sewa_perangkat_id))
                          <span class="text-xs font-weight-bolder badge badge-danger badge-sm">Denda</span>
                          @endif
                        </div>
                        <div class="ms-auto">
                          <p class="text-xs mb-0 text-secondary font-weight-bold">Total</p>
                          <span class="text-xs font-weight-bolder">@money($i->grand_total)</span>
                        </div>
                        <div class="mx-auto">
                          <p class="text-xs mb-0 text-secondary font-weight-bold">Status</p>
                          @if($i->status == "pending")
                          <span class="text-xs font-weight-bolder">Belum Dibayar</span>
                          @elseif($i->status == "success")
                          <span class="text-xs font-weight-bolder">Sudah Dibayar</span>
                          @elseif($i->status == "failed")
                          <span class="text-xs font-weight-bolder">Gagal</span>
                          @elseif($i->status == "expired")
                          <span class="text-xs font-weight-bolder">Kadaluarsa</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <hr class="horizontal dark mt-4 mb-0">
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          @endif
          {{-- <div class="col-lg-4 col-12 mt-4 mt-lg-0">
            <div class="card overflow-hidden">
              <div class="card-header p-3 pb-0">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                    <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                  <div class="ms-3">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tasks</p>
                    <h5 class="font-weight-bolder mb-0">
                      480
                    </h5>
                  </div>
                  <div class="progress-wrapper ms-auto w-25">
                    <div class="progress-info">
                      <div class="progress-percentage">
                        <span class="text-xs font-weight-bold">60%</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body mt-3 p-0">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="100"></canvas>
                </div>
              </div>
            </div>
            <div class="card overflow-hidden mt-4">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="d-flex">
                      <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                        <i class="ni ni-delivery-fast text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                      <div class="ms-3">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Projects</p>
                        <h5 class="font-weight-bolder mb-0">
                          115
                        </h5>
                      </div>
                    </div>
                    <span class="badge badge-dot d-block text-start pb-0 mt-3">
                      <i class="bg-gradient-info"></i>
                      <span class="text-muted text-xs font-weight-bold">Done</span>
                    </span>
                    <span class="badge badge-dot d-block text-start">
                      <i class="bg-gradient-secondary"></i>
                      <span class="text-muted text-xs font-weight-bold">In progress</span>
                    </span>
                  </div>
                  <div class="col-lg-7 my-auto">
                    <div class="chart ms-auto">
                      <canvas id="chart-bar" class="chart-canvas" height="150"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
        @push('scripts')
        <script>
            var ctx1 = document.getElementById("chart-line").getContext("2d");
            var ctx2 = document.getElementById("chart-bar").getContext("2d");

            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(33,82,255,0.1)');
            gradientStroke1.addColorStop(0.2, 'rgba(33,82,255,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(33,82,255,0)'); //purple colors

            new Chart(ctx1, {
              type: "line",
              data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                  label: "Tasks",
                  tension: 0.3,
                  pointRadius: 2,
                  pointBackgroundColor: "#2152ff",
                  borderColor: "#2152ff",
                  borderWidth: 2,
                  backgroundColor: gradientStroke1,
                  data: [40, 45, 42, 41, 40, 43, 40, 42, 39],
                  maxBarThickness: 6,
                  fill: true
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
                      color: '#252f40',
                      padding: 10
                    }
                  },
                  y: {
                    grid: {
                      drawBorder: false,
                      display: false,
                      drawOnChartArea: true,
                      drawTicks: false,
                      borderDash: [5, 5]
                    },
                    ticks: {
                      display: true,
                      padding: 10,
                      color: '#9ca2b7'
                    }
                  },
                  x: {
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
                      color: '#9ca2b7'
                    }
                  },
                },
              },
            });

            new Chart(ctx2, {
              type: "doughnut",
              data: {
                labels: ['Done', 'In progress'],
                datasets: [{
                  label: "Projects",
                  weight: 9,
                  cutout: 50,
                  tension: 0.9,
                  pointRadius: 2,
                  borderWidth: 2,
                  backgroundColor: ['#2152ff', '#a8b8d8'],
                  data: [75, 25],
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
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
              var options = {
                damping: '0.5'
              }
              Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
          </script>
        @endpush
</x-app-layout>

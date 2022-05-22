<x-app-layout>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-4">Detail Studio</h5>
              <div class="row">
                <div class="col-xl-5 col-lg-6 text-center">
                  <img class="w-100 border-radius-lg shadow-lg mx-auto" src="{{asset($studio->gambar)}}" alt="{{$studio->nama}}">
                  <div class="my-gallery d-flex mt-4 pt-2" itemscope itemtype="http://schema.org/ImageGallery">
                    @foreach($studiodetails as $key => $i)
                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                      <a href="{{asset($i)}}" itemprop="contentUrl" data-size="500x600">
                        <img class="w-75 min-height-100 max-height-100 border-radius-lg shadow" src="{{asset($i)}}" itemprop="thumbnail" alt="Image description" />
                      </a>
                    </figure>
                    @endforeach
                    {{-- <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                      <a href="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/chair-steel.jpg" itemprop="contentUrl" data-size="500x600">
                        <img class="w-75 min-height-100 max-height-100 border-radius-lg shadow" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/chair-steel.jpg" itemprop="thumbnail" alt="Image description" />
                      </a>
                    </figure>
                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                      <a href="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/chair-wood.jpg" itemprop="contentUrl" data-size="500x600">
                        <img class="w-75 min-height-100 max-height-100 border-radius-lg shadow" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/chair-wood.jpg" itemprop="thumbnail" alt="Image description" />
                      </a>
                    </figure> --}}
                  </div>
                  <!-- Root element of PhotoSwipe. Must have class pswp. -->
                  <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="pswp__bg"></div>
                    <!-- Slides wrapper with overflow:hidden. -->
                    <div class="pswp__scroll-wrap">
                      <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                      <!-- don't modify these 3 pswp__item elements, data is added later on. -->
                      <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                      </div>
                      <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                      <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                          <!--  Controls are self-explanatory. Order can be changed. -->
                          <div class="pswp__counter"></div>
                          <button class="btn btn-white btn-sm pswp__button pswp__button--close">Close (Esc)</button>
                          <button class="btn btn-white btn-sm pswp__button pswp__button--fs">Fullscreen</button>
                          <button class="btn btn-white btn-sm pswp__button pswp__button--arrow--left">Prev
                          </button>
                          <button class="btn btn-white btn-sm pswp__button pswp__button--arrow--right">Next
                          </button>
                          <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                          <!-- element will get class pswp__preloader--active when preloader is running -->
                          <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                              <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                          <div class="pswp__share-tooltip"></div>
                        </div>
                        <div class="pswp__caption">
                          <div class="pswp__caption__center"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 mx-auto">
                  <h3 class="mt-lg-0 mt-4">{{$studio->nama}}</h3>
                  <div class="rating">
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                  </div>
                  <br>
                  <h6 class="mb-0 mt-3">Harga</h6>
                  <h5>Rp.@money($studio->harga)</h5>
                  @if($studio->jumlah == 0)
                  <span class="badge badge-danger">Habis</span>
                  @else
                  <span class="badge badge-success">Tersedia</span>
                  @endif
                  <br>
                  <label class="mt-4">Deskripsi</label>
                  <ul>
                        {!!$studio->deskripsi!!}
                  </ul>
                  <div class="row mt-4">
                    <div class="col-lg-5">
                      @if($studio->jumlah == 0)
                      <a class="btn bg-gradient-success mb-0 mt-lg-auto w-100" href="{{route('sewa-studio-create', $studio->id)}}" type="button" name="button" disabled>Sewa Sekarang</a>
                      @else
                      <a class="btn bg-gradient-success mb-0 mt-lg-auto w-100" href="{{route('sewa-studio-create', $studio->id)}}" type="button" name="button">Sewa Sekarang</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{--Cek ketersediaan--}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="my-3 mx-2">Cek Ketersediaan</h5>
                    <form method="post" action="{{ route('cek-studio') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <input type="hidden" name="studio_id" value="{{$studio->id}}">
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                              <label>Tanggal Mulai</label>
                              <input class="form-control" type="datetime-local" name="tanggal_mulai" id="date1">
                            </div>
                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                              <label>Tanggal Akhir</label>
                              <input class="form-control" type="datetime-local" name="tanggal_berakhir" id="date2">
                            </div>
                          </div>
                          <div class="text-end">
                                  <button type="reset" class="btn bg-gradient-danger"><i class="ni ni-bold-left"></i>&nbsp;&nbsp;Reset</button>
                            <button type="submit" class="btn bg-gradient-dark"><i class="fas fa-plus"></i>&nbsp;&nbsp;Cek</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
                    {{-- Kalender --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="card card-calendar">
                <div class="card-body p-3">
                    <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
                </div>
                </div>
            </div>
        </div>
      <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-h100">
          <h5 class="my-3 mx-2">Studio Lainnya</h5>
          <div class="table table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Perangkat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                </tr>
              </thead>
              <tbody>
                @foreach($studiolain as $i)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{asset($i->gambar)}}" class="avatar avatar-md me-3" alt="table image">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$i->nama}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-sm text-secondary mb-0">{{$i->kode_studio}}</p>
                  </td>
                  <td>
                    <p class="text-sm text-secondary mb-0">Rp. @money($i->harga) </p>
                  </td>
                  <td  class="align-middle text-center">
                    <p class="text-sm text-secondary mb-0">{{$i->jumlah}} </p>
                  </td>
                  @if($i->jumlah == 0)
                  <td  class="align-middle text-center">
                    <span class="badge badge-danger badge-sm">Tidak Tersedia</span>
                  </td>
                  @else
                  <td  class="align-middle text-center">
                    <span class="badge badge-success badge-sm">Tersedia</span>
                  </td>
                  @endif
                  <td class="text-sm align-middle text-center">
                    <a href="{{route('user-studio.show', $i->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                      <i class="fas fa-eye text-secondary"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@push('scripts')
<script src="{{asset('tadmin/assets/js/plugins/orbit-controls.js')}}"></script>
<script>
  var kalender = {!!json_encode($sewa_studio) !!};
  var dates = [];
  var color = "";
  kalender.forEach(function(data) {
    // if (data['tipe'] == "kuis"){
    //   color = "bg-gradient-info";
    // }
    // if (data['tipe'] == "assignment"){
    //   color = "bg-gradient-primary";
    // }
    dates.push({title:data['invoice'],start:data['tanggal_mulai'],end:data['tanggal_mulai'],className:data['color']});
  });

    var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
      contentHeight: 'auto',
      initialView: "dayGridMonth",
      headerToolbar: {
        start: 'title', // will normally be on the left. if RTL, will be on the right
        center: '',
        end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
      },
      selectable: true,
      editable: false,
      initialDate: Date.now(),

      events: dates,

      views: {
        month: {
          titleFormat: {
            month: "long",
            year: "numeric"
          }
        },
        agendaWeek: {
          titleFormat: {
            month: "long",
            year: "numeric",
            day: "numeric"
          }
        },
        agendaDay: {
          titleFormat: {
            month: "short",
            year: "numeric",
            day: "numeric"
          }
        }
      },
    });
    calendar.render();

  var ctx1 = document.getElementById("chart-line-1").getContext("2d");

  var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(255,255,255,0.3)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Visitors",
        tension: 0.5,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#fff",
        borderWidth: 2,
        backgroundColor: gradientStroke1,
        data: [50, 45, 60, 60, 80, 65, 90, 80, 100],
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
            display: false
          }
        },
      },
    },
  });
</script>
@endpush
</x-app-layout>

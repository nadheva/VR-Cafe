<x-app-layout>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-4">Detail Produk</h5>
              <div class="row">
                <div class="col-xl-5 col-lg-6 text-center">
                  <img class="w-100 border-radius-lg shadow-lg mx-auto" src="{{asset($perangkat->gambar)}}" alt="{{$perangkat->nama}}">
                  <div class="my-gallery d-flex mt-4 pt-2" itemscope itemtype="http://schema.org/ImageGallery">
                    @foreach($perangkatdetails as $key => $i)
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
                  <h3 class="mt-lg-0 mt-4">{{$perangkat->nama}}</h3>
                  <div class="rating">
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                  </div>
                  <br>
                  <h6 class="mb-0 mt-3">Harga</h6>
                  <h5>Rp.@money($perangkat->harga)</h5>
                  @if($perangkat->stok == 0)
                  <span class="badge badge-danger">Stok Habis</span>
                  @else
                  <span class="badge badge-success">Stok Tersedia</span>
                  @endif
                  <br>
                  <label class="mt-4">Deskripsi</label>
                  <ul>
                        {!!$perangkat->deskripsi!!}
                  </ul>
                  <form action="{{route('cart.store')}}" method="POST">
                    @csrf
                  <div class="row mt-4">
                    <div class="col-lg-5 mt-lg-0 mt-2">
                      <label>Jumlah</label>
                      <input class="form-control" name="jumlah" type="number" max="{{$perangkat->stok}}" required>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-lg-5">
                        <input type="hidden" name="perangkat_id" value="{{$perangkat->id}}">
                        {{-- <input type="hidden" name="jumlah" value="1"> --}}
                        <input type="hidden" name="harga" value="{{$perangkat->harga}}">
                      <button class="btn bg-gradient-success mb-0 mt-lg-auto w-100" type="submit" name="button">Sewa Sekarang</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="row mt-5">
        <div class="col-12">
        <div class="card">
            <div class="card-h100">
          <h5 class="my-3 mx-2">Perangkat Lainnya</h5>
          <div class="table table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode Perangkat</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                </tr>
              </thead>
              <tbody>
                @foreach($perangkatlain as $i)
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
                    <p class="text-sm text-secondary mb-0">{{$i->kode_perangkat}}</p>
                  </td>
                  <td>
                    <p class="text-sm text-secondary mb-0">Rp. @money($i->harga) </p>
                  </td>
                  <td  class="align-middle text-center">
                    <p class="text-sm text-secondary mb-0">{{$i->stok}} </p>
                  </td>
                  @if($i->stok == 0)
                  <td  class="align-middle text-center">
                    <span class="badge badge-danger badge-sm">Stok Habis</span>
                  </td>
                  @else
                  <td  class="align-middle text-center">
                    <span class="badge badge-success badge-sm">Stok Tersedia</span>
                  </td>
                  @endif
                  <td class="text-sm align-middle text-center">
                    <a href="{{route('user-perangkat.show', $i->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
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
</x-app-layout>

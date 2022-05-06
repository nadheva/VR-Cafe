<x-app-layout>
    @if(is_null($denda->sewa_ruang_id))
    <div class="container-fluid py-4">
          <div class="col-lg-8 mt-lg-0 mt-4" style="align-items: center">
            <div class="card">
            <div class="table-responsive">
              <div class="card-body">
                <h5 class="font-weight-bolder">Detail Denda</h5>
                <div class="col-12 mx-0 text-end">
                    <a class="btn bg-gradient-warning mb-0" href="">Invoice</a>
                  </div>
                <table class="table">
                    <tbody>
                    <tr>
                      <td>No. Invoice </td>
                      <td>:</td>
                      <td>{{$denda->invoice}}</td>
                    </tr>
                    <tr>
                      <td>Nama Lengkap </td>
                      <td>:</td>
                      <td>{{$denda->sewa_perangkat->user->profile->nama_depan. " ".$denda->sewa_perangkat->user->profile->nama_belakang}}</td>
                    </tr>
                    <tr>
                      <td>No. Telp </td>
                      <td>:</td>
                      <td>{{$denda->sewa_perangkat->user->profile->no_telp}}</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>:</td>
                        <td>{{$denda->sewa_perangkat->user->profile->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Total Bayar </td>
                        <td>:</td>
                        <td>Rp. @money($denda->grand_total)</td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>:</td>
                        <td>
                            <div class="col-lg-5 text-right d-flex flex-column">
                            @if($denda->payment->status == "pending")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-info" aria-hidden="true"></i></button>
                            <span>Belum dibayar</span>
                            </div>
                            @elseif($denda->payment->status == "success")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                            <span>Sudah dibayar</span>
                            </div>
                            @elseif($denda->payment->status == "failed")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                            <span>Gagal</span>
                            </div>
                            @elseif($denda->payment->status == "expired")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-undo" aria-hidden="true"></i></button>
                            <span>Kadaluarsa</span>
                            </div>
                            @endif
                            </div>
                        </td>
                    </tr>
                    </tbody>
                  </table>
              </div>
            </div>
            </div>
        </div>
        <div class="row mt-4">
          <div class="col-sm-8 mt-sm-0 mt-4col-sm-8 mt-sm-0 mt-4">
            <div class="card">
                <div class="table-responsive">
                <div class="card-body">
                  <div class="row">
                      <h5 class="font-weight-bolder">Perangkat</h5>
                      <table class="table" id="products-list">
                          <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subtotal</th>
                              </tr>
                            </thead>
                          <tbody>
                          @foreach($denda->sewa_perangkat->order as $i)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                            <div class="d-flex">
                                <img class="w-10 ms-3" src="{{asset($i->perangkat->gambar)}}" alt="{{$i->perangkat->nama}}">
                                <h6 class="ms-3 my-auto">{{$i->perangkat->nama}}</h6>
                              </div>
                            </td>
                            <td>Rp. @money($i->perangkat->harga)</td>
                            <td>{{$i->jumlah}}</td>
                            <td>Rp. @money($i->harga)</td>
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

          @elseif(is_null($denda->sewa_perangkat_id))
          <div class="container-fluid py-4">
            <div class="col-lg-8 mt-lg-0 mt-4" style="align-items: center">
              <div class="card">
              <div class="table-responsive">
                <div class="card-body">
                  <h5 class="font-weight-bolder">Detail Denda</h5>
                  <div class="col-12 mx-0 text-end">
                      <a class="btn bg-gradient-warning mb-0" href="">Invoice</a>
                    </div>
                  <table class="table">
                      <tbody>
                      <tr>
                        <td>No. Invoice </td>
                        <td>:</td>
                        <td>{{$denda->invoice}}</td>
                      </tr>
                      <tr>
                        <td>Nama Lengkap </td>
                        <td>:</td>
                        <td>{{$denda->sewa_ruang->user->profile->nama_depan. " ".$denda->sewa_ruang->user->profile->nama_belakang}}</td>
                      </tr>
                      <tr>
                        <td>No. Telp </td>
                        <td>:</td>
                        <td>{{$denda->sewa_ruang->user->profile->no_telp}}</td>
                      </tr>
                      <tr>
                          <td>Alamat </td>
                          <td>:</td>
                          <td>{{$denda->sewa_ruang->user->profile->alamat}}</td>
                      </tr>
                      <tr>
                          <td>Total Bayar </td>
                          <td>:</td>
                          <td>Rp. @money($denda->grand_total)</td>
                      </tr>
                      <tr>
                        <td>Status </td>
                        <td>:</td>
                        <td>
                            <div class="col-lg-5 text-right d-flex flex-column">
                            @if($denda->payment->status == "pending")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-info" aria-hidden="true"></i></button>
                            <span>Belum dibayar</span>
                            </div>
                            @elseif($denda->payment->status == "success")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                            <span>Sudah dibayar</span>
                            </div>
                            @elseif($denda->payment->status == "failed")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                            <span>Gagal</span>
                            </div>
                            @elseif($denda->payment->status == "expired")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-undo" aria-hidden="true"></i></button>
                            <span>Kadaluarsa</span>
                            </div>
                            @endif
                            </div>
                        </td>
                    </tr>
                      </tbody>
                    </table>
                </div>
              </div>
              </div>
          </div>
          <div class="row mt-4">
            <div class="col-sm-8 mt-sm-0 mt-4col-sm-8 mt-sm-0 mt-4">
              <div class="card">
                  <div class="table-responsive">
                  <div class="card-body">
                    <div class="row">
                        <h5 class="font-weight-bolder">Studio</h5>
                        <table class="table">
                            <tbody>
                              <tr>
                                  <td>Nama</td>
                                  <td> : </td>
                                  <td>{{$denda->sewa_ruang->studio->nama}}</td>
                              </tr>
                              <tr>
                                  <td>Gambar</td>
                                  <td> : </td>
                                  <td><img src="{{asset($denda->sewa_ruang->studio->gambar)}}" style="max-width: 70px" class="img-fluid shadow border-radius-xl"></td>
                              </tr>
                              <tr>
                                  <td>Harga</td>
                                  <td> : </td>
                                  <td>{{$denda->sewa_ruang->studio->harga}}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
            </div>
          @endif

          @push('scripts')
          <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{$client}}"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function(){
                    // SnapToken acquired from previous step
                    snap.pay('{{$denda->payment->snap_token}}', {
                        // Optional
                        onSuccess: function(result){
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                        // Optional
                        onPending: function(result){
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                        // Optional
                        onError: function(result){
                          document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                };

            if (document.getElementById('products-list')) {
              const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
              });

              document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                  var type = el.dataset.type;

                  var data = {
                    type: type,
                    filename: "soft-ui-" + type,
                  };

                  if (type === "csv") {
                    data.columnDelimiter = "|";
                  }

                  dataTableSearch.export(data);
                });
              });
            };
          </script>
          @endpush
  </x-app-layout>

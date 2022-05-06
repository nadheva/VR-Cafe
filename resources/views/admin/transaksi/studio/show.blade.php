<x-app-layout>
    <div class="container-fluid py-4">
          <div class="col-lg-8 mt-lg-0 mt-4" style="align-items: center">
            <div class="card">
            <div class="table-responsive">
              <div class="card-body">
                <h5 class="font-weight-bolder">Detail Transaksi</h5>
                <div class="col-12 mx-0 text-end">
                    <a class="btn bg-gradient-danger mb-0"  href="" data-bs-toggle="modal" data-bs-target="#denda-{{$sewa_studio->id}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Denda</a>
                  </div>
                <table class="table">
                    <tbody>
                    <tr>
                      <td>No. Invoice </td>
                      <td>:</td>
                      <td>{{$sewa_studio->invoice}}</td>
                    </tr>
                    <tr>
                      <td>Nama Lengkap </td>
                      <td>:</td>
                      <td>{{$sewa_studio->user->profile->nama_depan. " ".$sewa_studio->user->profile->nama_belakang}}</td>
                    </tr>
                    <tr>
                      <td>No. Telp </td>
                      <td>:</td>
                      <td>{{$sewa_studio->user->profile->no_telp}}</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>:</td>
                        <td>{{$sewa_studio->user->profile->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Total Bayar </td>
                        <td>:</td>
                        <td>Rp. @money($sewa_studio->grand_total)</td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>:</td>
                        <td>
                            <div class="col-lg-5 text-right d-flex flex-column">
                            @if($sewa_studio->payment->status == "pending")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-info" aria-hidden="true"></i></button>
                            <span>Belum dibayar</span>
                            </div>
                            @elseif($sewa_studio->payment->status == "success")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                            <span>Sudah dibayar</span>
                            </div>
                            @elseif($sewa_studio->payment->status == "failed")
                            <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                            <span>Gagal</span>
                            </div>
                            @elseif($sewa_studio->payment->status == "expired")
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
                      <table class="table" id="products-list">
                          <tbody>
                            <tr>
                                <td>Nama</td>
                                <td> : </td>
                                <td>{{$sewa_studio->studio->nama}}</td>
                            </tr>
                            <tr>
                                <td>Gambar</td>
                                <td> : </td>
                                <td><img src="{{asset($sewa_studio->studio->gambar)}}" style="max-width: 70px" class="img-fluid shadow border-radius-xl"></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td> : </td>
                                <td>{{$sewa_studio->studio->harga}}</td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
                </div>
                </div>
              </div>
          </div>
          </div>

    <!-- Modal Edit Perangkat -->
    <div class="modal fade" id="denda-{{$sewa_studio->id}}" tabindex="-1" role="dialog" aria-labelledby="dendaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('denda-studio.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sewa_ruang_id" value="{{$sewa_studio->id}}">
                    <input type="hidden" name="user_id" value="{{$sewa_studio->user->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPerangkatLabel">Denda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid py-4">
                            <div  style="align-items: center">
                              <div class="table-responsive">
                                  <table class="table">
                                      <tbody>
                                      <tr>
                                        <td>No. Invoice </td>
                                        <td>:</td>
                                        <td>{{$sewa_studio->invoice}}</td>
                                      </tr>
                                      <tr>
                                        <td>Nama Lengkap </td>
                                        <td>:</td>
                                        <td>{{$sewa_studio->user->profile->nama_depan. " ".$sewa_studio->user->profile->nama_belakang}}</td>
                                      </tr>
                                      <tr>
                                        <td>No. Telp </td>
                                        <td>:</td>
                                        <td>{{$sewa_studio->user->profile->no_telp}}</td>
                                      </tr>
                                      <tr>
                                          <td>Alamat </td>
                                          <td>:</td>
                                          <td>{{$sewa_studio->user->profile->alamat}}</td>
                                      </tr>
                                      <tr>
                                          <td>Grand Total</td>
                                          <td>:</td>
                                          <td><input class="form-control" type="number" name="grand_total" required></td>
                                      </tr>
                                      </tbody>
                                    </table>
                                </div>
                          </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn bg-gradient-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

          @push('scripts')
          <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{$client}}"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function(){
                    // SnapToken acquired from previous step
                    snap.pay('{{$sewa_studio->payment->snap_token}}', {
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

<x-app-layout>
    <div class="container-fluid py-4">
          <div class="col-lg-8 mt-lg-0 mt-4" style="align-items: center">
            <div class="card">
            <div class="table-responsive">
              <div class="card-body">
                <h5 class="font-weight-bolder">Detail Transaksi</h5>
                <div class="col-12 mx-0 text-end">
                    <a class="btn bg-gradient-warning mb-0" href="{{route('invoice-transaksi-studio', $sewa_ruang->id)}}" target="_blank">Invoice</a>
                  </div>
                <table class="table">
                    <tbody>
                    <tr>
                      <td>No. Invoice </td>
                      <td>:</td>
                      <td>{{$sewa_ruang->invoice}}</td>
                    </tr>
                    <tr>
                      <td>Nama Lengkap </td>
                      <td>:</td>
                      <td>{{$sewa_ruang->user->profile->nama_depan. " ".$sewa_ruang->user->profile->nama_belakang}}</td>
                    </tr>
                    <tr>
                      <td>No. Telp </td>
                      <td>:</td>
                      <td>{{$sewa_ruang->user->profile->no_telp}}</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>:</td>
                        <td>{{$sewa_ruang->user->profile->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Total Bayar </td>
                        <td>:</td>
                        <td>Rp. @money($sewa_ruang->grand_total)</td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>:</td>
                        <td>
                            <div class="col-lg-5 text-right d-flex flex-column">
                            @if($sewa_ruang->payment->status == "pending")
                            <button class="btn bg-gradient-info" id="pay-button">Bayar</button>
                            @elseif($sewa_ruang->payment->status == "success")
                            <button class="btn bg-gradient-success" id="pay-button">Sudah Bayar</button>
                            @elseif($sewa_ruang->payment->status == "failed")
                            <button class="btn bg-gradient-danger" id="pay-button">Gagal</button>
                            @elseif($sewa_ruang->payment->status == "expired")
                            <button class="btn bg-gradient-warning" id="pay-button">Kadaluarsa</button>
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
                                  <td>{{$sewa_ruang->studio->nama}}</td>
                              </tr>
                              <tr>
                                  <td>Gambar</td>
                                  <td> : </td>
                                  <td><img src="{{asset($sewa_ruang->studio->gambar)}}" style="max-width: 70px" class="img-fluid shadow border-radius-xl"></td>
                              </tr>
                              <tr>
                                  <td>Harga</td>
                                  <td> : </td>
                                  <td>{{$sewa_ruang->studio->harga}}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
            </div>

          @push('scripts')
          <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{$client}}"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function(){
                    // SnapToken acquired from previous step
                    snap.pay('{{$sewa_ruang->payment->snap_token}}', {
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
                searchable: false,
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

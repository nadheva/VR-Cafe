<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- Card header -->
              <div class="card-header pb-0">
                <div class="d-lg-flex">
                  <div>
                    <h5 class="mb-0">Studio</h5>
                  </div>
                  <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                      <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog mt-lg-10">
                          <div class="modal-content">
                            <div class="modal-body">
                              <p>You can browse your computer for a file.</p>
                              <input type="text" placeholder="Browse file..." class="form-control mb-3">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="importCheck" checked="">
                                <label class="custom-control-label" for="importCheck">I accept the terms and conditions</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-0">
                <div class="table-responsive">
                  <table class="table table-flush" id="products-list">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>Studio</th>
                        <th>Kode Perangkat</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($ruang as $i)
                      <tr>
                        <td class="text-sm">{{$loop->iteration}}</td>
                        <td>
                          <div class="d-flex">
                            <img class="w-10 ms-3" src="{{asset($i->gambar)}}" alt="{{$i->nama}}">
                            <h6 class="ms-3 my-auto">{{$i->nama}}</h6>
                          </div>
                        </td>
                        <td class="text-sm">{{$i->kode_ruang}}</td>
                        <td class="text-sm">Rp. @money($i->harga) </td>
                        <td class="text-sm">{{$i->jumlah}}</td>
                        @if($i->jumlah == 0)
                        <td>
                          <span class="badge badge-danger badge-sm">Tidak Tersedia</span>
                        </td>
                        @else
                        <td>
                          <span class="badge badge-success badge-sm">Tersedia</span>
                        </td>
                        @endif
                        <td class="text-sm">
                          <a href="{{route('user-ruang.show', $i->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                            <i class="fas fa-eye text-secondary"></i>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No.</th>
                        <th>Product</th>
                        <th>Kode Perangkat</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>


          @push('scripts')
          <script>
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

<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- Card header -->
              <div class="card-header pb-0">
                <div class="d-lg-flex">
                  <div>
                    <h5 class="mb-0">Keranjang</h5>
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
                  <table class="table table-success table-striped" id="datatable-basic">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $i)
                    {{-- @php $total += $i['harga'] * $i['jumlah'] @endphp --}}
                      <tr>
                        <td class="text-sm">{{$loop->iteration}}</td>
                        <td>
                          <div class="d-flex">
                            <img class="w-10 ms-3" src="{{asset($i->perangkat->gambar)}}" alt="{{$i->perangkat->nama}}">
                            <h6 class="ms-3 my-auto">{{$i->perangkat->nama}}</h6>
                          </div>
                        </td>
                        <td class="text-sm">Rp. @money($i->perangkat->harga) </td>
                        <td class="text-sm">{{$i->jumlah}}</td>
                        <td class="text-sm">Rp. @money($i->harga)</td>
                        <td class="text-sm">
                          <a href="{{url('remove-cart', $i->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                            <i class="fas fa-trash text-danger"></i>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>

                  </table>
                  <div>
                    <div class="mx-3" colspan="5" class="text-right"><h5>Total:<span style="align-items: flex-end"><strong> Rp. @money($total)</strong></span></h5></div>
                </div>
                <div>
                    <div class="mx-3" colspan="5" class="text-right">
                        <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Kembali</a>
                        <button class="btn btn-success">Checkout</button>
                    </div>
                </div>
                  {{-- <div>
                    Total: Rp. @money($total)
                   </div>
                   <div>
                     <form action="{{ url('remove-cart') }}" method="POST">
                       @csrf
                       <button class="px-6 py-2 text-red-800 bg-red-300">Remove All Cart</button>
                     </form>
                   </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>


          @push('scripts')
          <script>
            const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: false,
            fixedHeight: true,
            paging: false
            });
          </script>
          @endpush
</x-app-layout>

<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- Card header -->
              <div class="card-header pb-0">
                <div class="center">
                  <div>
                    <h3 class="center" style="text-align: center">Keranjang</h3>
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
                  <table class="table table-striped table-hover" id="datatable-basic">
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
                        @if($i->perangkat->stok >= $i->jumlah)
                        <td class="text-sm">{{$i->jumlah}}</td>
                        @else
                        <td class="text-sm"><span class="badge badge-danger badge-sm">Mohon Cek Stok</span></td>
                        @endif
                        <td class="text-sm">Rp. @money($i->harga)</td>
                        <td class="text-sm">
                            <div>
                                <form id="form-delete" action="{{route('cart.destroy', $i->id)}}" method="POST" style="display: inline">
                                  @csrf
                                  @method("DELETE")
                                  <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0 show_confirm" data-toggle="tooltip" title='Delete' ><i class="fas fa-trash text-secondary"></i></button>
                                </form>
                              </div>
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
                    <div class="text-right" colspan="5" style="display: flex; justify-content: flex-end"><h5>Total:<span style="text-align: right"><strong> Rp. @money($total)</strong></span></h5></div>
                </div>
                <div>
                    <div class="mx-3" colspan="5" class="text-right" style="display: flex; justify-content: flex-end">
                        <a href="{{ route('user-perangkat.index') }}" class="btn btn-warning mx-2"><i class="fa fa-angle-left"></i> Kembali</a>
                        <a href="{{ route('sewa-perangkat.index')}}" class="btn btn-success mx-2">Checkout</a>
                    </div>
                </div>
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
            $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Hapus Data?`,
                text: "Jika data terhapus, data akan hilang selamanya!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                form.submit();
              }
            });
        });
          </script>
          @endpush
</x-app-layout>

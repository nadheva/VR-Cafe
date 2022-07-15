<x-app-layout>
    <div class="row  mt-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex pb-0 p-3">
                    <h6 class="my-auto">Wishlist</h6>
                    <div class="nav-wrapper position-relative ms-auto w-50">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#cam1"
                                    role="tab" aria-controls="cam1" aria-selected="true">
                                    Perangkat VR
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#cam2" role="tab"
                                    aria-controls="cam2" aria-selected="false">
                                    Studio
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
                                                <th>No.</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Gambar</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wishlist->where('studio_id', '=', NULL) as $i)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$loop->iteration}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$i->perangkat->kode_perangkat}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$i->perangkat->nama}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0"><img src="{{ asset( $i->perangkat->gambar) }}" style="max-width: 70px" class="img-fluid shadow border-radius-xl"></p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$i->perangkat->stok}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">Rp. @money($i->perangkat->harga)</p>
                                                    </div>
                                                  </td>
                                                  <td class="text-sm">
                                                    <a href="{{route('user-perangkat.show', encrypt($i->perangkat_id))}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
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
                        <div class="tab-pane fade show position-relative  height-400 border-radius-lg" id="cam2"
                            role="tabpanel" aria-labelledby="cam2">
                            <div class="row mt-4">
                                {{-- <div class="table-responsive"> --}}
                                    <table class="table table-flush" id="datatable-search1">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Gambar</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Resepsionis</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wishlist->where('perangkat_id', '=', NULL) as $s)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$loop->iteration}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$s->studio->kode_studio}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$s->studio->nama}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0"><img src="{{ asset( $s->studio->gambar) }}" style="max-width: 70px" class="img-fluid shadow border-radius-xl"></p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$s->studio->jumlah}}</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">Rp. @money($s->studio->harga)</p>
                                                    </div>
                                                  </td>
                                                  <td>
                                                    <div class="d-flex align-items-center">
                                                      <p class="text-xs font-weight-bold ms-2 mb-0">{{$s->studio->resepsionis->nama}}</p>
                                                    </div>
                                                  </td>
                                                  <td class="text-sm">
                                                    <a href="{{route('user-studio.show', encrypt($s->studio_id))}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                                      <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                  </td>
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


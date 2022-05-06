<x-app-layout>
    <div class="container-fluid py-4">
        <div class="d-sm-flex justify-content-between">
          <div>
            {{-- <a href="javascript:;" class="btn btn-icon bg-gradient-primary">
              New order
            </a> --}}
            <h5>Pengembalian Perangkat VR</h5>
          </div>
          <div class="d-flex">
            <div class="dropdown d-inline">
              {{-- <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                Filters
              </a> --}}
              <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Paid</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Refunded</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Canceled</a></li>
                <li>
                  <hr class="horizontal dark my-2">
                </li>
                {{-- <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a></li> --}}
              </ul>
            </div>
            {{-- <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
              <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
              <span class="btn-inner--text">Export CSV</span>
            </button> --}}
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                    <tr>
                      <th>No.</th>
                      <th>Invoice</th>
                      <th>Penyewa</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Berakhir</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($sewa_perangkat as $i)
                    <tr>
                    <td>
                        <div class="d-flex align-items-center">
                          <p class="text-xs font-weight-bold ms-2 mb-0">{{$loop->iteration}}</p>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <p class="text-xs font-weight-bold ms-2 mb-0">{{$i->invoice}}</p>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <p class="text-xs font-weight-bold ms-2 mb-0">{{$i->user->name}}</p>
                        </div>
                      </td>
                      <td class="font-weight-bold">
                        <span class="my-2 text-xs">{{$i->tanggal_mulai}}</span>
                      </td>
                      <td class="font-weight-bold">
                        <span class="my-2 text-xs">{{$i->tanggal_berakhir}}</span>
                      </td>
                      <td class="text-sm">
                        <a href="{{route('order-perangkat.show', $i->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                          <i class="fas fa-eye text-secondary"></i>
                        </a>
                        <a class="btn btn-link text-dark px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#editPerangkat-{{$i->id}}"><i class="fas fa-user-edit text-secondary"></i></a>
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

    <!-- Modal -->
    @foreach($sewa_perangkat as $i)
    <div class="modal fade" id="editPerangkat-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="editPerangkatLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ url('sewa-perangkat-update', $i->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPerangkatLabel">Verifikasi Pengembalian</h5>
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
                                        <td>{{$i->invoice}}</td>
                                      </tr>
                                      <tr>
                                        <td>Nama Lengkap </td>
                                        <td>:</td>
                                        <td>{{$i->user->profile->nama_depan. " ".$i->user->profile->nama_belakang}}</td>
                                      </tr>
                                      <tr>
                                        <td>No. Telp </td>
                                        <td>:</td>
                                        <td>{{$i->user->profile->no_telp}}</td>
                                      </tr>
                                      <tr>
                                          <td>Alamat </td>
                                          <td>:</td>
                                          <td>{{$i->user->profile->alamat}}</td>
                                      </tr>
                                      <tr>
                                          <td>Total Bayar </td>
                                          <td>:</td>
                                          <td>Rp. @money($i->grand_total)</td>
                                      </tr>
                                      <tr>
                                          <td>Status </td>
                                          <td>:</td>
                                          <td>
                                              <div class="col-lg-5 text-right d-flex flex-column">
                                              @if($i->payment->status == "pending")
                                              <div class="d-flex align-items-center">
                                                  <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-info" aria-hidden="true"></i></button>
                                                  <span>Belum dibayar</span>
                                              </div>
                                              @elseif($i->payment->status == "success")
                                              <div class="d-flex align-items-center">
                                                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                                                  <span>Sudah dibayar</span>
                                              </div>
                                              @elseif($i->payment->status == "failed")
                                              <div class="d-flex align-items-center">
                                                  <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                                                  <span>Gagal</span>
                                              </div>
                                              @elseif($i->payment->status == "expired")
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
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn bg-gradient-primary">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
      @push('scripts')
      <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
          searchable: true,
          fixedHeight: true
        });
      </script>
      @endpush
</x-app-layout>

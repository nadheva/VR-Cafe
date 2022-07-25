<x-app-layout>
    <div class="row  mt-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex pb-0 p-3">
                    <h6 class="my-auto">Transaksi Studio</h6>
                    <div class="nav-wrapper position-relative ms-auto w-50">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#cam1"
                                    role="tab" aria-controls="cam1" aria-selected="true">
                                    Disetujui
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#cam2" role="tab"
                                    aria-controls="cam2" aria-selected="false">
                                    Belum disetujui
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
                                                <th>Invoice</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Bayar</th>
                                                <th>Proses</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sewa_studio->where('approval', '=', '1') as $i)
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
                                                  <td class="font-weight-bold">
                                                    <span class="my-2 text-xs">{{$i->created_at->format('d.m.Y')}}</span>
                                                  </td>
                                                  @if($i->payment->status == 'pending')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-info" aria-hidden="true"></i></button>
                                                      <span>Belum dibayar</span>
                                                    </div>
                                                  </td>
                                                  @elseif($i->payment->status == 'success')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                                                      <span>Sudah dibayar</span>
                                                    </div>
                                                  </td>
                                                  @elseif($i->payment->status == 'failed')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                                                      <span>Gagal</span>
                                                    </div>
                                                  </td>
                                                  @elseif($i->payment->status == 'expired')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-undo" aria-hidden="true"></i></button>
                                                      <span>Kadaluarsa</span>
                                                    </div>
                                                  </td>
                                                  @endif
                                                  <td class="text-xs font-weight-bold">
                                                    <span class="my-2 text-xs">Rp. @money($i->grand_total)</span>
                                                  </td>
                                                  @if($i->proses == 'Disewa')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-info badge-sm">Disewa</span>
                                                  </td>
                                                  @elseif($i->proses == 'Dalam Proses')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-warning badge-sm">Dalam Proses</span>
                                                  </td>
                                                  @elseif($i->proses == 'Ditolak')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-danger badge-sm">Ditolak</span>
                                                  </td>
                                                  @elseif($i->proses == 'Dikembalikan')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-success badge-sm">Dikembalikan</span>
                                                  </td>
                                                  @endif
                                                  <td class="text-sm">
                                                    <a href="{{route('order-studio.show', encrypt($i->id))}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
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
                                                <th>Invoice</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Bayar</th>
                                                <th>Proses</th>
                                                <th>Approval</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sewa_studio->where('approval', '=', '0') as $i)
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
                                                  <td class="font-weight-bold">
                                                    <span class="my-2 text-xs">{{$i->created_at->format('d.m.Y')}}</span>
                                                  </td>
                                                  @if($i->payment->status == 'pending')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-info" aria-hidden="true"></i></button>
                                                      <span>Belum dibayar</span>
                                                    </div>
                                                  </td>
                                                  @elseif($i->payment->status == 'success')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                                                      <span>Sudah dibayar</span>
                                                    </div>
                                                  </td>
                                                  @elseif($i->payment->status == 'failed')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                                                      <span>Gagal</span>
                                                    </div>
                                                  </td>
                                                  @elseif($i->payment->status == 'expired')
                                                  <td class="text-xs font-weight-bold">
                                                    <div class="d-flex align-items-center">
                                                      <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-undo" aria-hidden="true"></i></button>
                                                      <span>Kadaluarsa</span>
                                                    </div>
                                                  </td>
                                                  @endif
                                                  <td class="text-xs font-weight-bold">
                                                    <span class="my-2 text-xs">Rp. @money($i->grand_total)</span>
                                                  </td>
                                                  @if($i->proses == 'Disewa')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-info badge-sm">Disewa</span>
                                                  </td>
                                                  @elseif($i->proses == 'Dalam Proses')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-warning badge-sm">Dalam Proses</span>
                                                  </td>
                                                  @elseif($i->proses == 'Ditolak')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-danger badge-sm">Ditolak</span>
                                                  </td>
                                                  @elseif($i->proses == 'Dikembalikan')
                                                  <td  class="text-xs font-weight-bold">
                                                    <span class="badge badge-success badge-sm">Dikembalikan</span>
                                                  </td>
                                                  @endif
                                                  <td>
                                                    <div class="align-middle text-center">
                                                      <a class="btn btn-link text-dark px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#approval-{{$i->id}}"><i class="fas fa-user-edit text-secondary"></i></a>
                                                    </div>
                                                  </td>
                                                  <td class="text-sm">
                                                    <a href="{{route('order-studio.show', encrypt($i->id))}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
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

        <!-- Modal Edit Perangkat -->
        @foreach($sewa_studio as $i)
        <div class="modal fade" id="approval-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="approvalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahPerangkatLabel">Approval</h5>
                            <div class="nav-wrapper position-relative ms-auto w-50">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#at1"
                                            role="tab" aria-controls="at1" aria-selected="true">
                                            Setuju
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#at2" role="tab"
                                            aria-controls="at2" aria-selected="false">
                                            Tolak
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="tab-pane fade show position-relative  height-400 border-radius-lg" id="at1"
                        role="tabpanel" aria-labelledby="at1">
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
                                            <td>Studio </td>
                                            <td>:</td>
                                            <td>{{$i->studio->nama}}</td>
                                          </tr>
                                          <tr>
                                            <td>Pelanggan </td>
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
                                            <td>Waktu Mulai </td>
                                            <td>:</td>
                                            <td>{{$i->tanggal_mulai}}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Selesai </td>
                                            <td>:</td>
                                            <td>{{$i->tanggal_berakhir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Lama Sewa</td>
                                            <td>:</td>
                                            <td> {{ \Carbon\Carbon::parse($i->tanggal_mulai)->diffInHours(\Carbon\Carbon::parse($i->tangggal_selesai)) }} Jam</td>
                                        </tr>
                                          </tbody>
                                        </table>
                                    </div>
                              </div>
                        </div>

                        <div class="modal-footer">
                            <form method="post" action="{{ route('approve-studio', $i->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn bg-gradient-primary" name="Setuju">Setujui</button>
                        </form>
                        {{-- <form id="form-delete" action="{{route('deny-studio', $i->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method("PUT")
                            <button type="submit" class="btn bg-gradient-danger" name="Tolak">Tolak</button>
                          </form> --}}
                        </div>
                        </div>
                        <div class="tab-pane fade show position-relative  height-400 border-radius-lg" id="at2"
                        role="tabpanel" aria-labelledby="at2">
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
                                            <td>Studio </td>
                                            <td>:</td>
                                            <td>{{$i->studio->nama}}</td>
                                          </tr>
                                          <tr>
                                            <td>Pelanggan </td>
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
                                            <td>Waktu Mulai </td>
                                            <td>:</td>
                                            <td>{{$i->tanggal_mulai}}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Selesai </td>
                                            <td>:</td>
                                            <td>{{$i->tanggal_berakhir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Lama Sewa</td>
                                            <td>:</td>
                                            <td> {{ \Carbon\Carbon::parse($i->tanggal_mulai)->diffInHours(\Carbon\Carbon::parse($i->tangggal_selesai)) }} Jam</td>
                                        </tr>
                                          </tbody>
                                        </table>
                                    </div>
                              </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn bg-gradient-primary" name="Setuju">Setujui</button>
                        </form>
                        <form id="form-delete" action="{{route('deny-studio', $i->id)}}" method="POST" style="display: inline">
                            @csrf
                            @method("PUT")
                            <input type="text" class="form-data" name="alasan_tolak">
                            <button type="submit" class="btn bg-gradient-danger" name="Tolak">Tolak</button>
                          </form>
                        </div>
                </div>
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
        const dataTableSearch1 = new simpleDatatables.DataTable("#datatable-search1", {
            searchable: true,
            fixedHeight: true
        });
    </script>
    @endpush
    </x-app-layout>

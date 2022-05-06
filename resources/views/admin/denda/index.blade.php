<x-app-layout>
    <div class="container-fluid py-4">
        <div class="d-sm-flex justify-content-between">
          <div>
            {{-- <a href="javascript:;" class="btn btn-icon bg-gradient-primary">
              New order
            </a> --}}
            <h5>Denda</h5>
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
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Bayar</th>
                        <th>Jenis</th>
                        <th>Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($denda as $i)
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
                      @if(is_null($i->sewa_perangkat_id))
                      <td  class="text-xs font-weight-bold">
                        <span class="badge badge-dark badge-sm">Studio</span>
                      </td>
                      @elseif(is_null($i->sewa_ruang_id))
                      <td  class="text-xs font-weight-bold">
                        <span class="badge badge-primary badge-sm">Perangkat VR</span>
                      </td>
                      @endif
                      <td class="text-sm">
                        <a href="{{route('denda.show', $i->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
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
      @push('scripts')
      <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
          searchable: true,
          fixedHeight: true
        });
      </script>
      @endpush
</x-app-layout>

<x-app-layout>
    <div class="col-md-12 mb-lg-0 mb-4">
      <div class="card mt-4">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h6 class="mb-0">Data Resepsionis</h6>
            </div>
            @if(Auth::user()->where('role', '=', 'Admin'))
            <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="" data-bs-toggle="modal" data-bs-target="#tambahResepsionis"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Resepsionis</a>
              </div>
            @endif
          </div>
        </div>
        <div class="card">
          <div class="table-responsive">
            <table id="datatable-search" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">E-mail</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telepon</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($resepsionis as $item)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" maxlength="10" >{{ $item->nama }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <img src="{{ asset( $item->foto) }}" style="max-width: 50%" class="img-fluid shadow border-radius-xl">
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $item->no_telp }}</span>
                  </td>
                  <td>
                    <div class="align-middle text-center">
                      <form id="form-delete" action="{{route('resepsionis.destroy', $item->id)}}" method="POST" style="display: inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0 show_confirm" data-toggle="tooltip" title='Delete' ><i class="fas fa-trash text-secondary"></i></button>
                      </form>
                      <a class="btn btn-link text-dark px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#editResepsionis-{{$item->id}}"><i class="fas fa-user-edit text-secondary"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Perangkat -->
    <div class="modal fade" id="tambahResepsionis" tabindex="-1" role="dialog" aria-labelledby="tambahResepsionisLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('resepsionis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPerangkatLabel">Tambah Resepsionis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="nama" placeholder="*Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" name="foto" placeholder="*Foto" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="*Email" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" name="no_telp" placeholder="*Telepon" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Perangkat -->
    @foreach($resepsionis as $i)
    <div class="modal fade" id="editResepsionis-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="editResepsionisLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ url('resepsionis-update', $i->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPerangkatLabel">Edit Resepsionis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="nama" value="{{$i->nama}}">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" name="foto" value="{{asset($i->foto)}}">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">E-mail:</label>
                            <input type="email" class="form-control" name="stok" value="{{$i->email}}">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" name="no_telp" value="{{$i->no_telp}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
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

<x-app-layout>
    @if(Auth::user()->where('role', '=', 'Admin'))
    <div class="col-md-12 mb-lg-0 mb-4">
      <div class="card mt-4">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h6 class="mb-0">Data User</h6>
            </div>
            <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="" data-bs-toggle="modal" data-bs-target="#tambahPerangkat"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah User</a>
              </div>
          </div>
        </div>
        <div class="card">
          <div class="table-responsive">
            <table id="datatable-search" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $item)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" maxlength="10" >{{ $item->name }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $item->role }}</span>
                  </td>
                  <td>
                    <div class="align-middle text-center">
                      <form id="form-delete" action="{{route('user.destroy', $item->id)}}" method="POST" style="display: inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0 show_confirm" data-toggle="tooltip" title='Delete' ><i class="fas fa-trash text-secondary"></i></button>
                      </form>
                      <a class="btn btn-link text-dark px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#editPerangkat-{{$item->id}}"><i class="fas fa-user-edit text-secondary"></i></a>
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
    <div class="modal fade" id="tambahPerangkat" tabindex="-1" role="dialog" aria-labelledby="tambahPerangkatLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPerangkatLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="name" placeholder="*Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">E-mail:</label>
                            <input type="email" class="form-control" name="email" placeholder="*E-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="*Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="col-form-label">Role:</label>
                            <select class="form-control" name="role" id="exampleFormControlSelect1" placeholder="*Role" required>
                            <option value="">--Silahkan Pilih--</option>
                              <option value="admin">admin</option>
                              <option value="user">user</option>
                            </select>
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
    @foreach($user as $i)
    <div class="modal fade" id="editPerangkat-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="editPerangkatLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ url('user-update', $i->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPerangkatLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="name" value="{{$i->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">E-mail:</label>
                            <input type="email" class="form-control" name="email" value="{{$i->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" name="password" value="{{$i->password}}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="col-form-label">Role:</label>
                            <select class="form-control" name="role" id="exampleFormControlSelect1" placeholder="*Role" required>
                            <option value="{{$i->role}}" selected>{{$i->role}}</option>
                              <option value="admin">admin</option>
                              <option value="user">user</option>
                            </select>
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
    @endif

    @if(Auth::user()->where('role', '=', 'user'))

    @endif
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

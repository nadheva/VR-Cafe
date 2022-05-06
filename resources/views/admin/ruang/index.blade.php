<x-app-layout>
    <div class="col-md-12 mb-lg-0 mb-4">
      <div class="card mt-4">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h6 class="mb-0">Data Ruang</h6>
            </div>
            @if(Auth::user()->where('role', '=', 'Admin'))
            <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="" data-bs-toggle="modal" data-bs-target="#tambahRuang"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Ruang</a>
              </div>
            @endif
          </div>
        </div>
        <div class="card">
          <div class="table-responsive">
            <table id="datatable-search" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Resepsionis</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                  @if(Auth::user()->where('role', '=', 'Admin'))
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($ruang as $item)
                <tr>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" >{{ $item->kode_ruang }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" maxlength="10" >{{ $item->nama }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <img src="{{ asset( $item->gambar) }}" style="max-width: 70px" class="img-fluid shadow border-radius-xl">
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">Rp. @money($item->harga)</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{$item->jumlah}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $item->resepsionis->nama }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold" style="display:block;text-overflow: ellipsis;width: 200px;overflow: hidden; white-space: nowrap;">{!! $item->deskripsi !!}</span>
                  </td>
                  @if(Auth::user()->where('role', '=', 'Admin'))
                  <td>
                    <div class="align-middle text-center">
                      <form id="form-delete" action="{{route('ruang.destroy', $item->id)}}" method="POST" style="display: inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0 show_confirm" data-toggle="tooltip" title='Delete' ><i class="fas fa-trash text-secondary"></i></button>
                      </form>
                      <a class="btn btn-link text-dark px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#editRuang-{{$item->id}}"><i class="fas fa-user-edit text-secondary"></i></a>
                    </div>
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Perangkat -->
    <div class="modal fade" id="tambahRuang" tabindex="-1" role="dialog" aria-labelledby="tambahRuangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('ruang.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahRuangLabel">Tambah Ruang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Kode Ruang:</label>
                            <input type="number" class="form-control" name="kode_ruang" placeholder="4 Digit" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Ruang:</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Gambar:</label>
                            <input type="file" class="form-control" name="gambar" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Gambar Detail:</label>
                            <input type="file" class="form-control" name="gambar_detail[]" multiple required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Banner:</label>
                            <input type="file" class="form-control" name="banner" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="col-form-label">Resepsionis</label>
                            <select class="form-control" name="resepsionis_id" id="exampleFormControlSelect1" required>
                              @foreach ($resepsionis as $item)
                              <option value="{{$item->id}}">{{$item->nama}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Harga:</label>
                            <input type="number" class="form-control" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Jumlah:</label>
                            <input type="number" class="form-control" name="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Ukuran:</label>
                            <input type="number" class="form-control" name="ukuran" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Monitor:</label>
                            <input type="number" class="form-control" name="monitor" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Perangkat VR:</label>
                            <input type="number" class="form-control" name="perangkat_vr" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">PC Desktop:</label>
                            <input type="number" class="form-control" name="pc_desktop" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Deskripsi:</label>
                            <textarea class="form-control" name="deskripsi" id="mytextarea" required></textarea>
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
    @foreach($ruang as $i)
    <div class="modal fade" id="editRuang-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="editRuangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ url('ruang-update', $i->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahRuangLabel">Edit Ruang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Kode Ruang:</label>
                          <input type="number" class="form-control" name="kode_ruang" value="{{$i->kode_ruang}}" placeholder="4 Digit" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Ruang:</label>
                            <input type="text" class="form-control" name="nama" value="{{$i->nama}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Gambar:</label>
                            <input type="file" class="form-control" name="gambar" value="{{asset($i->gambar)}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Gambar Detail:</label>
                            <input type="file" class="form-control" name="gambar_detail[]" value="{{asset($i->gambar_detail)}}" multiple required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Banner:</label>
                            <input type="file" class="form-control" name="banner" value="{{asset($i->banner)}}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="col-form-label">Resepsionis</label>
                            <select class="form-control" name="resepsionis_id" id="exampleFormControlSelect1" required>
                              @foreach ($resepsionis as $item)
                              <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Harga:</label>
                            <input type="number" class="form-control" name="harga" value="{{$i->harga}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Jumlah:</label>
                            <input type="number" class="form-control" name="jumlah" value="{{$i->jumlah}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Ukuran:</label>
                            <input type="number" class="form-control" name="ukuran" value="{{$i->ukuran}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Monitor:</label>
                            <input type="number" class="form-control" name="monitor" value="{{$i->monitor}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Perangkat VR:</label>
                            <input type="number" class="form-control" name="perangkat_vr" value="{{$i->perangkat_vr}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">PC Desktop:</label>
                            <input type="number" class="form-control" name="pc_desktop" value="{{$i->pc_desktop}}" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Deskripsi:</label>
                            <textarea class="form-control" name="deskripsi" id="mytextarea" value="{{$i->deskripsi}}" required>{{$i->deskripsi}}</textarea>
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

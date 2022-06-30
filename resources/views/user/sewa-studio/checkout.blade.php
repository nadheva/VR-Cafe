
    <x-app-layout>
        <div class="container-fluid py-4">
            <div class="row">
              <div class="col-12">
                <div class="multisteps-form mb-5">
                  <!--progress bar-->
                  <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                      <div class="multisteps-form__progress">
                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                          <span>Info Pesanan</span>
                        </button>
                        <button class="multisteps-form__progress-btn" type="button" title="Address">Detail Pesanan</button>
                        {{-- <button class="multisteps-form__progress-btn" type="button" title="Socials">Pembayaran</button> --}}
                      </div>
                    </div>
                  </div>
                  <!--form panels-->
                  <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                      <form class="multisteps-form__form mb-8" action="{{route('sewa-studio.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any()){
                        @php
                        return redirect()->back();
                        @endphp
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        }
                        @endif
                        <!--single form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                          <h5 class="font-weight-bolder mb-0">Rincian</h5>
                          {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                          <div class="multisteps-form__content">
                              <input type="hidden" name="studio_id" value="{{$studio->id}}">
                            <div class="row mt-3">
                              <div class="col-12 col-sm-6">
                                <label>Nama Pemesan</label>
                                <input class="multisteps-form__input form-control" type="text" value="{{$profil->nama_depan." ".$profil->nama_belakang}}" disabled/>
                              </div>
                              <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>Nomor Telepon</label>
                                <input class="multisteps-form__input form-control" type="text" value="{{$profil->no_telp}}" disabled/>
                              </div>
                            </div>
                            {{-- <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                  <label>Tanggal Mulai</label>
                                  <input class="form-control datetimepicker2" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)" name="tanggal_mulai" id="date1">
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                  <label>Tanggal Akhir</label>
                                  <input class="form-control datetimepicker2" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)" name="tanggal_berakhir" id="date2">
                                </div>
                              </div> --}}
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                  <label>Waktu Mulai</label>
                                  <input class="form-control" type="datetime-local" name="tanggal_mulai" id="date1" placeholder="*Waktu Mulai" required>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                  <label>Waktu Akhir</label>
                                  <input class="form-control" type="datetime-local" name="tanggal_berakhir" id="date2" placeholder="*Waktu Akhir" required>
                                </div>
                              </div>
                            <div class="row mt-3">
                              <div>
                                <label>Keperluan</label>
                                <textarea class="multisteps-form__input form-control" name="keperluan" id="mytextarea" placeholder="*Keperluan" required></textarea>
                              </div>
                            </div>
                            <div class="button-row d-flex mt-4">
                              <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Selanjutnya">Selanjutnya</button>
                            </div>
                          </div>
                        </div>
                        <!--single form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                          <h5 class="font-weight-bolder">Rincian</h5>
                          <div class="multisteps-form__content">
                            <div class="row mt-3">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="datatable-basic">
                                      <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td> : </td>
                                            <td>{{$studio->nama}}</td>
                                        </tr>
                                        <tr>
                                            <td>Gambar</td>
                                            <td> : </td>
                                            <td><img src="{{asset($studio->gambar)}}" style="max-width: 70px" class="img-fluid shadow border-radius-xl"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td> : </td>
                                            <td>{{$studio->harga}}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                            </div>
                            <div class="button-row d-flex mt-4">
                              <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Sebelumnya">Sebelumnya</button>
                              <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Simpan">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </form>
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
            if (document.querySelector('.datetimepicker')) {
                flatpickr('.datetimepicker', {
                    allowInput: true
                }); // flatpickr
            }
            </script>
        @endpush
    </x-app-layout>

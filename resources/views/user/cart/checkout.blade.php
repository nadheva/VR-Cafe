
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
                      <form class="multisteps-form__form mb-8" action="{{route('sewa-perangkat.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--single form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                          <h5 class="font-weight-bolder mb-0">Rincian</h5>
                          {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                          <div class="multisteps-form__content">
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
                            <div class="row mt-3">
                              <div class="col-12 col-sm-6">
                                <label>Tanggal Mulai</label>
                                <input class="form-control datetimepicker" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)" name="tanggal_mulai" id="date1" required>
                              </div>
                              <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>Tanggal Akhir</label>
                                <input class="form-control datetimepicker" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)" name="tanggal_berakhir" id="date2" required>
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div>
                                <label>Keperluan</label>
                                <textarea class="multisteps-form__input form-control" name="keperluan" id="mytextarea" required></textarea>
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
                                      <thead class="thead-light">
                                        <tr>
                                          <th>No.</th>
                                          <th>Nama</th>
                                          <th>Harga</th>
                                          <th>Jumlah</th>
                                          <th>Subtotal</th>
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
                                        </tr>
                                      </tfoot>
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

            function getNumberOfDays(tanggal_mulai, tanggal_berakhir) {
                const date1 = new Date(tanggal_mulai);
                const date2 = new Date(tanggal_berakhir);

                // One day in milliseconds
                const oneDay = 1000 * 60 * 60 * 24;

                // Calculating the time difference between two dates
                const diffInTime = date2.getTime() - date1.getTime();

                // Calculating the no. of days between two dates
                const diffInDays = Math.round(diffInTime / oneDay);

                return diffInDays;
            }
                $('.grand-total').on('change', function(){
                    var total = "<?php echo $total ?>";
                    console.log(getNumberOfDays(tanggal_mulai, tanggal_berakhir) * total);
                });
            </script>
        @endpush
    </x-app-layout>

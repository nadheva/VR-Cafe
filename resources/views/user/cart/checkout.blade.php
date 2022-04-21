
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
                        <button class="multisteps-form__progress-btn" type="button" title="Socials">Pembayaran</button>
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
                                <input class="multisteps-form__input form-control" type="text" name="nama_depan"/>
                              </div>
                              <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>Nomor Telepon</label>
                                <input class="multisteps-form__input form-control" type="text" name="nama_belakang" />
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-12 col-sm-6">
                                <label>Tanggal Mulai</label>
                                <input class="form-control datetimepicker" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)" name="tanggal_mulai">
                              </div>
                              <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                <label>Tanggal Akhir</label>
                                <input class="form-control datetimepicker" placeholder="Please select date" type="date" onfocus="focused(this)" onfocusout="defocused(this)" name="tanggal_berakhir">
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-12 col-sm-6">
                                <label>Keperluan</label>
                                <textarea class="multisteps-form__input form-control" name="keperluan" id="mytextarea"></textarea>
                              </div>
                            </div>
                            <div class="button-row d-flex mt-4">
                              <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Selanjutnya">Selanjutnya</button>
                            </div>
                          </div>
                        </div>
                        <!--single form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                          <h5 class="font-weight-bolder">Alamat</h5>
                          <div class="multisteps-form__content">
                            <div class="row mt-3">
                              <div class="col">
                                <label>Alamat</label>
                                <input class="multisteps-form__input form-control" type="text" name="alamat" placeholder="eg. Street 221" />
                              </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-12 col-sm-6">
                                <label>Kota</label>
                                <input class="multisteps-form__input form-control" type="text" name="kota" placeholder="eg. Tokyo" />
                              </div>
                              <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                <label>Provinsi</label>
                                <input class="multisteps-form__input form-control" type="text" name="provinsi" placeholder="eg. Jawa" />
                              </div>
                              <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                <label>Kode Pos</label>
                                <input class="multisteps-form__input form-control" type="number" name="kode_pos" placeholder="eg. 98765" />
                              </div>
                            </div>
                            <div class="button-row d-flex mt-4">
                              <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Sebelumnya">Sebelumnya</button>
                              <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Selanjutnya">Selanjutnya</button>
                            </div>
                          </div>
                        </div>
                        <!--single form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                          <h5 class="font-weight-bolder">Media Sosial</h5>
                          <div class="multisteps-form__content">
                            <div class="row mt-3">
                              <div class="col-12 mt-3">
                                <label>Facebook</label>
                                <input class="multisteps-form__input form-control" type="text" name="facebook" placeholder="https://..." />
                              </div>
                              <div class="col-12 mt-3">
                                <label>Instagram</label>
                                <input class="multisteps-form__input form-control" type="text" name="instagram" placeholder="https://..." />
                              </div>
                            </div>
                            <div class="row">
                              <div class="button-row d-flex mt-4 col-12">
                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Sebelumnya">Sebelumnya</button>
                                <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Simpan">Simpan</button>
                              </div>
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
            if (document.querySelector('.datetimepicker')) {
                flatpickr('.datetimepicker', {
                    allowInput: true
                }); // flatpickr
            }
            </script>
        @endpush
    </x-app-layout>

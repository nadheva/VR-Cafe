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
                      <span>Info Pengguna</span>
                    </button>
                    <button class="multisteps-form__progress-btn" type="button" title="Address">Alamat</button>
                    <button class="multisteps-form__progress-btn" type="button" title="Socials">Media Sosial</button>
                    {{-- <button class="multisteps-form__progress-btn" type="button" title="Profile">Profil</button> --}}
                  </div>
                </div>
              </div>
              <!--form panels-->
              <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                  <form class="multisteps-form__form mb-8" action="{{route('profil.update', $profil->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                      <h5 class="font-weight-bolder mb-0">Tentang Saya</h5>
                      {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                      <div class="multisteps-form__content">
                        <div class="row mt-3">
                          <div class="col-12 col-sm-6">
                            <label>Nama Depan</label>
                            <input class="multisteps-form__input form-control" type="text" name="nama_depan" value="{{$profil->nama_depan}}"/>
                          </div>
                          <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>Nama Belakang</label>
                            <input class="multisteps-form__input form-control" type="text" name="nama_belakang" value="{{$profil->nama_belakang}}" />
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12 col-sm-6">
                            <label>NIK</label>
                            <input class="multisteps-form__input form-control" type="number" name="nik" value="{{$profil->nik}}"/>
                          </div>
                          <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>Email</label>
                            <input class="multisteps-form__input form-control" type="email" value="{{$email}}" disabled />
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12 col-sm-6">
                            <label>Nomor Telepon</label>
                            <input class="multisteps-form__input form-control" type="number" name="no_telp" value="{{$profil->no_telp}}"/>
                          </div>
                          <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <label>Foto</label>
                            <input class="multisteps-form__input form-control" type="file" name="foto" value="{{$profil->foto}}"/>
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
                            <input class="multisteps-form__input form-control" type="text" name="alamat" value="{{$profil->alamat}}" />
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-12 col-sm-6">
                            <label>Kota</label>
                            <input class="multisteps-form__input form-control" type="text" name="kota" value="{{$profil->kota}}" />
                          </div>
                          <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                            <label>Provinsi</label>
                            <input class="multisteps-form__input form-control" type="text" name="provinsi" value="{{$profil->provinsi}}" />
                          </div>
                          <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                            <label>Kode Pos</label>
                            <input class="multisteps-form__input form-control" type="number" name="kode_pos" value="{{$profil->kode_pos}}" />
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
                            <input class="multisteps-form__input form-control" type="text" name="facebook" value="{{$profil->facebook}}" />
                          </div>
                          <div class="col-12 mt-3">
                            <label>Instagram</label>
                            <input class="multisteps-form__input form-control" type="text" name="instagram" value="{{$profil->instagram}}" />
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
</x-app-layout>

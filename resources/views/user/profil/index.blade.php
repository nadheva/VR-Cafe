<x-app-layout>
    <div class="container-fluid py-4">
        @if(!$profil)
        <div class="row">
          <div class="col-lg-6">
            <h4>Data Profil</h4>
            <p>Anda belum mengisi data profil, silahkan isi terlebih dahulu!.</p>
          </div>
          <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
            <a class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" href="{{route('profil.create')}}">Isi</a>
          </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-6">
              <h4>Data Profil</h4>
              {{-- <p>Anda belum mengisi data profil, silahkan isi terlebih dahulu!.</p> --}}
            </div>
            <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
              <a class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" href="{{route('profil.edit', $profil->id)}}">Edit</a>
            </div>
          </div>
        <div class="row mt-4">
          <div class="col-lg-4">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="font-weight-bolder">Foto Profil</h5>
                <div class="row">
                  <div class="col-12">
                    <img class="w-100 border-radius-lg shadow-lg mt-3" src="{{asset($profil->foto)}}" alt="">
                  </div>
                  {{-- <div class="col-12 mt-4">
                    <div class="d-flex">
                      <button class="btn bg-gradient-primary btn-sm mb-0 me-2" type="button" name="button">Edit</button>
                      <button class="btn btn-outline-dark btn-sm mb-0" type="button" name="button">Remove</button>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 mt-lg-0 mt-4">
            <div class="card">
              <div class="card-body">
                <h5 class="font-weight-bolder">Informasi Profil</h5>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label>Nama Lengkap</label>
                    <input class="form-control" type="text" value="{{$profil->nama_depan." ".$profil->nama_belakang}}" disabled/>
                  </div>
                  <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                    <label>NIK</label>
                    <input class="form-control" type="text" value="{{$profil->nik}}" disabled/>
                  </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Email</label>
                        <input class="form-control" type="text" value="{{$profil->user->email}}" disabled/>
                    </div>
                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                        <label>Telepon</label>
                        <input class="form-control" type="text" value="{{$profil->no_telp}}" disabled/>
                    </div>
                  </div>
              </div>
            </div>
            <div class="card">
                <div class="card-body">
                  <div class="row">
                    <h5 class="font-weight-bolder">Alamat</h5>
                    <div class="row mt-3">
                      <div class="col">
                        <label>Alamat</label>
                        <input class="multisteps-form__input form-control" type="text" value="{{$profil->alamat}}" disabled/>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-12 col-sm-6">
                        <label>Kota</label>
                        <input class="multisteps-form__input form-control" type="text" value="{{$profil->kota}}" disabled/>
                      </div>
                      <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                        <label>Provinsi</label>
                        <input class="multisteps-form__input form-control" type="text" value="{{$profil->provinsi}}" disabled/>
                      </div>
                      <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                        <label>Kode Pos</label>
                        <input class="multisteps-form__input form-control" type="number" value="{{$profil->kode_pos}}" disabled />
                      </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="font-weight-bolder">Media Sosial</h5>
                <label class="mt-4">Facebook</label>
                <input class="form-control" type="text" value="{{$profil->facebook}}" disabled/>
                <label class="mt-4">Instagram</label>
                <input class="form-control" type="text" value="{{$profil->instagram}}" disabled/>
              </div>
            </div>
          </div>
          <div class="col-sm-8 mt-sm-0 mt-4">

          </div>
        </div>
        @endif
     </div>
        </div>
</x-app-layout>

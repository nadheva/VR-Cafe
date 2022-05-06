@include('admin.partials.head')
<main class="main-content max-height-vh-100 h-100">
    <div class="container-fluid my-3 py-3">
      <div class="row">
        <div class="col-md-8 col-sm-10 mx-auto">
          <form class="" action="index.html" method="post">
            <div class="card my-sm-5">
              <div class="card-header text-center">
                <div class="row justify-content-between">
                  <div class="col-md-4 text-start">
                    <img class="mb-2 w-25 p-2 h-200" src="{{ asset('tuser/assets/img/favicon.png') }}" alt="Logo">
                    <h6>
                        VR & Streaming Cafe<br>
                        Jl. Radio IV No.8B Barito Kebayoran Baru,<br>
                        Jakarta Selatan
                    </h6>
                    <p class="d-block text-secondary">tel: +6295735691018</p>
                  </div>
                  <div class="col-lg-3 col-md-7 text-md-end text-start mt-5">
                    <h6 class="d-block mt-2 mb-0">Ditagih ke: {{$sewa_perangkat->user->profile->nama_depan. " ".$sewa_perangkat->user->profile->nama_belakang}}</h6>
                    <p class="text-secondary">{{$sewa_perangkat->user->profile->alamat}}<br>
                        {{$sewa_perangkat->user->profile->kota}}<br>
                        {{$sewa_perangkat->user->profile->provinsi.", ".$sewa_perangkat->user->profile->kode_pos}}
                    </p>
                  </div>
                </div>
                <br>
                <div class="row justify-content-md-between">
                  <div class="col-md-4 mt-auto">
                    <h6 class="mb-0 text-start text-secondary">
                      Invoice:
                    </h6>
                    <h5 class="text-start mb-0">
                      {{$sewa_perangkat->invoice}}
                    </h5>
                  </div>
                  <div class="col-lg-5 col-md-7 mt-auto">
                    <div class="row mt-md-5 mt-4 text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">Tanggal Invoice:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">{{$sewa_perangkat->created_at->format('d.m.Y')}}</h6>
                      </div>
                    </div>
                    {{-- <div class="row text-md-end text-start">
                      <div class="col-md-6">
                        <h6 class="text-secondary mb-0">Due date:</h6>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-dark mb-0">11/03/2019</h6>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                            <table class="table text-right">
                                <thead class="bg-default">
                                    <tr>
                                      <th scope="col" class="pe-2 text-start ps-2">No.</th>
                                      <th scope="col" class="pe-2">Nama</th>
                                      <th scope="col" class="pe-2" >Harga</th>
                                      <th scope="col" class="pe-2">Jumlah</th>
                                      <th scope="col" class="pe-2">Lama Sewa</th>
                                      <th scope="col" class="pe-2">Subtotal</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                @foreach($sewa_perangkat->order as $i)
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td class="text-start">
                                  <div class="d-flex">
                                      <img class="w-10 ms-3" src="{{asset($i->perangkat->gambar)}}" alt="{{$i->perangkat->nama}}">
                                      <h6 class="ms-3 my-auto">{{$i->perangkat->nama}}</h6>
                                    </div>
                                  </td>
                                  <td class="ps-4">Rp. @money($i->perangkat->harga)</td>
                                  <td class="ps-4">{{$i->jumlah}}</td>
                                  <td class="ps-4">{{$hari}} Hari</td>
                                  <td class="ps-4">Rp. @money($i->harga)</td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th class="h5 ps-4" colspan="2">Grand Total</th>
                                      <th colspan="1" class="text-right h5 ps-4">{{$sewa_perangkat->payment->grand_total}}</th>
                                    </tr>
                                  </tfoot>
                              </table>
                        </div>
                      </div>
                      </div>
                    </div>
              <div class="card-footer mt-md-5 mt-4">
                <div class="row">
                  <div class="col-lg-5 text-left">
                    <h5>Terima kasih!</h5>
                    <p class="text-secondary text-sm">Jika Anda mengalami masalah terkait invoice, Anda dapat menghubungi kami di:</p>
                    <h6 class="text-secondary mb-0">
                      email:
                      <span class="text-dark">vrcafe.business@gmail.com</span>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</main>

<script>window.print()</script>
@include('admin.partials.scripts')

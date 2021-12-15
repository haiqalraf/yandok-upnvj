@extends('layouts.app')

@section('content')

  @php
  $adminTitle = auth()
      ->user()
      ->adminTitle();
  @endphp

  <form
    action="{{ route($adminTitle . '.surat.detail', [
    'surat' => $surat,
    'status' => $surat->verifikasi + 1,]) }}"
    method="post">
    @csrf
    @method("PUT")
    <div class="container mt-3 mb-5">
      <h4 class="font-weight-bolder mb-5">Pemesanan Surat <span style="border-left: 2px solid #000;"></span> <span
          class="font-weight-lighter pl-2 ">
          {{$surat->titleStatus()}}
        </span>
      </h4>
      <div class="row mb-5">
        <div class="col p-3 bg-white rounded shadow">
          <div class="d-flex justify-content-end">
            <a href="{{url()->previous()}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
          </div>
          <h3>Detail Pesanan</h3>
          <hr>
          <table class="table table-bordered table-md table-responsive-sm">
            <thead class="text-white" style="background-color: #06750F;">
                <tr>
                    <th>Kode Pemesanan</th>
                    <th>{{strtoupper($surat->id)}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>Nama Pemesan</td>
                  <td>{{$user->name}}</td>
                </tr>
                <tr>
                  <td>NIM Pemesan</td>
                  <td>{{$user->nim}}</td>
                </tr>
                <tr>
                  <td>Tahun Lulus</td>
                  <td>{{$user->thn_lulus}}</td>
                </tr>
                <tr>
                  <td>Fakultas</td>
                  <td>{{$user->faculty->nama}}</td>
                </tr>
                <tr>
                  <td>Tanggal Pemesanan</td>
                  <td>{{$surat->created_at->locale('id')->isoFormat('LL');}}</td>
                </tr>
                <tr>
                    <td>Detail Status</td>
                  @if ($surat->verifikasi == 0)
                    @if ($surat->komentar)
                    <td>{{$surat->komentar}}</td>
                    @else
                    <td>Dokumen yang diunggah tidak sesuai persyaratan. Harap di cek lagi dengan teliti dan lakukan pesanan ulang</td>
                    @endif
                  @elseif ($surat->verifikasi == 1)
                      <td>Pesanan perlu ditinjau</td>
                  @elseif ($surat->verifikasi == 2)
                      <td>Masih dalam peninjauan</td>
                  @elseif($surat->verifikasi == 3)
                    @if ($surat->raw_tujuan == 1)
                      <td>Sudah Selesai</td>
                    @elseif($surat->verifikasi_pengiriman == 1)
                      <td>Pesanan selesai, menunggu pengiriman Bukti Pembayaran</td>
                    @elseif($surat->verifikasi_pengiriman == 2)
                      <td>Bukti Pembayaran telah dikirim. Bukti pembayaran dapat dilihat 
                        <a href="#" data-toggle="modal" data-target="#buktiModal">
                          Di Sini
                        </a>.
                      </td>
                      <div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row row-cols-2">
                                <div class="col">Nama Bank</div>
                                <div class="col">: {{$surat->buktiBayar->bank}}</div>
                                <div class="col">Nomor Rekening</div>
                                <div class="col">: {{$surat->buktiBayar->norek}}</div>
                                <div class="col">Nama Pemilik Rekening</div>
                                <div class="col">: {{$surat->buktiBayar->owner}}</div>
                                <div class="col">Jumlah Dikirimkan</div>
                                <div class="col">: {{$surat->buktiBayar->jml_bayar}}</div>
                                <div class="col">Tanggal Pembayaran</div>
                                <div class="col">: {{$surat->buktiBayar->tgl_bayar->locale('id')->isoFormat('LL')}}</div>
                              </div>
                              <div class="row">
                                <div class="col-12">Bukti Pembayaran:</div>
                                <img class="col-12 w-100" src="{{route($adminTitle.'.download', ['filePath' => 'bukti_bayar/' . $surat->buktiBayar->bukti_bayar,])}}" alt="bukti_bayar">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @elseif($surat->verifikasi_pengiriman == 3)
                      <td>Pesanan Telah Dikirim dengan resi <span class="text-info">Dummy</span></td>
                    @elseif($surat->verifikasi_pengiriman == 4)
                      <td>Pesanan Telah Diterima dengan resi <span class="text-info">Dummy</span></td>
                    @endif
                  @endif
                </tr>
            </tbody>
          </table>

          <table class="table table-bordered" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
              <tr>
                @php
                  $x=1
                @endphp
                <th>No.</th>
                <th>Daftar Pesanan</th>
                <th>Jumlah </th>
                @if (in_array($surat->verifikasi, [0]))
                <th>Catatan Penolakan</th>
                @endif
                <th>Persyaratan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($daftar_pesanan as $key => $item)
                <tr>
                  <td class="text-center align-middle">{{ $x++ }}</td>
                  <td>{{ $key }}</td>
                  <td class="text-center">{{ $item }}</td>
                  @if ($surat->verifikasi==0)
                  <td>{{ $surat->komentar ? $surat->komentar : 'Tidak ada Catatan' }}</td>
                  @endif
                    <td class="align-middle text-center" style="font-size: 15px;">
                      <div class="d-flex justify-content-center">
                        <ol type="number" class="text-left" style="font-size: 13px;">
                          @foreach ($surat->documentRequirement($key) as $requirement)
                            <li>{{$requirement}}</li>
                          @endforeach
                        </ol>
                      </div>
                      <br>
                      @if (strpos($key, 'Pengganti'))
                        @isset($surat->file[1][Str::slug($key, '')])
                          <a href="{{ route($adminTitle.'.download', ['filePath' => 'suket/' . $surat->file[1][Str::slug($key, '')],]) }}"
                            class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                        @endisset
                      @elseif (strpos($key, 'Perubahan')||strpos($key, 'Ralat'))
                        @isset($surat->file[2][Str::slug($key, '')])
                          <a href="{{ route($adminTitle.'.download', ['filePath' => 'suket/' . $surat->file[2][Str::slug($key, '')],]) }}"
                            class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                        @endisset
                      @elseif (strpos($key, 'Alumni'))
                        @isset($surat->file[3][Str::slug($key, '')])
                          <a href="{{ route($adminTitle.'.download', ['filePath' => 'suket/' . $surat->file[3][Str::slug($key, '')],]) }}"
                            class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                        @endisset
                      @endif
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-end">
        @if ($surat->verifikasi == 1)
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">
          Tolak
        </button>
        <button type="submit" class="btn btn-sm btn-success pull-right">
          Proses
        </button>
        @elseif ($surat->verifikasi == 2)
          @if ($surat->raw_tujuan==2)
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pembayaranModal">
              Tetapkan Biaya Pengiriman
            </button>
            <!-- Modal -->
            <div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="pembayaranModalLabel">Biaya Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="biaya">Tetapkan Biaya Pengiriman untuk Pesanan Surat ini</label>
                      <input type="number" class="form-control" id="biaya" name="biaya" min="0">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                  </div>
                </div>
              </div>
            </div>
          @else
            <button type="submit" class="btn btn-sm btn-success pull-right">
              Selesai
            </button>
          @endif
        @elseif($surat->verifikasi == 3 && $surat->verifikasi_pengiriman == 2)
          <button type="button" data-toggle="modal" data-target="#pengirimanModal" class="btn btn-sm btn-success pull-right">
            Kirim Pesanan
          </button>
        @endif
    </div>
  </div>
</form>

@if ($surat->verifikasi == 3 && $surat->verifikasi_pengiriman == 2)
<!-- Modal -->
<div class="modal fade" id="pengirimanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ route($adminTitle.'.kiriman.surat', ['surat' => $surat, 'status' => 3]) }}" method="post"
    class="modal-dialog">
    @csrf
    @method('PUT')
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pesanan akan dikirim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="formresi">Masukkan resi pengiriman</label>
          <input class="form-control" id="formresi" name="resi">
        </div>
        <p>Pilihan tidak dapat diubah. Yakin dengan pilihan Anda? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Yakin</button>
      </div>
    </div>
  </form>
</div>
@endif

      </div>
    </div>
  </form>
    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route($adminTitle.'.surat.detail', ['surat' => $surat, 'status' => 0]) }}" method="post"
      class="modal-dialog">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Batalkan Pesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="formtolak">Berikan Alasan Penolakan</label>
            <textarea class="form-control" id="formtolak" rows="3" name="komentar"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Yakin</button>
        </div>
      </div>
    </form>
  </div>
  <br />
  <br />
  <br />
  <br />
  <br />
@endsection
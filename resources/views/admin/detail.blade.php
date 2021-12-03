@extends('layouts.app')

@section('content')

@php
    $adminTitle = auth()->user()->adminTitle()
@endphp

<form action="{{ route($adminTitle.'.'.$type.'.detail', [
  $type => $pesanan,
  'status' => $pesanan->verifikasi+1]) }}"
  method="post">
  @csrf
  @method("PUT")
  <div class="container mt-3 mb-5">
    <h4 class="font-weight-bolder mb-5">Pemesanan {{Str::title($type)}} <span style="border-left: 2px solid #000;"></span> <span
        class="font-weight-lighter pl-2 ">
        {{$pesanan->titleStatus()}}
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
                  <th>{{strtoupper($pesanan->id)}}</th>
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
                <td>{{$pesanan->created_at->locale('id')->isoFormat('LLL');}}</td>
              </tr>
              <tr>
                <td>Tanggal Selesai</td>
                <td>{{$pesanan->completed_at ? $pesanan->completed_at->locale('id')->isoFormat('LLL') : '-'}}</td>
              </tr>
              <tr>
                <td>Tanggal Dikirim</td>
                <td>{{$pesanan->sent_at ? $pesanan->sent_at->locale('id')->isoFormat('LLL') : '-'}}</td>
              </tr>
              <tr>
                <td>Tanggal Diterima</td>
                <td>{{$pesanan->accepted_at ? $pesanan->accepted_at->locale('id')->isoFormat('LLL') : '-'}}</td>
              </tr>
              <tr>
                  <td>Detail Status</td>
                  @if ($pesanan->verifikasi == 0)
                    @if ($pesanan->komentar)
                    <td>{{$pesanan->komentar}}</td>
                    @else
                    <td>Dokumen yang diunggah tidak sesuai persyaratan. Harap di cek lagi dengan teliti dan lakukan pesanan ulang</td>
                    @endif
                  @elseif ($pesanan->verifikasi == 1)
                      <td>Pesanan perlu ditinjau</td>
                  @elseif ($pesanan->verifikasi == 2)
                      <td>Masih dalam peninjauan</td>
                  @elseif($pesanan->verifikasi == 3)
                    @if ($pesanan->raw_tujuan == 1)
                      <td>Sudah Selesai</td>
                    @elseif($pesanan->verifikasi_pengiriman == 1)
                      <td>Pesanan selesai, menunggu pengiriman Bukti Pembayaran</td>
                    @elseif($pesanan->verifikasi_pengiriman == 2)
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
                                <div class="col">: {{$pesanan->buktiBayar->bank}}</div>
                                <div class="col">Nomor Rekening</div>
                                <div class="col">: {{$pesanan->buktiBayar->norek}}</div>
                                <div class="col">Nama Pemilik Rekening</div>
                                <div class="col">: {{$pesanan->buktiBayar->owner}}</div>
                                <div class="col">Jumlah Dikirimkan</div>
                                <div class="col">: {{$pesanan->buktiBayar->jml_bayar}}</div>
                                <div class="col">Tanggal Pembayaran</div>
                                <div class="col">: {{$pesanan->buktiBayar->tgl_bayar->locale('id')->isoFormat('LL')}}</div>
                              </div>
                              <div class="row">
                                <div class="col-12">Bukti Pembayaran:</div>
                                <img class="col-12 w-100" src="{{route($adminTitle.'.download', ['filePath' => 'bukti_bayar/' . $pesanan->buktiBayar->bukti_bayar,])}}" alt="bukti_bayar">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @elseif($pesanan->verifikasi_pengiriman == 3)
                      <td>Pesanan Telah Dikirim dengan resi <span class="text-info">{{$pesanan->resi}}</span></td>
                    @elseif($pesanan->verifikasi_pengiriman == 4)
                      <td>Pesanan Telah Diterima dengan resi <span class="text-info">{{$pesanan->resi}}</span></td>
                    @endif
                  @endif
              </tr>
          </tbody>
        </table>

        @include('admin.partials.'.$type)
        
      </div>
    </div>

    @if ($type==="legalisir")
    <div class="row">
      <div class="col bg-white rounded shadow" style="border-left: 20px solid #ecd714; border-radius: 8px;">
        <h6 class="text-left mt-2">Informasi Tambahan</h6>
        <hr style="background-color: #06750F;">
        <ul class="text-justify" style="font-size: 13px;">
          <li>Kebutuhan : {{ $pesanan->kebutuhan }}</li>
          <li>Permintaan Khusus : {{ $pesanan->keterangan }}</li>
        </ul>
      </div>
    </div>
    @endif

    <hr>
    <div class="d-flex justify-content-end">
      <!-- Button trigger modal -->
      @if ($pesanan->verifikasi==1)
        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">
          Tolak
        </button>
        <button type="submit" class="btn btn-sm btn-success pull-right">
          Proses
        </button>
      @elseif ($pesanan->verifikasi==2)
        @if ($pesanan->raw_tujuan==2)
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
      @elseif($pesanan->verifikasi == 3 && $pesanan->verifikasi_pengiriman == 2)
        <button type="button" data-toggle="modal" data-target="#pengirimanModal" class="btn btn-sm btn-success pull-right">
          Kirim Pesanan
        </button>
      @endif
    </div>
  </div>
</form>

@if ($pesanan->verifikasi == 3 && $pesanan->verifikasi_pengiriman == 2)
<!-- Modal -->
<div class="modal fade" id="pengirimanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ route($adminTitle.'.kiriman.'.$type, [$type => $pesanan, 'status' => 3]) }}" method="post"
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ route($adminTitle.'.'.$type.'.detail', [$type => $pesanan, 'status' => 0]) }}" method="post"
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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

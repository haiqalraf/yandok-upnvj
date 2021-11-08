@extends('layouts.app')

@section('content')

  @php
  $adminTitle = auth()
      ->user()
      ->adminTitle();
  @endphp

  <form
    action="{{ route($adminTitle . '.lainnya.detail', [
    'lainnya' => $lainnya,
    'status' => $lainnya->verifikasi + 1]) }}"
    method="post">
    @csrf
    @method("PUT")
    <div class="container mt-3 mb-5">
      <h4 class="font-weight-bolder mb-5">Pemesanan Lainnya <span style="border-left: 2px solid #000;"></span> <span
          class="font-weight-lighter pl-2 ">
          {{$lainnya->titleStatus()}}
        </span>
      </h4>
      <div class="row mb-5">
        <div class="col p-3 bg-white rounded shadow">
            <div class="d-flex justify-content-end">
            <a href="{{route($adminTitle.'.lainnya', ['status'=>$lainnya->verifikasi])}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
          </div>
          <h3>Detail Pesanan</h3>
          <hr>
          <table class="table table-bordered table-md table-responsive-sm">
            <thead class="text-white" style="background-color: #06750F;">
                <tr>
                    <th>Kode Pemesanan</th>
                    <th>{{strtoupper($lainnya->id)}}</th>
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
                  <td>{{$lainnya->created_at->locale('id')->isoFormat('LL');}}</td>
                </tr>
                <tr>
                    <td>Detail Status</td>
                    @if ($lainnya->verifikasi == 0)
                      @if ($lainnya->komentar)
                      <td>{{$lainnya->komentar}}</td>
                      @else
                      <td>Dokumen yang diunggah tidak sesuai persyaratan. Harap di cek lagi dengan teliti dan lakukan pesanan ulang</td>
                      @endif
                    @elseif ($lainnya->verifikasi == 1)
                        <td>Pesanan perlu ditinjau</td>
                    @elseif ($lainnya->verifikasi == 2)
                        <td>Masih dalam peninjauan</td>
                    @else
                        <td>Sudah Selesai</td>
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
                @if (in_array($lainnya->verifikasi, [0]))
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

                  @if ($loop->first)
                  @if ($lainnya->verifikasi==0)
                  <td>{{ $lainnya->komentar ? $lainnya->komentar : 'Tidak ada Catatan' }}</td>
                  @endif
                  <td rowspan="12" class="align-middle text-center" style="font-size: 15px;">
                    <a href="{{ route($adminTitle.'.download', ['filePath' => 'lainnya/' . $lainnya->file]) }}"
                      class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                  </td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-end">
        @if ($lainnya->verifikasi == 2)
          <button type="submit" class="btn btn-sm btn-success pull-right">
            Selesai
          </button>
        @elseif ($lainnya->verifikasi == 1)
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">
            Tolak
          </button>
          <button type="submit" class="btn btn-sm btn-success pull-right">
            Proses
          </button>
        @endif
      </div>
    </div>
  </form>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route($adminTitle.'.lainnya.detail', ['lainnya' => $lainnya, 'status' => 0]) }}" method="post"
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

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
          <table class="table table-bordered" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
              <tr>
                <th>Kode Pesanan</th>
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
                  @if ($loop->first)
                    <td rowspan="{{ $daftar_pesanan->count() }}" class="text-center align-middle">{{ $surat->id }}</td>
                  @endif
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
        <button type="submit" class="btn btn-sm btn-success pull-right">
          Proses
        </button>
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

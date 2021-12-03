<table class="table table-bordered" style="width: 100%;">
  <thead class="text-white" style="background-color: #06750F;">
    <tr>
      @php
        $x=1
      @endphp
      <th>No.</th>
      <th>Daftar Pesanan</th>
      <th>Jumlah </th>
      @if (in_array($pesanan->verifikasi, [0]))
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
        @if ($pesanan->verifikasi==0)
        <td>{{ $pesanan->komentar ? $pesanan->komentar : 'Tidak ada Catatan' }}</td>
        @endif
          <td class="align-middle text-center" style="font-size: 15px;">
            <div class="d-flex justify-content-center">
              <ol type="number" class="text-left" style="font-size: 13px;">
                @foreach ($pesanan->documentRequirement($key) as $requirement)
                  <li>{{$requirement}}</li>
                @endforeach
              </ol>
            </div>
            <br>
            @if (strpos($key, 'Pengganti'))
              @isset($pesanan->file[1][Str::slug($key, '')])
                <a href="{{ route($adminTitle.'.download', ['filePath' => 'suket/' . $pesanan->file[1][Str::slug($key, '')],]) }}"
                  class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
              @endisset
            @elseif (strpos($key, 'Perubahan')||strpos($key, 'Ralat'))
              @isset($pesanan->file[2][Str::slug($key, '')])
                <a href="{{ route($adminTitle.'.download', ['filePath' => 'suket/' . $pesanan->file[2][Str::slug($key, '')],]) }}"
                  class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
              @endisset
            @elseif (strpos($key, 'Alumni'))
              @isset($pesanan->file[3][Str::slug($key, '')])
                <a href="{{ route($adminTitle.'.download', ['filePath' => 'suket/' . $pesanan->file[3][Str::slug($key, '')],]) }}"
                  class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
              @endisset
            @endif
          </td>
      </tr>
    @endforeach
  </tbody>
</table>
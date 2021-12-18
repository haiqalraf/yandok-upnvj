<table class="table table-bordered" style="width: 100%;">
  <thead class="text-white" style="background-color: #06750F;">
    <tr>
      @php
        $x=1
      @endphp
      <th>No.</th>
      <th>Daftar Pesanan</th>
      <th>Jumlah </th>
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
        <td rowspan="12" class="align-middle text-center" style="font-size: 15px;">
          <a href="{{ route($adminTitle.'.download', ['filePath' => 'lainnya/' . $pesanan->file]) }}"
            class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
        </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
@extends('layouts.app')

@section('css')
    <!-- Data tables CDN-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container p-3 bg-white shadow rounded">
    <h3>Daftar Pesanan Lainnya</h3><hr>
    <ul class="nav nav-fill justify-content-center">
        @if (auth()->user()->is_admin==2)
        <li class="nav-item">
            <a class="nav-link @if ($status==='1'||$status===null){{'active'}}@endif" href="{{ route('akpk.lainnya', ['status' => '1'])}}">Belum Diproses</a>
        </li>
       <li class="nav-item">
         <a class="nav-link @if ($status==='0'){{'active'}}@endif" href="{{ route('akpk.lainnya', ['status' => '0'])}}">Ditolak</a>
      </li>
      <li class="nav-item">
         <a class="nav-link @if ($status==='2'){{'active'}}@endif" href="{{ route('akpk.lainnya', ['status' => '2'])}}">Telah Diverifikasi</a>
      </li>
        @endif
        @if (auth()->user()->is_admin==3)
        <li class="nav-item">
            <a class="nav-link @if ($status==='1'||$status===null){{'active'}}@endif" href="{{ route('dekan.lainnya', ['status' => '1'])}}">Sedang Diproses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($status==='2' ){{'active'}}@endif" href="{{ route('dekan.lainnya', ['status' => '2'])}}">Sudah Diproses</a>
        </li>
        @endif
    </ul>

    <div class="tab-content">
       <div id="belumdiproses" class="tab-pane fade show active">
          <!-- table user -->
          <div class="container mt-3 mb-5">
             <div class="row">
                <div class="col p-3">
                   <table class="table table-striped table-bordered mydatatable" style="width: 100%;">
                      <thead class="text-white" style="background-color: #06750F;">
                         <tr>
                            <th>Kode Pesanan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Detail</th>
                         </tr>
                      </thead>
                      <tbody>
                          @foreach ($lainnya as $item)
                          <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                {{auth()->user()->where('nim', $item->nim_pemesan)->first()->name}}
                            </td>
                            <td>
                                @if (auth()->user()->is_admin==2)
                                <a href="{{route('akpk.lainnya.detail', [ 'lainnya' => $item ])}}" title="Detail" class="btn btn-sm btn-success">Detail</a>
                                @elseif(auth()->user()->is_admin==3)
                                <a href="{{route('dekan.lainnya.detail', [ 'lainnya' => $item ])}}" title="Detail" class="btn btn-sm btn-success">Detail</a>
                                @endif
                            </td>
                         </tr>
                          @endforeach
                         
                      </tbody>
                   </table>
                </div>

             </div>
          </div>
          <!-- end table user -->
       </div>

    </div>
 </div>
@endsection

@section('script')
    <!-- JS for data table CDN -->
   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

   <!-- custom script -->
   <script>
      $('.mydatatable').DataTable({
         "order": []
      } );
   </script>
@endsection
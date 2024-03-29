@extends('layouts.app')

@section('css')
       <!-- Data tables CDN-->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container p-3 bg-white shadow rounded">
    <ul class="nav nav-tabs nav-fill justify-content-center">
       <li class="nav-item">
          <a class="nav-link @if ($status==='1'||$status===null){{'active'}}@endif" href="{{ route('admin.lainnya', ['status' => '1'])}}">Belum Diproses</a>
       </li>
       <li class="nav-item">
          <a class="nav-link @if ($status==='2' ){{'active'}}@endif" href="{{ route('admin.lainnya', ['status' => '2'])}}">Sedang Diproses</a>
       </li>
       <li class="nav-item">
          <a class="nav-link @if ($status==='3' ){{'active'}}@endif" href="{{ route('admin.lainnya', ['status' => '3'])}}">Sudah Diproses</a>
       </li>
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
                               <a href="{{route('admin.lainnya.detail', [ 'lainnya' => $item ])}}" title="Detail" class="btn btn-sm btn-success">Detail</a>
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
      $('.mydatatable').DataTable();
   </script>
@endsection
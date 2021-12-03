@extends('layouts.app')

@section('css')
  <!-- Data tables CDN-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection

@php
    $adminTitle = auth()->user()->adminTitle();
@endphp

@section('content')
  <div class="container p-3 bg-white shadow rounded">
    <h3>Daftar Kiriman</h3>
    <hr>
    <ul class="nav nav-fill justify-content-center">
      <li class="nav-item">
        <a class="nav-link @if ($status === '1' || $status === null){{ 'active' }}@endif" 
          href="{{ route($adminTitle.'.kiriman', ['status' => '1']) }}">
          Belum Dibayar
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if ($status === '2'){{ 'active' }}@endif" 
          href="{{ route($adminTitle.'.kiriman', ['status' => '2']) }}">
          Sudah Dibayar
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if ($status === '3'){{ 'active' }}@endif" 
          href="{{ route($adminTitle.'.kiriman', ['status' => '3']) }}">
          Sudah Dikirim
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if ($status === '4'){{ 'active' }}@endif" 
          href="{{ route($adminTitle.'.kiriman', ['status' => '4']) }}">
          Sudah Diterima
        </a>
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
                    <th>Nama Pemesan</th>
                    <th>Alamat</th>
                    {{-- <th>Kontak</th> --}}
                    <th>Status Pembayaran</th>
                    <th>Status Pengiriman</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pesanan as $item)
                  @php
                    $routeName = $item->route_name;
                  @endphp
                    <tr>
                      <td>{{ $item->user->name }}</td>
                      <td>{{ $item->alamat }}</td>
                      {{-- <td>
                        @if($item->no_rumah)<i class="fa fa-home"></i> {{ $item->no_rumah }}@endif
                        @if($item->no_hp)<br> <i class="fa fa-phone"></i> {{ $item->no_hp }}@endif 
                      </td> --}}
                      <td>
                        <div class="badge {{ $item->buktiBayar ? 'badge-success' : 'badge-warning'}}">
                          {{ $item->buktiBayar ? 'Telah Dibayar' : 'Belum Dibayar'}}
                        </div>
                      </td>
                      <td>
                        <div class="badge {{ $item->verifikasi_pengiriman == 4 ? 'badge-success' : ($item->verifikasi_pengiriman == 3 ? 'badge-info' : 'badge-warning') }}">
                          {{ $item->verifikasi_pengiriman == 4 ? 'Telah Diterima' : ($item->verifikasi_pengiriman == 3 ? 'Telah Dikirim' : 'Belum Dikirim') }}
                        </div>
                      </td>
                      <td>
                        <a href="{{ route($adminTitle.'.'.$routeName.'.detail', [$routeName => $item]) }}" title="Detail"
                          class="btn btn-sm btn-success">Detail</a>
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
    });
  </script>
@endsection

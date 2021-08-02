@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col bg-white rounded shadow p-3">
        <h3>Pengolahan Akun DEKANAT</h3>
        <hr>
        <div class="mb-4" style="font-size: 15px;">Berikut daftar user DEKANAT</div>
        <table class="table table-striped table-bordered mydatatable text-center" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
                <tr>
                <th>Akun</th>
                <th>Password</th>
                <th>NIP/NIK/NIM</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dekan as $item)
                <tr>
                    <td>{{$item->nim}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->password}}</td>
                    <td>
                        <span><i class="fa fa-circle" style="color: #06750F;"></i> NOT IMPLEMENTED
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <div class="text-right">
            <a href="{{route('superadmin.dekan.create')}}" class="btn btn-sm btn-success mt-2 text-white">
                <i class="fa fa-plus"></i>
                Akun Baru
            </a>
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
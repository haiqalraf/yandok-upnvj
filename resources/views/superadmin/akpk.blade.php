@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col bg-white rounded shadow p-3">
        <h3>Pengolahan Akun AKPK</h3>
        <hr>
        <div class="mb-4" style="font-size: 15px;">Berikut daftar user AKPK</div>
        <table class="table table-striped table-bordered mydatatable" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
                <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Password</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akpk as $item)
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
            <a href="{{route('superadmin.akpk.create')}}" class="btn btn-sm btn-success mt-2 text-white">
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
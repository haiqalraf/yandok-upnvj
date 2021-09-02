
@extends('layouts.app')

@section('content')
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-10 bg-white rounded shadow p-3">
        <h6 class="text-center">Selamat pesanan kamu selesai dibuat, pengambilan dokumen hanya berjangka <span
                class="text-danger">14 hari</span> dari waktu diubahnya status.</h6>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-4 col-md-3 bg-white rounded shadow align-self-center p-2 d-flex" style="min-height: 285px">
            @if (date('Y-m-d', strtotime($data->updated_at.'+ 14 days')) >= date('Y-m-d'))
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->id, 'QRCODE', 10, 10)}}" alt="barcode" width="100%" />
            @else
            <h3 class="m-auto">Expired</h3>
            @endif
        </div>

        <div class="col-sm bg-white p-3 shadow ml-5 text-sm d-flex" style="border-left: 20px solid #06750F; border-radius: 8px;">
            <div class="mb-auto">
                <div class="d-flex justify-content-end">
                    <a href="{{route('riwayat')}}" class="btn btn-sm btn-outline-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
                </div>
                <h4 class="text-left mt-2">Kode Pesanan:</h4>
                @if (date('Y-m-d', strtotime($data->updated_at.'+ 14 days')) >= date('Y-m-d'))
                    <h3>{{strtoupper($data->id)}}</h3>
                @else
                    <h3 style="text-decoration: line-through; color: red;">{{strtoupper($data->id)}}</h3>
                @endif
                <hr style="background-color: #06750F;">
                <ul class="text-justify" style="font-size: 13px;">
                    <li>Daftar pesanan akan lihat dari menu riwayat pemesanan saat dokumen selesai dimabil, jadi pastikan
                        dokumen telah berada pada kondisi baik.</li>
                    <li>Untuk mengambil dokumen di loket ULT harap menunjukan KTM anda</li>
                </ul>
            </div>
        </div>


    </div>
@endsection
@section('script')
@endsection
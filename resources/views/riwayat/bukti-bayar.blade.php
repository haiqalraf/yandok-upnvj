@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="row bg-white rounded shadow p-3" action="{{route('bayar.update', ['id'=>$pesanan->id])}}" method="POST"
  enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="col-12">
    <a href="{{route('riwayat')}}" class="btn btn-sm btn-success float-right"><i class="fa fa-arrow-left"></i> Kembali</a> 
    <h3>Konfirmasi Pembayaran</h3>
    <hr>
  </div>
  <div class="form-group col-6">
    <div class="card">
      <div class="card-body p-3">
        <small class="card-title">Total yang perlu dibayar:</small>
        <h4 class="card-title">Rp{{number_format($pesanan->biaya)}}</h4>
      </div>
    </div>
  </div>
  <div class="form-group col-6">
    <label for="bukti">Bukti Pembayaran</label>
    <input type="file" class="form-control-file" id="bukti" name="bukti_bayar">
  </div>
  <div class="form-group col-4">
    <label for="bank">Nama Bank</label>
    <input type="text" class="form-control" id="bank" name="bank">
  </div>
  <div class="form-group col-4">
    <label for="owner">Nama Pemilik Rekening</label>
    <input type="text" class="form-control" id="owner" name="owner">
  </div>
  <div class="form-group col-4">
    <label for="norek">Nomor Rekening</label>
    <input type="text" class="form-control" id="norek" name="norek">
  </div>
  <div class="form-group col-6">
    <label for="jml_bayar">Total Pembayaran</label>
    <input type="number" class="form-control" id="jml_bayar" name="jml_bayar">
    <small class="form-text text-muted">Contoh: 20000</small>
  </div>
  <div class="form-group col-6">
    <label for="tglbayar">Tanggal Pembayaran</label>
    <input type="date" class="form-control" id="tglbayar" name="tgl_bayar">
  </div>
  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-success">Konfirmasi</button>
  </div>
</form>

@endsection
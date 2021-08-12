@extends('layouts.app')
   
@section('content')
<!-- Konten -->
<div class="container mb-5">
    <!-- Palet Sambutan -->
    <div class="row bg-white rounded shadow mb-5">
       <div class="col p-3">
          <h5 class="text-left" >Selamat Datang, AKPK <span style="color: #0c5012;">
                @if (auth()->user()->is_admin===2){{auth()->user()->name}}@endif</span> di Sistem Layanan Dokumen Alumni UPN Veteran Jakarta</h5>
       </div>
       <img src="{{asset('img/greeting.png')}}" alt="aksesoris" style="float: right; margin-bottom: 5px; opacity: 45%;"
          height="60px">
    </div>

    <!-- table Profil -->
    <div class="row">
       <div class="col bg-white p-3 rounded shadow">
          <h3>Profil Saya</h3>
          <hr><br>
          <table class="table table-borderless table-responsive-sm table-sm">
             <tr>
                <td>Nama</td>
                <td>
                   <input type="text" name="nama_alumni" class="form-control form-control-sm" placeholder="{{auth()->user()->name}}"
                      readonly>
                </td>
             </tr>

             <tr>
                <td>NIP</td>
                <td>
                   <input type="text" name="nim" class="form-control form-control-sm" placeholder="{{auth()->user()->nim}}" readonly>
                </td>
             </tr>

             <tr>
                <td>Email</td>
                <td>
                   <input type="email" name="email" class="form-control form-control-sm"
                      placeholder="{{auth()->user()->email}}" readonly>
                </td>
             </tr>

             <tr>
                <td>Ganti Foto</td>
                <td>
                   <input type="file" name="foto" class="btn-sm" placeholder="Foto anda">
                </td>
             </tr>

             <tr>
                <td>Alamat</td>
                <td>
                   <textarea name="alamat" class="form-control form-control-sm" placeholder="Alamat"
                      style="height: 250px;">
					  {{auth()->user()->address}}
                   </textarea>
                </td>
             </tr>

          </table>
          <button type="submit" class="btn btn-sm btn-success pull-right">
             <i class="fa fa-check-circle-o" aria-hidden="true"></i> Update Data Profil
          </button>
       </div>

    </div>
 </div>
@endsection
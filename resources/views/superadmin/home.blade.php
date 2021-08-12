@extends('layouts.app')

@section('content')
<!-- Palet Sambutan -->
<div class="row bg-white rounded shadow mb-5">
    <div class="col p-3">
        <h5 class="text-left" >Selamat Datang,<span style="color: #0c5012;">
                {{auth()->user()->name}}</span> di Sistem Layanan Dokumen Alumni UPN Veteran Jakarta</h5>
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
                <input type="text" name="nama_alumni" class="form-control form-control-sm" placeholder="Nama anda"
                    value="{{auth()->user()->name}}" readonly>
                </td>
            </tr>

            <!-- <tr>
                <td>NIP</td>
                <td>
                <input type="text" name="nim" class="form-control form-control-sm" placeholder="NIM" readonly>
                </td>
            </tr> -->

            <!-- <tr>
                <td>Tahun Lulus</td>
                <td>
                <input type="number" name="nim" class="form-control form-control-sm" placeholder="Tahun Lulus"
                    value="xxxx" readonly>
                </td>
            </tr> -->

            <tr>
                <td>Email</td>
                <td>
                <input type="email" name="email" class="form-control form-control-sm"
                    placeholder="Email lengkap anda" value="{{auth()->user()->email}}">
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td>
                <input type="password" name="password" class="form-control form-control-sm" placeholder="Password"
                    value="">
                <p class="text-danger text-right" style="font-size: 13px;">Ketik Minimal 6 karakter untuk mengganti
                    ke sandi baru.</p>
                </td>
            </tr>

            <tr>
                <td>Telepon Ponsel</td>
                <td>
                <input type="text" name="telepon" class="form-control form-control-sm"
                    placeholder="No. Telepon Ponsel Anda" value="{{auth()->user()->no_hp}}">
                </td>
            </tr>

            <tr>
                <td>Telepon Rumah</td>
                <td>
                <input type="text" name="telepon" class="form-control form-control-sm"
                    placeholder="No. Telepon Rumah Anda" value="{{auth()->user()->no_rumah}}">
                </td>
            </tr>

            <tr>
                <td>Ganti Foto</td>
                <td>
                <input type="file" name="foto" class="btn-sm" placeholder="Foto anda">
                </td>
            </tr>

            <!-- <tr>
                <td>Pekerjaan</td>
                <td>
                <input type="text" name="pekerjaan" class="form-control form-control-sm" readonly>
                </td>
            </tr> -->

            <tr>
                <td>Alamat</td>
                <td>
                <textarea name="alamat" class="form-control form-control-sm" placeholder="Alamat"
                    style="height: 250px;" value="{{auth()->user()->address}}">

                </textarea>
                </td>
            </tr>

        </table>
        <button type="submit" class="btn btn-sm btn-success pull-right">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Update Data Profil
        </button>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6 bg-white p-3 shadow">
        <div style="height: 20px; width: 100%; color: black;"></div>
        <h3 class="text-center font-weight-bold mt-2" style="font-family:'Times New Roman', Times, serif;">
            @if ($role===2)
            AKPK
            @elseif($role===3)
            Dekanat
            @endif
        </h3>
        <hr>
        @if ($role===2)
        <form action="{{route('superadmin.akpk')}}" method="POST">
        @else
        <form action="{{route('superadmin.dekan')}}" method="POST">
        @endif
        @csrf
            <div class="form-group">
                <label for="Nama" class="text-sm font-weight-bold">Nama</label>
                <input type="text" class="form-control form-control-sm" id="Nama"
                placeholder="Harap masukan nama anda disini" name="name">
            </div>
            <div class="form-group">
                <label for="NIM" class="text-sm font-weight-bold">NIP</label>
                <input type="text" class="form-control form-control-sm" id="NIM"
                placeholder="Harap masukan NIM anda disini" name="nim">
            </div>
            <div class="form-group">
                <label for="pass" class="text-sm font-weight-bold">Password</label>
                <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control form-control-sm"
                    placeholder="Harap masukan sandi anda disini" aria-label="Password"
                    aria-describedby="basic-addon2" id="pass1" name="password">
                <div class="input-group-append">
                    <a class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash"
                            aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="pass" class="text-sm font-weight-bold">Konfirmasi Password</label>
                <div class="input-group" id="show_hide_password1">
                <input type="password" class="form-control form-control-sm"
                    placeholder="Harap masukan sandi anda disini" aria-label="Password"
                    aria-describedby="basic-addon2" id="pass1" name="password_confirmation">
                <div class="input-group-append">
                    <a class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash"
                            aria-hidden="true"></i></a>
                </div>
                </div>
            </div>
            <input type="text" class="form-control form-control-sm" name="role" value="{{$role}}" hidden>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success btn-block">Buat Akun Baru</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<!-- local script -->
<script>
    $(document).ready(function () {
       $("#show_hide_password a").on('click', function (event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
             $('#show_hide_password input').attr('type', 'password');
             $('#show_hide_password i').addClass("fa-eye-slash");
             $('#show_hide_password i').removeClass("fa-eye");
          } else if ($('#show_hide_password input').attr("type") == "password") {
             $('#show_hide_password input').attr('type', 'text');
             $('#show_hide_password i').removeClass("fa-eye-slash");
             $('#show_hide_password i').addClass("fa-eye");
          }
       });
       $("#show_hide_password1 a").on('click', function (event) {
          event.preventDefault();
          if ($('#show_hide_password1 input').attr("type") == "text") {
             $('#show_hide_password1 input').attr('type', 'password');
             $('#show_hide_password1 i').addClass("fa-eye-slash");
             $('#show_hide_password1 i').removeClass("fa-eye");
          } else if ($('#show_hide_password1 input').attr("type") == "password") {
             $('#show_hide_password1 input').attr('type', 'text');
             $('#show_hide_password1 i').removeClass("fa-eye-slash");
             $('#show_hide_password1 i').addClass("fa-eye");
          }
       });
    });
 </script>
@endsection
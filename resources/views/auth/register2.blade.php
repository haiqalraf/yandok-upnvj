<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

   <!-- font google -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet">

   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&display=swap" rel="stylesheet">

   <!-- font awsome -->
   <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" />

   <!-- Local css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
   <!-- header -->
   <section class=" container-fluid mb-5"
      style="background-color: #06750F; box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.226);">
      <div class=" row">
         <div class="col-1 d-flex justify-content-start align-self-center">
            <a class="btn btn-sm text-left aktif p-2" href="{{route('index')}}"><i class="fa fa-arrow-left"></i> Kembali</a>
         </div>
         <div class="col p-3 d-flex justify-content-center" style="margin-right: 150px;">
            <a href="{{route('index')}}"><img src="img/logoUPN2.png" alt="logo"></a>
         </div>
      </div>
   </section>

   <div class="container">

      <div class="row">
         <div class="col table-bordered bg-white p-3"
            style="border-top: 18px solid #06750F; border-radius: 8px 8px 8px 8px;">
            <div style="height: 20px; width: 100%; color: black;"></div>
            <h2 class="text-center mt-2">Registrasi</h2><br>
            <h5>Verifikasi Data</h5>
            <hr>
            <form method="POST" action="{{route('apiupn')}}" >
               @csrf
               <div class="row">
                  <div class="col">

                        <div class="form-group">
                           <label for="NIM" class="text-sm">NIM</label>
                           <input name="nim" type="text" class="form-control form-control-sm" id="NIM"
                              value="{{$responseBody->result->nim}}">
                        </div>
                        <div class="form-group">
                           <label for="tgl" class="text-sm">Tanggal Lahir</label>
                           <input name="tgl" type="text" class="form-control form-control-sm" id="tgl" value="{{$responseBody->result->tanggal_lahir}}">
                        </div>

                  </div>
                  <div class="col align-self-center">
                     <!-- style="border-left: 2px solid rgba(124, 124, 124, 0.72); height: fit-content;"> -->
                     <ul>
                        <li>Isi NIM dan tanggal lahir anda untuk memverifikasi data anda.</li>
                        <li>Pada saat verifikasi sistem membutuhkan beberapa saat, jadi mohon untuk bersabar</li>
                     </ul>
                  </div>
               </div>
               <div class="mt-3 d-flex justify-content-center">
                  <input type="submit" class="btn btn-sm btn-success" value="verifikasi">
               </div>
            </form>

            <form method="POST" action="{{ route('storeData') }}">
               @csrf
               <div class="col bg-light">
                  <table width="100%" class="table-borderless" cellpadding="5">
                     <tr>
                        <td class="font-weight-bold">Nim</td>
                        <td>:<input name="nim_verified" style="border:none" type="text" value="{{$responseBody->result->nim}}" readonly ></td>
                     </tr>
                     <tr>
                        <td class="font-weight-bold">Nama</td>
                        <td>:<input name="name" style="border:none" type="text" value="{{$responseBody->result->nama}}" readonly></td>
                     </tr>
                     <tr>
                        <td class="font-weight-bold">Program Studi</td>
                        <td>:<input name="prodi" style="border:none" type="text" value="{{$responseBody->result->program_studi}}" readonly> </td>
                     </tr>
                     <tr>
                        <td class="font-weight-bold">Tahun Lulus</td>
                        <td>:<input name="tahun_lulus" style="border:none" type="text" value="{{$responseBody->result->tahun_akademik_lulus}}" readonly> </td>
                     </tr>
                     <tr>
                        <td class="font-weight-bold">Angkatan</td>
                        <td>:<input name="angkatan" style="border:none" type="text" value="{{$responseBody->result->angkatan}}" readonly> </td>
                     </tr>
                  </table>
               </div>
               <div>
                  <div class="form-row mb-3">
                     <div class="col">
                        <label for="wa" class="text-sm">Telepon WA</label>
                        <input name="no_hp" type="tel" class="form-control" placeholder="" id="wa" pattern="^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$">
                     </div>
                     <div class="col">
                        <label for="rumah" class="text-sm">Telepon Rumah</label>
                        <input name="no_rumah" type="tel" class="form-control" placeholder="" id="rumah" pattern="^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$">
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col">
                        <label for="pass1" class="text-sm">Password</label>
                        <div class="input-group" id="show_hide_password">
                           <input name="password" type="password" class="form-control form-control-sm" placeholder="Password"
                              aria-label="Password" aria-describedby="basic-addon2" id="pass1">
                           <div class="input-group-append">
                              <a class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash"
                                    aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col">
                        <label for="pass2" class="text-sm">Verfikasi Password</label>
                        <div class="input-group" id="show_hide_password1">
                           <input name="password_confirmation" type="password" class="form-control form-control-sm"
                              placeholder="Ulangi Password" aria-label="Password" aria-describedby="basic-addon2"
                              id="pass2">
                           <div class="input-group-append">
                              <a class="input-group-text" id="basic-addon2"><i class="fa fa-eye-slash"
                                    aria-hidden="true"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="mt-3 d-flex justify-content-end mb-3">
                  <button type="submit" class="btn btn-primary">Register</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- JS -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
   </script>
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

</body> 
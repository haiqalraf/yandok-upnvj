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
         <div class="col p-3 d-flex justify-content-center" style="margin-right: 150px;">
            <a href="{{route('index')}}"><img src="img/logoUPN2.png" alt="logo"></a>
         </div>
      </div>
   </section>

   <div class="container">

      <div class="row">
         <div class="col table-bordered bg-white p-3"
            style="border-top: 18px solid #06750F; border-radius: 8px 8px 0px 0px;">
            <div style="height: 20px; width: 100%; color: black;"></div>
            <div class="d-flex justify-content-end">
               <a href="{{url()->previous()}}" class="btn btn-sm btn-outline-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
            </div>
            <h2 class="text-center mt-2">Registrasi</h2><br>
            <hr>
            <div class="row">
               <div class="col">
                  <form>
                     <div>
                        <div class="form-row mb-3">
                           <div class="col">
                              <label for="wa" class="text-sm">Telepon WAAA</label>
                              <input type="text" class="form-control" placeholder="" id="wa">
                           </div>
                           <div class="col">
                              <label for="rumah" class="text-sm">Telepon Rumah</label>
                              <input type="text" class="form-control" placeholder="" id="rumah">
                           </div>
                        </div>

                        <div class="form-row">
                           <div class="col">
                              <label for="pass1" class="text-sm">Password</label>
                              <div class="input-group" id="show_hide_password">
                                 <input type="password" class="form-control form-control-sm" placeholder="Password"
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
                                 <input type="password" class="form-control form-control-sm"
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
                  </form>
                  <div class="mt-3 d-flex justify-content-end mb-3">
                     <a href="{{route('home')}}" class="btn btn-sm btn-success">Next <i class="fa fa-arrow-right"></i></a>
                  </div>
               </div>
            </div>



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
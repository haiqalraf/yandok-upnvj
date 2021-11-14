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
         <div class="col-4 bg-white p-3 shadow" style="border-top: 20px solid #06750F; border-radius: 8px;">
            <div class="d-flex justify-content-end">
               <a href="{{route('index')}}" class="btn btn-sm btn-outline-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
            </div>
            <div style="height: 20px; width: 100%; color: black;"></div>
            <h4 class="text-center mt-2">Log In</h4>
            <hr>
            <form method="POST" action="{{ route('login') }}">
            @csrf
               <div class="form-group">
                  <i class="fa fa-user mr-1"></i> <label for="username" class="text-sm">Username</label>
                  <input type="text" name="nim" class="form-control form-control-sm" id="username"
                     placeholder="Harap masukan NIM anda disini">
               </div>
               <div class="form-group">
                  <i class="fa fa-key mr-1"></i> <label for="pass" class="text-sm"> Sandi</label>
                  <input type="password" name="password" class="form-control form-control-sm @if(Session::has('error')) is-invalid @endif" id="pass"
                     placeholder="Harap masukan sandi anda disini">
                  @if(Session::has('error'))
                     <span class="invalid-feedback" role="alert">
                           <strong>{{ Session::get('error') }}</strong>
                     </span>
                  @endif
               </div>
               
               <div class="form-group">
                  <input type="submit" value="Submit"> 
                  <a class="ml-3" href="{{route('password.request')}}"><small>Lupa Sandi Anda?</small></a>
               </div>
            </form>
            <div style="border-left: 1px solid black; border-right-width: thick;" class="mb-3">
               <p style="font-size: 11px;"> &nbsp; Apabila belum memiliki akun, silahkan melakukan <a
                     href="{{route('register')}}" class="text-primary">Registrasi</a></p>
            </div>
         </div>

         <div class="col  bg-white p-3 shadow ml-5 text-sm"
            style="border-left: 20px solid #06750F; border-radius: 8px;">
            <div style="height: 20px; width: 100%; color: black;"></div>
            <h4 class="text-left mt-2">Informasi</h4>
            <hr style="background-color: #06750F;">
            <ul class="text-justify">
               <li>Untuk angkatan baru 2019-2020 bisa menggunakan layanan dengan Log In tanpa melakukan Pemesanan.</li>
            </ul>
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
</body>
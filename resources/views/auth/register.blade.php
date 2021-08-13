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
         <div class="col-2">
            <a class="btn btn-sm text-left aktif p-2" href="{{ url()->previous() }}"><i
                  class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
         </div>
         <div class="col table-bordered bg-white p-3"
            style="border-top: 18px solid #06750F; border-radius: 8px 8px 0px 0px;">
            <div style="height: 20px; width: 100%; color: black;"></div>
            <h2 class="text-center mt-2">Registrasi</h2><br>
            <h5>Verifikasi Data</h5>
            <hr>
            <div class="row">
               <div class="col">
                  <form method="POST" action="{{route('apiupn')}}">
                  @csrf
                     <div class="form-group">
                        <label for="NIM" class="text-sm">NIM</label>
                        <input name="nim" type="text" class="form-control form-control-sm" id="NIM"
                           placeholder="Harap masukan nama disini">
                     </div>
                     <div class="form-group">
                        <label for="tgl" class="text-sm">Tanggal Lahir</label>
                        <input name="tgl" type="text" class="form-control form-control-sm" id="tgl" placeholder="Misal : 2000-29-03">
                     </div>
                  
                  </div>
                  <div class="col align-self-center">
                     <!-- style="border-left: 2px solid rgba(124, 124, 124, 0.72); height: fit-content;"> -->
                     <ul>
                        <li>Isi NIM dan tanggal lahir anda untuk memverifikasi data anda.</li>
                        <li>NIM dapat Anda lihat pada ijazah/ transkrip Anda</li>
                        <li>Pada saat verifikasi sistem membutuhkan beberapa saat, jadi mohon untuk bersabar</li>
                     </ul>
                  </div>
               </div>

               <div class="mt-3 d-flex justify-content-center">
                  <input type="submit" class="btn btn-sm btn-success" value="verifikasi">
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="alert"></div>
   

   <!-- JS -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
   </script>
</body>
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
   <section class="bg-white shadow">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-md bg-white">
            <a class="navbar-brand" href="#">
               <img id="logoku" src="img/logoUPN.png" alt="logo" height="63" width="243"
                  class="d-inline-block align-top">
            </a>
            <div class="collapse navbar-collapse">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link link-regis ml-2" href="{{ route('register') }}">Registrasi</a>
                  </li>
               </ul>
            </div>
         </nav>
      </div>
   </section>

   <!-- banner -->
   <section class="container-fluid">
      <div class="container-fluid">
         <div class="row">
            <div class="col-6 col-sm-5 align-self-center mb-3" style="margin-left: 22px;">
               <h2 class="" style="font-family: 'Lora', serif;">Welcome To <span style="color: #06750F;">Yandok</span>
                  UPN Veteran Jakarta
               </h2>
               <br>
               <p id="konten-banner">
                  Halo para alumni, selamat datang di Layanan Pemesanan Dokumen UPN Veteran Jakarta <br><br>
                  Sekarang UPNVJ telah menyediakan layanan pemesanan untuk kamu yang membutuhkan dokumen-dokumen
                  legalisir,
                  surat keterangan dan dokumen lainnya.
               </p>
               <br>
               <div class="d-flex justify-content-end">
                  <a class="btn btn-block btn-outline-success rounded" href="{{route('login')}}">Ayo Daftar Sekarang,
                     <b>Gratis</b></a>
               </div>
            </div>

            <img class="ml-auto" src="img/Bannerfoto.png" alt="banner" width="55%" height="30%">
         </div>
      </div>
   </section>

   <!-- Pengumuman -->
   <section class="bg-white">
      <div class="container pt-5 pb-5">
         <div class="row">
            <div class="col-12">
               <h2 class="text-center">Pengumuman</h2>
               <hr width="130px" style="border: 1px solid #06750F;">
            </div>
         </div>

         <!-- Konten baris 1 -->
         <div class="row mb-5">
            <div class="col-md-4">
               <div class="card">
                  <img src="img/a1.png" class="card-img-to p-2">
                  <div class="card-body">
                     <a id="item-pengumuman" href="#">
                        <h4 class="card-title">Title</h4>
                     </a>
                     <hr>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <br><i class="fa fa-clock-o"></i> 24 Menit lalu
                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
                  <img src="img/a1.png" class="card-img-to p-2">
                  <div class="card-body">
                     <a id="item-pengumuman" href="#">
                        <h4 class="card-title">Title</h4>
                     </a>
                     <hr>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <br><i class="fa fa-clock-o"></i> 24 Menit lalu
                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
                  <img src="img/a1.png" class="card-img-to p-2">
                  <div class="card-body">
                     <a id="item-pengumuman" href="#">
                        <h4 class="card-title">Title</h4>
                     </a>
                     <hr>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <br><i class="fa fa-clock-o"></i> 24 Menit lalu
                  </div>
               </div>
            </div>
         </div>

         <!-- Konten baris 2 -->
         <div class="row">
            <div class="col-md-4">
               <div class="card">
                  <img src="img/a1.png" class="card-img-to p-2">
                  <div class="card-body">
                     <a id="item-pengumuman" href="#">
                        <h4 class="card-title">Title</h4>
                     </a>
                     <hr>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <br><i class="fa fa-clock-o"></i> 24 Menit lalu
                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
                  <img src="img/a1.png" class="card-img-to p-2">
                  <div class="card-body">
                     <a id="item-pengumuman" href="#">
                        <h4 class="card-title">Title</h4>
                     </a>
                     <hr>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <br><i class="fa fa-clock-o"></i> 24 Menit lalu
                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
                  <img src="img/a1.png" class="card-img-to p-2">
                  <div class="card-body">
                     <a id="item-pengumuman" href="#">
                        <h4 class="card-title">Title</h4>
                     </a>
                     <hr>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <br><i class="fa fa-clock-o"></i> 24 Menit lalu
                  </div>
               </div>
            </div>
         </div>

         <div class="mt-3 d-flex justify-content-center">
            <a href="#" class="btn btn-outline-success">Memuat Lebih</a>
         </div>
   </section>

   <section style="background-color: #383838;">
      <div class="container">
         <div class="row">
            <div class="col pt-3 pb-3 text-white">
               <h6>Kontak Kami :</h6><br>
               <ul class="list-unstyled" style="font-size: 13px;">
                  <li><img src="img/icon/map.png" alt="ikon-map"> Jl. Rs. Fatmawati, Pondok Labu,
                     Jakarta Selatan, DKI Jakarta, 12450</li>
                  <li><img src="img/icon/phone.png" alt="ikon-map"> +62 765 6971</li>
                  <li><img src="img/icon/mail.png" alt="ikon-map"> upnvj@upnvj.ac.id</li>
                  <li><img src="img/icon/globe.png" alt="ikon-map"> https://www.upnvj.ac.id/</li>
               </ul>
            </div>
            <div class="align-self-center" style="width: 0px; height: 100px; border: 1px #06750F solid;"></div>
            <div class="col pt-3 pb-3 text-white" id="sosmed">
               <h6>Sosial Media :</h6><br>
               <div class="d-flex">
                  <a href="#"><img class="mr-3" src="img/icon/facebook.png" alt="fb"></a>
                  <a href="#"><img class="mr-3" src="img/icon/instagram.png" alt="ig"></a>
                  <a href="#"><img class="mr-3" src="img/icon/twitter.png" alt="twiter"></a>
                  <a href="#"><img class="mr-3" src="img/icon/youtube.png" alt="yt"></a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section style="background-color: #7D7D7D;">
      <div class="container text-center p-2 text-white">
         © 2013 - 2021 Universitas Pembangunan Nasional Veteran Jakarta | made with <img src="img/icon/coffee-cup.png"
            alt="kopi" width="24px" height="24px">
      </div>
   </section>

   <!-- JS -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
   </script>
</body>
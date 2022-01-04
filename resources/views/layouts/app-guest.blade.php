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
   <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" />

   <!-- Local css -->
   <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>

<body style="height: 100vh;">
   <!-- header -->
   <section class="bg-white shadow">
      <div class="container-fluid">
         <nav class="navbar navbar-expand-md bg-white">
            <a class="navbar-brand" href="#">
               <img id="logoku" src="{{asset('img/logoUPN.png')}}" alt="logo" height="63" width="243"
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

   @yield('content')

   <section class="position-sticky" style="background-color: #7D7D7D;bottom:0;">
      <div class="container text-center p-2 text-white">
         © {{date('Y')}} Universitas Pembangunan Nasional Veteran Jakarta
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
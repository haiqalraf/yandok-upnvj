<!doctype html>
<html lang="en">
<!-- !!! !!! -->

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
	  href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
	  rel="stylesheet">

   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&display=swap" rel="stylesheet">

   <!-- font awsome -->
   <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" />

   <!-- Local css -->
   <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

   @yield('css')
</head>

<body>
   <!-- header -->
   <div class="container-fluid mb-5 shadow bg-white">
	  <div class="col">
		 <nav class="navbar navbar-expand-md bg-white">
			<a id="link" class="navbar-brand" href="{{route('home')}}">
            @if (auth()->user()->is_admin===1)
            <img id="logoku" src="{{asset('img/logoUPNAdmin.png')}}" alt="logo" height="63" width="100%"
               class="d-inline-block align-top">
            @else
            <img id="logoku" src="{{asset('img/logoUPN.png')}}" alt="logo" height="63" width="243"
				  class="d-inline-block align-top">
            @endif
			   
			</a>
			<div class="collapse navbar-collapse">
			   <ul class="navbar-nav ml-auto">
				  <li class="nav-item">
					 <a class="nav-link active" href="{{route('home')}}"><i class="fa fa-home"></i></a>
				  </li>
              
				  @if (auth()->user()->is_admin===1)
              <li class="nav-item ml-2">
               <div class="dropdown ml-2">
                   <a class="nav-link dropdown-toggle active" type="button" id="dropdownMenu2"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Daftar Pesanan
                   </a>
                   <div class="dropdown-menu dropdown-menu-sm-right " aria-labelledby="dropdownMenu2">
                       <a href="{{route('admin.legalisir')}}" class="dropdown-item on" type="button"
                           style="font-size: small; font-weight: 600;">
                           Legalisir
                       </a>
                       <a href="{{route('admin.surat')}}" class="dropdown-item" type="button"
                           style="font-size: small; font-weight: 600;">
                           Surat Keterangan
                       </a>
                       <a href="{{route('admin.lainnya')}}" class="dropdown-item" type="button"
                           style="font-size: small; font-weight: 600;">
                           Lainnya
                       </a>
                   </div>

               </div>
           </li>
				  @else
            <li class="nav-item ml-2">
               <div class="dropdown ml-2">
               <a class="nav-link dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Pesan
               </a>
               <div class="dropdown-menu dropdown-menu-sm-right" aria-labelledby="dropdownMenu2">
                  <a href="{{url('legalisir')}}" class="dropdown-item" type="button"
                     style="font-size: small; font-weight: 600;">
                     Legalisir
                  </a>
                  <a href="{{url('surat')}}" class="dropdown-item" type="button"
                     style="font-size: small; font-weight: 600;">
                     Surat Keterangan
                  </a>
                  <a href="{{url('lainnya')}}" class="dropdown-item" type="button"
                     style="font-size: small; font-weight: 600;">
                     Lain-lainya
                  </a>
               </div>

               </div>
            </li>
            <li class="nav-item ml-2">
              <a class="nav-link" href="{{route('riwayat')}}">Riwayat Pemesanan</a>
            </li>
          </ul>
          <div class="dropdown ml-2">
            <a class="nav-link dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Bantuan
            </a>
				  @endif

				  
				  <div class="dropdown-menu dropdown-menu-sm-right" aria-labelledby="dropdownMenu2">
					 <a href="{{route('alur')}}" class="dropdown-item" type="button" style="font-size: small;">Alur Proses
						Pemesanan</a>
				  </div>

			   </div>
			   <div class="dropdown">
				  <a style="text-decoration: none;" class="dropdown-toggle text-dark" href="#" data-toggle="dropdown">
					 <img src="{{asset('img/profil.png')}}" height="64px" width="64px"
						style="border-radius: 50%; margin-left: 30px;">
				  </a>
				  <div class="dropdown-menu dropdown-menu-sm-right">
					 <ul class="list-unstyled p-3">
						<li style="font-size: medium; font-weight: 500;">Albet Dwi Pangestu</li>
						<li style="font-size: small;">18105110XX</li>
					 </ul>
					 <div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
				  </div>
			   </div>
			   <!-- Notif -->
			   <div class="dropdown">
				  <a style="text-decoration: none;" class=" text-dark" href="#" data-toggle="dropdown">
					 <img src="{{asset('img/icon/lonceng.png')}}" alt="notif" class="align-self-center ml-4 mb-2">

				  </a>
				  <div class="dropdown-menu dropdown-menu-sm-right">
					 <a href="{{route('alur')}}" class="dropdown-item" type="button" style="font-size: small;">
						<p>
						   Pesanan nomor XXX telah diverifikasi/selesai <span class="text-right">
						</p>
					 </a>
					 <a href="{{route('alur')}}" class="dropdown-item" type="button" style="font-size: small;">
						<p>
						   Pesanan nomor XXX telah diverifikasi/selesai <span class="text-right">
						</p>
					 </a>
					 <a href="{{route('alur')}}" class="dropdown-item" type="button" style="font-size: small;">
						<p>
						   Pesanan nomor XXX telah diverifikasi/selesai <span class="text-right">
						</p>
					 </a>
				  </div>
			   </div>
			</div>
		 </nav>
	  </div>
   </div>
   <!-- end header -->

   <!-- Konten -->
   <div id="wrapper" class="container mb-5">
		@yield('content')
   </div>

<section style="background-color: #06750F; margin-top: 30%;" class="bottom mt-4">
	<div class="container text-center p-2 text-white">
		© 2013 - 2021 Universitas Pembangunan Nasional Veteran Jakarta | made with <img src="{{asset('img/icon/coffee-cup.png')}}"
			alt="kopi" width="24px" height="24px">
	</div>
</section>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
@yield('script')
</body>

</html>
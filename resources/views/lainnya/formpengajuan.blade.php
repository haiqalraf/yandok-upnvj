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
            <a href="{{route('home')}}"><img src="img/logoUPN2.png" alt="logo"></a>
         </div>
      </div>
   </section>

   <form action="{{route('lainnya.pengajuan')}}" method="POST" enctype="multipart/form-data" class="container">
      @csrf

      <div class="row">
         <div class="col-2">
            <a class="btn btn-sm text-left aktif p-2" href="{{ route('lainnya') }}"><i
                  class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
         </div>
         <div class="col-10 bg-white rounded shadow p-3 mb-3">
            <h4>Pemesanan Dokumen</h4>
            <hr>
            <span style="font-size: small;">Harap lengkapi kolom dibawah ini untuk dapat mengajukan dokumen</span>
         </div>
      </div>

      <div class="row">
         <div class="col-10 offset-2 bg-white rounded shadow p-3 mb-3">
            {{-- <form action=""> --}}
               <div class="form-group">
                  <label for="labeljudulsurat" class="font-weight-bold">Nama Dokumen</label>
                  <hr>
                  <input type="text" name="dokumen_dipesan" class="form-control form-control-sm" id="labeljudulsurat" placeholder="Cantumkan nama dokumen yang akan anda ajukan disini"
                     required>
               </div>
            {{-- </form> --}}
         </div>
      </div>

      <div class="row">
         <div class="col-10 offset-2 bg-white rounded shadow p-3 mb-3">
            {{-- <form action=""> --}}
               <div class="form-group">
                  <label for="opsi" class="font-weight-bold">Jumlah Dokumen</label>
                  <hr>
                  <select class="form-control form-control-sm" id="opsi" name="jumlah_dokumen" required>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                     <option value="6">6</option>
                     <option value="7">7</option>
                     <option value="8">8</option>
                     <option value="9">9</option>
                     <option value="10">10</option>
                  </select>
               </div>
            {{-- </form> --}}
         </div>
      </div>

      <div class="row">
         <div class="col-10 offset-2 bg-white rounded shadow p-3 mb-3">
            {{-- <form action=""> --}}
               <div class="form-group">
                  <label for="upload" class="font-weight-bold">Persyaratan</label><br>
                  <hr>
                  <input type="file" id="upload" name="file" hidden required>
                  <label for="upload" class="btn-light p-2 rounded">Upload <i class="fa fa-upload"></i></label>
                  <span id="file-chosen" style="font-size: 12px; font-weight: 400; color:cadetblue;">
                     Tidak ada file yang dipilih.
                  </span><br>
                  <span style="font-size: 10px; color: slategray;">Catatan : Harap untuk di kompress dalam bentuk
                     <span class="font-weight-bold">RAR/ZIP</span> maksimal <span class="font-weight-bold">10MB</span> sebelum di upload</span>

                  <script>
                     const actualBtn = document.getElementById('upload');

                     const fileChosen = document.getElementById('file-chosen');

                     actualBtn.addEventListener('change', function () {
                        fileChosen.textContent = this.files[0].name
                     })
                  </script>
               </div>
            {{-- </form> --}}
         </div>
      </div>

      <div class="row mb-5">
         <button type="submit" class="col-10 offset-2 btn btn-sm btn-block btn-success mt-2"">Selesai</a>
      </div>
   </form>

   <!-- JS -->
   <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
               integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
               crossorigin="anonymous">
            </script>
</body>
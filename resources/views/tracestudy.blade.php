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
            <img src="{{asset('img/logoUPN2.png')}}" alt="logo">
         </div>
      </div>
   </section>

   <form class="container" action="{{route('tracestudy')}}" method="post">
    @csrf
      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
            <h4>Tracer Study</h4>
            <hr>
            <ul>
               <li>Anda diharapkan mengisi Tracer Study setelah anda lulus dari dari UPN Veteran Jakarta selama 6 bulan.
               </li>
               <li>Apabila anda belum memiliki pengalaman pekerjaan, anda dapat melewati form ini.</li>
            </ul>
         </div>
      </div>

      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
               <div class="form-group">
                  <label for="job" class="font-weight-bold">Tempat pekerjaan pertama setelah lulus</label>
                  <hr>
                  <input type="text" class="form-control form-control-sm" id="job" aria-describedby="job"
                     placeholder="Misal : PT. Yasagama" name="tempat_kerja">
               </div>
         </div>
      </div>

      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
               <div class="form-group">
                  <label for="role" class="font-weight-bold">Jabatan dalam perkejaan</label>
                  <hr>
                  <input type="text" class="form-control form-control-sm" id="job" aria-describedby="role"
                     placeholder="Misal : Designer UI/UX" name="jabatan">
               </div>
         </div>
      </div>

      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
               <div class="form-group">
                  <label for="time" class="font-weight-bold">Kapan Anda awal bekerja</label>
                  <hr>
                  <input type="date" class="form-control form-control-sm" id="time" aria-describedby="role"
                     placeholder="Misal : 31/12/2021" name="tanggal_kerja">
               </div>
         </div>
      </div>

      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
               <div class="form-group">
                  <label for="address" class="font-weight-bold">Dimana alamat tempat Anda bekerja ?</label>
                  <hr>
                  <textarea class="form-control form-control-sm"  name="alamat_kerja" id="address" rows="3"></textarea>
               </div>
         </div>
      </div>

      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
               <div class="form-group">
                  <label for="MOU" class="font-weight-bold">Anda sebagai karyawan tetap atau sistem kontrak ?</label>
                  <hr>
                  <input type="text" class="form-control form-control-sm" id="job" aria-describedby="MOU"
                     placeholder="Misal : Sistem Kontrak" name="status_kerja">
               </div>
         </div>
      </div>
      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-3">
               <div class="form-group">
                  <label for="time" class="font-weight-bold">Bila sistem kontrak, Anda dikontrak berapa lama?</label>
                  <hr>
                  <input type="text" class="form-control form-control-sm" id="job" aria-describedby="time"
                     placeholder="Misal : 2 tahun 0 Bulan" name="waktu_kontrak">
               </div>
         </div>
      </div>
      <div class="row mb-5">
         <button type="submit" class="btn btn-sm btn-block btn-success mt-2">Selesai</button>
      </div>
   </form>
   <!-- JS -->
   <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
   </script>
</body>
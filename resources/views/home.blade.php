
@extends('layouts.app')

@section('content')
<!-- Palet Sambutan -->
<div class="row bg-white rounded shadow mb-5">
   <div class="col p-3">
      <h5 class="text-left" style="font-family: 'Lora', serif;">Selamat Datang,<span style="color: #0c5012;">
         {{ $user->name }}</span> di Sistem Layanan Dokumen Alumni UPN Veteran Jakarta</h5>


   </div>
   <img src="{{asset('img/greeting.png')}}" alt="aksesoris" style="float: right; margin-bottom: 5px; opacity: 45%;"
      height="60px">
</div>

<!-- table Profil -->
<div class="row">
   <div class="col bg-white p-3 rounded shadow">
      <h3>Profil Saya</h3>
      <hr><br>
      <form action="{{ route('updUser') }}" method="POST" class="ajax_action">
         @csrf
         <table class="table table-borderless table-responsive-sm table-sm">
            <tr>
               <td>Nama</td>
               <td>
                  <input type="text" name="nama_alumni" class="form-control form-control-sm" placeholder="Nama anda" value="{{ $user->name }}" readonly>
               </td>
            </tr>
            @if ($user->is_admin == 0)
            <tr>
               <td>NIM</td>
               <td>
                  <input type="text" name="nim" class="form-control form-control-sm" placeholder="NIM" value="{{ $user->nim }}" readonly>
               </td>
            </tr>

            <tr>
               <td>Tahun Lulus</td>
               <td>
                  <input type="number" name="thn_lulus" class="form-control form-control-sm" placeholder="Tahun Lulus" value="{{ date('Y', strtotime($user->thn_lulus)) }}" readonly>
               </td>
            </tr>
            @else
                  <input type="hidden" name="nim" class="form-control form-control-sm" placeholder="NIM" value="{{ $user->nim }}" readonly>
            @endif

            <tr>
               <td>Email</td>
               <td>
                  <input type="email" name="email" class="form-control form-control-sm" value="{{ $user->email }}" placeholder="Email lengkap anda">
               </td>
            </tr>

            <tr>
               <td>Password</td>
               <td>
                  <input type="password" name="password" class="form-control form-control-sm" placeholder="Password"
                     value="">
                  <p class="text-danger text-right" style="font-size: 13px;">Ketik Minimal 6 karakter untuk mengganti
                     ke sandi baru.</p>
               </td>
            </tr>

            <tr>
               <td>Telepon Ponsel</td>
               <td id="handphone">
                  <input type="text" name="handphone" class="form-control form-control-sm" value="{{ $user->no_hp }}"
                     placeholder="No. Telepon Ponsel Anda">
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>

            <tr>
               <td>Telepon Rumah</td>
               <td id="telepon">
                  <input type="text" name="telepon" class="form-control form-control-sm" value="{{ $user->no_rumah }}"
                     placeholder="No. Telepon Rumah Anda">
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>

            <tr>
               <td>Ganti Foto</td>
               <td id="foto">
                  <input type="file" name="foto" class="btn-sm" placeholder="Foto anda">
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>

            @if ($user->is_admin == 0)
            <tr>
               <td>Pekerjaan</td>
               <td>
                  <input type="text" name="pekerjaan" class="form-control form-control-sm" readonly value="{{ $user->pekerjaan }}">
               </td>
            </tr>
            @endif

            <tr>
               <td>Alamat</td>
               <td id="alamat">
                  <textarea name="alamat" class="form-control form-control-sm" placeholder="Alamat" style="height: 250px;">{{ $user->address }}</textarea>
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>

         </table>
         <button type="submit" class="btn btn-sm btn-success pull-right">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Update Data Profil
         </button>
      </form>
   </div>

</div>
@endsection
@section('script')
<script>
$(document).ready(function () {
   $(".ajax_action").submit(function(event){

      $(':input[type="submit"]').prop('disabled', true);

      event.preventDefault();
      var post_url = $(this).attr("action"); // Get the form action URL
      var request_method = $(this).attr("method"); // Get form GET/POST method
      var form_data = new FormData(this);

      $.ajax({
         url : post_url,
         type: request_method,
         data : form_data,
         contentType: false,
         cache: false,
         processData: false,
         dataType: 'json', 
         success: function(results){
            
            var status = results.status;
            var text = results.text;

            if (status){

               alert(text);
               $(':input[type="submit"]').prop('disabled', false);
                  
            } else {

               alert(text);
               $(':input[type="submit"]').prop('disabled', false);
            
            }
         },
         error: function (xhr, status, error){

            var text = xhr.responseJSON.message

            alert(text);

            $(':input[type="submit"]').prop('disabled', false);
         }
      });
   });
});
</script>
@endsection
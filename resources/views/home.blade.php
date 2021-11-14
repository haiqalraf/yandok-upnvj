
@extends('layouts.app')

@section('content')
<!-- Palet Sambutan -->
<div class="row bg-white rounded shadow mb-5">
   <div class="col p-3">
      <h3 class="text-left" >Selamat Datang,<span style="color: #0c5012;">
         {{ $user->name }}</span> di Sistem Layanan Dokumen Alumni UPN Veteran Jakarta</h3>


   </div>
   <img src="{{asset('img/greeting.png')}}" alt="aksesoris" style="float: right; margin-bottom: 5px; opacity: 45%;"
      height="60px">
</div>

<!-- table Profil -->
<div class="row">
   <div class="col bg-white p-3 rounded shadow">
      <h3>Profil Saya</h3>
      <hr>
      @if (!auth()->user()->is_profile_completed)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Harap Lengkapi Biodata Profil Anda!</strong>
      </div>
      @endif      
      <br>
      <form action="{{ route('updUser') }}" method="POST" class="ajax_action">
         @csrf
         <table class="table table-borderless table-responsive-sm table-sm">
            <tr>
               <td>Nama</td>
               <td>
                  <input type="text" name="nama_alumni" class="form-control form-control-sm" placeholder="Nama anda" value="{{ empty($user->name) ? "-" : $user->name }}" readonly>
               </td>
            </tr>
            @if ($user->is_admin == 0)
            <tr>
               <td>NIM</td>
               <td>
                  <input type="text" name="nim" class="form-control form-control-sm" placeholder="NIM" value="{{ empty($user->nim) ? "-" : $user->nim }}" readonly>
               </td>
            </tr>

            <tr>
               <td>Fakultas</td>
               <td>
                  <input type="text" name="fakultas" class="form-control form-control-sm" placeholder="Fakultas" value="{{ empty($user->faculty) ? "-" : $user->faculty->nama }}" readonly>
               </td>
            </tr>

            <tr>
               <td>Tahun Lulus</td>
               <td>
                  <input type="text" name="thn_lulus" class="form-control form-control-sm" placeholder="Tahun Lulus" value="{{empty($user->thn_lulus) ? "-" : $user->thn_lulus}}" readonly>
               </td>
            </tr>
            <tr>
               <td>Tanggal Lahir</td>
               <td id="tgl">
                  <input type="text" class="form-control form-control-sm" value="{{ empty($user->tanggal_lahir) ? "-" : $user->tanggal_lahir }}" readonly>
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>
            @else
                  <input type="hidden" name="nim" class="form-control form-control-sm" placeholder="NIM" value="{{ empty($user->nim) ? "-" : $user->nim }}" readonly>
            @endif

            <tr>
               <td>Email</td>
               <td>
                  <input type="email" name="email" class="form-control form-control-sm" value="{{ $user->email }}" placeholder="Email lengkap anda" readonly>
               </td>
            </tr>

            <tr>
               <td>Password</td>
               <td>
                  <a href="{{route('password.edit')}}" class="btn btn-link">Ubah Sandi</a>
               </td>
            </tr>

            <tr>
               <td>Telepon Ponsel</td>
               <td id="handphone">
                  <input type="text" name="handphone" class="form-control form-control-sm" value="{{ $user->no_hp }}"
                     placeholder="No. Telepon Ponsel Anda" pattern="^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$" required>
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>

            <tr>
               <td>Telepon Rumah</td>
               <td id="telepon">
                  <input type="text" name="telepon" class="form-control form-control-sm" value="{{ $user->no_rumah }}"
                     placeholder="No. Telepon Rumah Anda" pattern="^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$" required>
                     
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

            <tr>
               <td>Alamat </td>
               <td id="alamat">
                  <textarea name="alamat" class="form-control form-control-sm" placeholder="Alamat" style="height: 250px;" required>{{ $user->address }}</textarea>
                     
                  <div class="invalid-feedback">Please fill out this field.</div>
               </td>
            </tr>

            @if ($user->is_admin == 0)
            
            <tr>
               <td>Pekerjaan saat ini</td>
               <td>
                  <input type="text" name="pekerjaan" class="form-control form-control-sm" value="{{ $user->pekerjaan }}" required>
               </td>
            </tr>
            <tr>
               <td>Nama perusahaan</td>
               <td>
                  <input type="text" name="nama_perusahaan" class="form-control form-control-sm" value="{{ $user->nama_perusahaan }}" required>
               </td>
            </tr>
            <tr>
               <td>Jabatan</td>
               <td>
                  <input type="text" name="jabatan" class="form-control form-control-sm" value="{{ $user->jabatan }}" required>
               </td>
            </tr>
            <tr>
               <td>Alamat Perusahaan</td>
               <td>
                  <input type="text" name="alamat_perusahaan" class="form-control form-control-sm" value="{{ $user->alamat_perusahaan }}" required>
               </td>
            </tr>
            @endif

         </table>
         <button type="submit" class="btn btn-sm btn-success pull-right">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Update Data Profil
         </button>
      </form>
   </div>
   @if (in_array(auth()->user()->is_admin, [0, null])
      && !auth()->user()->is_tracer 
      && auth()->user()->thn_lulus <= now()->format('Y')
      && now()->addYear(-5)->format('Y') <= auth()->user()->thn_lulus)
   <!-- Modal -->
   <div class="modal fade" id="tracestudy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-warning"></i> Pemberitahuan
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               Agar dapat melakukan pemesanan pada layanan YANDOK UPNVJ, anda harus mengisi <span
                  class="font-weight-bold">Trace Study</span> terlebih dahulu
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-success" onclick="tracer()">Isi sekarang</button>
            </div>
         </div>
      </div>
   </div>
   @endif
</div>
<div class="alert"></div>
@endsection
@section('script')
<script src="{{asset('js/alert.js')}}"></script>
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

               showAlert('Berhasil', text, function (e) {
                  location.reload();
               })
               $(':input[type="submit"]').prop('disabled', false);
                  
            } else {

               showAlert('Gagal', text);
               $(':input[type="submit"]').prop('disabled', false);
            
            }
         },
         error: function (xhr, status, error){

            var text = xhr.responseJSON.message

            showAlert('Gagal', text);

            $(':input[type="submit"]').prop('disabled', false);
         }
      });
   });
});
</script>
@if (session('status'))
<script>
   showAlert("Berhasil", "{{session('status')}}");
</script>
@endif
@isset(auth()->user()->thn_lulus)
@if (!auth()->user()->is_tracer 
   && auth()->user()->thn_lulus <= now()->format('Y')
   && now()->addYear(-5)->format('Y') <= auth()->user()->thn_lulus)
<script>
   $('#tracestudy').modal('show');
</script>

<script>
   function tracer() {
      window.open("https://tracer.upnvj.ac.id/admin/login", "_blank")
      window.location.href = "{{route('tracestudy')}}";
   }
</script>
@endif
@endisset
@endsection
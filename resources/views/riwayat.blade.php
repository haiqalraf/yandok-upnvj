
@extends('layouts.app')

@section('content')
   <div class="row">
      <div class="col bg-white rounded shadow p-3">
         <h3>Riwayat Pesanan Anda</h3>
         <hr>
         <div class="mb-4" style="font-size: 15px;">Berikut daftar riwayat pesanan anda</div>
         <table class="table table-striped table-bordered mydatatable" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
               <tr>
                  <th>Kode Pesanan</th>
                  <th>Status</th>
                  <th>Tanggal Memesan</th>
                  <th>Tanggal Target Selesai</th>
                  <th>Opsi</th>
               </tr>
            </thead>
            <tbody>
               @foreach($datas as $data)

                  <tr align="center">
                     <td>{{$data->id}}</td>
                     <td><span class="badge {{$data->badge}} p-2">{{$data->verifikasi}}</span></td>
                     <td>{{date('d F Y', strtotime($data->created_at))}}</td>
                     <td>{{date('d F Y', strtotime($data->updated_at))}}</td>
                     <td>
                        <a href="detail2.html" title="Detail" class="btn btn-sm btn-success">Detail <i
                              class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        @if ($data->pesanan)
                        <a href="ambil.html" title="Ambil" class="btn btn-sm btn-primary">Ambil Pesanan <i
                              class="fa fa-dropbox"></i>

                        </a>
                        @endif
                     </td>
                  </tr>
               @endforeach


            </tbody>
         </table>
         <hr>
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
            alert("Somethink Error, Please Try Again Later.");

            $(':input[type="submit"]').prop('disabled', false);
         }
      });
   });
});
</script>
@endsection
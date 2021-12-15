
@extends('layouts.app')

@section('content')
   <div class="row">
      <div class="col bg-white rounded shadow p-3">
         <h3>Riwayat Pesanan Anda</h3>
         <hr>
         <div class="mb-4" style="font-size: 1rem;">Berikut daftar riwayat pesanan anda</div>
         <table class="table table-striped table-bordered mydatatable" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
               <tr>
                  <th>Kode Pesanan</th>
                  <th>Status</th>
                  <th>Tanggal Memesan</th>
                  <th>Tanggal Selesai</th>
                  <th>Opsi</th>
               </tr>
            </thead>
            <tbody>
               @foreach($datas as $data)

                  <tr align="center">
                     <td>{{strtoupper($data->id)}}</td>
                     <td><span class="badge {{$data->badge}} p-2">{{$data->verifikasi}}</span></td>
                     <td>{{$data->created_at->locale('id')->isoFormat('LL')}}, {{$data->created_at->locale('id')->isoFormat('HH:mm')}}</td>
                     <td>{{$data->completed_at ? $data->completed_at->locale('id')->isoFormat('LL').', '.$data->completed_at->locale('id')->isoFormat('HH:mm') : '-'}}</td>
                     <td>
                        <a href="{{ url('/riwayat/detail') }}/{{$data->id}}" title="Detail" class="btn btn-sm btn-success" target="blank">Detail <i
                              class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        @if ($data->pesanan)
                           @if ($data->tujuan==2)
                              <a href="{{route('bayar', ['id' => $data->id])}}" title="Ambil" class="btn btn-sm btn-warning" target="blank">Bayar Pesanan <i class="fa fa-credit-card-alt"></i></a>
                           @else
                              <a href="{{ url('/riwayat/ambil') }}/{{$data->id}}" title="Ambil" class="btn btn-sm btn-primary" target="blank">Ambil Pesanan <i class="fa fa-dropbox"></i></a>
                           @endif
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
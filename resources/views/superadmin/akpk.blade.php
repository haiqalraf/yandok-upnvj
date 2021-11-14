@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col bg-white rounded shadow p-3">
        <h3>Pengolahan Akun AKPK</h3>
        <hr>
        <div class="mb-4" style="font-size: 1rem;">Berikut daftar user AKPK</div>
        <table class="table table-striped table-bordered mydatatable" style="width: 100%;">
            <thead class="text-white" style="background-color: #06750F;">
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Hapus Akun</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akpk as $item)
                <tr>
                    <td>{{$item->nim}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->password}}</td>
                    <td>
                        @if(Cache::has('user-is-online-' . $item->id))
                            <span><i class="fa fa-circle" style="color: #06750F;"></i> Online
                        @else
                            <span><i class="fa fa-circle" style="color: red;"></i> Offline
                        @endif
                    </td>
                    <td>
                        <form action="{{route('superadmin.akpk.delete')}}" class="ajax_action" method="post">
                            @csrf
                            <input type="hidden" name="nim" id="" value="{{$item->nim}}">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>


        <div class="text-right">
            <a href="{{route('superadmin.akpk.create')}}" class="btn btn-sm btn-success mt-2 text-white">
                <i class="fa fa-plus"></i>
                Akun Baru
            </a>
        </div>
    </div>

</div>
   <div class="alert"></div>
@endsection

@section('script')
<!-- JS for data table CDN -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<!-- custom script -->
<script>
    $('.mydatatable').DataTable();
</script>
<script src="{{asset('js/alert.js')}}"></script>
<script>
      $(document).ready(function () {
         // ALFIO
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
                  showAlert("Berhasil", text, function (e) {
                     window.location.reload();
                  });
                //   showAlert("Berhasil", text);
                  $(':input[type="submit"]').prop('disabled', false);
                  // window.location.replace("login");
                     
               } else {

                  showAlert("Gagal", text);
                  $(':input[type="submit"]').prop('disabled', false);
               
               }
            },
            error: function (xhr, status, error){

               var text = xhr.responseJSON.message

               showAlert("Gagal", text);

               $(':input[type="submit"]').prop('disabled', false);
            }
         });
         });
      });
   </script>
@endsection
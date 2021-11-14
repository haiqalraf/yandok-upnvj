@extends('layouts.app')

@section('content')
   <div class="container mb-5">
      <div class="row">
         <div class="col bg-white rounded shadow p-3 mb-5">
            <img src="img/Info.png" alt="aksesoris" style="float: right; margin-bottom: 15px;" height="20px">
            <ul>
               <li>Isi dan lengkapi persyaratan dokumen yang ingin dipesan</li>
               <li>Pastikan dokumen yang anda ajukan sudah ditanyakan ke pihak ULT sehingga dapat dipesan</li>
               <li>Anda wajib menyertakan persyaratan dokumen untuk pengajuan dokumen yang akan dipesan.</li>
            </ul>
         </div>
      </div>
      <div class="row">
         <form action="{{ route('lainnya') }}" method="POST" enctype="multipart/form-data" class="col bg-white rounded shadow p-3">
            @csrf
            <h3>List Dokumen Yang ingin di ajukan</h3>
            <hr>
            <div class="mb-4" style="font-size: 1rem;">Berikut Daftar Produk yang tersedia bagi anda.</div>

            <table class="table table-bordered">
               <thead class="text-white" style="background-color: #06750F;">
                  <tr>
                     <th>Jenis Dokumen</th>
                     <th style="width: 100px;">Jumlah</th>
                  </tr>
               </thead>
               <tbody>
                  @php
                  $count = 0;
                  @endphp
                  @foreach ($document as $item)
                  <tr>
                     <td>{{$item->dokumen_dipesan}}</td>
                     <td>
                        <input id="item[{{++$count;}}]" type="number" min="0" class="form-control form-control-sm" style="width: 100px;"
                           value="{{(int)$item->jumlah_dokumen}}" name="item[{{$item->id}}]">
                     </td>
                  </tr>
                  @endforeach
               </tbody>
               <tfoot>
                  <tr>
                     <td class="text-center">Total</td>
                     <td colspan="2" class="font-weight-bold text-center">
                        <div class="form-group mb-0">
                           <input type="text" id="total" class="form-control" readonly="">
                        </div>
                     </td>
                  </tr>
               </tfoot>
            </table>
            <hr>
            <div class="text-right">
               <a href="{{route('lainnya.pengajuan')}}" class="btn btn-sm btn-success mt-2 text-white">
                  <i class="fa fa-file-o"></i>
                  Buat Pengajuan Dokumen
               </a>

               
               @if($document->isNotEmpty())
               <button type="button" data-target="#exampleModal" data-toggle="modal" title="Buat Pesanan"
                  class="btn btn-sm btn-success mt-2 text-white">
                  Simpan
               </button>
               @endif

               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true" data-backdrop="static" data-keyboard="false" tabindex="-1">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Buat Pesanan</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body text-sm-left bg-light" style="font-size: 15px;">
                           <div class="form-group metode">
                              <label for="tujuan">Metode Pengiriman</label>
                              <select class="form-control" id="tujuan" name="tujuan">
                                 <option value="1" selected>Ambil Langsung ke UPNVJ</option>
                                 <option value="2">Dikirim ke Alamat Saya</option>
                              </select>
                           </div>
                           
                        </div>
                        <div class="mb-3 text-left p-3">
                           Apakah anda yakin membuat pesanan dengan jumlah dokumen yang anda tentukan??<br><br>Pesanan
                           yang telah
                           dibuat tidak dapat diubah lagi jumlahnya
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"><i
                                 class="fa fa-times"></i>
                              Close</button>
                           <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Ya, Saya
                              Yakin.</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('script')
   <!-- Script auto calculation -->
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function () {
         $('#tujuan').change(function() {
            if($(this).val()==2) {
               console.log($(this).val())
               $(this).parent().parent().append(`
                  <div class="form-group alamat">
                     <label for="alamat">Alamat Pengiriman</label>
                     <textarea class="form-control" id="alamat" rows="3" name="alamat">{{auth()->user()->address}}</textarea>
                  </div>
               `)
            } else {
               $(this).parent().parent().find('.alamat').remove()
            }
         })
         $("#item1, #item2, #item3, #item4, #item5, #item6, #item7, #item8, #item9, #item10, #item11").change(
            function () {
               var item1 = $("#item1").val();
               var item2 = $("#item2").val();
               var item3 = $("#item3").val();
               var item4 = $("#item4").val();
               var item5 = $("#item5").val();
               var item6 = $("#item6").val();
               var item7 = $("#item7").val();
               var item8 = $("#item8").val();
               var item9 = $("#item9").val();
               var item10 = $("#item10").val();
               var item11 = $("#item11").val();
               var item12 = $("#item12").val();

               // var total = parseInt(item1) + parseInt(item2);
               var total = parseInt(item1) + parseInt(item2) + parseInt(item3) + parseInt(item4) + parseInt(
                  item5) + parseInt(item6) + parseInt(item7) + parseInt(item8) + parseInt(item9) + parseInt(
                  item10) + parseInt(item11) + parseInt(item12);
               $("#total").val(total);
            });
      });
   </script>
@endsection
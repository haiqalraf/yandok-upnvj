@extends('layouts.app')

@section('content')
   <div class="container mb-5">
      <div class="row">
         <form action="{{ route('legalisir.store') }}" method="POST" enctype="multipart/form-data" class="col bg-white rounded shadow p-3">
            @csrf
            <h3>Pemesanan Legalisir</h3>
            <hr>
            <div class="mb-4" style="font-size: 1rem;">Berikut Daftar Produk yang tersedia bagi anda.</div>

            <table class="table table-bordered">
               <thead class="text-white" style="background-color: #06750F;">
                  <tr>
                     <th>Jenis Dokumen</th>
                     <th>Jumlah</th>
                     <th>Persyaratan</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Legalisir Ijazah</td>
                     <td>
                        <input id="item1" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_01">
                     </td>
                     <td rowspan="12" class="text-center align-middle" style="font-size: 14px;">
                        Scan ijazah/transkrip asli
                        <br>
                        <input type="file" id="upload" name="file" hidden>
                        <label for="upload" class="btn-light p-2 rounded">Upload <i class="fa fa-upload"></i></label>
                        <span id="file-chosen" style="font-size: 13px; font-weight: 400; color:cadetblue;">Tidak ada
                           file
                           yang
                           dipilih
                        </span>
                        
                        <p style="font-size: 10px; color: slategray;">Catatan : Harap untuk di kompress dalam bentuk
                           RAR/ZIP sebelum di upload</p>

                        <script>
                           const actualBtn = document.getElementById('upload');

                           const fileChosen = document.getElementById('file-chosen');

                           actualBtn.addEventListener('change', function () {
                              fileChosen.textContent = this.files[0].name
                           })
                        </script>
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Transkrip</td>
                     <td>
                        <input id="item2" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_02">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Piagam Cum Laude</td>
                     <td>
                        <input id="item3" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_03">
                     </td>
                  </tr>
                  <tr>
                     <td>Terjemahan Ijazah</td>
                     <td>
                        <input id="item4" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_04">
                     </td>
                  </tr>
                  <tr>
                     <td>Terjemahan Transkrip</td>
                     <td>
                        <input id="item5" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_05">
                     </td>
                  </tr>
                  <tr>
                     <td>Terjemahan Piagam Cumlaude</td>
                     <td>
                        <input id="item6" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_06">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Akreditasi Program Studi (Tanggal Lulus)</td>
                     <td>
                        <input id="item7" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_07">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Akreditasi Program Studi (Saat Ini)</td>
                     <td>
                        <input id="item8" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_08">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Akreditasi Institusi (Tanggal Lulus)</td>
                     <td>
                        <input id="item9" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_09">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Akreditasi Institusi (Saat Ini)</td>
                     <td>
                        <input id="item10" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_10">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Akreditasi Program Profesi - Spesialis (Tanggal Lulus)</td>
                     <td>
                        <input id="item11" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_11">
                     </td>
                  </tr>
                  <tr>
                     <td>Legalisir Akreditasi Program Profesi - Spesialis (Saat Ini)</td>
                     <td>
                        <input id="item12" type="number" min="0" class="form-control form-control-sm" style="width: 65px;"
                           value="0" name="dok_12">
                     </td>
                  </tr>
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
               <button type="button" class="btn btn-sm btn-success mt-2 text-white">
                  <i class="fa fa-floppy-o"></i>
                  Update
               </button>

               <button type="button" data-target="#exampleModal" data-toggle="modal" title="Buat Pesanan"
                  class="btn btn-sm btn-success mt-2 text-white">
                  Simpan
               </button>

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
                           <div class="form-group">
                              <label for="opsirole">Anda memesan dokumen untuk memenuhi kebutuhan apa?</label>
                              <select class="form-control" id="opsirole" name="kebutuhan">
                                 <option value="ASN" selected>ASN</option>
                                 <option value="TNI atau Polri">TNI atau Polri</option>
                                 <option value="Swasta">Swasta</option>
                                 <option value="Lainnya">Lainnya</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="alasan">Apakah anda memiliki permintaaan khusus? Jika ada harap tulis dikolom
                                 di bawah ini</label>
                              <input type="text" class="form-control form-control-sm" name="keterangan">
                           </div>
                        </div>

                        <div class="mb-3 text-left p-3">
                           <span style="font-size: 14px; color: darkgray;"> Apakah anda yakin
                              membuat pesanan dengan
                              jumlah dokumen yang ada?<br>Dokumen yang telah dipesan tidak bisa dirubah.</span>
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
         </div>
      </div>
   </div>
@endsection

@section('script')
   <!-- Script auto calculation -->
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function () {
         $("#item1, #item2, #item3, #item4, #item5, #item6, #item7, #item8, #item9, #item10, #item11, #item12").change(
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
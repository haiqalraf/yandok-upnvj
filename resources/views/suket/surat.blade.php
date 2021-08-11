@extends('layouts.app')

@section('content')
   <div class="container mb-5">
      <form action="{{url('surat')}}" method="POST" class="row" enctype="multipart/form-data">
         @csrf
         <div class="col bg-white rounded shadow p-3">
            <h3>Pemesanan Surat Keterangan</h3>
            <hr>
            <div class="mb-4" style="font-size: 15px;">Berikut daftar produk yang tersedia bagi anda.</div>

            <table class="table table-bordered table-striped table-responsive-md">
               <thead class="text-white" style="background-color: #06750F;">
                  <tr>
                     <th>Jenis Dokumen</th>
                     <th>Persyaratan</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <div class="panel panel-default">
                           <div class="panel-heading font-weight-bold">Dokumen Surat Keterangan Pengganti</div>
                           <hr>
                           <div class="panel-body">
                              <!-- membuat form  -->
                              <div class="bordered">
                                 <div class="control-group after-add-more pl-3">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_pengganti[1]" id="jenisPengganti1" value="Surat Keterangan Pengganti Ijazah" checked>
                                       <label class="form-check-label" for="jenisPengganti1">Surat Keterangan Pengganti Ijazah</label>
                                    </div>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_pengganti[2]" id="jenisPengganti2" value="Surat Keterangan Pengganti Transkrip" checked>
                                       <label class="form-check-label" for="jenisPengganti2">Surat Keterangan Pengganti Transkrip</label>
                                    </div>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_pengganti[3]" id="jenisPengganti3" value="Surat Keterangan Pengganti SKPI" checked>
                                       <label class="form-check-label" for="jenisPengganti3">Surat Keterangan Pengganti SKPI</label>
                                    </div>
                                    <br><br>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                     <td class="align-middle text-center" style="font-size: 15px;">
                        <div class="d-flex justify-content-center">
                           <ol type="number" class="text-left" style="font-size: 13px;">
                              <li>Scan FC Ijazah (Bagi yang memesan Pengganti Ijazah)</li>
                              <li>Scan FC Transkrip (Bagi yang memesan Pengganti Transkrip)</li>
                              <li>Scan FC SKPI (Bagi yang memesan Pengganti SKPI)</li>
                              <li>Surat permohonan yang ditujukan ke dekan</li>
                              <li>Akte kelahiran / Akte Notaris</li>
                              <li>Foto 3x4 hitam putih</li>
                           </ol>
                        </div>
                        <br>

                        <input type="file" id="upload" name="upload_pengganti" hidden>
                        <label for="upload" class="btn-light p-2 rounded">Upload <i class="fa fa-upload"></i></label>
                        <span id="file-chosen" style="font-size: 12px; font-weight: 400; color:cadetblue;">
                           Tidak ada file yang dipilih.
                        </span><br>
                        <span style="font-size: 10px; color: slategray;">Catatan : Harap untuk di kompress dalam bentuk
                           RAR/ZIP sebelum di upload</span>

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
                     <td>
                        <div class="panel panel-default">
                           <div class="panel-heading font-weight-bold">Dokumen Surat Keterangan Perubahan</div>
                           <hr>
                           <div class="panel-body">
                              <!-- membuat form  -->
                              <div class="bordered">
                                 <div class="control-group after-add-more pl-3">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_perubahan[1]" id="jenisPerubahan1" value="Surat Keterangan Perubahan Ijazah" checked>
                                       <label class="form-check-label" for="jenisPerubahan1">Surat Keterangan Perubahan Ijazah</label>
                                    </div>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_perubahan[2]" id="jenisPerubahan2" value="Surat Keterangan Perubahan Transkrip" checked>
                                       <label class="form-check-label" for="jenisPerubahan2">Surat Keterangan Perubahan Transkrip</label>
                                    </div>
                                    <br><br>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                     <td rowspan="2" class="align-middle text-center" style="font-size: 15px;">
                        <div class="d-flex justify-content-center">
                           <ol type="number" class="text-left" style="font-size: 13px;">
                              <li>Scan FC Ijazah (Bagi yang memesan Perubahan/Ralat Ijazah)</li>
                              <li>Scan FC Transkrip (Bagi yang memesan Perubahan/Ralat Transkrip)</li>
                              <li>Surat permohonan yang ditujukan ke dekan</li>
                              <li>Surat Keterangan Hilang Dari Polisi</li>
                              <li>Foto 3x4 hitam putih</li>
                           </ol>
                        </div>
                        <br>

                        <input type="file" id="upload2" name="upload_perubahan_ralat" hidden>
                        <label for="upload2" class="btn-light p-2 rounded">Upload <i class="fa fa-upload"></i></label>
                        <span id="file-chosen2" style="font-size: 12px; font-weight: 400; color:cadetblue;">
                           Tidak ada file yang dipilih.
                        </span><br>
                        <span style="font-size: 10px; color: slategray;">Catatan : Harap untuk di kompress dalam bentuk
                           RAR/ZIP sebelum di upload</span>

                        <script>
                           const actualBtn2 = document.getElementById('upload2');

                           const fileChosen2 = document.getElementById('file-chosen2');

                           actualBtn2.addEventListener('change', function () {
                              fileChosen2.textContent = this.files[0].name
                           })
                        </script>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="panel panel-default">
                           <div class="panel-heading font-weight-bold">Dokumen Surat Keterangan Ralat</div>
                           <hr>
                           <div class="panel-body">
                              <!-- membuat form  -->
                              <div class="bordered">
                                 <div class="control-group after-add-more pl-3">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_ralat[1]" id="jenisRalat1" value="Surat Keterangan Ralat Ijazah" checked>
                                       <label class="form-check-label" for="jenisRalat1">Surat Keterangan Ralat Ijazah</label>
                                    </div>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_ralat[2]" id="jenisRalat2" value="Surat Keterangan Ralat Transkrip" checked>
                                       <label class="form-check-label" for="jenisRalat2">Surat Keterangan Perubahan Transkrip</label>
                                    </div>
                                    <br><br>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="panel panel-default">
                           <div class="panel-heading font-weight-bold">Dokumen Surat Keterangan Alumni</div>
                           <hr>
                           <div class="panel-body">
                              <!-- membuat form  -->
                              <div class="bordered">
                                 <div class="control-group after-add-more pl-3">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="jenis_alumni[1]" id="jenisAlumni1" value="Surat Keterangan Alumni" checked>
                                       <label class="form-check-label" for="jenisRalat1">Surat Keterangan Alumni</label>
                                    </div>
                                    <br><br>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                     <td rowspan="2" class="align-middle text-center" style="font-size: 15px;">
                        <div class="d-flex justify-content-center">
                           <ol type="" class="text-left" style="font-size: 13px; list-style: none;">
                              <li>Scan Ijazah / Transkrip Nilai</li>
                           </ol>
                        </div>
                        <br>

                        <input type="file" id="upload3" name="upload_alumni" hidden>
                        <label for="upload3" class="btn-light p-2 rounded">Upload <i class="fa fa-upload"></i></label>
                        <span id="file-chosen3" style="font-size: 12px; font-weight: 400; color:cadetblue;">
                           Tidak ada file yang dipilih.
                        </span><br>
                        <span style="font-size: 10px; color: slategray;">Catatan : Harap untuk di kompress dalam bentuk
                           RAR/ZIP sebelum di upload</span>

                        <script>
                           const actualBtn3 = document.getElementById('upload3');

                           const fileChosen3 = document.getElementById('file-chosen3');

                           actualBtn3.addEventListener('change', function () {
                              fileChosen3.textContent = this.files[0].name
                           })
                        </script>
                     </td>
                  </tr>
               </tbody>
            </table>
            <hr>
            <div class="text-right">
               <button type="button" class="btn btn-sm mt-2 text-white" style="background-color: #06750F;">
                  <i class="fa fa-floppy-o"></i>
                  Update
               </button>

               <button type="button" data-target="#exampleModal" data-toggle="modal" title="Buat Pesanan"
                  class="btn btn-sm mt-2 text-white" style="background-color: #06750F;">
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
         </div>
      </form>
   </div>
@endsection
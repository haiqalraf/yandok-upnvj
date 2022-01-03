@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row d-flex justify-content-center mb-5">
         <div class="col-11 bg-white rounded shadow p-3">
            <h6 class="text-center">Alur Pemesanan Dokumen pada Sistem Layanda UPN Vetaran Jakarta</h6>
         </div>
      </div>
      <div class="row d-flex justify-content-center">
         <div class="col-3 bg-white rounded shadow p-3">
            <img src="img/ilustration/order.png" class="card-img-top" alt="...">
            <hr>
            <div class="card-body">
               <p class="card-text text-justify" style="font-size: 14px;">Pilih, temukan dan tentukan jumlah dokumen
                  serta dilanjut dengan buat pesanan dengan menekan tombol <span class="text-primary">simpan</span> yang
                  dipesan pada menu <a href="#"
                     style="color: #06750F; font-weight: 600; text-decoration: none;">Pesan</a></p>
            </div>
         </div>

         <div class="col-1 align-self-center">
            <img src="img/icon/panah.png" alt="panah">
         </div>

         <div class="col-3 bg-white rounded shadow p-3">
            <img src="img/ilustration/wait.png" class="card-img-top" alt="...">
            <hr>
            <div class="card-body">
               <p class="card-text text-justify" style="font-size: 14px;">Tunggu hingga pesanan anda berstatus <span
                     class="badge-success p-1 rounded" style="font-size: 10px;">Selesai</span> pada daftar riwayat
                  pemesanan pada menu <a href="#"
                     style="color: #06750F; font-weight: 600; text-decoration: none;">Riwayat Pemesanan</a> dan untuk
                  detailnya kamu bisa membuka sub menu <span class="text-info">Detail</span></p>
            </div>
         </div>

         <div class="col-1 align-self-center">
            <img src="img/icon/panah.png" alt="panah">
         </div>
         <div class="col-3 bg-white rounded shadow p-3">
            <img src="img/ilustration/got_it.png" class="card-img-top" alt="...">
            <hr>
            <div class="card-body">
               <p class="card-text text-justify" style="font-size: 14px;">Ambil pesananmu di ULT(Unit Layanan Terpadu)
                  di kampus Cilandak sambil menunjukan kode transaksi pesanan yang ingin kamu ambil dengan cara menekan
                  tombol <span class="text-primary">Ambil pesanan</span> pada menu <a href="#"
                     style="color: #06750F; font-weight: 600; text-decoration: none;">Riwayat Pemesanan</a></p>
            </div>
         </div>


      </div>
   </div>
@endsection
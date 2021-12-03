
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col bg-white rounded shadow p-3">
            <div class="d-flex justify-content-end">
               <a href="{{route('riwayat')}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
            </div>
            <h3>Riwayat Pesanan Anda</h3>
            <hr>
            <div class="mb-4" style="font-size: 1rem;">Berikut daftar riwayat pesanan anda</div>

                <table class="table table-bordered table-md table-responsive-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode Pemesanan</th>
                            <th>{{strtoupper($data->id)}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                            <td>Fakultas</td>
                            <td>{{$data->FAK}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pemesanan</td>
                            <td>{{$data->created_at->locale('id')->isoFormat('LLL')}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{$data->completed_at ? $data->completed_at->locale('id')->isoFormat('LLL') : '-'}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Dikirim</td>
                            <td>{{$data->sent_at ? $data->sent_at->locale('id')->isoFormat('LLL') : '-'}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Diterima</td>
                            <td>{{$data->accepted_at ? $data->accepted_at->locale('id')->isoFormat('LLL') : '-'}}</td>
                        </tr>
                        <tr>
                            <td>Detail Status</td>
                            @if ($data->verifikasi == 0)
                                @if ($data->getCommentIfExists($data))
                                <td>{{$data->getCommentIfExists($data)}}</td>
                                @else
                                <td>Dokumen yang Anda unggah tidak sesuai persyaratan. Harap di cek lagi dengan teliti dan lakukan pesanan ulang</td>
                                @endif

                            @elseif ($data->verifikasi == 1)

                                <td>Pesanan Anda akan ditinjau</td>
                            
                            @elseif ($data->verifikasi == 2)

                                <td>Pesanan Anda sedang diproses</td>

                            @elseif($data->verifikasi == 3)

                                @if ($data->tujuan==2)

                                    @if ($data->verifikasi_pengiriman == 1)

                                        <td>Sudah Selesai, harap melakukan pembayaran <a class="text-info" href="{{ route('bayar', ['id'=> $data->id]) }}">di sini</a></td>
                                    
                                    @elseif($data->verifikasi_pengiriman == 2)

                                        <td>Bukti Pembayaran sedang diverifikasi</td>

                                    @elseif($data->verifikasi_pengiriman == 3)

                                        <td>Bukti Pembayaran Telah dikonfirmasi dan Pesanan sedang dikirim dengan resi <span class="text-info">{{$data->resi}}</span></td>

                                    @elseif($data->verifikasi_pengiriman == 4)

                                        <td>Sudah Selesai, Pesanan telah diterima dengan resi <span class="text-info">{{$data->resi}}</span></td>

                                    @endif

                                @else

                                    <td>Sudah Selesai, harap mengambil dokumen di loket ULT dengan menunjukan <a class="text-info" href="{{ url('/riwayat/ambil') }}/{{$data->id}}">kode pesanan</a></td>

                                @endif

                            @endif
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-md table-responsive-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Jenis Dokumen</th>
                            <th>Jumlah Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $x = 0
                        @endphp
                        @foreach($data->table as $table)
                            @php
                            $x++
                            @endphp
                            <tr>
                                <td>{{$x}}</td>
                                <td>{{$table['jenis']}}</td>
                                <td>{{intval($table['jumlah'])}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($data->verifikasi_pengiriman == 3)

                    <form action="{{route('terima', ['id' => $data->id, 'status_kirim' => 4])}}" method="post">
                    @csrf
                    @method('PUT')
                        <button class="btn btn-success w-100" type="submit">Terima Pesanan</button>
                    </form>
                    
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
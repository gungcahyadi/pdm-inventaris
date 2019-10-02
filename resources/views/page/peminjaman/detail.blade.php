@extends('layouts.app')
@section('title')
<title>Detail Peminjaman {{ $peminjaman->pegawai->nama_pegawai }} - Sarana & Inventaris</title>
@endsection
@section('content')
<div class="row">            
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">                    
                <div style="padding-bottom: 20px">
                    <div class="float-left">
                        <table>
                            <tr>
                                <td>Nama</td><td>: {{ $peminjaman->pegawai->nama_pegawai }}</td>
                            </tr>
                            <tr>
                                <td>NIP</td><td>: {{ $peminjaman->pegawai->nip }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td><td>: {{ $peminjaman->pegawai->alamat }}</td>
                            </tr>
                        </table>                    
                    </div>
                    <div class="float-right">
                        <table>
                            <tr>
                                <td>Tanggal Pinjam</td><td>: {{ date('d M, Y', strtotime($peminjaman->tanggal_pinjam)) }}</td>
                            </tr>
                            <tr>
                                <td>Status</td><td>: {{ $peminjaman->status_peminjaman }}</td>
                            </tr>
                        </table>                    
                    </div>
                </div>
                <div class="">
                    <form class="forms-sample" action="{{ url('/peminjaman/detail/update/'.$peminjaman->id_peminjaman) }}" method="POST">
                            @csrf                

                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Inventaris</th>
                                    <th>Dipinjam</th>
                                    <th>Dikembalikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($detail as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->inventaris->kode_inventaris }}</td>
                                    <td>{{ $item->inventaris->nama }}</td>
                                    <td>
                                        <input type="hidden" name="jml_awal[]" value="{{ $item->jumlah }}">
                                        <input style="border-color: transparent; background: transparent;" type="text" class="form-control jumlah" name="jumlah[]" data-inven="{{ $item->inventaris->jumlah }}" data-val="{{ $item->jumlah }}" value="{{ $item->jumlah }}">
                                    </td>    
                                    <td>{{ $item->jumlah_kembali }}</td>                                
                                </tr>          
                                @endforeach
                            </tbody>
                        </table>
                        <div style="padding-top: 20px; float: right;">
                            <button id="save-btn" class="btn btn-primary" type="submit">Save</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>           
</div>
@endsection
@section('js')
<script>
    $('input.jumlah').on('input blur paste', function(){
        var ipt = $(this).val();
        var r = ipt.replace(/\D/g, '');
        var r = r.replace('00', '0');
        var current = $(this).data('inven') + $(this).data('val');
        if (current >= r) {
            $(this).val(r);
        }else{
            $(this).val(current);
        }
    });
    $('#save-btn').css('display','none');
    $('input.jumlah').on('click', function(){
        $('#save-btn').css('display','block');
    });
</script>
@endsection

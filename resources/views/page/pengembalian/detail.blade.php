@extends('layouts.app')
@section('title')

<title>Detail Pengembalian {{ $peminjaman->pegawai->nama_pegawai }} - Sarana & Inventaris</title>
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
                                @if($peminjaman->status_peminjaman == 'dipinjam')

                                <td>Tanggal Pinjam</td><td>: {{ date('d M, Y', strtotime($peminjaman->tanggal_pinjam)) }}</td>
                                @endif
                                @if($peminjaman->status_peminjaman == 'dikembalikan')

                                <td>Tanggal Kembali</td><td>: {{ date('d M, Y', strtotime($peminjaman->tanggal_kembali)) }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Status</td><td>: {{ $peminjaman->status_peminjaman }}</td>
                            </tr>
                        </table>                    
                    </div>
                </div>
                <div class="">
                    @if($peminjaman->status_peminjaman == 'dikembalikan')
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Inventaris</th>
                                <th>Jumlah Dikembalikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($detail as $item)
                            <tr>                                    
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->inventaris->kode_inventaris }}</td>
                                <td>{{ $item->inventaris->nama }}</td>
                                <td>{{ $item->jumlah_kembali }}</td>
                            </tr>          

                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @if($peminjaman->status_peminjaman == 'dipinjam')

                    <form class="forms-sample" action="{{ url('/pengembalian/detail/update/'.$peminjaman->id_peminjaman) }}" method="POST">
                        @csrf                

                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Inventaris</th>
                                    <th>Jumlah Dipinjam</th>
                                    <th>Jumlah Kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach($detail as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->inventaris->kode_inventaris }}</td>
                                    <td>{{ $item->inventaris->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>
                                        <input type="hidden" name="jml_awal[]" value="{{ $item->jumlah }}">
                                        <input type="text" class="form-control jumlah" name="jumlah[]"  data-max="{{ $item->jumlah }}" value="">
                                    </td>                                    
                                </tr>          
                                @endforeach
                            </tbody>
                        </table>
                        <div style="padding-top: 20px; float: right;">
                            <button id="kembali-semua" class="btn btn-info" type="button">Kembalikan Semua</button>
                            <button id="save-btn" class="btn btn-primary" type="submit">Save</button>
                            
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>           
</div>
<div class="row">            
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">History Pengembalian</h4>
                <p class="card-description">
                </p>
                <div class="">
                    <table class="simpleDataTables table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Inventaris</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($history as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ date('d M, Y', strtotime($item->tanggal_kembali)) }}</td>
                                <td>{{ $item->inventaris->kode_inventaris }}</td>
                                <td>{{ $item->inventaris->nama }}</td>
                                <td>{{ $item->jumlah_kembali }}</td>
                            </tr>          
                            @endforeach
                        </tbody>
                    </table>
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
        var current = $(this).data('max');
        if (current >= r) {
            $(this).val(r);
        }else{
            $(this).val(current);
        }
    });
    $('#kembali-semua').on('click', function(){        
        $('input.jumlah').each( function (i) {
            var max = $(this).attr('data-max');
            $(this).val(max);
        } );
    });
</script>
@endsection

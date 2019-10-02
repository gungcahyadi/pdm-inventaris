@extends('layouts.app')
@section('title')

<title>List Pengembalian - Sarana & Inventaris</title>
@endsection
@section('content')
    <div class="row">            
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">Pengembalian</h4>
                    <p class="card-description">
                    </p>
                    <div class="">
                        <table class="simpleDataTables table display table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($pengembalian as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>@if($item->pegawai->nama_pegawai != null) {{ $item->pegawai->nama_pegawai }} @endif</td>
                                <td>{{ date('d M, Y', strtotime($item->tanggal_kembali)) }}</td>
                                <td><span class="badge badge-<?= $item->status_peminjaman == 'dipinjam' ? 'primary' : 'success' ?>">{{ $item->status_peminjaman }}</span></td>
                                <td> 
                                    <form method="GET" action="{{ url('/pengembalian/delete/'.$item->id_peminjaman) }}">

                                    <a class="btn btn-sm btn-success" href="{{ url('/pengembalian/detail/'.$item->id_peminjaman) }}"><i class="fa fa-eye"></i></a>

                                    <button type="submit" class="btn btn-delete js-submit-confirm btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                                </td>
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

@endsection

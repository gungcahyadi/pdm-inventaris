@extends('layouts.app')
@section('title')

<title>List Peminjaman - Sarana & Inventaris</title>
@endsection

@section('content')
    <div class="row">            
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">Peminjaman</h4>
                    <p class="card-description">
                    </p>
                    <div class="">
                        <table class="simpleDataTables table display table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tgl Pinjam</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($peminjaman as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>@if($item->pegawai->nama_pegawai != null) {{ $item->pegawai->nama_pegawai }} @endif</td>
                                <td>{{ date('d M, Y', strtotime($item->tanggal_pinjam)) }}</td>                                
                                <td><span class="badge badge-<?= $item->status_peminjaman == 'dipinjam' ? 'primary' : 'success' ?>">{{ $item->status_peminjaman }}</span></td>
                                <td>                                    
                                    <a class="btn btn-sm btn-success" href="{{ url('/peminjaman/detail/'.$item->id_peminjaman) }}"><i class="fa fa-eye"></i></a>
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

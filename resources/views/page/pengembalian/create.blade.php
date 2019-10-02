@extends('layouts.app')
@section('title')

<title>Add Pengembalian - Sarana & Inventaris</title>
@endsection
@section('content')
@section('css')
<style>
    #inventaris-main #inventaris-item .inventaris .btn-remove{
        display: none;
    }
</style>
@endsection
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pengembalian Inventaris</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" action="" method="POST">
                            @csrf                
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <select name="id_pegawai" id="id_peminjaman" class="form-control" style="width: 100%">
                                            <option value=""></option>
                                            @foreach($data_pegawai as $item)
                                            <option value="{{ $item->id_pegawai }}">{{ $item->nama_pegawai }}</option>
                                            @endforeach
                                        </select>                        
                                    </div>         
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Dari Tanggal</label> 
                                        <input type="date" name="dari_tgl" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" name="sampai_tgl" class="form-control" value="{{ date('Y-m-d') }}">      
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Submit</button>                                
                        </form>
                    </div>
                </div>
            </div>               
        </div>
    </div>                       
</div>
<div class="row">            
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">Peminjaman</h4>
                    <p class="card-description">
                    </p>
                    <div class="table-responsive">
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
                            @if($data != '')
                            @php $no=1 @endphp
                            @foreach(@$data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>@if($item->pegawai->nama_pegawai != null) {{ $item->pegawai->nama_pegawai }} @endif</td>
                                <td>{{ date('d M, Y', strtotime($item->tanggal_pinjam)) }}</td>                                
                                <td><span class="badge badge-<?= $item->status_peminjaman == 'dipinjam' ? 'primary' : 'success' ?>">{{ $item->status_peminjaman }}</span></td>
                                <td>                                    
                                    <a class="btn btn-sm btn-success" href="{{ url('/pengembalian/detail/'.$item->id_peminjaman) }}"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>          
                            @endforeach
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>           
    </div>
@endsection
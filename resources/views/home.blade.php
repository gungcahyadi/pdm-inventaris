@extends('layouts.app')

@section('title')
<title>Dashboard - Sarana & Inventaris</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-table text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Inventaris</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $jml['inventaris'] }}</h3>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="fa fa-user text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Pegawai</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $jml['pegawai'] }}</h3>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-dropbox text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Peminjaman</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $jml['peminjaman'] }}</h3>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-restart text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Pengembalian</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $jml['pengembalian'] }}</h3>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="{!! url('profile/update/'.Auth::user()->id_petugas) !!}" method="POST">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Fullname</label>
                        <input id="edit_nama" type="text" class="form-control" name="nama_petugas" required placeholder="Fullname" value="{{ Auth::user()->nama_petugas }}">
                    </div>  
                    <div class="form-group">
                        <label>Pilih Gambar</label>
                        <input id="edit_image" type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image" value="{{ old('image') }}">     
                    </div>                             
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

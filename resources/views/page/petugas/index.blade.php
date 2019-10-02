@extends('layouts.app')
@section('title')

<title>Petugas - Sarana & Inventaris</title>
@endsection
@section('content')
<div class="row">            
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">Petugas</h4>
                <p class="card-description">
                    <button type="button" class="btn btn-add btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-plus"></i></button>
                </p>
                <div class="">
                    <table class="simpleDataTables table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Petugas Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas as $item)
                            <tr>
                                <td>{{ $item->nama_petugas }}</td>
                                <td>{{ $item->level->nama_level }}</td>
                                <td>
                                    <form method="GET" action="{{ url('/petugas/delete/'.$item->id_petugas) }}">
                                        <button 
                                        type="button" 
                                        class="btn btn-edit btn-sm btn-warning" 
                                        data-toggle="modal" 
                                        data-target="#modalEdit" 
                                        data-whatever="@getbootstrap"
                                        data-edit-id="{{ $item->id_petugas }}"
                                        data-edit-nama="{{ $item->nama_petugas }}"
                                        data-edit-level="{{ $item->id_level }}"
                                        data-edit-image="{{ $item->image }}"
                                        ><i class="fa fa-edit"></i></button>

                                        @if($item->id_petugas != Auth::user()->id_petugas)
                                        <button type="submit" class="btn btn-delete js-submit-confirm btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        @endif
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #fff">
            <form enctype="multipart/form-data" method="POST" action="{{ url('petugas/store') }}">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Fullname</label>
                        <input id="name" type="text" class="form-control" name="nama_petugas" value="{{ old('nama_petugas') }}" required placeholder="Fullname">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Username</label>                        
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required placeholder="{{ __('Username') }}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Level</label>  
                        <select name="level" id="" class="form-control">
                            @foreach($level->where('id_level', '!=', '1') as $item)
                            <option value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label>Pilih Gambar</label>
                        <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image">                        
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Password</label>                                                
                        <input id="password" type="password" class="form-control" name="password" required placeholder="{{ __('Password') }}">                        
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Confirm Password</label>                                                
                        <input type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                    </div>                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="POST">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Fullname</label>
                        <input id="edit_nama" type="text" class="form-control" name="nama_petugas" value="{{ old('nama_petugas') }}" required placeholder="Fullname">
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-form-label">Level</label>  
                        <select name="level" id="" class="form-control">
                            @foreach($level as $item)
                            <option id="lv_{{ $item->id_level }}" value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                            @endforeach
                        </select>                        
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
@section('js')
<script>
    $(document).ready(function() {
        $('.btn-edit').click(function(){
            var url = "{!! url('petugas/update') !!}";
            var id = $(this).data('edit-id');
            var nama = $(this).data('edit-nama');
            var level = $(this).data('edit-level');
            var image = $(this).data('edit-image');

            $('#modalEdit form').attr("action",url+'/'+id);
            $('#edit_nama').val(nama);
            $('#lv_'+level).attr("selected", "selected");
            $('#edit_image').text(image);
        });


        $("#nama_jenis").keyup(function(){
          var data = $(this).val().substring(0,1).toUpperCase();  
          $("#kode_jenis").val(data);
      });


    });
</script>
@endsection
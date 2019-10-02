@extends('layouts.app')
@section('title')
<title>Pegawai - Sarana & Inventaris</title>
@endsection
@section('content')
<div class="row">            
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">Pegawai</h4>
                <p class="card-description">
                    <button type="button" class="btn btn-add btn-sm btn-primary" data-toggle="modal" data-target="#modalCreate" data-whatever="@getbootstrap"><i class="fa fa-plus"></i></button>
                </p>
                <div class="">
                    <table class="simpleDataTables table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nip</th>
                                <th>Nama</th>
                                <th class="none">Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($pegawai as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <form method="GET" action="{{ url('/pegawai/delete/'.$item->id_pegawai) }}">

                                        <button 
                                        type="button" 
                                        class="btn btn-edit btn-sm btn-warning" 
                                        data-toggle="modal" 
                                        data-target="#modalEdit" 
                                        data-whatever="@getbootstrap"
                                        data-edit-id="{{ $item->id_pegawai }}"
                                        data-edit-nip="{{ $item->nip }}"
                                        data-edit-nama="{{ $item->nama_pegawai }}"
                                        data-edit-alamat="{{ $item->alamat }}"
                                        ><i class="fa fa-edit"></i></button>

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

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('pegawai/store') }}">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input id="nama" type="text" class="form-control" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required placeholder="Nama">                        
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label">NIP</label>
                        <input id="nip" type="text" class="form-control" name="nip" value="{{ old('nip') }}" required placeholder="NIP">
                    </div>    
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required placeholder="Alamat">
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
            <form method="POST">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input id="edit_nama" type="text" class="form-control" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required placeholder="Nama">
                    </div>   
                    <div class="form-group">
                        <label class="col-form-label">NIP</label>
                        <input id="edit_nip" type="text" class="form-control" name="nip" value="{{ old('NIP') }}" required placeholder="nip">
                    </div>    
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <input id="edit_alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required placeholder="Alamat">
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
            var url = "{!! url('pegawai/update') !!}";
            var id = $(this).data('edit-id');
            var nama = $(this).data('edit-nama');
            var nip = $(this).data('edit-nip');
            var alamat = $(this).data('edit-alamat');

            $('#modalEdit form').attr("action",url+'/'+id);
            $('#edit_nama').val(nama);
            $('#edit_nip').val(nip);
            $('#edit_alamat').val(alamat);
        });
    });
</script>
@endsection

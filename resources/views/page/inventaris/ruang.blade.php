@extends('layouts.app')
@section('title')
<title>Ruang Inventaris - Sarana & Inventaris</title>
@endsection
@section('content')
<div class="row">            
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">Ruang Inventaris</h4>
                <p class="card-description">
                    <button type="button" class="btn btn-add btn-sm btn-primary" data-toggle="modal" data-target="#modalCreate" data-whatever="@getbootstrap"><i class="fa fa-plus"></i></button>
                </p>
                <div class="">
                    <table class="simpleDataTables table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($ruang as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->kode_ruang }}</td>
                                <td>{{ $item->nama_ruang }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <form method="GET" action="{{ url('/ruang-inventaris/delete/'.$item->id_ruang) }}">

                                        <button 
                                        type="button" 
                                        class="btn btn-edit btn-sm btn-warning" 
                                        data-toggle="modal" 
                                        data-target="#modalEdit" 
                                        data-whatever="@getbootstrap"
                                        data-edit-id="{{ $item->id_ruang }}"
                                        data-edit-nama="{{ $item->nama_ruang }}"
                                        data-edit-kode="{{ $item->kode_ruang }}"
                                        data-edit-keterangan="{{ $item->keterangan }}"
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
            <form method="POST" action="{{ url('ruang-inventaris/store') }}">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Ruang Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>                        
                        <input id="nama_ruang" type="text" class="form-control" name="nama_ruang" value="{{ old('nama_ruang') }}" required placeholder="Nama">                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kode</label>                        
                        <input id="kode_ruang" type="text" class="form-control" name="kode_ruang" value="{{ old('kode_ruang') }}" required placeholder="Kode">                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Keterangan</label>                        
                        <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="3" required placeholder="keterangan">{{ old('keterangan') }}</textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ruang Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input id="edit_nama" type="text" class="form-control" name="nama_ruang" value="{{ old('nama_ruang') }}" required placeholder="Nama">
                    </div>                    
                    <div class="form-group">
                        <label class="col-form-label">Kode</label>
                        <input id="edit_kode" type="text" class="form-control" name="kode_ruang" value="{{ old('kode_ruang') }}" required placeholder="Kode">
                    </div> 
                    <div class="form-group">
                        <label class="col-form-label">Keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" class="form-control" cols="30" rows="3" required placeholder="keterangan">{{ old('keterangan') }}</textarea>
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
            var url = "{!! url('ruang-inventaris/update') !!}";
            var id = $(this).data('edit-id');
            var nama = $(this).data('edit-nama');
            var kode = $(this).data('edit-kode');
            var keterangan = $(this).data('edit-keterangan');


            $('#modalEdit form').attr("action",url+'/'+id);
            $('#edit_nama').val(nama);
            $('#edit_kode').val(kode);
            $('#edit_keterangan').text(keterangan);
        });
        $("#nama_ruang").keyup(function(){
            var ipt = $(this).val();
          var data = ipt.substring(0,1).toUpperCase();  
          var num = "{!! $counter !!}";
          if (num.length == 1) {
            var zr = '00';
        }else if(num.length == 2){
            var zr = '0';
        }else{
            var zr = '';
        }
        var vals = 'R'+data + zr + num;
        if (ipt != '') {
            $("#kode_ruang").val(vals);
        }else{
            $("#kode_ruang").val('');
        }
    });
    });
</script>
@endsection


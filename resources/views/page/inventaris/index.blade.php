@extends('layouts.app')
@section('title')
<title>Inventaris - Sarana & Inventaris Sekolah</title>
@endsection
@section('content')
<div class="row">            
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">Inventaris</h4>
                <p class="card-description">
                    <button type="button" class="btn btn-add btn-sm btn-primary" data-toggle="modal" data-target="#modalCreate" data-whatever="@getbootstrap"><i class="fa fa-plus"></i></button>
                </p>
                <div class="">
                    <table class="simpleDataTables table-sm table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="200px">Nama</th>
                                <th>Kode</th>
                                <th>Jenis</th>
                                <th>Ruang</th>
                                <th class="none">Jumlah</th>
                                <th class="none">Kondisi</th>
                                <th class="none">Keterangan</th>
                                <th class="none">Tgl Register</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventaris as $item)
                            <tr>
                                <td width="200px">{{ $item->nama }}</td>
                                <td>{{ $item->kode_inventaris }}</td>
                                <td>{{ $item->jenis->nama_jenis }}</td>
                                <td>{{ $item->ruang->nama_ruang }}</td>
                                <td><p>Total : {{ $item->jumlah }}</p>
                                    @if($item->current != 0)
                                    <p>Sisa : {{ $item->current }}</p>
                                    <p>Dipinjam : {{ (int)$item->jumlah - (int)$item->current }}</p>
                                    @endif
                                </td>
                                <td>{{ $item->kondisi }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ date('d M, Y', strtotime($item->tanggal_register)) }}</td>
                                <td>
                                    <form method="GET" action="{{ url('/inventaris/delete/'.$item->id_inventaris) }}">
                                    <button 
                                    type="button" 
                                    class="btn btn-edit btn-sm btn-warning" 
                                    data-toggle="modal" 
                                    data-target="#modalEdit" 
                                    data-whatever="@getbootstrap"
                                    data-edit-id="{{ $item->id_inventaris }}"
                                    data-edit-nama="{{ $item->nama }}"
                                    data-edit-kode="{{ $item->kode_inventaris }}"
                                    data-edit-id_jenis="{{ $item->id_jenis }}"
                                    data-edit-id_ruang="{{ $item->id_ruang }}"
                                    data-edit-kondisi="{{ str_slug($item->kondisi) }}"
                                    data-edit-jumlah="{{ $item->jumlah }}"
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
            <form method="POST" action="{{ url('inventaris/store') }}">
                @csrf                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required placeholder="Nama">                        
                    </div>                    
                    <div class="form-group">
                        <label class="col-form-label">Jenis</label>
                        <select name="id_jenis" id="id_jenis" class="form-control" required style="width: 100%">
                            @foreach($jenis as $item)
                            <option data-kode-jenis="{{ $item->kode_jenis }}" value="{{ $item->id_jenis }}">{{ $item->nama_jenis }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Ruang</label>
                        <select name="id_ruang" id="id_ruang" class="form-control" required style="width: 100%">
                            @foreach($ruang as $item)
                            <option data-kode-ruang="{{ $item->kode_ruang }}" value="{{ $item->id_ruang }}">{{ $item->nama_ruang }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kondisi</label>                        
                        <select name="kondisi" class="form-control" required style="width: 100%">
                            <option value="bagus">Bagus</option>
                            <option value="kurang bagus">Kurang Bagus</option>
                            <option value="buruk">Buruk</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kode</label>
                        <div class="input-group">
                            <input id="result_kode_jenis" type="text" class="form-control" name="kode1">
                            <input id="result_kode_ruang" type="text" class="form-control" name="kode2">
                            <input id="kode" type="text" class="form-control" name="kode3" value="{{ old('kode') }}" required placeholder="Kode">
                        </div>                      
                    </div>    
                    <div class="form-group">
                        <label class="col-form-label">Jumlah</label>
                        <input id="jumlah" type="text" class="form-control jumlah" name="jumlah" value="{{ old('jumlah') }}" required placeholder="Jumlah">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nama</label>                        
                        <input id="edit_nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required placeholder="Nama">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Jenis</label>
                        <select name="id_jenis" id="id_jenis" class="form-control" required style="width: 100%">
                            @foreach($jenis as $item)
                            <option id="jenis_{{ $item->id_jenis }}" value="{{ $item->id_jenis }}">{{ $item->nama_jenis }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Ruang</label>
                        <select name="id_ruang" id="id_ruang" class="form-control" required style="width: 100%">
                            @foreach($ruang as $item)
                            <option id="ruang_{{ $item->id_ruang }}" value="{{ $item->id_ruang }}">{{ $item->nama_ruang }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kode</label>                        
                        <div class="input-group">
                            <input id="edit_kode" type="text" class="form-control" name="kode" value="{{ old('kode') }}" required placeholder="Kode">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kondisi</label>                        
                        <select id="id_kondisi" name="kondisi" class="form-control" required style="width: 100%">
                            <option id="bagus" value="bagus">Bagus</option>
                            <option id="kurang-bagus" value="kurang bagus">Kurang Bagus</option>
                            <option id="buruk" value="buruk">Buruk</option>
                        </select>
                    </div>                
                    <div class="form-group">
                        <label class="col-form-label">jumlah</label>
                        <input id="edit_jumlah" type="text" class="form-control jumlah {{ $errors->has('jumlah') ? ' is-invalid' : '' }}" name="jumlah" value="{{ old('jumlah') }}" required placeholder="Jumlah">
                    </div>  
                    <div class="form-group">
                        <label class="col-form-label">keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" class="form-control {{ $errors->has('keterangan') ? ' is-invalid' : '' }}" cols="30" rows="3" required placeholder="keterangan">{{ old('keterangan') }}</textarea>
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
            $('#modalEdit form').trigger("reset");
            var url = "{!! url('inventaris/update') !!}";
            var id = $(this).data('edit-id');
            var nama = $(this).data('edit-nama');
            var idJenis = $(this).data('edit-id_jenis');
            var idRuang = $(this).data('edit-id_ruang');
            var kondisi = $(this).data('edit-kondisi');
            var jumlah = $(this).data('edit-jumlah');
            var kode = $(this).data('edit-kode');
            var keterangan = $(this).data('edit-keterangan');

            $('#modalEdit form').attr("action",url+'/'+id);
            $('#edit_nama').val(nama);
            $('#edit_jumlah').val(jumlah);
            $('#edit_kode').val(kode);
            $('#edit_keterangan').val(keterangan);

            $('#'+kondisi).attr("selected","selected");
            $('#jenis_'+idJenis).attr("selected","selected");
            $('#ruang_'+idRuang).attr("selected","selected");
        });

        $('#id_ruang option').on("click", function(){
            var kode_ruang = $(this).data('kode-ruang');
            $('#result_kode_ruang').val(kode_ruang);
        });
        $('#id_jenis option').on("click", function(){
            var kode_jenis = $(this).data('kode-jenis');
            $('#result_kode_jenis').val(kode_jenis);
        });
        $("#nama").keyup(function(){
          var data = $(this).val().substring(0,1).toUpperCase();  
          var num = "{!! $counter !!}";
          if (num.length == 1) {
            var zr = '00';
        }else if(num.length == 2){
            var zr = '0';
        }else{
            var zr = '';
        }
        var vals = 'I'+data + zr + num;
        $("#kode").val(vals);
    });
        $('input.jumlah').on('input blur paste', function(){
            var ipt = $(this).val();
            var r = ipt.replace(/\D/g, '');
            $(this).val(r);
        });
    });
</script>
@endsection

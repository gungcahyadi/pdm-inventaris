@extends('layouts.app')
@section('title')
<title>Add Peminjaman - Sarana & Inventaris</title>
@endsection
@section('content')
@section('css')
<style>
    #save-inventaris .btn-add,
    #inventaris-main .btn-remove,
    #inventaris-main .clm-jml,
    #save-inventaris .clm-jml-text {
        display: none;
    }
    #save-inventaris .clm-jml,
    #inventaris-main .clm-jml-text{
        display: block;
    }

</style>
@endsection
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search Inventaris</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" action="" method="POST">
                            @csrf                
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Nama Inventaris</label>
                                        <input type="text" name="fil_nama" class="form-control" value="">                       
                                    </div>         
                                </div>                             
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" name="fil_kode" class="form-control" value="">      
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label></label>
                                        <button style="margin-top: 25px" type="submit" class="btn btn-success mr-2"><i class="fa fa-search"></i></button>                                
                                    </div>
                                </div>
                            </div>
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
                <h4 class="card-title text-capitalize">Inventaris</h4>
                <p class="card-description">
                </p>
                <div class="">                    
                    <table class=" table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="col-md-3">Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Ruang</th>
                                <th>Jumlah</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="inventaris-main">
                            @if($inventaris != '')

                            @foreach($inventaris as $item)
                            <tr>
                                <td>{{ $item->kode_inventaris }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis->nama_jenis }}</td>
                                <td>{{ $item->ruang->nama_ruang }}</td>
                                <td>
                                    <span class="clm-jml-text">{{ $item->jumlah }}</span>
                                    <input type="hidden" name="inventaris[]" value="{{ $item->id_inventaris }}" >
                                    <input type="hidden" name="jml_inventaris[]" value="{{ $item->jumlah }}" >
                                    <div class="clm-jml">
                                        <input type="text" data-max="{{ $item->jumlah }}" class="form-control jumlah" name="jumlah[]">
                                    </div>
                                </td>
                                <td class="inven">
                                    <button type="button" class="btn-add btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn-remove btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></td>

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
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pinjam Inventaris</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" action="{{ url('/peminjaman/store') }}" method="POST">
                            @csrf                

                            
                            

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Ruang</th>
                                        <th class="col-2">Jumlah</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody id="save-inventaris"></tbody>
                            </table>
                            <div class="form-group">
                                <label>Pegawai</label>                                    
                                <select name="id_pegawai" required="" class="form-control" style="width: 100%">
                                    <option value=""></option>
                                    @foreach($pegawai as $item)
                                    <option value="{{ $item->id_pegawai }}">{{ $item->nama_pegawai }}</option>
                                    @endforeach
                                </select>                        
                            </div>                                     
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>                                
                        </form>
                    </div>
                </div>
            </div>               
        </div>
    </div>                       
</div>


@endsection
@section('js')
<script>
    $(document).ready(function() { 
        $('input.jumlah').on('input blur paste', function(){
            var ipt = $(this).val();
            var r = ipt.replace(/\D/g, '');
            var current = $(this).data('max');
            if (current >= r) {
                $(this).val(r);
            }else{
                $(this).val(current);
            }
        });
        $('.btn-add').click(function(){
            var add_ipt = $(this).parents('tr');
            var el = $(add_ipt);
            $('#save-inventaris').append(el);
            btn_row_delete();
        });
        function btn_row_delete() {
            $('.btn-remove').click(function(){
                var add_ipt = $(this).parents('tr');
                var el = $(add_ipt);
                $('#inventaris-main').append(el);
                            // $(this).parents('tr').remove();
                        });
        }
    });

    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#advanced_fil thead tr').clone(true).appendTo( '#advanced_fil thead' );
    $('#advanced_fil thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                .column(i)
                .search( this.value )
                .draw();
            }
        } );
    } );

    var table = $('#advanced_fil').DataTable( {
        orderCellsTop: true,
        pageLength: 5,
    } );
} );
</script>
@endsection

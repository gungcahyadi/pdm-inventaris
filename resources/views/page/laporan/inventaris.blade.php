@extends('layouts.app')
@section('title')
<title>Laporan Inventaris - Sarana & Inventaris</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Inventaris</h4>
                        <p class="card-description">

                        </p>
                        <form class="forms-sample" action="{{ url('/laporan-inventaris/') }}" method="GET">
                            @csrf                

                            <div class="form-group">
                                <label>Jenis</label>                                    
                                <select name="id_jenis" class="form-control" style="width: 100%">
                                    <option value=""></option>
                                    @foreach($jenis as $item)
                                    <option value="{{ $item->id_jenis }}">{{ $item->nama_jenis }}</option>
                                    @endforeach
                                </select>                        
                            </div>

                            <div class="form-group">
                                <label>Ruang</label>                                    
                                <select name="id_ruang" class="form-control" style="width: 100%">
                                    <option value=""></option>
                                    @foreach($ruang as $item)
                                    <option value="{{ $item->id_ruang }}">{{ $item->nama_ruang }}</option>
                                    @endforeach
                                </select>                        
                            </div>

                            <button type="submit" class="btn btn-success mr-2">Proses</button>                                
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
                <div class="table-responsive">
                    <table class="masterDataTables table display table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Ruang</th>
                                <th>Kondisi</th>
                                <th>Jumlah</th>
                                <th>Tanggal Registrasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($inventaris as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->kode_inventaris }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis->nama_jenis }}</td>
                                <td>{{ $item->ruang->nama_ruang }}</td>
                                <td>{{ $item->kondisi }}</td>
                                <td>
                                    <p>Total : {{ $item->jumlah }}</p>
                                    <p>Sisa : {{ $item->jumlah - $item->current }}</p>
                                    <p>Dipinjam : {{ $item->current }}</p>
                                </td>
                                <td>{{ date('d M, Y', strtotime($item->tanggal_register)) }}</td>
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
        $('.masterDataTables').DataTable({
            "lengthMenu": [
            [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                        ],

                    // set the initial value
                    "pageLength": 10,

                    "language": {
                        "lengthMenu": " _MENU_ records"
                    },
                    "columnDefs": [{ // set default column settings
                        'orderable': true,
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                    "buttons": [
                    { extend: 'print', className: 'btn btn-lg bg-dark text-white',title: 'Laporan Pengembalian Inventaris', },
                    { extend: 'pdf', className: 'btn btn-lg bg-danger text-white', title: 'Laporan Pengembalian Inventaris', customize: function (doc) {doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split(''); } },
                    { extend: 'csv', className: 'btn btn-lg bg-primary text-white ', title: 'Laporan Pengembalian Inventaris'},
                    { extend: 'excel', className: 'btn btn-lg bg-success text-white ', title: 'Laporan Pengembalian Inventaris'},
                    ],
                    "dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'lB><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                    "order": [
                    [0, "asc"]
                    ] // set first column as a default sort by asc
                });
</script>
@endsection

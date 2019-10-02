@extends('layouts.app')
@section('title')
<title>Laporan Pengembalian - Sarana & Inventaris</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Pengembalian</h4>
                            <p class="card-description">

                            </p>
                            <form class="forms-sample" action="{{ url('/laporan-pengembalian/') }}" method="GET">
                                @csrf                
                                
                                <div class="form-group">
                                    <label>Dari Tanggal</label> 
                                    <input type="date" name="dari_tgl" class="form-control">                                   
                                </div>

                                <div class="form-group">
                                    <label>Sampai Tanggal</label>                                    
                                    <input type="date" name="sampai_tgl" class="form-control" value="{{ date('Y-m-d') }}">                                   
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
                    <h4 class="card-title text-capitalize">Pengembalian</h4>
                    <p class="card-description">

                    </p>
                    <div class="table-responsive">                     
                        <table class="masterDataTables table display table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($pengembalian as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->pegawai->nama_pegawai }}</td>
                                    <td>{{ date('d M, Y', strtotime($item->tanggal_pinjam)) }}</td>
                                    <td>
                                        {{ $item->pegawai->nama_pegawai }} Mengembalikan Inventaris 
                                        @foreach($item->detail as $dtl)
                                        @if($item->detail->last() == $dtl)
                                            <span class="font-weight-bold">{{ $dtl->inventaris->nama }}</span> berjumlah <span>{{ $dtl->jumlah }}</span>
                                        @else
                                            <span class="font-weight-bold">{{ $dtl->inventaris->nama }}</span> berjumlah <span>{{ $dtl->jumlah }}</span>, 
                                        @endif                                        
                                        @endforeach
                                        </ul>
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

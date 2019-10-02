<?php

namespace App\Http\Controllers;
use App\Peminjaman;
use App\Pegawai;
use App\DetailPinjam;
use App\Inventaris;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = Peminjaman::where('status_peminjaman','dipinjam')->get();        
        return view('page.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::get();
        $inventaris = Inventaris::where('jumlah','>=','0')->get();
        return view('page.peminjaman.create', compact('pegawai','inventaris'));
        
    }
    public function search(Request $request)
    {
        if ($request->fil_nama != '' && $request->fil_kode != '') {
            @$inventaris = Inventaris::where('jumlah','>=','0')
            ->where('nama','LIKE','%'.$request->fil_nama.'%')
            ->where('kode_inventaris','LIKE','%'.$request->fil_kode.'%')
            ->get();
        }elseif ($request->fil_nama != '') {
            @$inventaris = Inventaris::where('jumlah','>=','0')
            ->where('nama','LIKE','%'.$request->fil_nama.'%')
            ->get();
        }elseif ($request->fil_kode != '') {
            @$inventaris = Inventaris::where('jumlah','>=','0')
            ->where('kode_inventaris','LIKE','%'.$request->fil_kode.'%')
            ->get();
        }else{
            @$inventaris = Inventaris::where('jumlah','>=','0')->get();
        }
        $pegawai = Pegawai::get();
        
        return view('page.peminjaman.create', compact('pegawai','inventaris'));
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        

        $peminjaman = new Peminjaman;
        $peminjaman->tanggal_pinjam = date('y-m-d');
        $peminjaman->status_peminjaman = 'dipinjam';
        $peminjaman->id_pegawai = $request->id_pegawai;
        $peminjaman->save();

        $i=0;
        foreach ($request->inventaris as $id_inventaris) {
            $detail = new DetailPinjam;
            $detail->id_peminjaman = $peminjaman->id_peminjaman;
            $detail->id_inventaris = $id_inventaris;
            $detail->jumlah = $request->jumlah[$i];
            $detail->save();

            $inventaris = Inventaris::where('id_inventaris',$id_inventaris)->first();
            $inventaris->jumlah = $inventaris->jumlah - $detail->jumlah;
            $inventaris->current = $detail->jumlah;
            $inventaris->save();

            $i++;
        }        

        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Peminjaman Berhasil di Simpan.']);        
        return redirect(url('peminjaman'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::find($id);
        $detail = DetailPinjam::where('id_peminjaman',$peminjaman->id_peminjaman)->get();
        return view('page.peminjaman.detail', compact('peminjaman','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $peminjam = Peminjaman::where('id_peminjaman', $id)->first()->pegawai->nama_pegawai;
        $detail = DetailPinjam::where('id_peminjaman', $id)->get();
        $i=0;
        foreach ($detail as $item) {
            $f_detail = DetailPinjam::where('id_detail_pinjam', $item->id_detail_pinjam)->first();
            $f_detail->jumlah = $request->jumlah[$i];
            $f_detail->save();

            $inventaris = Inventaris::where('id_inventaris',$f_detail->id_inventaris)->first();
            $inventaris->jumlah = $inventaris->jumlah - ($f_detail->jumlah - $request->jml_awal[$i]);
            $inventaris->current = $inventaris->current + ($f_detail->jumlah - $request->jml_awal[$i]);
            $inventaris->save();

            $i++;
        } 
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Peminjaman '.$peminjam.' Berhasil di Ubah.']);
        return redirect(url('peminjaman'));                

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

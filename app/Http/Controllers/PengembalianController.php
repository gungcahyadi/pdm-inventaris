<?php

namespace App\Http\Controllers;
use App\Peminjaman;
use App\Pegawai;
use App\DetailPinjam;
use App\Inventaris;
use App\History;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responsek     */
    public function index()
    {
        $pengembalian = Peminjaman::where('status_peminjaman','dikembalikan')->get();
        $data_pegawai = Pegawai::whereIn('id_pegawai',$pengembalian)->get();
        return view('page.pengembalian.index', compact('pengembalian','data_pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengembalian = Peminjaman::where('status_peminjaman','dipinjam')->pluck('id_pegawai');

        $pegawai = Pegawai::get();
        $data_pegawai = Pegawai::whereIn('id_pegawai',$pengembalian)->get();        
        $inventaris = Inventaris::get();
        $data = '';
        return view('page.pengembalian.create', compact('data','pegawai','inventaris','data_pegawai'));
        
    }

    public function search(Request $request)
    {
        if ($request->id_pegawai != '' && $request->dari_tgl != null && $request->sampai_tgl != null) {
            @$data = Peminjaman::where('status_peminjaman','dipinjam')
            ->where('id_pegawai',$request->id_pegawai)
            ->where('tanggal_pinjam', '>=', date('Y-m-d', strtotime($request->dari_tgl)) )
            ->where('tanggal_pinjam', '<=', date('Y-m-d', strtotime($request->sampai_tgl)))
            ->get();
        }elseif ($request->dari_tgl != null && $request->sampai_tgl != null) {
            @$data = Peminjaman::where('status_peminjaman','dipinjam')
            ->where('tanggal_pinjam', '>=', date('Y-m-d', strtotime($request->dari_tgl)) )
            ->where('tanggal_pinjam', '<=', date('Y-m-d', strtotime($request->sampai_tgl)))
            ->get();
        }elseif ($request->id_pegawai != '') {
            @$data = Peminjaman::where('status_peminjaman','dipinjam')
            ->where('id_pegawai',$request->id_pegawai)
            ->get();
        }else{
            @$data = null;
        }
        $pengembalian = Peminjaman::where('status_peminjaman','dipinjam')->pluck('id_pegawai');

        $pegawai = Pegawai::get();
        $data_pegawai = Pegawai::whereIn('id_pegawai',$pengembalian)->get();        
        $inventaris = Inventaris::get();
        return view('page.pengembalian.create', compact('data','pegawai','inventaris','data_pegawai'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        

        $pengembalian = new Peminjaman;
        $pengembalian->tanggal_pinjam = date('y-m-d');
        $pengembalian->status_peminjaman = 'dipinjam';
        $pengembalian->id_pegawai = $request->id_pegawai;

        $pengembalian->save();

        $i=0;
        foreach ($request->inventaris as $id_inventaris) {
            $detail = new DetailPinjam;
            $detail->id_peminjaman = $pengembalian->id_peminjaman;
            $detail->id_inventaris = $id_inventaris;
            $detail->jumlah = $request->jumlah[$i];
            $detail->save();

            $inventaris = Inventaris::where('id_inventaris',$detail->id_inventaris)->first();
            $inventaris->current = $inventaris->current - $detail->jumlah;
            $inventaris->save();

            $i++;
        }        

        alert()->success('Peminjaman saved.','Success')->autoclose(3500);        
        return redirect(url('pengembalian'));
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
        $history = History::where('id_peminjaman',$peminjaman->id_peminjaman)->orderBy('tanggal_kembali', 'desc')->get();
        return view('page.pengembalian.detail', compact('peminjaman','detail','history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $pengembalian = Peminjaman::where('status_peminjaman','dipinjam')->pluck('id_pegawai');

        $pegawai = Pegawai::get();
        $data_pegawai = Pegawai::whereIn('id_pegawai',$pengembalian)->get();        
        $inventaris = Inventaris::get();
        return view('page.pengembalian.create', compact('pegawai','inventaris','data_pegawai'));
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
        $sisa = 0;
        foreach ($detail as $item) {
            $f_detail = DetailPinjam::where('id_detail_pinjam', $item->id_detail_pinjam)->first();
            $f_detail->jumlah = $f_detail->jumlah - $request->jumlah[$i];
            if ($f_detail->jumlah_kembali != 0) {                
                $f_detail->jumlah_kembali = $f_detail->jumlah_kembali + $request->jumlah[$i];
            }else{
                $f_detail->jumlah_kembali = $request->jumlah[$i];
            }
            $f_detail->save();
            $sisa += $f_detail->jumlah;

            if ($request->jumlah[$i] != '' || $request->jumlah[$i] != '0') {
                $history = new History;
                $history->id_inventaris = $f_detail->id_inventaris;
                $history->id_peminjaman = $f_detail->id_peminjaman;
                $history->id_detail_pinjam = $f_detail->id_detail_pinjam;
                $history->jumlah_kembali = $request->jumlah[$i];
                $history->tanggal_kembali = date('Y-m-d');
                $history->save();
            }

            $inventaris = Inventaris::where('id_inventaris',$f_detail->id_inventaris)->first();
            $inventaris->jumlah = $inventaris->jumlah + $request->jumlah[$i];
            if ($inventaris->current != 0) {                
                $inventaris->current = $inventaris->current - $request->jumlah[$i];
            }
            $inventaris->current = $request->jumlah[$i];
            $inventaris->save();            

            $i++;
        } 
        if ($sisa == 0) {
            $data = Peminjaman::where('status_peminjaman','dipinjam')->where('id_peminjaman',$id)->first();
            $data->tanggal_kembali = date('y-m-d');
            $data->status_peminjaman = 'dikembalikan';
            $data->save();
        }

        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Pengembalian '.$peminjam.' Berhasil di Simpan.']);

        
        return redirect(url('pengembalian/detail/'.$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = DetailPinjam::where('id_peminjaman', $id)->get();
        $history = History::where('id_peminjaman', $id)->get();
        foreach ($detail as $item) {
            $item->delete();
        }
        foreach ($history as $item) {
            $item->delete();
        }
        Peminjaman::where('id_peminjaman', $id)->firstOrFail()->delete();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Berhasil di Hapus.']);
        return redirect(url('pengembalian'));
    }
}

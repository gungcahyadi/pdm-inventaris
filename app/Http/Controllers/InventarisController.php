<?php

namespace App\Http\Controllers;

use App\Inventaris;
use App\Jenis;
use App\Ruang;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventaris = Inventaris::get();
        $jenis = Jenis::get();
        $ruang = Ruang::get();
        $counter = $this->counter();        
        return view('page.inventaris.index', compact('inventaris','jenis','ruang','counter'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'id_jenis' => 'required',
            'id_ruang' => 'required',
            'kode1' => 'required',
            'kode2' => 'required',
            'kode3' => 'required',
        ]);
        $userId = auth()->user()->id_petugas;        
        $data = new Inventaris;
        $data->nama = $request->nama;        
        $data->kondisi = $request->kondisi;        
        $data->keterangan = $request->keterangan;
        $data->jumlah = $request->jumlah;
        $data->current = 0;
        $data->id_jenis = $request->id_jenis;
        $data->id_ruang = $request->id_ruang;
        $data->kode_inventaris = $request->kode1.'-'.$request->kode2.'-'.$request->kode3;
        $data->tanggal_register = date('Y-m-d');
        $data->id_petugas = $userId;    
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Inventaris Berhasil di Simpan.']);        
        return redirect(url('inventaris'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $rowRules = [
            'nama' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'id_jenis' => 'required',
            'id_ruang' => 'required',
            'kode' => 'required',
        ];
        $validator = \Validator::make($request->toArray(), $rowRules);
        if ($validator->passes()) {
        $userId = auth()->user()->id_petugas;
        $data = Inventaris::where('id_petugas',$userId)->where('id_inventaris',$id)->first();
        $data->nama = $request->nama;        
        $data->kondisi = $request->kondisi;        
        $data->keterangan = $request->keterangan;
        $data->jumlah = $request->jumlah;
        $data->id_jenis = $request->id_jenis;
        $data->id_ruang = $request->id_ruang;
        $data->kode_inventaris = $request->kode;
        $data->tanggal_register = date('Y-m-d');
        $data->id_petugas = $userId;        
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Inventaris Berhasil di Ubah.']);   
        return redirect(url('inventaris'));
        }else{
            return back()->withErrors($validator);

        }     
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventaris = Inventaris::find($id);
        if ($inventaris->dipinjam->count() == 0) {
            $inventaris->delete();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Inventaris Berhasil di Hapus.']);        
        }else {
        \Session::flash('notification', ['level' => 'danger', 'message' => 'Data Inventaris Gagal di Hapus..! Masih berisi data penting.']);
        }
        return redirect(url('inventaris'));

    }

    public function counter() {
        $counter = Inventaris::get()->count();
        return $counter + 1;
    }
}

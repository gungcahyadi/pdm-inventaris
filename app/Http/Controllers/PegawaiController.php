<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::orderBy('id_pegawai', 'desc')->get();
        return view('page.pegawai.index', compact('pegawai'));
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
            'nama_pegawai' => 'required',
            'nip' => 'required|unique:pegawai',
            'alamat' => 'required',
        ]);
        $data = new Pegawai;
        $data->nama_pegawai = $request->nama_pegawai;        
        $data->nip = $request->nip;        
        $data->alamat = $request->alamat;
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Pegawai Berhasil di Simpan.']);
        return redirect(url('pegawai'));

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
        $this->validate($request, [
            'nama_pegawai' => 'required',
            'nip' => 'required|unique:pegawai',
            'alamat' => 'required',
        ]);
        $data = Pegawai::find($id);
        $data->nama_pegawai = $request->nama_pegawai;        
        $data->nip = $request->nip;        
        $data->alamat = $request->alamat;
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Pegawai Berhasil di Ubah.']);
        return redirect(url('pegawai'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::find($id)->delete();
        
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Pegawai Berhasil di Hapus.']);
        return redirect(url('pegawai'));

    }
}

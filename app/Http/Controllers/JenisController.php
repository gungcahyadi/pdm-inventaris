<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis::orderBy('id_jenis', 'desc')->get();
        $counter = $this->counter();
        return view('page.inventaris.jenis', compact('jenis','counter'));
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
        $data = new Jenis;
        $data->nama_jenis = $request->nama_jenis;
        $data->kode_jenis = $request->kode_jenis;
        $data->keterangan = $request->keterangan;
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Jenis Berhasil di Simpan.']);

        return redirect(url('jenis-inventaris'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $data = Jenis::where('id_jenis', $id)->first();
        $data->nama_jenis = $request->nama_jenis;
        $data->kode_jenis = $request->kode_jenis;        
        $data->keterangan = $request->keterangan;
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Jenis Berhasil di Ubah.']);

        return redirect(url('jenis-inventaris'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Jenis::find($id);
        if ($jenis->inventaris->count() == 0) {
            $jenis->delete();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Jenis Berhasil di Hapus.']);

        }else {
        \Session::flash('notification', ['level' => 'danger', 'message' => 'Data Jenis Gagal di Hapus..! Masih berisi data penting.']);

        }
        return redirect(url('jenis-inventaris'));
    }

    public function counter() {
        $counter = Jenis::get()->count();
        return $counter + 1;
    }
}

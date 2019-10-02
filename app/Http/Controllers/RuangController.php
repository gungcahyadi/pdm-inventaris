<?php

namespace App\Http\Controllers;

use App\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruang = Ruang::orderBy('id_ruang', 'desc')->get();
        $counter = $this->counter();
        return view('page.inventaris.ruang', compact('ruang','counter'));
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
        $data = new ruang;
        $data->nama_ruang = $request->nama_ruang;
        $data->kode_ruang = $request->kode_ruang;
        $data->keterangan = $request->keterangan;
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Ruang Berhasil di Simpan.']);

        return redirect(url('ruang-inventaris'));

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
        $data = Ruang::where('id_ruang', $id)->first();
        $data->nama_ruang = $request->nama_ruang;
        $data->kode_ruang = $request->kode_ruang;        
        $data->keterangan = $request->keterangan;
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Ruang Berhasil di Ubah.']);

        return redirect(url('ruang-inventaris'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruang = Ruang::find($id);
        if ($ruang->inventaris->count() == 0) {
            $ruang->delete();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Ruang Berhasil di Hapus.']);
        }else {
        \Session::flash('notification', ['level' => 'danger', 'message' => 'Data Ruang Gagal di Hapus..! Masih berisi data penting.']);
        }
        return redirect(url('ruang-inventaris'));
    }
    public function counter() {
        $counter = Ruang::get()->count();
        return $counter + 1;
    }
}

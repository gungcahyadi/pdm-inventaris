<?php

namespace App\Http\Controllers;

use App\Petugas;
use App\MyImage;
use App\Level;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::orderBy('nama_petugas', 'asc')->get();
        $level = Level::get();
        return view('page.petugas.index', compact('petugas','level'));        
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
        // role
        $this->validate($request, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:petugas'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required','min:6','same:password'],
        ]);
        if ($request->password_confirmation == $request->password) {
            $data = new Petugas;
            $data->nama_petugas = $request->nama_petugas;
            $data->username = $request->username;
            $data->password = Hash::make($request->password);
            $data->show_password = $request->password;
            $data->id_level = $request->level;
            if ($request->hasFile('image')) {
                $myimage = new MyImage();
                $data->image = $myimage->saveImage($request->file('image'));
            }
            $data->save();
        }
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Petugas Berhasil di Simpan.']);
        return redirect(url('petugas'));
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
        $data = Petugas::where('id_petugas', $id)->first();
        $data->nama_petugas = $request->nama_petugas;
        $data->id_level = $request->level;  

        if ($request->hasFile('image')) {
            $myimage = new MyImage();
            if ($data->image != '') {
                $myimage->deleteImage($data->image);
            }
            $data->image = $myimage->saveImage($request->file('image'));
        }
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Petugas Berhasil di Ubah.']);
        return redirect(url('petugas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        Petugas::where('id_petugas', $id)->firstOrFail()->delete();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Data Petugas Berhasil di Hapus.']);
        return redirect(url('petugas'));
    }
}

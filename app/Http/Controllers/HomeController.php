<?php

namespace App\Http\Controllers;

use App\Inventaris;
use App\MyImage;
use App\Jenis;
use App\Ruang;
use App\Peminjaman;
use App\Pegawai;
use App\Petugas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $jml['inventaris'] = Inventaris::get()->count();
        $jml['jenis'] = Jenis::get()->count();
        $jml['ruang'] = Ruang::get()->count();
        $jml['pegawai'] = Pegawai::get()->count();
        $jml['peminjaman'] = Peminjaman::where('status_peminjaman','dipinjam')->get()->count();
        $jml['pengembalian'] = Peminjaman::where('status_peminjaman','dikembalikan')->get()->count();
        $user = auth()->user()->nama_petugas;
        // \Session::flash('notification', ['level' => 'success', 'message' => ' You are logged in! , Hello '.$user]);                
        return view('home',compact('jml'));
    }

    public function profileupdate(Request $request, $id)
    {
        $data = Petugas::where('id_petugas', $id)->first();
        $data->nama_petugas = $request->nama_petugas;
        if ($request->hasFile('image')) {
            $myimage = new MyImage();
            if ($data->image != '') {
                $myimage->deleteImage($data->image);
            }
            $data->image = $myimage->saveImage($request->file('image'));
        }
        $data->save();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Profile Berhasil Di Ubah']);
        return redirect(url('/'));
    }
}

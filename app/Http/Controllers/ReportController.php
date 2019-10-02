<?php

namespace App\Http\Controllers;
use App\Inventaris;
use App\Peminjaman;
use App\DetailPinjam;
use App\Pegawai;
use App\Jenis;
use App\Ruang;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventaris(Request $request)    {
        $ruang = Ruang::get();
        $jenis = Jenis::get();
        if ($request->id_jenis != null && $request->id_ruang != null) {
            $inventaris = Inventaris::where('id_jenis',$request->id_jenis)->where('id_ruang',$request->id_ruang)->get();
        }elseif ($request->id_jenis != null || $request->id_jenis != '') {
            $inventaris = Inventaris::where('id_jenis',$request->id_jenis)->get();
        }elseif ($request->id_ruang != null || $request->id_ruang != '') {
            $inventaris = Inventaris::where('id_ruang',$request->id_ruang)->get();
        } else{
            $inventaris = Inventaris::get();
        }

        return view('page.laporan.inventaris', compact('inventaris','jenis','ruang'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function peminjaman(Request $request)
    {
        if ($request->dari_tgl != null && $request->sampai_tgl != null) {
            $peminjaman = Peminjaman::where('status_peminjaman','dipinjam')->where('tanggal_pinjam', '>=', date('Y-m-d', strtotime($request->dari_tgl)) )->where('tanggal_pinjam', '<=', date('Y-m-d', strtotime($request->sampai_tgl)))->get();
        } else{
            $peminjaman = Peminjaman::where('status_peminjaman','dipinjam')->get();
        }

        return view('page.laporan.peminjaman', compact('peminjaman'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pengembalian(Request $request)
    {
        if ($request->dari_tgl != null && $request->sampai_tgl != null) {
            $pengembalian = Peminjaman::where('status_peminjaman','dikembalikan')->where('tanggal_pinjam', '>=', date('Y-m-d', strtotime($request->dari_tgl)) )->where('tanggal_pinjam', '<=', date('Y-m-d', strtotime($request->sampai_tgl)))->get();
        } else{
            $pengembalian = Peminjaman::where('status_peminjaman','dikembalikan')->get();
        }

        return view('page.laporan.pengembalian', compact('pengembalian'));
    }

}

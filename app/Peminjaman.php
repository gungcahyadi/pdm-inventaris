<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
	protected $table = 'peminjaman';
	protected $guarded = [];
	protected $primaryKey = 'id_peminjaman';
	public $timestamps = false;

	public function pegawai(){
		return $this->belongsTo('App\Pegawai', 'id_pegawai');
	}

	public function detail(){
		return $this->hasMany('App\DetailPinjam', 'id_peminjaman');
	}
}

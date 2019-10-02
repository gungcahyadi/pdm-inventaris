<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
	protected $table = 'history_pengembalian';
	protected $guarded = [];
	protected $primaryKey = 'id_history';
	public $timestamps = false;

	public function inventaris(){
		return $this->belongsTo('App\Inventaris', 'id_inventaris');
	}
	public function peminjaman(){
		return $this->belongsTo('App\Peminjaman', 'id_peminjaman');
	}
	public function detail_pinjam(){
		return $this->hasOne('App\DetailPinjam', 'id_detail_pinjam');
	}
}

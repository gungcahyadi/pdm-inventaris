<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{
	protected $table = 'detail_pinjam';
	protected $guarded = [];
	protected $primaryKey = 'id_detail_pinjam';
	public $timestamps = false;

	public function inventaris(){
		return $this->belongsTo('App\Inventaris', 'id_inventaris');
	}
}

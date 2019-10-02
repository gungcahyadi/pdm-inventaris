<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
	protected $table = 'ruang';
	protected $guarded = [];
	protected $primaryKey = 'id_ruang';
	public $timestamps = false;

	public function inventaris(){
		return $this->hasMany('App\Inventaris', 'id_ruang');
	}
}

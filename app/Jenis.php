<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
	protected $table = 'jenis';
	protected $guarded = [];
	protected $primaryKey = 'id_jenis';
	public $timestamps = false;

	public function inventaris(){
		return $this->hasMany('App\Inventaris', 'id_jenis');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
	protected $table = 'pegawai';
	protected $guarded = [];
	protected $primaryKey = 'id_pegawai';
	public $timestamps = false;
}

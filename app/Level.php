<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
	protected $table = 'level';
	protected $guarded = [];
	protected $primaryKey = 'id_level';
	public $timestamps = false;
}

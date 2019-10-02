<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $timestamps = false;    
    protected $fillable = [
        'username', 'password', 'show_password', 'nama_petugas', 'id_level', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'username', 'password', 'show_password', 'nama_petugas', 'id_level', 'remember_token',
    ];


    public function level(){
        return $this->belongsTo('App\Level', 'id_level');
    }

    public function getThumbImageAttribute()
    {
        if ($this->image != '') {
            return asset('assets/images/' . $this->image);
        } else {
            return asset('assets/images/profile.png');
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kukja extends Model
{
    protected $table = 'kukja';
    public $timestamps = false;

    public function kukjakorisnik()
    {
        return $this->hasMany('App\KukjaKorisnik', 'id_kukja');
    }

    public function uredi()
    {
        return $this->hasMany('App\Ured', 'id_kukja');
    }
}

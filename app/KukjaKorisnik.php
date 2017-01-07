<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KukjaKorisnik extends Model
{
    protected $table = 'kukja_korisnik';
    public $timestamps = false;

    public function kukja() {
        return $this->belongsTo('App\Kukja', 'id_kukja');
    }

    public function korisnik() {
        return $this->belongsTo('App\User', 'id_korisnik');
    }
}

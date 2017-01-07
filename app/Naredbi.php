<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Naredbi extends Model
{
    protected $table = 'naredbi';
    public $timestamps = false;

    public function ured() {
        return $this->belongsTo('App\Ured', 'id_ured');
    }

    public function dal_naredba() {
        return $this->belongsTo('App\User', 'id_korisnik');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktivnost extends Model
{
    protected $table = 'aktivnosti';
    public $timestamps = false;

    public function dal_naredba() {
        return $this->belongsTo('App\User', 'id_korisnik');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    protected $table = 'kategorija';
    public $timestamps = false;

    public function uredi()
    {
        return $this->hasMany('App\Ured', 'id_kategorija');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soba extends Model
{
    protected $table = 'soba';
    public $timestamps = false;

    public function uredi()
    {
        return $this->hasMany('App\Ured', 'id_soba');
    }
}

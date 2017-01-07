<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ured extends Model
{
    protected $table = 'ured';
    public $timestamps = false;

    public function kukja() {
        return $this->belongsTo('App\Kukja', 'id_kukja');
    }

    public function kategorija() {
        return $this->belongsTo('App\Kategorija', 'id_kategorija');
    }

    public function soba() {
        return $this->belongsTo('App\Soba', 'id_soba');
    }
}

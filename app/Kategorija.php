<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    protected $table = 'kategorija';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['vid_na_ured', 'mokjnost_vati'];
    public function uredi()
    {
        return $this->hasMany('App\Ured', 'id_kategorija');
    }
}

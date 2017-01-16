<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pomos extends Model
{
    protected $table = 'pomosh';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['naslov', 'objasnuvanje'];
}

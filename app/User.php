<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }
    public function kukji()
    {
        return $this->hasMany('App\KukjaKorisnik', 'id_korisnik');
    }
    public function naredbi()
    {
        return $this->hasMany('App\Naredbi', 'id_korisnik');
    }

    public function isAdmin() {
        if($this->role->name == 'Administrator') {
            return true;
        }
        return false;
    }
}

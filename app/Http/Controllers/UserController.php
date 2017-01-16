<?php

namespace App\Http\Controllers;

use App\Aktivnost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function promeniLozinka(){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->password = bcrypt(request('nova_lozinka'));
        $user->save();

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." си ја промени лозинката ";
        $akt->save();
    }
}

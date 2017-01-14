<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class KorisniciController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    public function index()
    {
        $title = 'Vkluci.MK - Корисници';
        $korisnici = User::select('name', 'email')->where('role_id', 1)->get();
        return view('korisnici', compact('title', 'korisnici'));
    }

    public function getUserKorisnici(){
        return User::where('role_id', 1)->get();
    }

    public function UserExists($kemail){
        if (User::where('email', $kemail)->count())
            return ['postoi' => 1];
        else
            return ['postoi' => 0];
    }

    public function dodajKorisnik(){
        $user = new User();
        $user->role_id = 1;
        $user->name = request('ime');
        $user->email = request('email');
        $user->password = bcrypt(request('lozinka'));
        $user->save();
    }

    public function izbrisiKorisnik(){
        User::find(request('k_id'))->delete();
    }

    public function getUserKorisnik($k_id){
        return User::where('id', $k_id)->where('role_id', 1)->get();
    }

    public function izmeniKorisnik(){
        $user = User::find(request('id'));
        $user->name = request('ime');
        $user->email = request('email');
        if(request('lozinka'))
        $user->password = bcrypt(request('lozinka'));
        $user->save();
    }
}

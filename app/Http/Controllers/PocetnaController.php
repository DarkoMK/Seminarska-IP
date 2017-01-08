<?php

namespace App\Http\Controllers;

use App\Ured;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PocetnaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('IsAdmin');
    }
    public function index()
    {
        if (Auth::user()->IsAdmin())
            return redirect('/korisnici');
        $title = 'Vkluci.MK - Почетна';
            $userid = Auth::user()->id;
            $uredi = Ured::join('kukja', 'ured.id_kukja', '=', 'kukja.id')
                ->join('kukja_korisnik', 'kukja.id', '=', 'kukja_korisnik.id_kukja')
                ->join('users', 'users.id', '=', 'kukja_korisnik.id_korisnik')
                ->join('kategorija', 'kategorija.id', '=', 'ured.id_kategorija')
                ->join('soba', 'soba.id', '=', 'ured.id_soba')
                ->select('ured.id', 'ured.ime', 'soba.ime', 'kategorija.vid_na_ured', 'kategorija.mokjnost_vati', 'ured.vklucena_sostojba', 'ured.br_izvod')
                ->where('users.id', $userid)
                ->get();
            return view('pocetna', compact('title', 'uredi'));
    }
}

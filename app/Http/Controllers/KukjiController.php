<?php

namespace App\Http\Controllers;

use App\Kategorija;
use App\Kukja;
use App\KukjaKorisnik;
use App\Soba;
use App\Ured;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KukjiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    public function index()
    {
        $title = 'Vkluci.MK - Куќи';
        $kukji = Kukja::
            selectRaw('id, ime, (SELECT count(*) FROM ured WHERE ured.id_kukja = kukja.id) as br_uredi')
            ->paginate(10);;
        return view('kukji', compact('title', 'kukji'));
    }

    public function izbrisiKukja($id_kukja){
        Ured::where('id_kukja', $id_kukja)->delete();
        Kukja::find($id_kukja)->delete();
        return redirect()->back();
    }

    public function izmeniKukja($id_kukja)
    {
        $title = 'Vkluci.MK - Измена на куќа';
        $kukja = Kukja::where('kukja.id', $id_kukja)->with('uredi', 'kukjakorisnik.korisnik', 'uredi.soba', 'uredi.kategorija')->get();
        //dd($kukja);
        return view('izmenaKukja', compact('title', 'kukja'));
    }

    public function zacuvajKukja()
    {
        $kukja = Kukja::find(request('id_kukja'));
        $kukja->ime = request('ime');
        $kukja->save();
        return redirect()->back();
    }

    public function izbrisiKukjaKorisnik()
    {
        KukjaKorisnik::where('id_kukja', request('id_kukja'))->where('id_korisnik', request('id_korisnik'))->delete();
        return redirect()->back();
    }

    public function dodajKukjaKorisnik($id_kukja)
    {
        $title = 'Vkluci.MK - Додај корисник на куќа';
        $korisnici = User::where('role_id', 1)->paginate(10);
        return view('dodajKukjaKorisnik', compact('title', 'korisnici', 'id_kukja'));
    }

    public function zacuvajKukjaKorisnik()
    {
        $count = KukjaKorisnik::where('id_kukja', request('id_kukja'))->where('id_korisnik', request('id_korisnik'))->count();
        if(!$count) {
            $kk = new KukjaKorisnik();
            $kk->id_kukja = request('id_kukja');
            $kk->id_korisnik = request('id_korisnik');
            $kk->save();
        }
        return redirect('/kukji/izmeni/'.request('id_kukja'));
    }

    public function izbrisiKukjaUred(){
        Ured::find(request('id_ured'))->delete();
        return redirect()->back();
    }

    public function dodajKukjaUred($id_kukja)
    {
        $title = 'Vkluci.MK - Додај уред на куќа';
        $sobi = Soba::all();
        $kat = Kategorija::all();
        return view('dodajKukjaUred', compact('title', 'id_kukja', 'sobi', 'kat'));
    }

    public function zacuvajKukjaUred()
    {
        $count = Ured::where('br_izvod', request('izvod'))->count();
        if(!$count) {
            $ured = new Ured();
            $ured->id_kukja = request('id_kukja');
            $ured->id_kategorija = request('kategorija');
            $ured->id_soba = request('soba');
            $ured->ime = request('ime');
            $ured->vklucena_sostojba = 0;
            $ured->br_izvod = request('izvod');
            $ured->save();
        }
        return redirect('/kukji/izmeni/'.request('id_kukja'));
    }

    public function zacuvajNovaKukja()
    {
        $kukja = new Kukja();
        $kukja->ime = request('ime');
        $kukja->save();
    }

    public function kImePostoi($ime){
        $count = Kukja::where('ime', $ime)->count();
        return ['postoi' => $count];
    }
}

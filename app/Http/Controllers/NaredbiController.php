<?php

namespace App\Http\Controllers;

use App\Naredbi;
use App\Ured;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NaredbiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('IsAdmin');
    }
    public function index()
    {
        $title = 'Vkluci.MK - Наредби';
        return view('naredbi', ['title' => $title]);
    }

    private function isOwner($id_ured){
        $userid = Auth::user()->id;
        $e_sopstvenik = Ured::join('kukja', 'ured.id_kukja', '=', 'kukja.id')
            ->join('kukja_korisnik', 'kukja.id', '=', 'kukja_korisnik.id_kukja')
            ->join('users', 'users.id', '=', 'kukja_korisnik.id_korisnik')
            ->where('users.id', $userid)
            ->where('ured.id', $id_ured)
            ->count();
        return ($e_sopstvenik) ? true : false;
    }

    public function getUredStatusVK(Request $request, $id_ured){
        $current_time = Carbon::now();
        $uredStatus = Naredbi::where('id_ured', $id_ured)->whereNotNull('vreme_vklucuvanje')->orderBy('vreme_vklucuvanje', 'desc')->with('dal_naredba', 'ured')->first();
        return compact('uredStatus', 'current_time');
    }

    public function getUredStatusISK(Request $request, $id_ured){
        $current_time = Carbon::now();
        $uredStatus = Naredbi::where('id_ured', $id_ured)->whereNotNull('vreme_isklucuvanje')->orderBy('vreme_isklucuvanje', 'desc')->with('dal_naredba', 'ured')->first();
        return compact('uredStatus', 'current_time');
    }

    public function vkluciUred(){
        $id_ured = request('id_ured');
        if ($this->isOwner($id_ured)){
            //naredbi -> vreme_vkl now, vreme_iskl null
            //uredi -> sostojba on
            $current_time = Carbon::now();
            $naredba = new Naredbi();
            $naredba->id_ured = $id_ured;
            $naredba->id_korisnik = Auth::user()->id;
            $naredba->vreme_vklucuvanje = $current_time;
            $naredba->save();
            $ured = Ured::find($id_ured);
            $ured->vklucena_sostojba = 1;
            $ured->save();
        }else{
            abort(403, 'Недозволена акција!');
        }
    }

    public function iskluciUred(){
        $id_ured = request('id_ured');
        if ($this->isOwner($id_ured)){
            $current_time = Carbon::now();
            $naredba = new Naredbi();
            $naredba->id_ured = $id_ured;
            $naredba->id_korisnik = Auth::user()->id;
            $naredba->vreme_isklucuvanje = $current_time;
            $naredba->save();
            $ured = Ured::find($id_ured);
            $ured->vklucena_sostojba = 0;
            $ured->save();
        }else{
            abort(403, 'Недозволена акција!');
        }
    }

    public function getUserNaredbi(){
        $userid = Auth::user()->id;
        $current_time = Carbon::now();
        $naredbi = Naredbi::join('ured', 'naredbi.id_ured', '=', 'ured.id')
            ->join('kukja', 'kukja.id', '=', 'ured.id_kukja')
            ->join('kukja_korisnik', 'kukja_korisnik.id_kukja', '=', 'kukja.id')
        ->where('kukja_korisnik.id_korisnik', $userid)->where('naredbi.na_tajmer', 1)->where('vreme_vklucuvanje', '>', $current_time)->orWhere('vreme_isklucuvanje', '>', $current_time)->with('ured.soba')->get();
        return $naredbi;
    }

    public function getUserUredi(){
        $userid = Auth::user()->id;
        $uredi = Ured::join('kukja', 'ured.id_kukja', '=', 'kukja.id')
            ->join('kukja_korisnik', 'kukja.id', '=', 'kukja_korisnik.id_kukja')
            ->join('users', 'users.id', '=', 'kukja_korisnik.id_korisnik')
            ->join('soba', 'soba.id', '=', 'ured.id_soba')
            ->select('ured.id', 'ured.ime as iured', 'soba.ime as isoba')
            ->where('users.id', $userid)
            ->get();
        return $uredi;
    }

    public function getServerTime(){
        $current_time = Carbon::now();
        return $current_time;
    }

    public function vnesiNaredba(){
        $id_ured = request('id_ured');
        if ($this->isOwner($id_ured)){
            $naredba = new Naredbi();
            $naredba->id_ured = $id_ured;
            $naredba->id_korisnik = Auth::user()->id;
            $naredba->na_tajmer = 1;
            $naredba->vreme_vklucuvanje = request('timeStrv');
            $naredba->vreme_isklucuvanje =request('timeStri');
            $naredba->save();
        }else{
            abort(403, 'Недозволена акција!');
        }
    }

    public function editNaredba(){
        $id_ured = request('id_ured');
        if ($this->isOwner($id_ured)){
            $naredba = Naredbi::find(request('id_naredba'));
            $naredba->id_ured = $id_ured;
            $naredba->id_korisnik = Auth::user()->id;
            $naredba->na_tajmer = 1;
            $naredba->vreme_vklucuvanje = request('timeStrv');
            $naredba->vreme_isklucuvanje =request('timeStri');
            $naredba->save();
        }else{
            abort(403, 'Недозволена акција!');
        }
    }

    public function izbrisiNaredba(){
        $id_ured = request('id_ured');
        $naredba_id = request('naredba_id');
        if ($this->isOwner($id_ured)){
            Naredbi::find($naredba_id)->delete();
        }else{
            abort(403, 'Недозволена акција!');
        }
    }
}

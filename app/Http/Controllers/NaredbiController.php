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
        return view('naredbi', ['title' => 'Vkluci.MK - Наредби']);
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
}

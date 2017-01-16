<?php

namespace App\Http\Controllers;

use App\Aktivnost;
use App\Kategorija;
use App\Pomos;
use App\Soba;
use App\User;
use Illuminate\Http\Request;

class PodesuvanjaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    public function index()
    {
        $title = 'Vkluci.MK - Подесувања';
        $br_adm = User::where('role_id', 2)->count();
        $br_kat = Kategorija::count();
        $br_sobi = Soba::count();
        $br_pomos = Pomos::count();
        $br_akt = Aktivnost::count();
        return view('podesuvanja', compact('title', 'br_adm', 'br_kat', 'br_sobi', 'br_pomos', 'br_akt'));
    }

}

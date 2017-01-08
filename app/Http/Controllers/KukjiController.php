<?php

namespace App\Http\Controllers;

use App\Kukja;
use App\Ured;
use Illuminate\Http\Request;

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
            ->get();
        $bruredi = Ured::where('id_kukja','=', 2)->count();
        return view('kukji', compact('title', 'kukji'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Pomos;
use Illuminate\Http\Request;

class PomosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('IsAdmin');
    }
    public function index()
    {
        $title = 'Vkluci.MK - Помош';
        $pomos = Pomos::all();
        return view('pomos', compact('title', 'pomos'));
    }
}

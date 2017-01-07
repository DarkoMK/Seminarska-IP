<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PocetnaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('IsAdmin');
    }
    public function index()
    {
        return view('pocetna', ['title' => 'Vkluci.MK - Почетна']);
    }
}

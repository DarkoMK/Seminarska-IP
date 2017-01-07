<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

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
}

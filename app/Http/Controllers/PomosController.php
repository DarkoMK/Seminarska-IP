<?php

namespace App\Http\Controllers;

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
        return view('pomos', ['title' => 'Vkluci.MK - Помош']);
    }
}

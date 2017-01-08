<?php

namespace App\Http\Controllers;

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
        return view('podesuvanja', ['title' => 'Vkluci.MK - Подесувања']);
    }
}

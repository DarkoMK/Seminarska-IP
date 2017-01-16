<?php

namespace App\Http\Controllers\Admin;

use App\Aktivnost;
use App\Http\Controllers\Controller;
use Session;
use App\Http\Requests;

class AktivnostiController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    $this->middleware('IsAdmin');
    }

    public function index()
    {
        $title = 'Vkluci.MK - Активности';
        $aktivnosti = Aktivnost::paginate(25);
        return view('admin.aktivnosti.index', compact('aktivnosti', 'title'));
    }
}

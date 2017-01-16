<?php

namespace App\Http\Controllers;

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
        return view('podesuvanja', ['title' => 'Vkluci.MK - Подесувања']);
    }

    public function getAdmini(){
        return User::where('role_id', 2)->get();
    }

    public function getAdmin($id_user){
        return User::find($id_user);
    }
}

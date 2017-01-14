<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function promeniLozinka(){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->password = bcrypt(request('nova_lozinka'));
        $user->save();
    }
}

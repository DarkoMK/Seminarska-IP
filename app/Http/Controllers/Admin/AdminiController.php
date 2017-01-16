<?php

namespace App\Http\Controllers\Admin;

use App\Aktivnost;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Vkluci.MK - Админи';
        $admini = User::where('role_id', 2)->paginate(25);
        $izmeni = 0;
        return view('admin.admini.index', compact('admini', 'title', 'izmeni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Vkluci.MK - Додај админ';
        $izmeni = 0;
        return view('admin.admini.create', compact('title', 'izmeni'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'email' => 'unique:users|required|email',
			'password' => 'required'
		]);

        $user = new User();
        $user->role_id = 2;
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." додаде нов админ " . request('email');
        $akt->save();

        Session::flash('flash_message', 'Успешно додаден!');

        return redirect('admin/admini');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $admini = User::findOrFail($id);

        return view('admin.admini.show', compact('admini'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $title = 'Vkluci.MK - Измени админ';
        $admini = User::findOrFail($id);
        $izmeni = 1;
        return view('admin.admini.edit', compact('admini', 'title', 'izmeni'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			//'password' => 'required'
		]);
        $requestData = $request->all();
        
        $User = User::findOrFail($id);
        $User->update($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." направи измена на админот " . request('email');
        $akt->save();

        Session::flash('flash_message', 'Успешно ажуриран!');

        return redirect('admin/admini');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'Успешно избришан!');

        return redirect('admin/admini');
    }
}

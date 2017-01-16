<?php

namespace App\Http\Controllers\Admin;

use App\Aktivnost;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pomos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class PomosController extends Controller
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

        $title = 'Vkluci.MK - Помош';
        $pomos = Pomos::paginate(25);

        return view('admin.pomos.index', compact('pomos', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Vkluci.MK - Помош - додај';
        return view('admin.pomos.create', compact('title'));
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
        
        $requestData = $request->all();
        
        Pomos::create($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." додаде нова помош " . request('naslov');
        $akt->save();

        Session::flash('flash_message', 'Додадено!');

        return redirect('admin/pomos');
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
        $pomos = Pomos::findOrFail($id);

        return view('admin.pomos.show', compact('pomos'));
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
        $title = 'Vkluci.MK - Помош - измени';
        $pomos = Pomos::findOrFail($id);

        return view('admin.pomos.edit', compact('pomos', 'title'));
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
        
        $requestData = $request->all();
        
        $pomos = Pomos::findOrFail($id);
        $pomos->update($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." направи измена на помош " . request('naslov');
        $akt->save();

        Session::flash('flash_message', 'Ажурирано!');

        return redirect('admin/pomos');
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
        Pomos::destroy($id);

        Session::flash('flash_message', 'Избришано!');

        return redirect('admin/pomos');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Aktivnost;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Soba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SobaController extends Controller
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
        $title = 'Vkluci.MK - Соби';
        $soba = Soba::paginate(25);

        return view('admin.soba.index', compact('soba', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Vkluci.MK - Додај соба';
        return view('admin.soba.create', compact('title'));
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
			'ime' => 'required'
		]);
        $requestData = $request->all();
        
        Soba::create($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." додаде нова соба " . request('ime');
        $akt->save();

        Session::flash('flash_message', 'Собата е додадена!');

        return redirect('admin/soba');
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
        $soba = Soba::findOrFail($id);

        return view('admin.soba.show', compact('soba'));
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
        $title = 'Vkluci.MK - Измени соби';
        $soba = Soba::findOrFail($id);

        return view('admin.soba.edit', compact('soba', 'title'));
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
			'ime' => 'required'
		]);
        $requestData = $request->all();
        
        $soba = Soba::findOrFail($id);
        $soba->update($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." направи измена на соба " . request('ime');
        $akt->save();

        Session::flash('flash_message', 'Собата е ажурирана!');

        return redirect('admin/soba');
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
        Soba::destroy($id);

        Session::flash('flash_message', 'Собата е избришана!');

        return redirect('admin/soba');
    }
}

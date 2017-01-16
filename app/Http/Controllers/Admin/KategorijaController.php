<?php

namespace App\Http\Controllers\Admin;

use App\Aktivnost;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Kategorija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class KategorijaController extends Controller
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
        $title = 'Vkluci.MK - Видови уреди';
        $kategorija = Kategorija::paginate(25);

        return view('admin.kategorija.index', compact('kategorija', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Vkluci.MK - Додај вид на уред';
        return view('admin.kategorija.create', compact('title'));
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
			'vid_na_ured' => 'required'
		]);
        $requestData = $request->all();
        
        Kategorija::create($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." додаде нов вид на уред " . request('vid_na_ured');
        $akt->save();

        Session::flash('flash_message', 'Успешно додадено!');

        return redirect('admin/kategorija');
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
        $kategorija = Kategorija::findOrFail($id);

        return view('admin.kategorija.show', compact('kategorija'));
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
        $title = 'Vkluci.MK - Измени вид на уред';
        $kategorija = Kategorija::findOrFail($id);

        return view('admin.kategorija.edit', compact('kategorija', 'title'));
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
			'vid_na_ured' => 'required'
		]);
        $requestData = $request->all();
        
        $kategorija = Kategorija::findOrFail($id);
        $kategorija->update($requestData);

        $akt = new Aktivnost();
        $akt->id_korisnik = Auth::user()->id;
        $akt->description = Auth::user()->name." измени вид на уред " . request('vid_na_ured');
        $akt->save();

        Session::flash('flash_message', 'Успешно ажурирано!');

        return redirect('admin/kategorija');
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
        Kategorija::destroy($id);

        Session::flash('flash_message', 'Видот е избришан!');

        return redirect('admin/kategorija');
    }
}

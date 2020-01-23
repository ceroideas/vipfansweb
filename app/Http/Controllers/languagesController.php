<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;

class languagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $l = Language::where('status' , 1)->get();
        return view('admin.languages' , compact('l'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'iso'   => 'required',
        ] , [
            'title.required' => 'Ingresa el título del idioma',
            'iso.required'   => 'Ingresa el iso del idioma',
        ]);

        $l = new Language;
        $l->title = $request->title;
        $l->iso   = $request->iso;
        $l->status = 1;
        $l->save();

        return back()->with('msj' , 'Idioma agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ln = Language::find($id);
        $l  = Language::where('status' , 1)->get();
        return view('admin.languages' , compact('ln' , 'l'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'title' => 'required',
            'iso'   => 'required',
        ] , [
            'title.required' => 'Ingresa el título del idioma',
            'iso.required'   => 'Ingresa el iso del idioma',
        ]);

        $l = Language::find($id);
        $l->title = $request->title;
        $l->iso   = $request->iso;
        $l->save();

        return redirect('/admin/languages')->with('msj' , 'Idioma actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $l = Language::find($id);
        $l->status = 0;
        $l->save();

        return redirect('/admin/languages')->with('msj' , 'Idioma eliminado exitosamente');
    }
}

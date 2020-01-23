<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Theme;

use App\Language;

use App\Translation;

class themesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $t = Theme::where('status' , 1)->get();
        $l = Language::where('status' , 1)->get();
        return view('admin.themes.index' , compact('t' , 'l'));
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
            'title'       => 'required',
            // 'description' => 'required',
        ] , [
            'title.required'       => 'Ingresa el título de la temática',
            'description.required' => 'Ingresa la descripción de la temática',
        ]);

        $t = new Theme;
        $t->title = $request->title;
        $t->description = $request->title;
        $t->status = 1;
        $t->save();

        $table = $t->getTable();

        if (count($request->title_lang) > 0) {
            foreach ($request->title_lang as $key => $value) {
                $t2 = new Translation;
                $t2->iso_language = $request->langs[$key];
                $t2->table        = $table;
                $t2->item_id      = $t->id;
                $t2->key          = 'title';
                $t2->value        = $value ? $value : '';
                $t2->save();
            }
        }


        return redirect('/admin/themes')->with('msj' , 'Temática agregada exitosamente');
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
        $t = Theme::where('status' , 1)->get();
        $te = Theme::find($id);
        $l = Language::where('status' , 1)->get();
        return view('admin.themes.index' , compact('te' , 't' , 'l'));
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
            'title'       => 'required',
            // 'description' => 'required',
        ] , [
            'title.required'       => 'Ingresa el título de la temática',
            'description.required' => 'Ingresa la descripción de la temática',
        ]);

        $t = Theme::find($id);
        $t->title = $request->title;
        $t->description = $request->title;
        $t->save();

        $table = $t->getTable();

        if (count($request->title_lang) > 0) {
            foreach ($request->title_lang as $key => $value) {
                $t2 = Translation::where([
                    'iso_language' => $request->langs[$key],
                    'table'        => $table,
                    'key'          => 'title',
                    'item_id'      => $t->id
                ])->first();
                if (!$t2) {
                    $t2 = new Translation;
                    $t2->iso_language = $request->langs[$key];
                    $t2->table        = $table;
                    $t2->item_id      = $t->id;
                    $t2->key          = 'title';
                    $t2->value        = $value ? $value : '';
                    $t2->save();
                }else{
                    $t2->value        = $value ? $value : '';
                    $t2->save();
                }
            }
        }

        return redirect('/admin/themes')->with('msj' , 'Temática actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus($id){
        $t = Theme::find($id);
        if ($t->status == 1) {
            $t->status = 0;
        }else{
            $t->status = 1;
        }
        $t->save();

        return redirect('/admin/themes')->with('msj' , 'Temática eliminada exitosamente');
    }
}

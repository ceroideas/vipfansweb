<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CreditPackage;

use App\Language;

use App\Translation;

class creditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = CreditPackage::where('status' , 1)->get();
        $l = Language::where('status' , 1)->get();
        return view('admin.packages.credits' , compact('c' , 'l'));
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
        if (!$request->title) {
            return back()->with('error' , 'Ingres ael título del credito');
        }

        $c = new CreditPackage;
        $c->title  = $request->title;
        $c->status = 1;
        $c->save();

        $table = $c->getTable();

        if (count($request->title_lang) > 0) {
            foreach ($request->title_lang as $key => $value) {
                $t = new Translation;
                $t->iso_language = $request->langs[$key];
                $t->table        = $table;
                $t->item_id      = $c->id;
                $t->key          = 'title';
                $t->value        = $value ? $value : '';
                $t->save();
            }
        }

        return back()->with('msj' , 'Credito agregado exitosamente');
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
        $cr = CreditPackage::find($id);
        $c  = CreditPackage::where('status' , 1)->get();
        $l = Language::where('status' , 1)->get();
        return view('admin.packages.credits' , compact('cr' , 'c' , 'l'));  
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
        if (!$request->title) {
            return back()->with('error' , 'Ingres ael título del credito');
        }

        $c = CreditPackage::find($id);
        $c->title  = $request->title;
        $c->save();

        $table = $c->getTable();

        if (count($request->title_lang) > 0) {
            foreach ($request->title_lang as $key => $value) {
                $t = Translation::where([
                    'iso_language' => $request->langs[$key],
                    'table'        => $table,
                    'key'          => 'title',
                    'item_id'      => $c->id
                ])->first();
                if (!$t) {
                    $t = new Translation;
                    $t->iso_language = $request->langs[$key];
                    $t->table        = $table;
                    $t->item_id      = $c->id;
                    $t->key          = 'title';
                    $t->value        = $value ? $value : '';
                    $t->save();
                }else{
                    $t->value        = $value ? $value : '';
                    $t->save();
                }
            }
        }

        return redirect('/admin/credits')->with('msj' , 'Credito actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = CreditPackage::find($id);
        $c->status = 0;
        $c->save();

        return redirect('/admin/credits')->with('msj' , 'Credito eliminado exitosamente');
    }
}

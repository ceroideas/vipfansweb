<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Faq;

use App\Language;

use App\Translation;

class faqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $f = Faq::where('status' , 1)->get();
        return view('admin.faqs.index' , compact('f'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $l = Language::where('status' , 1)->get(); 
        return view('admin.faqs.create' , compact('l'));
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
            'title'    => 'required',
            'position' => 'required',
            'answer'   => 'required',
        ] , [
            'title.required'    => 'Ingresa el título de la pregunta',
            'position.required' => 'Selecciona la posición de la pregunta',
            'answer.required'   => 'Ingresa la respuesta de la pregunta',
        ]);

        $old = Faq::where('position' , $request->position)->first();
        if ($old) {
            $old->position = Faq::count() + 1;
            $old->save();
        }

        $f = new Faq;
        $f->title    = $request->title;
        $f->position = $request->position;
        $f->answer   = $request->answer;
        $f->status   = 1;
        $f->save();

        $table = $f->getTable();

        if ($request->title_lang) {
            if (count($request->title_lang) > 0) {
                foreach ($request->title_lang as $key => $value) {
                    $t = new Translation;
                    $t->iso_language = $request->langs[$key];
                    $t->table        = $table;
                    $t->item_id      = $f->id;
                    $t->key          = 'title';
                    $t->value        = $value ? $value : '';
                    $t->save();
                }
            }

            if (count($request->answer_lang) > 0) {
                foreach ($request->answer_lang as $key => $value) {
                    $t = new Translation;
                    $t->iso_language = $request->langs[$key];
                    $t->table        = $table;
                    $t->item_id      = $f->id;
                    $t->key          = 'answer';
                    $t->value        = $value ? $value : '';
                    $t->save();
                }
            }
        }

        return redirect('/admin/faqs')->with('msj' , 'Pregunta gregada exitosamente');
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
        $f = Faq::find($id);
        $l = Language::where('status' , 1)->get(); 
        return view('admin.faqs.edit' , compact('f' , 'l'));
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
            'title'    => 'required',
            'position' => 'required',
            'answer'   => 'required',
        ] , [
            'title.required'    => 'Ingresa el título de la pregunta',
            'position.required' => 'Selecciona la posición de la pregunta',
            'answer.required'   => 'Ingresa la respuesta de la pregunta',
        ]);

        $f = Faq::find($id);
        $old = Faq::where('position' , $request->position)->where('id' , '!=' , $id)->first();
        if ($old) {
            $old->position = $f->position;
            $old->save();
        }

        $f->title    = $request->title;
        $f->position = $request->position;
        $f->answer   = $request->answer;
        $f->status   = 1;
        $f->save();

        $table = $f->getTable();

        if ($request->title_lang) {
       
            if (count($request->title_lang) > 0) {
                foreach ($request->title_lang as $key => $value) {
                    $t = Translation::where([
                        'iso_language' => $request->langs[$key],
                        'table'        => $table,
                        'key'          => 'title',
                        'item_id'      => $f->id
                    ])->first();
                    if (!$t) {
                        $t = new Translation;
                        $t->iso_language = $request->langs[$key];
                        $t->table        = $table;
                        $t->item_id      = $f->id;
                        $t->key          = 'title';
                        $t->value        = $value ? $value : '';
                        $t->save();
                    }else{
                        $t->value        = $value ? $value : '';
                        $t->save();
                    }
                }
            }

            if (count($request->answer_lang) > 0) {
                foreach ($request->answer_lang as $key => $value) {
                    $t = Translation::where([
                        'iso_language' => $request->langs[$key],
                        'table'        => $table,
                        'key'          => 'answer',
                        'item_id'      => $f->id
                    ])->first();
                    if (!$t) {
                        $t = new Translation;
                        $t->iso_language = $request->langs[$key];
                        $t->table        = $table;
                        $t->item_id      = $f->id;
                        $t->key          = 'answer';
                        $t->value        = $value ? $value : '';
                        $t->save();
                    }else{
                        $t->value        = $value ? $value : '';
                        $t->save();
                    }
                }
            }
        }

        return back()->with('msj' , 'Pregunta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $f = Faq::find($id);
        $f->status = 0;
        $f->save();

        return back()->with('msj' , 'Pregunta eliminada exitosamente');
    }
}

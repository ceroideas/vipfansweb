<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Like;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use App\Earning;

use App\Magnetism;

use App\MagnetismPackageOption;

use App\MagnetismPackage;

use App\Faq;

use App\User;

use App\Language;

use App\Translation;

class adminController extends Controller
{
    public function postLogin(Request $r){
        // $u = User::where('role' , 2)->get();
        // $im = 1;
        // if (count($u) > 0) {
        //     foreach ($u as $us) {
        //         $us->avatar = url('/files/users').'/user_'.$im.'.jpg';
        //         $us->save();
        //         $im++;
        //     }
        // }
        // return $u;
    	$r->validate([
    		'email' => 'required|email',
    		'password' => 'required'
    	] , [
    		'email.required'    => 'Ingresa un email',
    		'email.email'       => 'Ingresa un email valido',
    		'password.required' => 'Ingresa la contraseña'
    	]);

    	$credentials = $r->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/home');
        }else{
        	return back()->with('error' , 'Datos incorrectos');
        }
    }

    public function showindex(){
    	return view('admin.index');
    }

    public function logout(){
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect('/admin/login');
    }

    public function likes(){
        $l = Like::first();
        return view('admin.like' , compact('l'));
    }

    public function postLike(Request $r){
        $r->validate([
            'likes'          => 'required',
            'followers'      => 'required',
            'followers_hour' => 'required',
            'texts'          => 'required',
            'hashtags'       => 'required',
            'messages'       => 'required',
            'tags'           => 'required',
            'comments'       => 'required',
        ] , [
            'likes.required' => 'Ingresa la cantidad de likes',
            'followers.required' => 'Ingresa la cantidad de seguidores',
            'followers_hour.required' => 'Ingresa la cantidad de cuentas por hora',
            'texts.required' => 'Ingresa la cantidad de textos',
            'hashtags.required' => 'Ingresa la cantidad de hashtags',
            'messages.required' => 'Ingresa la cantidad de mensajes',
            'tags.required' => 'Ingresa la cantidad de etiquetas',
            'comments.required' => 'Ingresa la cantidad de comentarios',
        ]);

        $l = Like::first();
        if (!$l) {
            $l = new Like;
        }

        $l->likes          = $r->likes;
        $l->followers      = $r->followers;
        $l->followers_hour = $r->followers_hour;
        $l->texts          = $r->texts;
        $l->hashtags       = $r->hashtags;
        $l->messages       = $r->messages;
        $l->tags           = $r->tags;
        $l->comments       = $r->comments;
        $l->save();

        return back()->with('msj' , 'Información guardada exitosamente');
    }

    public function earnings(){
        $e = Earning::first();
        return view('admin.earnings' , compact('e'));
    }

    public function magnetism(){
        $m = Magnetism::first();
        return view('admin.magnetism' , compact('m'));
    }

    public function postEarnings(Request $r){
        $e = Earning::first();
        if (!$e) {
            $e = new Earning;
        }
        $e->likes     = $r->likes;
        $e->comments  = $r->comments;
        $e->followers = $r->followers;
        $e->videos    = $r->videos;
        $e->premiun   = $r->premiun;
        $e->save();

        return back()->with('msj' , 'Información guardada exitosamente');
    }

    public function postMagnetism(Request $r){
        $m = Magnetism::first();
        if (!$m) {
            $m = new Magnetism;
        }
        $m->percent = $r->percent;
        $m->save();

        return back()->with('msj' , 'Información guardada exitosamente');
    }

    public function privacy(){
        return view('privacy');
    }

    public function optionsMagnetism(){
        $o = MagnetismPackageOption::where('status' , 1)->get();
        $l = Language::where('status' , 1)->get(); 
        return view('admin.magnetism.options' , compact('o' , 'l'));
    }

    public function postMagnetismOptions(Request $r){
        $r->validate([
            'title' => 'required'
        ] , [
            'title.required' => 'ingresa el título de la opción'
        ]);

        $o = new MagnetismPackageOption;
        $o->title = $r->title;
        $o->status = 1;
        $o->save();

        $table = $o->getTable();

        if (count($r->title_lang) > 0) {
            foreach ($r->title_lang as $key => $value) {
                $t = new Translation;
                $t->iso_language = $r->langs[$key];
                $t->table        = $table;
                $t->item_id      = $o->id;
                $t->key          = 'title';
                $t->value        = $value ? $value : '';
                $t->save();
            }
        }

        return back()->with('msj' , 'Opcion agregada exitosamente');
    }

    public function editOptions($id){
        $o  = MagnetismPackageOption::where('status' , 1)->get();
        $op = MagnetismPackageOption::find($id);
        $l  = Language::where('status' , 1)->get();
        return view('admin.magnetism.options' , compact('o' , 'op' , 'l'));
    }

    public function updateMagnetismOptions(Request $r , $id){
         $r->validate([
            'title' => 'required'
        ] , [
            'title.required' => 'ingresa el título de la opción'
        ]);

        $o = MagnetismPackageOption::find($id);
        $o->title = $r->title;
        $o->save();

        $table = $o->getTable();

        if (count($r->title_lang) > 0) {
            foreach ($r->title_lang as $key => $value) {
                $t = Translation::where([
                    'iso_language' => $r->langs[$key],
                    'table'        => $table,
                    'key'          => 'title',
                    'item_id'      => $o->id
                ])->first();
                if (!$t) {
                    $t = new Translation;
                    $t->iso_language = $r->langs[$key];
                    $t->table        = $table;
                    $t->item_id      = $o->id;
                    $t->key          = 'title';
                    $t->value        = $value ? $value : '';
                    $t->save();
                }else{
                    $t->value        = $value ? $value : '';
                    $t->save();
                }
            }
        }

        return redirect('/admin/magnetism/options')->with('msj' , 'Opcion editada exitosamente');
    }

    public function deleteOptions($id){
        $o = MagnetismPackageOption::find($id);
        $o->status = 0;
        $o->save();

        return back()->with('msj' , 'Opcion eliminada exitosamente');
    }

    public function listMagnetismPackages(){
        $m = MagnetismPackage::where('status' , 1)->get();
        return view('admin.magnetism.index' , compact('m'));
    }

    public function createMagnetismPackages(){
        $o = MagnetismPackageOption::where('status' , 1)->get();
        $l  = Language::where('status' , 1)->get();
        return view('admin.magnetism.create' , compact('o' , 'l'));
    }

    public function storeMagnetismPackages(Request $r){
        $r->validate([
            'option'      => 'required',
            'points'      => 'required',
            'icon'        => 'required',
            'description' => 'required',
        ] , [
            'option.required'      => 'Seleccion ala opción de la tarea',
            'points.required'      => 'Ingresa la cantidad de puntos de la tarea',
            'icon.required'        => 'Selecciona el icono de la tarea',
            'description.required' => 'Ingresa una descripción para la tarea',
        ]);

        $op = MagnetismPackageOption::find($r->option);
        $title = $op ? $op->title : 'Sin título';

        $p = new MagnetismPackage;
        $p->option_id   = $r->option;
        $p->title       = $title;
        $p->icon        = $r->icon;
        $p->description = $r->description;
        $p->points      = $r->points;
        $p->status      = 1;
        $p->save();

        $table = $p->getTable();

        if (count($r->answer_lang) > 0) {
            foreach ($r->answer_lang as $key => $value) {
                $t = new Translation;
                $t->iso_language = $r->langs[$key];
                $t->table        = $table;
                $t->item_id      = $p->id;
                $t->key          = 'description';
                $t->value        = $value ? $value : '';
                $t->save();
            }
        }

        return redirect('/admin/magnetism/packages')->with('msj' , 'Tarea agregada exitosamente');
    }

    public function editMagnetismPackages($id){
        $p = MagnetismPackage::find($id);
        $o = MagnetismPackageOption::where('status' , 1)->get();
        $l  = Language::where('status' , 1)->get();
        return view('admin.magnetism.edit' , compact('p' , 'o' , 'l')); 
    }

    public function updateMagnetismPackages(Request $r , $id){
        $r->validate([
            'option'      => 'required',
            'points'      => 'required',
            'icon'        => 'required',
            'description' => 'required',
        ] , [
            'option.required'      => 'Seleccion ala opción de la tarea',
            'points.required'      => 'Ingresa la cantidad de puntos de la tarea',
            'icon.required'        => 'Selecciona el icono de la tarea',
            'description.required' => 'Ingresa una descripción para la tarea',
        ]);

        $op = MagnetismPackageOption::find($r->option);
        $title = $op ? $op->title : 'Sin título';

        $p = MagnetismPackage::find($id);
        $p->option_id   = $r->option;
        $p->title       = $title;
        $p->icon        = $r->icon;
        $p->description = $r->description;
        $p->points      = $r->points;
        $p->status      = 1;
        $p->save();

        $table = $p->getTable();

        if (count($r->answer_lang) > 0) {
            foreach ($r->answer_lang as $key => $value) {
                $t = Translation::where([
                    'iso_language' => $r->langs[$key],
                    'table'        => $table,
                    'key'          => 'description',
                    'item_id'      => $p->id
                ])->first();
                if (!$t) {
                    $t = new Translation;
                    $t->iso_language = $r->langs[$key];
                    $t->table        = $table;
                    $t->item_id      = $p->id;
                    $t->key          = 'description';
                    $t->value        = $value ? $value : '';
                    $t->save();
                }else{
                    $t->value        = $value ? $value : '';
                    $t->save();
                }
            }
        }

        return back()->with('msj' , 'Tarea actualizada exitosamente');
    }

    public function deleteMagnetismPackages($id){
        $p = MagnetismPackage::find($id);
        $p->status = 0;
        $p->save();

        return back()->with('msj' , 'Tarea eliminada exitosamente');
    }

    public function faqs(){
        $f = Faq::where('status' , 1)->orderBy('position' , 'asc')->get();
        return view('faqs', compact('f'));
    }

    public function migrar(){
        // Schema::create('translations', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('iso_language');
        //     $table->string('table');
        //     $table->integer('item_id');
        //     $table->string('key');
        //     $table->text('value');
        //     $table->timestamps();
        // });
    }
}

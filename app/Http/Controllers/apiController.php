<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class apiController extends Controller
{
    public function getAllUsers(){
        $u = User::where('role' , 2)->get();
        return $u;
    }

    public function addMagnetism(Request $r , $id){
        $u = User::find($id);
        if ($u) {
            $u->magnetism = $r->magnetism;
            $u->save();
        }

        return $u;
    }

    public function addShowUser(Request $r){
        $u = User::where('instagram_id' , $r->sub)->first();
        if (!$u) {
            $u = new User;
            $u->instagram_id = $r->sub;
        }

        $u->name      = $r->name;
        $u->username  = $r->nickname; // vamos a usar el apellido para el nickname
        $u->email     = ""; // esto no es necesario aun
        // $u->gender    = $r->gender;
        // $u->city_id   = $r->city;
        // $u->theme     = $r->theme;
        $u->status    = 1;
        $u->password  = "";
        $u->role      = 2;
        $u->avatar    = $r->picture;
        $u->save();

        return $u;
    }
}
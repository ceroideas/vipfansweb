<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\City;

use DateTime;

use App\Theme;

use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;

use App\Imports\UsersImport;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u = User::where('role' , 2)->get();
        $t = Theme::where('status' , 1)->get();
        return view('admin.users.index' , compact('u' , 't'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $c = City::where('ubicacionpaisid' , 28)->orderBy('estadonombre' , 'asc')->get();
        $t = Theme::where('status' , 1)->get();
        return view('admin.users.create' , compact('c' , 't'));
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
            'name'      => 'required',
            'email'     => 'required',
            'born_date' => 'required',
            'gender'    => 'required',
            'city'      => 'required',
            'theme'     => 'required',
            'status'    => 'required',
        ] , [
            'name.required'      => 'Ingresa el nombre del usuario',
            'email.required'     => 'Ingresa el email del usuario',
            'born_date.required' => 'Ingresa la fecha de nacimiento del usuario',
            'gender.required'    => 'Selecciona el genero del usuario',
            'city.required'      => 'Selecciona la ciudad del usuario',
            'theme.required'     => 'Ingresa la tematica del usuario',
            'status.required'    => 'Selecciona el estatus del usuario',
        ]);

        $date = DateTime::createFromFormat('d/m/Y', $request->born_date);

        $u = new User;
        $u->name      = $request->name;
        $u->last_name = $request->last_name;
        $u->email     = $request->email;
        $u->born_date = $date;
        $u->gender    = $request->gender;
        $u->city_id   = $request->city;
        $u->theme     = $request->theme;
        $u->status    = $request->status;
        $u->password  = bcrypt('password');
        $u->role      = 2; 

        // if ($request->avatar) {
        //     $name_avatar = md5(uniqid().$request->avatar->getClientOriginalName()).'.'.$request->avatar->getClientOriginalExtension();
        //     $u->avatar = $name_avatar;
        //     $request->avatar->move(public_path().'/files/users/' , $name_avatar);
        // }

        $u->save();

        return redirect('/admin/users')->with('msj' , 'Usuario agregado exitosamente');
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
        $u = User::find($id);
        $c = City::where('ubicacionpaisid' , 28)->orderBy('estadonombre' , 'asc')->get();
        $t = Theme::where('status' , 1)->get();
        return view('admin.users.edit' , compact('u' , 'c' , 't'))->render();
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
        // $request->validate([
        //     'name'      => 'required',
        //     'email'     => 'required',
        //     'born_date' => 'required',
        //     'gender'    => 'required',
        //     'city'      => 'required',
        //     'theme'     => 'required',
        //     'status'    => 'required',
        // ] , [
        //     'name.required'      => 'Ingresa el nombre del usuario',
        //     'email.required'     => 'Ingresa el email del usuario',
        //     'born_date.required' => 'Ingresa la fecha de nacimiento del usuario',
        //     'gender.required'    => 'Selecciona el genero del usuario',
        //     'city.required'      => 'Selecciona la ciudad del usuario',
        //     'theme.required'     => 'Selecciona la tematica del usuario',
        //     'status.required'    => 'Selecciona el estatus del usuario',
        // ]);

        $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'born_date' => 'required',
            'gender'    => 'required',
            'city'      => 'required',
            'theme'     => 'required',
            // 'status'    => 'required',
        ];

        $mess = [
            'name.required'      => 'Ingresa el nombre del usuario',
            'email.required'     => 'Ingresa el email del usuario',
            'born_date.required' => 'Ingresa la fecha de nacimiento del usuario',
            'gender.required'    => 'Selecciona el genero del usuario',
            'city.required'      => 'Selecciona la ciudad del usuario',
            'theme.required'     => 'Selecciona la tematica del usuario',
            'status.required'    => 'Selecciona el estatus del usuario',
        ];

        $v = Validator::make($request->all() , $rules , $mess);

        if ($v->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $v->errors()->first(),
                'id'      => $id
            ]);
        }

        $date = DateTime::createFromFormat('d/m/Y', $request->born_date);

        $u = User::find($id);
        $u->name      = $request->name;
        $u->last_name = $request->last_name;
        $u->email     = $request->email;
        $u->born_date = $date;
        $u->gender    = $request->gender;
        $u->city_id   = $request->city;
        $u->theme     = $request->theme;
        // $u->status    = $request->status;

        // if ($request->avatar) {
        //     $name_avatar = md5(uniqid().$request->avatar->getClientOriginalName()).'.'.$request->avatar->getClientOriginalExtension();
        //     $u->avatar = $name_avatar;
        //     $request->avatar->move(public_path().'/files/users/' , $name_avatar);
        // }

        $u->save();
        return response()->json([
            'success' => true,
            'msj'     => 'Usuario actualizado exitosamente',
            'id'      => $id,
            'user'    => $u
        ]);
        // return back()->with('msj' , 'Usuario actualizado exitosamente');
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
        $u = User::find($id);
        if ($u->status == 1) {
            $u->status = 0;
        }else{
            $u->status = 1;
        }
        $u->save();

        return back()->with('msj' , 'Usuario actualizado exitosamente');
    }

    public function credits(Request $r , $id){
        $u = User::find($id);
        $u->likes     = $r->likes;
        $u->followers = $r->followers;
        $u->comments  = $r->comments;
        $u->videos    = $r->videos;
        $u->magnetism = $r->magnetism;
        $u->save();

        return response()->json([
            'success' => true,
            'msj'     => 'Informacion guardada exitosamente',
            'id'      => $id
        ]);
    }

    public function filter(Request $r){
        $u = User::where('role' , 2)->get();
        $msj = '';
        $gender_filter = 0;
        $city_filter = 0;
        $theme_filter = 0;
        $buy_filter = 0;
        $filter_active = 1;
        $t = Theme::where('status' , 1)->get();

        if ($r->gender && !$r->city && !$r->theme && !$r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = 0;
            $theme_filter       = 0;
            $buy_filter         = 0;
            $filter_active = 1;

            $u = User::where('role' , 2)->where('gender' , $r->gender)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if ($r->gender && $r->city && !$r->theme && !$r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = $r->city;
            $theme_filter       = 0;
            $buy_filter         = 0;
            $filter_active = 1;

            $u = User::where('role' , 2)->where('gender' , $r->gender)->where('city_id' , $r->city)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if ($r->gender && $r->city && $r->theme && !$r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = $r->city;
            $theme_filter       = $r->theme;
            $buy_filter         = 0;
            $filter_active = 1;

            $u = User::where('role' , 2)->where('gender' , $r->gender)->where('city_id' , $r->city)->where('theme' , $r->theme)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if ($r->gender && $r->city && $r->theme && $r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = $r->city;
            $theme_filter       = $r->theme;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('gender' , $r->gender)->where('city_id' , $r->city)->where('theme' , $r->theme)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('gender' , $r->gender)->where('city_id' , $r->city)->where('theme' , $r->theme)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && $r->city && !$r->theme && !$r->buy) {

            $gender_filter      = 0;
            $city_filter        = $r->city;
            $theme_filter       = 0;
            $buy_filter         = 0;
            $filter_active = 1;
            
            $u = User::where('role' , 2)->where('city_id' , $r->city)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && $r->city && $r->theme && !$r->buy) {

            $gender_filter      = 0;
            $city_filter        = $r->city;
            $theme_filter       = $r->theme;
            $buy_filter         = 0;
            $filter_active = 1;
            
            $u = User::where('role' , 2)->where('city_id' , $r->city)->whre('theme' , $r->theme)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && $r->city && $r->theme && $r->buy) {

            $gender_filter      = 0;
            $city_filter        = $r->city;
            $theme_filter       = $r->theme;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('city_id' , $r->city)->where('theme' , $r->theme)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('city_id' , $r->city)->where('theme' , $r->theme)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && !$r->city && $r->theme && !$r->buy) {

            $gender_filter      = 0;
            $city_filter        = 0;
            $theme_filter       = $r->theme;
            $buy_filter         = 0;
            $filter_active = 1;

            $u = User::where('role' , 2)->where('theme' , $r->theme)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && !$r->city && $r->theme && $r->buy) {

            $gender_filter      = 0;
            $city_filter        = 0;
            $theme_filter       = $r->theme;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('theme' , $r->theme)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('theme' , $r->theme)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if ($r->gender && !$r->city && $r->theme && $r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = 0;
            $theme_filter       = $r->theme;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('gender' , $r->gender)->where('theme' , $r->theme)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('gender' , $r->gender)->where('theme' , $r->theme)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if ($r->gender && !$r->city && $r->theme && !$r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = 0;
            $theme_filter       = $r->theme;
            $buy_filter         = 0;
            $filter_active = 1;

            $u = User::where('role' , 2)->where('gender' , $r->gender)->where('theme' , $r->theme)->get();
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && !$r->city && !$r->theme && $r->buy) {

            $gender_filter      = 0;
            $city_filter        = 0;
            $theme_filter       = 0;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if (!$r->gender && $r->city && !$r->theme && $r->buy) {

            $gender_filter      = 0;
            $city_filter        = $r->city;
            $theme_filter       = 0;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('city_id' , $r->city)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('city_id' , $r->city)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }

        if ($r->gender && $r->city && !$r->theme && $r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = $r->city;
            $theme_filter       = 0;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('gender' , $r->gender)->where('city_id' , $r->city)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('gender' , $r->gender)->where('city_id' , $r->city)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        } 

        if ($r->gender && !$r->city && !$r->theme && $r->buy) {

            $gender_filter      = $r->gender;
            $city_filter        = 0;
            $theme_filter       = 0;
            $buy_filter         = $r->buy;
            $filter_active = 1;

            if ($r->buy == 1) {
                $u = User::where('role' , 2)->where('gender' , $r->gender)->whereExists(function ($query){
                        $query->from('package_users')
                        ->whereRaw('package_users.user_id = id'); 
                })->get();
            }else{
                $u = User::where('role' , 2)->where('gender' , $r->gender)->get();
            }
            return view('admin.users.index' , compact('u' , 'gender_filter' , 'city_filter' , 'theme_filter' , 'buy_filter' , 'filter_active' , 't'));
        }
        return $u;
    }   

    public function exportUsers(Request $r){
        $users_data = json_decode($r->data);
        $data = [];

        if (count($users_data) > 0) {
            foreach ($users_data as $da) {
                array_push($data, [
                    'name'     => $da->name.' '.$da->last_name,
                    'username' => $da->username,
                    'email'    => $da->email,
                    'estatus'  => $da->status == 1 ? 'Activo' : 'Bloqueado',
                ]);
            }
        }
        return Excel::download(new UsersExport($data), 'usuarios_'.date('Y-m-d').'.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Package;

use App\PackageUser;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\DefaultImport;

use App\Exports\SellsExport;

use App\CreditPackage;

class packagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Package::where('status' , 1)->get();
        $l = Language::where('status' , 1)->get();
        return view('admin.packages.index' , compact('p' , 'l'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $c = CreditPackage::where('status' , 1)->get();
        return view('admin.packages.create' , compact('c'));
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
            'price'    => 'required',
            'credit'   => 'required',
            'quantity' => 'required',
        ] , [
            'title.required'    => 'Ingresa el título del paquete',
            'price.required'    => 'Ingresa el precio del paquete',
            'credit.required'   => 'Selecciona el credito del paquete',
            'quantity.required' => 'Ingresa la cantidad de creditos del paquete',
        ]);

        $p = new Package;
        $p->title    = $request->title;
        $p->price    = $request->price;
        $p->credit   = $request->credit;
        $p->quantity = $request->quantity;
        $p->status   = 1;
        $p->save();

        return redirect('/admin/packages')->with('msj' , 'Paquete agregado exitosamente');
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
        $p = Package::find($id);
        $c = CreditPackage::where('status' , 1)->get();
        return view('admin.packages.edit' , compact('p' , 'c'));
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
            'price'    => 'required',
            'credit'   => 'required',
            'quantity' => 'required',
        ] , [
            'title.required'    => 'Ingresa el título del paquete',
            'price.required'    => 'Ingresa el precio del paquete',
            'credit.required'   => 'Selecciona el credito del paquete',
            'quantity.required' => 'Ingresa la cantidad de creditos del paquete',
        ]);

        $p = Package::find($id);
        $p->title    = $request->title;
        $p->price    = $request->price;
        $p->credit   = $request->credit;
        $p->quantity = $request->quantity;
        $p->save();

        return back()->with('msj' , 'Paquete aactualizado exitosamente');
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
        $p = Package::find($id);

        if ($p->status == 1) {
            $p->status = 0;
        }else{
            $p->status = 1;
        }
        $p->save();

        return back()->with('msj' , 'Paquete eliminado exitosamente');
    }

    public function sells($id){
        $p = Package::find($id);
        $s = PackageUser::where('package_id' , $id)->get();

        return view('admin.packages.sells' , compact('p' , 's'));
    }

    public function export($id){
        $p = Package::find($id);
        $s = PackageUser::where('package_id' , $id)->get();
        $data = [];

        if (count($s) > 0) {
            foreach ($s as $se) {
                array_push($data, [
                    'user' => $se->user->name.' '.$se->user->last_name,
                    'date' => $se->created_at,
                    'payment' => $se->payment_method ? $se->getMethod() : 'Sin registro',
                    'reference' => $se->payment_reference ? $se->payment_reference : 'Sin registro'
                ]);
            }
        }
        $tit = str_replace(' ', '-', $p->title);
        return Excel::download(new SellsExport($data), 'ventas_'.$tit.'_'.date('Y-m-d').'.xlsx');
        return 'Hola';
    }
}

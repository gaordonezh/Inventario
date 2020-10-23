<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $extraerdatos=Proveedor::where('empresa', 'LIKE', '%'.$query.'%')
                           ->orderBy('created_at','desc')
                           ->Simplepaginate(5);
            return view('proveedor/index',["extraerdatos"=>$extraerdatos, "searchText"=>$query]);
        }
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
        $this->validate($request,[
            'empresa' => 'required|max:50|unique:proveedors',
            'representante' => 'required|max:100',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric',
            'correo' => 'required|max:100|email'
        ]);

        $array_data = new Proveedor;
        $array_data->empresa = $request->get('empresa');
        $array_data->representante = $request->get('representante');
        $array_data->direccion = $request->get('direccion');
        $array_data->telefono = $request->get('telefono');
        $array_data->correo = $request->get('correo');
        $array_data->save();
        return Redirect('/proveedor');
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
        $array_data = Proveedor::findOrFail($id);
        return view('proveedor/edit',compact('array_data'));
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
        $this->validate($request,[
            'empresa' => 'required|max:50',
            'representante' => 'required|max:100',
            'direccion' => 'required|max:100',
            'telefono' => 'required|numeric',
            'correo' => 'required|max:100|email'
        ]);

        $array_data =  Proveedor::findOrFail($id);
        $array_data->empresa = $request->get('empresa');
        $array_data->representante = $request->get('representante');
        $array_data->direccion = $request->get('direccion');
        $array_data->telefono = $request->get('telefono');
        $array_data->correo = $request->get('correo');
        $array_data->update();
        return Redirect('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return Redirect('/proveedor');
    }
}

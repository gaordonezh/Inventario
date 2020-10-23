<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadMedida;

class UnidadMedidaController extends Controller
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
            $extraerdatos=UnidadMedida::where('codigo', 'LIKE', '%'.$query.'%')
                           ->orwhere('nombre', 'LIKE', '%'.$query.'%')
                           ->orderBy('created_at','desc')
                           ->Simplepaginate(5);
            return view('medida/index',["extraerdatos"=>$extraerdatos, "searchText"=>$query]);
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
            'codigo' => 'required|unique:unidad_medidas|max:20',
            'nombre' => 'required|unique:unidad_medidas|max:50'
        ]);

        $array_data = new UnidadMedida;
        $array_data->codigo = $request->get('codigo');
        $array_data->nombre = $request->get('nombre');
        $array_data->save();

        return Redirect('/medida');
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
        $array_data = UnidadMedida::findOrFail($id);
        return view('medida/edit',compact('array_data'));
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
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50'
        ]);

        $array_data =  UnidadMedida::findOrFail($id);
        $array_data->codigo = $request->get('codigo');
        $array_data->nombre = $request->get('nombre');
        $array_data->update();
        return Redirect('/medida');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UnidadMedida::destroy($id);
        return Redirect('/medida');
    }
}

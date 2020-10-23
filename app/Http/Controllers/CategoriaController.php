<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
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
            $extraerdatos=Categoria::where('nombre', 'LIKE', '%'.$query.'%')
                           ->orderBy('created_at','desc')
                           ->Simplepaginate(5);
            return view('categoria/index',["extraerdatos"=>$extraerdatos, "searchText"=>$query]);
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
            'nombre' => 'required|unique:categorias|max:50',
            'descripcion' => 'required|unique:categorias|max:150'
        ]);

        $array_data = new Categoria;
        $array_data->nombre = $request->get('nombre');
        $array_data->descripcion = $request->get('descripcion');
        $array_data->save();

        return Redirect('/categoria');
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
        $array_data = Categoria::findOrFail($id);
        return view('categoria/edit',compact('array_data'));
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
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:150'
        ]);

        $array_data =  Categoria::findOrFail($id);
        $array_data->nombre = $request->get('nombre');
        $array_data->descripcion = $request->get('descripcion');
        $array_data->update();
        return Redirect('/categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categoria::destroy($id);
        return Redirect('/categoria');
    }
}

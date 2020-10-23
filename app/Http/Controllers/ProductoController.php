<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extraerdatos = DB::table('categorias')
                        ->select('id', 'nombre', 'descripcion')
                        ->simplePaginate(8);
        return view('producto/index',["extraerdatos"=>$extraerdatos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'id_categoria' => 'required',
            'id_unimedida' => 'required',
            'nombre' => 'required|max:50|unique:productos',
            'descripcion' => 'max:150',
            'stock' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0'
        ]);

        $array_data = new Producto;
        $array_data->id_categoria = $request->get('id_categoria');
        $array_data->id_unimedida = $request->get('id_unimedida');
        $array_data->nombre = $request->get('nombre');
        $array_data->descripcion = $request->get('descripcion');
        $array_data->stock = $request->get('stock');
        $array_data->precio = $request->get('precio');
        $array_data->estado = '1';
        $array_data->save();
        return Redirect('/producto/'.$array_data->id_categoria.'');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $extraerdatos = DB::table('productos as p')
                ->join('unidad_medidas as u','p.id_unimedida','=','u.id')
                ->select('p.*','u.codigo')
                ->where('id_categoria', '=', $id)
                ->where('estado','=','1')
                ->orderBy('created_at', 'desc')
                ->simplePaginate(6);
        $array_um = DB::table('unidad_medidas')->get();
        $nom_cat = DB::table('categorias')->where('id','=',$id)->get();
        return view('producto/show',[
                                        "extraerdatos"=>$extraerdatos,
                                        "array_um"=>$array_um,
                                        "id"=>$id,
                                        "nom_cat"=>$nom_cat
                                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $array_data = Producto::findOrFail($id);
        $array_um = DB::table('unidad_medidas')->get();
        return view('producto/edit',["array_data"=>$array_data,"array_um"=>$array_um]);
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
            'id_categoria' => 'required',
            'id_unimedida' => 'required',
            'nombre' => 'required|max:50',
            'descripcion' => 'max:150',
            'stock' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0'
        ]);

        $array_data =  Producto::findOrFail($id);

        $id_categoria = $request->get('id_categoria');
        $array_data->id_unimedida = $request->get('id_unimedida');
        $array_data->nombre = $request->get('nombre');
        $array_data->descripcion = $request->get('descripcion');
        $array_data->stock = $request->get('stock');
        $array_data->precio = $request->get('precio');
        $array_data->update();
        return Redirect('/producto/'.$id_categoria.'');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $array_data = $request->get('id_cat');
        Producto::destroy($id);
        return Redirect('/producto/'.$array_data.'');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class SalidaController extends Controller
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
            $extraerdatos = DB::table('salidas as s')
                    ->join('productos as pr','s.id_producto','=','pr.id')
                    ->join('unidad_medidas as u','pr.id_unimedida','=','u.id')
                    ->join('categorias as c','pr.id_categoria','=','c.id')
                    ->select('s.*',
                             'pr.nombre',
                             'c.nombre as nom_cat',
                             'u.nombre as nom_um')
                    ->orwhere('pr.nombre', 'LIKE', '%'.$query.'%')
                    ->orwhere('c.nombre', 'LIKE', '%'.$query.'%')
                    ->orderBy('s.created_at','desc')
                    ->simplePaginate(5);
            $productos = DB::table('productos as p')
                                ->join('categorias as c','p.id_categoria','=','c.id')
                                ->select('p.id','p.nombre','c.nombre as nom_cat')
                                ->where('p.stock','>','0')
                                ->get();
            return view('salida/index',[
                                            "extraerdatos"=>$extraerdatos,
                                            "searchText"=>$query,
                                            "productos"=>$productos
                                        ]);
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
            'id_producto' => 'required',
            'cantidad' => 'required|numeric'
        ]);

        $array_data = new Salida;
        $array_data->id_producto = $request->get('id_producto');
        $array_data->cantidad = $request->get('cantidad');
        $array_data->save();

        $array_data =  Producto::findOrFail($array_data->id_producto);
        $array_data->stock = $array_data->stock - $request->get('cantidad');
        $array_data->update();

        return Redirect('/salida');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Salida::destroy($id);

        $array_data =  Producto::findOrFail($id);
        $array_data->stock = $array_data->stock + $request->get('cant_del');
        $array_data->update();

        return Redirect('/salida');
    }
}

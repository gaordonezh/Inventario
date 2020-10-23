<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
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
            $extraerdatos = DB::table('entradas as e')
                    ->join('proveedors as p','e.id_proveedor','=','p.id')
                    ->join('productos as pr','e.id_producto','=','pr.id')
                    ->join('unidad_medidas as u','pr.id_unimedida','=','u.id')
                    ->join('categorias as c','pr.id_categoria','=','c.id')
                    ->select('e.*',
                             'p.empresa', 'p.representante',
                             'pr.nombre',
                             'c.nombre as nom_cat',
                             'u.nombre as nom_um')
                    ->orwhere('p.empresa', 'LIKE', '%'.$query.'%')
                    ->orwhere('pr.nombre', 'LIKE', '%'.$query.'%')
                    ->orwhere('c.nombre', 'LIKE', '%'.$query.'%')
                    ->orderBy('created_at','desc')
                    ->simplePaginate(5);
            $proveedores = DB::table('proveedors')->get();
            $productos = DB::table('productos as p')
                                ->join('categorias as c','p.id_categoria','=','c.id')
                                ->select('p.id','p.nombre','c.nombre as nom_cat')
                                ->where('p.stock','>','0')
                                ->get();
            return view('entrada/index',[
                                            "extraerdatos"=>$extraerdatos,
                                            "searchText"=>$query,
                                            "proveedores"=>$proveedores,
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
            'id_proveedor' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required|numeric'
        ]);

        $array_data = new Entrada;
        $array_data->id_proveedor = $request->get('id_proveedor');
        $array_data->id_producto = $request->get('id_producto');
        $array_data->cantidad = $request->get('cantidad');
        $array_data->save();

        $array_data =  Producto::findOrFail($array_data->id_producto);
        $array_data->stock = $array_data->stock + $request->get('cantidad');
        $array_data->update();

        return Redirect('/entrada');
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
        Entrada::destroy($id);

        $array_data =  Producto::findOrFail($id);
        $array_data->stock = $array_data->stock - $request->get('cant_del');
        $array_data->update();

        return Redirect('/entrada');
    }
}

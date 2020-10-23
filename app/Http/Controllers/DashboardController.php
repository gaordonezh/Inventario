<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = DB::table('categorias')->get();
        $proveedores = DB::table('proveedors')->get();
        $productos = DB::table('productos')->get();
        $salidas = DB::table('salidas as s')
                    ->join('productos as pr','s.id_producto','=','pr.id')
                    ->join('unidad_medidas as u','pr.id_unimedida','=','u.id')
                    ->join('categorias as c','pr.id_categoria','=','c.id')
                    ->select('s.*',
                                'pr.nombre',
                                'c.nombre as nom_cat',
                                'u.nombre as nom_um')
                    ->orderBy('s.created_at','desc')
                    ->simplePaginate(5);
        $stock = DB::table('productos')
                ->orderBy('stock','desc')
                ->simplePaginate(5);
        $entradas = DB::table('entradas as e')
                    ->join('proveedors as p','e.id_proveedor','=','p.id')
                    ->join('productos as pr','e.id_producto','=','pr.id')
                    ->join('unidad_medidas as u','pr.id_unimedida','=','u.id')
                    ->join('categorias as c','pr.id_categoria','=','c.id')
                    ->select('e.*',
                                'p.empresa', 'p.representante',
                                'pr.nombre',
                                'c.nombre as nom_cat',
                                'u.nombre as nom_um')
                    ->orderBy('created_at','desc')
                    ->simplePaginate(5);
        return view('welcome',[ "categorias"=>$categorias,
                                "proveedores"=>$proveedores,
                                "productos"=>$productos,
                                "salidas"=>$salidas,
                                "stock"=>$stock,
                                "entradas"=>$entradas,
                              ]);
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
        //
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
    public function destroy($id)
    {
        //
    }
}

@extends('layouts.base')
@section('contenido')
<?php
use Illuminate\Support\Carbon;
?>
    <div class="row">
        <div class="col-md-12" style="padding:0">
            <div class="alert alert-light" role="alert" style="margin:0">
                <h2>DASHBOARD</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <div class="overview-item overview-item--c1">
                <a href="/categoria">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-widgets"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $categorias->count() }}</h2>
                                <span>Categorias</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="overview-item overview-item--c2">
                <a href="/proveedor">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-accounts-list"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $proveedores->count() }}</h2>
                                <span>Proveedores</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="overview-item overview-item--c3">
                <a href="/producto">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-view-list-alt"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $productos->count() }}</h2>
                                <span>Productos</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h2 class="title-1 m-b-25">Ultimos productos salientes</h2>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salidas as $sal)
                        <tr>
                            <td>{{ $sal->nom_cat }} {{ $sal->nombre }}</td>
                            <td>{{ $sal->cantidad }} {{ $sal->nom_um }}</td>
                            <td>{{Carbon::parse($sal->created_at)->format('d/m/Y')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <h2 class="title-1 m-b-25">Stock de Productos</h2>
            <div class="au-card au-card--bg-dark au-card-top-countries m-b-40">
                <div class="au-card-inner">
                    <div class="table-responsive">
                        <table class="table table-top-countries">
                            <tbody>
                                @foreach($stock as $cant)
                                    <tr>
                                        <td>{{ $cant->nombre }}</td>
                                        <td class="text-right">{{ $cant->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="title-1 m-b-25">Últimos productos ingresados</h2>
            <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entradas as $entrada)
                            <tr>
                                <td>{{ $entrada->empresa }} <span class="badge badge-light">{{ $entrada->representante }}</span></td>
                                <td>{{ $entrada->nom_cat }} {{ $entrada->nombre }}</td>
                                <td>{{ $entrada->cantidad }} {{ $entrada->nom_um }}</td>
                                <td>{{Carbon::parse($entrada->created_at)->format('d/m/Y')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
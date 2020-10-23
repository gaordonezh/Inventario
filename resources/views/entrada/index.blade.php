@extends('layouts.base')
@section('contenido')
<?php
use Illuminate\Support\Carbon;
?>
    <div class="alert alert-light" role="alert"> Listado <h3>Entradas</h3> </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#mediumModal"><i class="zmdi zmdi-plus"></i></button>
                </span>
                <!-- BUSCAR -->
                <form action="/entrada" method="get" autocomplete="off" role="search" style="width:calc(100% - 45px)">
                    <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{ $searchText }}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-light">Buscar</button>
                        </span>
                    </div>
                </form>
            </div>
            @if($errors->any)
                @foreach($errors->all() as $error)
                    <span class="badge badge-danger">{{ $error }}</span>
                @endforeach
            @endif
            <!-- END BUSCAR -->
            <div class="table-responsive">
                <table class="table table-data3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($extraerdatos as $dato)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dato->empresa }} <span class="badge badge-light">{{ $dato->representante }}</span></td>
                                <td>{{ $dato->nom_cat }} {{ $dato->nombre }}</td>
                                <td>{{ $dato->cantidad }} {{$dato->nom_um}}</td>
                                <td>{{Carbon::parse($dato->created_at)->format('d/m/Y')}}</td>
                                <td style="background:none">
                                    <div class="table-data-feature">
                                        <form action="{{ url('/entrada/'.$dato->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" hidden name="cant_del" value="{{ $dato->cantidad }}">
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('¿Borrar?')" ><i class="zmdi zmdi-delete"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $extraerdatos->links() }}
        </div>
    </div>
@endsection

@section('modales')
<!-- MODAL USUARIO -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">INSERTAR NUEVA ENTRADA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="/entrada" method="post" class="row" autocomplete="off" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_proveedor" class="control-label mb-1">Proveedor</label>
                                        <select name="id_proveedor" id="id_proveedor" class="form-control">
                                            @foreach($proveedores as $prov)
                                                <option value="{{ $prov->id }}">{{ $prov->empresa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_producto" class="control-label mb-1">Producto</label>
                                        <select name="id_producto" id="id_producto" class="form-control">
                                            @foreach($productos as $prod)
                                                <option value="{{ $prod->id }}">{{ $prod->nom_cat }} {{ $prod->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="cantidad" class="control-label mb-1">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control" min="0">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-sending">Guardar</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END MODAL USUARIO -->
@endsection
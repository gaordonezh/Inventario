@extends('layouts.base')
@section('contenido')
<?php
use Illuminate\Support\Carbon;
?>
            <div class="alert alert-light" role="alert"> Listado <h3>Unidades de medida</h3> </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#mediumModal"><i class="zmdi zmdi-plus"></i></button>
                        </span>
                        <!-- BUSCAR -->
                        <form action="/medida" method="get" autocomplete="off" role="search" style="width:calc(100% - 45px)">
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
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Creado</th>
                                    <th>Editado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($extraerdatos as $dato)
                                    <tr>
                                        <td>{{ $loop->iteration }}</tdstyle=>
                                        <td>{{ $dato->codigo }}</tdstyle=>
                                        <td>{{ $dato->nombre }}</tdstyle=>
                                        <td>{{Carbon::parse($dato->created_at)->diff(Carbon::now())->format('hace %d días')}}</td>
                                        <td>{{Carbon::parse($dato->updated_at)->diff(Carbon::now())->format('hace %d días')}}</td>
                                        <td style="background:none">
                                            <div class="table-data-feature">
                                                <a href="/medida/{{ $dato->id}}/edit" class="item" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                <form action="{{ url('/medida/'.$dato->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
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
                    <h5 class="modal-title" id="mediumModalLabel">INSERTAR NUEVA UNIDAD DE MEDIDA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="/medida" method="post" class="row" autocomplete="off" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="codigo" class="control-label mb-1">Código</label>
                                        <input id="codigo" name="codigo" type="text" class="form-control" value="{{ old('codigo') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label mb-1">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ old('nombre') }}">
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
@extends('layouts.base')
@section('contenido')
<div class="alert alert-light" role="alert"> Editar <h3>Producto </h3> </div>
<div class="row">
    <div class="col-lg-12">
        @if($errors->any)
            @foreach($errors->all() as $error)
                <span class="badge badge-danger">{{ $error }}</span>
            @endforeach
        @endif
        <form action="/producto/{{ $array_data->id }}" method="post" class="row" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nombre" class="control-label mb-1">Nombre *</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $array_data->nombre }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="precio" class="control-label mb-1">Precio *</label>
                    <input id="precio" name="precio" type="number" step="0.1" class="form-control" value="{{ $array_data->precio }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="stock" class="control-label mb-1">Stock *</label>
                    <input id="stock" name="stock" type="number" class="form-control" value="{{ $array_data->stock }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="id_unimedida" class="control-label mb-1">Unidad de medida *</label>
                    <select name="id_unimedida" id="id_unimedida" class="form-control">
                        <option value="{{ $array_data->id_unimedida }}">Actual</option>
                        @foreach($array_um as $data)
                            <option value="{{ $data->id }}">{{ $data->codigo }} - {{ $data->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="descripcion" class="control-label mb-1">Descripción</label>
                    <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{ $array_data->descripcion }}">
                </div>
            </div>
            
            <input id="id_categoria" name="id_categoria" type="hidden" hidden value="{{ $array_data->id_categoria }}">
            <div class="col-12">
                <button id="payment-button" type="submit" class="btn btn-info">Guardar</button>
                <a href="/producto/{{ $array_data->id_categoria }}" class="btn btn-secondary">Cancelar</a>
                <br>
                <br>
            </div>
        </form>
    </div>
</div>

@endsection
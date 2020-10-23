@extends('layouts.base')
@section('contenido')
<div class="alert alert-light" role="alert"> Editar <h3>Unidad de medida</h3> </div>
<div class="row">
    <div class="col-lg-12">
        @if($errors->any)
            @foreach($errors->all() as $error)
                <span class="badge badge-danger">{{ $error }}</span>
            @endforeach
        @endif
        <form action="/medida/{{ $array_data->id }}" method="post" class="row" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="codigo" class="control-label mb-1">Código</label>
                    <input id="codigo" name="codigo" type="text" class="form-control" value="{{ $array_data->codigo }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nombre" class="control-label mb-1">Nombre</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $array_data->nombre }}">
                </div>
            </div>
            <div class="col-12">
                <button id="payment-button" type="submit" class="btn btn-info">Guardar</button>
                <a href="/medida" class="btn btn-secondary">Cancelar</a>
                <br>
                <br>
            </div>
        </form>
    </div>
</div>

@endsection
@extends('layouts.base')
@section('contenido')
<div class="alert alert-light" role="alert"> Editar <h3>Categoria </h3> </div>
<div class="row">
    <div class="col-lg-12">
        @if($errors->any)
            @foreach($errors->all() as $error)
                <span class="badge badge-danger">{{ $error }}</span>
            @endforeach
        @endif
        <form action="/categoria/{{ $array_data->id }}" method="post" class="row" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nombre" class="control-label mb-1">Nombre</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $array_data->nombre }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="descripcion" class="control-label mb-1">Descripción</label>
                    <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{ $array_data->descripcion }}">
                </div>
            </div>
            <div class="col-12">
                <button id="payment-button" type="submit" class="btn btn-info">Guardar</button>
                <a href="/categoria" class="btn btn-secondary">Cancelar</a>
                <br>
                <br>
            </div>
        </form>
    </div>
</div>

@endsection
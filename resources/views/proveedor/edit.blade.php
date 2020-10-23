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
        <form action="/proveedor/{{ $array_data->id }}" method="post" class="row" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="empresa" class="control-label mb-1">Nombre de la empresa</label>
                    <input id="empresa" name="empresa" type="text" class="form-control" value="{{ $array_data->empresa }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="representante" class="control-label mb-1">Representante</label>
                    <input id="representante" name="representante" type="text" class="form-control" value="{{ $array_data->representante }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="direccion" class="control-label mb-1">Direccion</label>
                    <input id="direccion" name="direccion" type="text" class="form-control" value="{{ $array_data->direccion }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="telefono" class="control-label mb-1">Teléfono</label>
                    <input id="telefono" name="telefono" type="text" class="form-control" value="{{ $array_data->telefono }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="correo" class="control-label mb-1">Correo</label>
                    <input id="correo" name="correo" type="email" class="form-control" value="{{ $array_data->correo }}">
                </div>
            </div>
            <div class="col-12">
                <button id="payment-button" type="submit" class="btn btn-info">Guardar</button>
                <a href="/proveedor" class="btn btn-secondary">Cancelar</a>
                <br>
                <br>
            </div>
        </form>
    </div>
</div>

@endsection
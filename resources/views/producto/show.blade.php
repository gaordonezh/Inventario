@extends('layouts.base')
@section('contenido')
<div class="alert alert-light" role="alert"> Listado de productos
    <h3>@foreach($nom_cat as $cat) {{ $cat->nombre }} @endforeach</h3> 
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="input-group">
            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#mediumModal">Agregar <i class="zmdi zmdi-plus"></i></button>
        </div>
        @if($errors->any)
            @foreach($errors->all() as $error)
                <span class="badge badge-danger">{{ $error }}</span>
            @endforeach
        @endif
        <!-- END BUSCAR -->
        <div class="row">
            @foreach($extraerdatos as $dato)
                <div class="col-md-4">
                    <aside class="profile-nav alt">
                        <section class="card">
                            <div class="card-header user-header alt bg-dark">
                                <div class="media">
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="https://image.shutterstock.com/image-vector/box-icon-on-white-background-260nw-1502987297.jpg">
                                    <div class="media-body">
                                        <h2 class="text-light display-6" style="font-size:20px">{{ $dato->nombre }}</h2>
                                        <p>{{ $dato->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" style="background: transparent;">
                                    <span class="badge @if($dato->stock > 10) badge-light @else badge-danger @endif ">Stock > {{ $dato->stock }} {{ $dato->codigo }}</span>
                                    <span class="badge badge-light">Precio > S/{{ $dato->precio }}</span>
                                    <div class="table-data-feature">
                                        <a href="/producto/{{ $dato->id}}/edit" class="item" data-toggle="tooltip" data-placement="top" title="Editar"><i class="zmdi zmdi-edit"></i></a>
                                        <form action="{{ url('/producto/'.$dato->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" hidden name="id_cat" value="{{ $dato->id_categoria }}">
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('¿Borrar?')" ><i class="zmdi zmdi-delete"></i></button>
                                        </form>
                                    </div>
                                </li>
                            </ul>

                        </section>
                    </aside>
                </div>
            @endforeach
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
                    <h5 class="modal-title" id="mediumModalLabel">INSERTAR NUEVO PRODUCTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="/producto" method="post" class="row" autocomplete="off" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label mb-1">Nombre *</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ old('nombre') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="precio" class="control-label mb-1">Precio *</label>
                                        <input id="precio" name="precio" type="number" step="0.1" class="form-control" value="{{ old('precio') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="stock" class="control-label mb-1">Stock *</label>
                                        <input id="stock" name="stock" type="number" class="form-control" value="{{ old('stock') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_unimedida" class="control-label mb-1">Unidad de medida *</label>
                                        <select name="id_unimedida" id="id_unimedida" class="form-control">
                                            @foreach($array_um as $dato)
                                                <option value="{{ $dato->id }}">{{ $dato->codigo }} - {{ $dato->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="descripcion" class="control-label mb-1">Descripción</label>
                                        <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{ old('descripcion') }}">
                                    </div>
                                </div>
                                <input type="hidden" hidden name="id_categoria" value="{{ $id }}">
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
@extends('layouts.base')
@section('contenido')
            <div class="alert alert-light" role="alert"> Listado <h3>Categorias</h3> </div>
            <div class="row">
                <div class="col-lg-12">
                    @if($errors->any)
                        @foreach($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error }}</span>
                        @endforeach
                    @endif
                    <!-- END BUSCAR -->
                    <div class="row">
                        @foreach($extraerdatos as $dato)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class="rounded-circle mx-auto d-block" width="80px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSloz7z_XziYw12j--XD8UaaezsSMDOgedfPw&usqp=CAU" alt="Card image cap">
                                            <h4 class="text-sm-center mt-2 mb-1">
                                                <a href="/producto/{{ $dato->id}}"> {{ $dato->nombre }} <i class="zmdi zmdi-open-in-new"></i></a>
                                            </h4>
                                            <div class="location text-sm-center">{{ $dato->descripcion }}</div>
                                        </div>
                                    </div>
                                </div>
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
                    <h5 class="modal-title" id="mediumModalLabel">INSERTAR NUEVA CATEGORIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="/categoria" method="post" class="row" autocomplete="off" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre" class="control-label mb-1">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ old('nombre') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="descripcion" class="control-label mb-1">Descripción</label>
                                        <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{ old('descripcion') }}">
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
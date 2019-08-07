@extends('layouts.usuario.index')
@push('script')

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Editar categoria
    <!--<small>it all starts here</small>-->
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <form id="editarCategoriaFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarCategoria')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$categoria->id}}">
    <div class="box">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label >Nome</label>
                    <input name="nome" type="text" class="form-control" placeholder="nome" value="{{$categoria->nome}}" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <label >Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição" required>{{$categoria->descricao}}</textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            </div>
                            
        </div>
        <div class="box-footer">
            <a href="/usuario/categorias" class="btn btn-warning pull-left">Cancelar</a>
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
        </div>
    </form>

</section>

</div>
@endsection
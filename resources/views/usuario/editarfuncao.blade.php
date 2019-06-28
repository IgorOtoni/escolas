@extends('layouts.usuario.index')
@push('script')

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar função
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarFuncaoFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarFuncao')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{$funcao->id}}">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input value="{{$funcao->nome}}" name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <div class="radio">
                            <label>
                                <input name="apresentar" type="radio" {{($funcao->apresentar) ? "checked" : ""}}>
                                Apresentar membros com esta função em missões e valores
                            </label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição" required>{{$funcao->descricao}}</textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>

            </div>
            <div class="box-footer">
                <a href="/usuario/funcoes" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
        </div>
        </form>

    </section>

</div>
@endsection
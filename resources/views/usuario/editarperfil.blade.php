@extends('layouts.usuario.index')
@push('script')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/select2/dist/css/select2.min.css')}}">

<!-- Select2 -->
<script src="{{asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>

$(function(){

    $('#select_2_modulos').select2();

    var vetor = [];

    <?php
    foreach($modulos as $modulo){
        ?> vetor.push({{$modulo->id}}); <?php
    }
    ?>

    $.ajax({
        url: '/usuario/carregarModulosIgreja/'+{{$igreja->id}},
        type: 'get',
        dataType: 'json',
        success: function(response){

            var len = 0;

            if(response['data'] != null){
            len = response['data'].length;
            }

            if(len > 0){
            for(var i=0; i<len; i++){

                var id = response['data'][i].id;
                var nome = response['data'][i].nome;
                var sistema = response['data'][i].sistema;
                var gerencial = response['data'][i].gerencial;

                if(gerencial == true){
                    if(vetor.includes(id)){
                        var result = "<option value="+id+" selected>"+nome+" - "+sistema+"</option>";
                        $("#select_2_modulos").append(result);
                    }else{
                        var result = "<option value="+id+">"+nome+" - "+sistema+"</option>";
                        $("#select_2_modulos").append(result);
                    }
                }
            }
            }

        }
    });

    $('#editarPerfilFormulario').validator('update');
    $('#editarPerfilFormulario').validator('validate');

    $('#editarPerfilFormulario').validator({
        update: true,
        ignore: [],       
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#select_2_modulos').select2();
});
</script>

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar perfil
        <!--<small>it all starts here</small>-->
        </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
        <form id="editarPerfilFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarPerfil')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$perfil->id}}">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input value="{{$perfil->nome}}" name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição">{{$perfil->descricao}}</textarea>
                    </div>
                </div>
                <div class="col-md-12" id="list-area">
                    <div class="form-group has-feedback">
                    <label>Selecione quais módulos da igreja o perfil irá acessar:</label>
                    <select id="select_2_modulos" name="modulos[]" data-placeholder="Selecione os módulos" class="form-control select2" style="width: 100%;" multiple="multiple" required></select>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="/usuario/perfis" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
        </div>
    
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
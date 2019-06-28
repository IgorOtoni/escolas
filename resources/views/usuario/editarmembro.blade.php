@extends('layouts.usuario.index')
@push('script')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/select2/dist/css/select2.min.css')}}">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">
<!-- InputFilePTBR Confirm Dialog -->
<link href="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Select2 -->
<script src="{{asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputFilePTBR -->
<script src="{{asset('template_adm/bower_components/input.file.js/fileinput.js')}}"></script>
<script src="{{asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')}}"></script>
<!-- InputFilePTBR Confirm Dialog -->
<script src="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>

$(function(){

    $('[data-mask]').inputmask();

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#cep").val("");
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        //$("#ibge").val("");
    }

    $("#cep").keypress(function() {

        var cep = $(this).val().replace(/\D/g, '');
        
        //Preenche os campos com "..." enquanto consulta webservice.
        $("#rua").val("...");
        $("#bairro").val("...");
        $("#cidade").val("...");
        $("#uf").val("...");
        //$("#ibge").val("...");

        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
            
            if (!("erro" in dados)) {
                //Atualiza os campos com os valores da consulta.
                $("#rua").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#uf").val(dados.uf);
                //$("#ibge").val(dados.ibge);
            } //end if.
            else {
                //CEP pesquisado não foi encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        });
    });

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
        initialPreview: [
            <?php if($membro->foto != null){ ?>
                "{{'/storage/membros/'.$membro->foto}}",
            <?php } ?>
        ],
        deleteUrl: "{{'/storage'}}",
        uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php if($membro->foto != null){ ?>
                {caption: "{{$membro->foto}}", extra: {id: {{$membro->id}}, foto: "{{$membro->foto}}", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/membro/excluirFotoMembro", key: 1},
            <?php } ?>
        ],
        //overwriteInitial: false,
        //purifyHtml: true,
    }).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
            $.confirm({
                title: 'Confirmação!',
                content: 'A foto será excluída e <b>não poderá ser recuperada</b>, deseja realmente excluír a foto?',
                type: 'red',
                buttons: {   
                    ok: {
                        btnClass: 'btn-primary text-white',
                        keys: ['enter'],
                        action: function(){
                            resolve();
                        }
                    },
                    cancel: function(){
                        //$.alert('File deletion was aborted! ' + krajeeGetCount('file-6'));
                    }
                }
            });
        });
    });
});

</script>

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar membro
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarMembroFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarMembro')}}" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="id" id="id" value="{{$membro->id}}">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label >Nome</label>
                            <input name="nome" type="text" class="form-control" placeholder="Nome" value="{{$membro->nome}}" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label >Função</label>
                            <select id="funcao" name="funcao" class="form-control select2" style="width: 100%;" required>
                                <option value="0">Sem função</option>
                                <?php $funcoes = App\TblFuncoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                                @foreach ($funcoes as $funcao)
                                <option value="{{$funcao->id}}" {{($membro->id_funcao != null && $membro->id_funcao == $funcao->id) ? "selected" : ""}}>{{$funcao->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >CEP</label>
                            <input id="cep" name="cep" type="text" class="form-control" placeholder="CEP" value="{{$membro->cep}}" data-inputmask='"mask": "99.999-999"' data-mask>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Estado</label>
                            <input id="uf" name="estado" type="text" class="form-control" value="{{$membro->estado}}" placeholder="Estado">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Cidade</label>
                            <input id="cidade" name="cidade" type="text" class="form-control" value="{{$membro->cidade}}" placeholder="Cidade">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Bairro</label>
                            <input id="bairro" name="bairro" type="text" class="form-control" value="{{$membro->bairro}}" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Rua</label>
                            <input id="rua" name="rua" type="text" class="form-control" value="{{$membro->rua}}" placeholder="Rua">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label >Complemento</label>
                            <input name="complemento" type="text" class="form-control" value="{{$membro->complemento}}" placeholder="Complemento">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Número</label>
                            <input name="text" type="number" class="form-control" value="{{$membro->num}}" placeholder="Número">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Telefone</label>
                            <input name="telefone" type="text" class="form-control" placeholder="Telefone" data-inputmask='"mask": "(99) 99999-9999"' value="{{$membro->telefone}}" data-mask>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label >Email</label>
                            <input name="email" type="text" class="form-control" value="{{$membro->email}}" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Foto</label>
                            <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                            <input src="{{'/storage/membros/'.$membro->foto}}" name="foto" type="file" id="input_img">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Descrição</label>
                            <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição">{{$membro->descricao}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Facebook</label>
                            <input name="facebook" type="url" class="form-control" value="{{$membro->facebook}}" placeholder="Facebook">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Youtube</label>
                            <input name="youtube" type="url" class="form-control" value="{{$membro->youtube}}" placeholder="Youtube">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Twitter</label>
                            <input name="twitter" type="url" class="form-control" value="{{$membro->twitter}}" placeholder="Twitter">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="/usuario/membros" class="btn btn-warning pull-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
                </div>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
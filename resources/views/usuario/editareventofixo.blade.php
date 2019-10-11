@extends('layouts.usuario.index')
@push('script')
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">
<!-- InputFilePTBR Confirm Dialog -->
<link href="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')}}" rel="stylesheet" type="text/css" />

<!-- InputFilePTBR -->
<script src="{{asset('template_adm/bower_components/input.file.js/fileinput.js')}}"></script>
<script src="{{asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')}}"></script>
<!-- InputFilePTBR Confirm Dialog -->
<script src="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.js')}}"></script>

<script>

$(function(){
    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
        initialPreview: [
            <?php if($eventofixo->foto != null){ ?>
                "{{'data:image;base64,'.base64_encode($eventofixo->foto)}}",
            <?php } ?>
        ],
        deleteUrl: "{{'/storage'}}",
        uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php if($eventofixo->foto != null){ ?>
                {caption: "{{$eventofixo->foto}}", extra: {id: {{$eventofixo->id}}, foto: "{{$eventofixo->foto}}", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "route('usuario.excluirFotoEventoFixo')", key: 1},
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
        Editar evento fixo
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarEventoFixoFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarEventoFixo')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{$eventofixo->id}}">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" value="{{$eventofixo->nome}}" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                    <label >Data e local</label>
                    <input id="dados_horario_local" name="dados_horario_local" type="text" class="form-control" placeholder="Data e local" value="{{$eventofixo->dados_horario_local}}" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição">{{$eventofixo->descricao}}</textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Foto</label>
                        <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                        <input src="{{'/storage/eventosfixos/'.$eventofixo->foto}}" name="foto" type="file" id="input_img">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
                
            </div>
            <div class="box-footer">
                <a href="{{route('usuario.eventosfixos')}}" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
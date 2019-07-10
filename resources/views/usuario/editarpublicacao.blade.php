@extends('layouts.usuario.index')
@push('script')
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">
<!-- InputFilePTBR Confirm Dialog -->
<link href="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')}}" rel="stylesheet" type="text/css" />

<!-- CKEditor -->
<script src="{{asset('template_adm/bower_components/ckeditor/ckeditor.js')}}"></script>
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
            <?php foreach($fotos as $foto){ ?>
                "{{'/storage/galerias-publicacoes/'.$foto->foto}}",
            <?php } ?>
        ],
        //deleteUrl: "{{'/storage'}}",
        //uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        initialPreviewConfig: [
            <?php $x = 0; foreach($fotos as $foto){ $x++; ?>
                {caption: "{{$foto->foto}}", extra: {id: {{$foto->id}}, foto: "{{$foto->foto}}", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/usuario/excluirFotoPublicacao", key: {{$x}}},
            <?php } ?>
        ],
        overwriteInitial: false,
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

    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    var editor = CKEDITOR.replace('editor', {
        language: 'pt-br',
        //filebrowserBrowseUrl: '/template_adm/bower_components/ckeditor/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/template_adm/bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        //filebrowserWindowWidth: '1000',
        //filebrowserWindowHeight: '700'
    });
    /*CKEDITOR.instances.editor.setData( "{{limpa_html($publicacao->html)}}", function()
    {
        this.checkDirty();  // true
    });*/
    //CKFinder.setupCKEditor( editor );

});

</script>

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar publicação
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarPublicacaoFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarPublicacao')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id" value="{{$publicacao->id}}">
        <div class="box">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input value="{{$publicacao->nome}}" name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Conteúdo da publicação</label>
                        <textarea name="html" id="editor" class="form-control">{{limpa_html($publicacao->html)}}</textarea>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Galeria</label>
                        <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                        <input name="galeria[]" type="file" id="input_img" multiple>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="/usuario/publicacoes" class="btn btn-warning pull-left">Cancelar</a>
                <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
            </div>
        </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
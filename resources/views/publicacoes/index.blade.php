@extends('layouts.admin_site.index')
@push('script')
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">

<!-- CKEditor -->
<script src="{{asset('template_adm/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- CKFinder -->
<script src="{{asset('template_adm/bower_components/ckeditor/ckfinder/ckfinder.js')}}"></script>
<!-- InputFilePTBR -->
<script src="{{asset('template_adm/bower_components/input.file.js/fileinput.js')}}"></script>
<script src="{{asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')}}"></script>
<!-- InputFilePTBR -->
<script src="{{asset('template_adm/bower_components/input.file.js/fileinput.js')}}"></script>
<script src="{{asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')}}"></script>

<script>
$(function () {
    $('#galeria').fileinput({
        language: "pt-BR",
        //minImageCount: 1,
        maxImageCount: 15,
        //uploadUrl: "/file-upload-batch/2",
        
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
    //CKFinder.setupCKEditor( editor );
})
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Publicações
    <small>Lista de todas as publicações</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <div class="pull-right">
        <a class="btn btn-success" data-toggle="modal" data-target="#modal-incluir"><i class="fa fa-plus"></i>&nbspIncluír publicação</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div class="row">
            <div class="col-md-12">
                <table id="tbl_publicacoes" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        Footer
    </div>
    <!-- /.box-footer-->
    </div>
    <!-- /.box -->
</section>
</div>

<div class="modal fade" id="modal-incluir">
<form id="incluirPublicacoesFormulario" data-toggle="validator" method="POST" role="form" action="{{route('publicacoes.incluir')}}" enctype="multipart/form-data">
@csrf
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Incluir publicação</h4>
        </div>
        <div class="modal-body">
        <!-- form start -->
        
            <div class="box-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Conteúdo da publicação</label>
                        <textarea name="html" id="editor" class="form-control"></textarea>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                          <label >Galeria</label>
                          <input name="galeria[]" multiple type="file" id="galeria" required>
                          <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Incluir</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
</div>
<!-- /.modal -->
@endsection
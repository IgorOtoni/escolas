@extends('layouts.admin_site.index')
@push('script')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/select2/dist/css/select2.min.css')}}">
<!-- Treeview -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/treeview/treeview.css')}}">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="{{asset('template_adm/bower_components/input.file.js/fileinput.min.css')}}">
<!-- InputFilePTBR Confirm Dialog -->
<link href="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Select2 -->
<script src="{{asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- InputFilePTBR -->
<script src="{{asset('template_adm/bower_components/input.file.js/fileinput.js')}}"></script>
<script src="{{asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')}}"></script>
<!-- InputFilePTBR Confirm Dialog -->
<script src="{{asset('template_adm/plugins/krajee.confirm/jquery-confirm.min.js')}}"></script>

<script>

$(function(){
    $('[data-mask]').inputmask();

    $('.select2').select2();

    $('input[type=file]').fileinput({
        language: "pt-BR",
        //minImageCount: 0,
        //maxImageCount: 1,
        allowedFileExtensions: ["jpeg", "jpg", "png", "gif"],
        <?php if($igreja->logo != null){ ?>
        initialPreview: [
            "{{'data:image;base64,'.base64_encode($igreja->logo})}",
        ],
        <?php } ?>
        deleteUrl: "{{'/storage'}}",
        uploadExtraData:{'_token':$("#csrf_token").val()},
        initialPreviewAsData: true,
        //initialPreviewFileType: "image",
        <?php if($igreja->logo != null){ ?>
        initialPreviewConfig: [
            {caption: "{{$igreja->logo}}", extra: {id: {{$igreja->id}}, logo: "{{$igreja->logo}}", _token: $("#csrf_token").val()}, size: 215000, width: "120px", url: "/admin/igrejas/excluirLogo", key: 1},
        ],
        <?php } ?>
        //overwriteInitial: false,
        //purifyHtml: true,
    }).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
            $.confirm({
                title: 'Confirmação!',
                content: 'A logo será excluída e <b>não poderá ser recuperada</b>, deseja realmente excluír a logo?',
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

    $('#adicionarMenuFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#adicionarSubMenuFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#adicionarSubSubMenuFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#editarMenuFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#editarSubMenuFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    $('#editarSubSubMenuFormulario').validator({
        update: true,
        ignore: [':disabled', ':hidden', ':not(:visible)'],
        rules: {
        //Rules
        },
        messages: {
        //messages
        }
    });

    // PARA MENUS ===========================================================================
    $("#modal-incluir-menu #modulos_area").css('display', 'none');
    $("#modal-incluir-menu #modulo").attr('data-validate', 'false');

    $("#modal-incluir-menu #publicacoes_area").css('display', 'none');
    $("#modal-incluir-menu #publicacao").attr('data-validate', 'false');

    $("#modal-incluir-menu #eventos_area").css('display', 'none');
    $("#modal-incluir-menu #evento").attr('data-validate', 'false');

    $("#modal-incluir-menu #eventosfixos_area").css('display', 'none');
    $("#modal-incluir-menu #eventofixo").attr('data-validate', 'false');

    $("#modal-incluir-menu #noticias_area").css('display', 'none');
    $("#modal-incluir-menu #noticia").attr('data-validate', 'false');

    $("#modal-incluir-menu #sermoes_area").css('display', 'none');
    $("#modal-incluir-menu #sermao").attr('data-validate', 'false');

    $("#modal-incluir-menu #galerias_area").css('display', 'none');
    $("#modal-incluir-menu #galeria").attr('data-validate', 'false');

    $("#modal-incluir-menu #url_externa_area").css('display', 'none');
    $("#modal-incluir-menu #url").attr('data-validate', 'false');

    $('#adicionarMenuFormulario').validator('update');
    $('#adicionarMenuFormulario').validator('validate');

    $('#modal-incluir-menu #link').on('change', function (event) {
        $("#modal-incluir-menu #modulos_area").css('display', 'none');
        $("#modal-incluir-menu #modulo").attr('data-validate', 'false');

        $("#modal-incluir-menu #publicacoes_area").css('display', 'none');
        $("#modal-incluir-menu #publicacao").attr('data-validate', 'false');

        $("#modal-incluir-menu #eventos_area").css('display', 'none');
        $("#modal-incluir-menu #evento").attr('data-validate', 'false');

        $("#modal-incluir-menu #eventosfixos_area").css('display', 'none');
        $("#modal-incluir-menu #eventofixo").attr('data-validate', 'false');

        $("#modal-incluir-menu #noticias_area").css('display', 'none');
        $("#modal-incluir-menu #noticia").attr('data-validate', 'false');

        $("#modal-incluir-menu #sermoes_area").css('display', 'none');
        $("#modal-incluir-menu #sermao").attr('data-validate', 'false');

        $("#modal-incluir-menu #galerias_area").css('display', 'none');
        $("#modal-incluir-menu #galeria").attr('data-validate', 'false');

        $("#modal-incluir-menu #url_externa_area").css('display', 'none');
        $("#modal-incluir-menu #url").attr('data-validate', 'false');

        op = $("#modal-incluir-menu #link").val();
        if(op == 1){
            $("#modal-incluir-menu #modulos_area").css('display', 'block');
            $("#modal-incluir-menu #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-incluir-menu #publicacoes_area").css('display', 'block');
            $("#modal-incluir-menu #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-incluir-menu #eventos_area").css('display', 'block');
            $("#modal-incluir-menu #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-incluir-menu #eventosfixos_area").css('display', 'block');
            $("#modal-incluir-menu #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-incluir-menu #noticias_area").css('display', 'block');
            $("#modal-incluir-menu #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-incluir-menu #sermoes_area").css('display', 'block');
            $("#modal-incluir-menu #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-incluir-menu #galerias_area").css('display', 'block');
            $("#modal-incluir-menu #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-incluir-menu #url_externa_area").css('display', 'block');
            $("#modal-incluir-menu #url").attr('data-validate', 'true');
        }

        $('#adicionarMenuFormulario').validator('update');
        $('#adicionarMenuFormulario').validator('validate');
    });

    $("#modal-editar-menu #modulos_area").css('display', 'none');
    $("#modal-editar-menu #modulo").attr('data-validate', 'false');

    $("#modal-editar-menu #publicacoes_area").css('display', 'none');
    $("#modal-editar-menu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-menu #eventos_area").css('display', 'none');
    $("#modal-editar-menu #evento").attr('data-validate', 'false');

    $("#modal-editar-menu #eventosfixos_area").css('display', 'none');
    $("#modal-editar-menu #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-menu #noticias_area").css('display', 'none');
    $("#modal-editar-menu #noticia").attr('data-validate', 'false');

    $("#modal-editar-menu #sermoes_area").css('display', 'none');
    $("#modal-editar-menu #sermao").attr('data-validate', 'false');

    $("#modal-editar-menu #galerias_area").css('display', 'none');
    $("#modal-editar-menu #galeria").attr('data-validate', 'false');

    $("#modal-editar-menu #url_externa_area").css('display', 'none');
    $("#modal-editar-menu #url").attr('data-validate', 'false');

    $('#modal-editar-menu #link').on('change', function (event) {
        $("#modal-editar-menu #modulos_area").css('display', 'none');
        $("#modal-editar-menu #modulo").attr('data-validate', 'false');

        $("#modal-editar-menu #publicacoes_area").css('display', 'none');
        $("#modal-editar-menu #publicacao").attr('data-validate', 'false');

        $("#modal-editar-menu #eventos_area").css('display', 'none');
        $("#modal-editar-menu #evento").attr('data-validate', 'false');

        $("#modal-editar-menu #eventosfixos_area").css('display', 'none');
        $("#modal-editar-menu #eventofixo").attr('data-validate', 'false');

        $("#modal-editar-menu #noticias_area").css('display', 'none');
        $("#modal-editar-menu #noticia").attr('data-validate', 'false');

        $("#modal-editar-menu #sermoes_area").css('display', 'none');
        $("#modal-editar-menu #sermao").attr('data-validate', 'false');

        $("#modal-editar-menu #galerias_area").css('display', 'none');
        $("#modal-editar-menu #galeria").attr('data-validate', 'false');

        $("#modal-editar-menu #url_externa_area").css('display', 'none');
        $("#modal-editar-menu #url").attr('data-validate', 'false');

        op = $("#modal-editar-menu #link").val();
        if(op == 1){
            $("#modal-editar-menu #modulos_area").css('display', 'block');
            $("#modal-editar-menu #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-editar-menu #publicacoes_area").css('display', 'block');
            $("#modal-editar-menu #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-editar-menu #eventos_area").css('display', 'block');
            $("#modal-editar-menu #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-editar-menu #eventosfixos_area").css('display', 'block');
            $("#modal-editar-menu #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-editar-menu #noticias_area").css('display', 'block');
            $("#modal-editar-menu #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-editar-menu #sermoes_area").css('display', 'block');
            $("#modal-editar-menu #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-editar-menu #galerias_area").css('display', 'block');
            $("#modal-editar-menu #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-editar-menu #url_externa_area").css('display', 'block');
            $("#modal-editar-menu #url").attr('data-validate', 'true');
        }

        $('#editarMenuFormulario').validator('update');
        $('#editarMenuFormulario').validator('validate');
    });
    /////////////////////////////////////////////////////////////////////////////////////////

    // PARA SUB MENUS =======================================================================
    $("#modal-incluir-submenu #modulos_area").css('display', 'none');
    $("#modal-incluir-submenu #modulo").attr('data-validate', 'false');

    $("#modal-incluir-submenu #publicacoes_area").css('display', 'none');
    $("#modal-incluir-submenu #publicacao").attr('data-validate', 'false');

    $("#modal-incluir-submenu #eventos_area").css('display', 'none');
    $("#modal-incluir-submenu #evento").attr('data-validate', 'false');

    $("#modal-incluir-submenu #eventosfixos_area").css('display', 'none');
    $("#modal-incluir-submenu #eventofixo").attr('data-validate', 'false');

    $("#modal-incluir-submenu #noticias_area").css('display', 'none');
    $("#modal-incluir-submenu #noticia").attr('data-validate', 'false');

    $("#modal-incluir-submenu #sermoes_area").css('display', 'none');
    $("#modal-incluir-submenu #sermao").attr('data-validate', 'false');

    $("#modal-incluir-submenu #galerias_area").css('display', 'none');
    $("#modal-incluir-submenu #galeria").attr('data-validate', 'false');

    $("#modal-incluir-submenu #url_externa_area").css('display', 'none');
    $("#modal-incluir-submenu #url").attr('data-validate', 'false');

    $('#adicionarSubMenuFormulario').validator('update');
    $('#adicionarSubMenuFormulario').validator('validate');

    $('#modal-incluir-submenu #link').on('change', function (event) {
        $("#modal-incluir-submenu #modulos_area").css('display', 'none');
        $("#modal-incluir-submenu #modulo").attr('data-validate', 'false');

        $("#modal-incluir-submenu #publicacoes_area").css('display', 'none');
        $("#modal-incluir-submenu #publicacao").attr('data-validate', 'false');

        $("#modal-incluir-submenu #eventos_area").css('display', 'none');
        $("#modal-incluir-submenu #evento").attr('data-validate', 'false');

        $("#modal-incluir-submenu #eventosfixos_area").css('display', 'none');
        $("#modal-incluir-submenu #eventofixo").attr('data-validate', 'false');

        $("#modal-incluir-submenu #noticias_area").css('display', 'none');
        $("#modal-incluir-submenu #noticia").attr('data-validate', 'false');

        $("#modal-incluir-submenu #sermoes_area").css('display', 'none');
        $("#modal-incluir-submenu #sermao").attr('data-validate', 'false');

        $("#modal-incluir-submenu #galerias_area").css('display', 'none');
        $("#modal-incluir-submenu #galeria").attr('data-validate', 'false');

        $("#modal-incluir-submenu #url_externa_area").css('display', 'none');
        $("#modal-incluir-submenu #url").attr('data-validate', 'false');

        op = $("#modal-incluir-submenu #link").val();
        if(op == 1){
            $("#modal-incluir-submenu #modulos_area").css('display', 'block');
            $("#modal-incluir-submenu #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-incluir-submenu #publicacoes_area").css('display', 'block');
            $("#modal-incluir-submenu #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-incluir-submenu #eventos_area").css('display', 'block');
            $("#modal-incluir-submenu #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-incluir-submenu #eventosfixos_area").css('display', 'block');
            $("#modal-incluir-submenu #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-incluir-submenu #noticias_area").css('display', 'block');
            $("#modal-incluir-submenu #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-incluir-submenu #sermoes_area").css('display', 'block');
            $("#modal-incluir-submenu #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-incluir-submenu #galerias_area").css('display', 'block');
            $("#modal-incluir-submenu #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-incluir-submenu #url_externa_area").css('display', 'block');
            $("#modal-incluir-submenu #url").attr('data-validate', 'true');
        }

        $('#adicionarSubMenuFormulario').validator('update');
        $('#adicionarSubMenuFormulario').validator('validate');
    });

    $("#modal-editar-submenu #modulos_area").css('display', 'none');
    $("#modal-editar-submenu #modulo").attr('data-validate', 'false');

    $("#modal-editar-submenu #publicacoes_area").css('display', 'none');
    $("#modal-editar-submenu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-submenu #eventos_area").css('display', 'none');
    $("#modal-editar-submenu #evento").attr('data-validate', 'false');

    $("#modal-editar-submenu #eventosfixos_area").css('display', 'none');
    $("#modal-editar-submenu #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-submenu #noticias_area").css('display', 'none');
    $("#modal-editar-submenu #noticia").attr('data-validate', 'false');

    $("#modal-editar-submenu #sermoes_area").css('display', 'none');
    $("#modal-editar-submenu #sermao").attr('data-validate', 'false');

    $("#modal-editar-submenu #galerias_area").css('display', 'none');
    $("#modal-editar-submenu #galeria").attr('data-validate', 'false');

    $("#modal-editar-submenu #url_externa_area").css('display', 'none');
    $("#modal-editar-submenu #url").attr('data-validate', 'false');

    $('#modal-editar-submenu #link').on('change', function (event) {
        $("#modal-editar-submenu #modulos_area").css('display', 'none');
        $("#modal-editar-submenu #modulo").attr('data-validate', 'false');

        $("#modal-editar-submenu #publicacoes_area").css('display', 'none');
        $("#modal-editar-submenu #publicacao").attr('data-validate', 'false');

        $("#modal-editar-submenu #eventos_area").css('display', 'none');
        $("#modal-editar-submenu #evento").attr('data-validate', 'false');

        $("#modal-editar-submenu #eventosfixos_area").css('display', 'none');
        $("#modal-editar-submenu #eventofixo").attr('data-validate', 'false');

        $("#modal-editar-submenu #noticias_area").css('display', 'none');
        $("#modal-editar-submenu #noticia").attr('data-validate', 'false');

        $("#modal-editar-submenu #sermoes_area").css('display', 'none');
        $("#modal-editar-submenu #sermao").attr('data-validate', 'false');

        $("#modal-editar-submenu #galerias_area").css('display', 'none');
        $("#modal-editar-submenu #galeria").attr('data-validate', 'false');

        $("#modal-editar-submenu #url_externa_area").css('display', 'none');
        $("#modal-editar-submenu #url").attr('data-validate', 'false');

        op = $("#modal-editar-submenu #link").val();
        if(op == 1){
            $("#modal-editar-submenu #modulos_area").css('display', 'block');
            $("#modal-editar-submenu #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-editar-submenu #publicacoes_area").css('display', 'block');
            $("#modal-editar-submenu #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-editar-submenu #eventos_area").css('display', 'block');
            $("#modal-editar-submenu #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-editar-submenu #eventosfixos_area").css('display', 'block');
            $("#modal-editar-submenu #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-editar-submenu #noticias_area").css('display', 'block');
            $("#modal-editar-submenu #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-editar-submenu #sermoes_area").css('display', 'block');
            $("#modal-editar-submenu #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-editar-submenu #galerias_area").css('display', 'block');
            $("#modal-editar-submenu #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-editar-submenu #url_externa_area").css('display', 'block');
            $("#modal-editar-submenu #url").attr('data-validate', 'true');
        }

        $('#editarSubMenuFormulario').validator('update');
        $('#editarSubMenuFormulario').validator('validate');
    });
    /////////////////////////////////////////////////////////////////////////////////////////

    // PARA SUB SUB MENUS =======================================================================
    $("#modal-incluir-subsubmenu #modulos_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #modulo").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #publicacoes_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #publicacao").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #eventos_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #evento").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #eventosfixos_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #eventofixo").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #noticias_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #noticia").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #sermoes_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #sermao").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #galerias_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #galeria").attr('data-validate', 'false');

    $("#modal-incluir-subsubmenu #url_externa_area").css('display', 'none');
    $("#modal-incluir-subsubmenu #url").attr('data-validate', 'false');

    $('#adicionarSubSubMenuFormulario').validator('update');
    $('#adicionarSubSubMenuFormulario').validator('validate');

    $('#modal-incluir-subsubmenu #link').on('change', function (event) {
        $("#modal-incluir-subsubmenu #modulos_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #modulo").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #publicacoes_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #publicacao").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #eventos_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #evento").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #eventosfixos_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #eventofixo").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #noticias_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #noticia").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #sermoes_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #sermao").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #galerias_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #galeria").attr('data-validate', 'false');

        $("#modal-incluir-subsubmenu #url_externa_area").css('display', 'none');
        $("#modal-incluir-subsubmenu #url").attr('data-validate', 'false');

        op = $("#modal-incluir-subsubmenu #link").val();
        if(op == 1){
            $("#modal-incluir-subsubmenu #modulos_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-incluir-subsubmenu #publicacoes_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-incluir-subsubmenu #eventos_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-incluir-subsubmenu #eventosfixos_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-incluir-subsubmenu #noticias_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-incluir-subsubmenu #sermoes_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-incluir-subsubmenu #galerias_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-incluir-subsubmenu #url_externa_area").css('display', 'block');
            $("#modal-incluir-subsubmenu #url").attr('data-validate', 'true');
        }

        $('#adicionarSubSubMenuFormulario').validator('update');
        $('#adicionarSubSubMenuFormulario').validator('validate');
    });

    $("#modal-editar-subsubmenu #modulos_area").css('display', 'none');
    $("#modal-editar-subsubmenu #modulo").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #publicacoes_area").css('display', 'none');
    $("#modal-editar-subsubmenu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #eventos_area").css('display', 'none');
    $("#modal-editar-subsubmenu #evento").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #eventosfixos_area").css('display', 'none');
    $("#modal-editar-subsubmenu #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #noticias_area").css('display', 'none');
    $("#modal-editar-subsubmenu #noticia").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #sermoes_area").css('display', 'none');
    $("#modal-editar-subsubmenu #sermao").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #galerias_area").css('display', 'none');
    $("#modal-editar-subsubmenu #galeria").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #url_externa_area").css('display', 'none');
    $("#modal-editar-subsubmenu #url").attr('data-validate', 'false');

    $('#adicionarSubSubMenuFormulario').validator('update');
    $('#adicionarSubSubMenuFormulario').validator('validate');

    $('#modal-editar-subsubmenu #link').on('change', function (event) {
        $("#modal-editar-subsubmenu #modulos_area").css('display', 'none');
        $("#modal-editar-subsubmenu #modulo").attr('data-validate', 'false');

        $("#modal-editar-subsubmenu #publicacoes_area").css('display', 'none');
        $("#modal-editar-subsubmenu #publicacao").attr('data-validate', 'false');

        $("#modal-editar-subsubmenu #eventos_area").css('display', 'none');
        $("#modal-editar-subsubmenu #evento").attr('data-validate', 'false');

        $("#modal-editar-subsubmenu #eventosfixos_area").css('display', 'none');
        $("#modal-editar-subsubmenu #eventofixo").attr('data-validate', 'false');

        $("#modal-editar-subsubmenu #noticias_area").css('display', 'none');
        $("#modal-editar-subsubmenu #noticia").attr('data-validate', 'false');

        $("#modal-editar-subsubmenu #sermoes_area").css('display', 'none');
        $("#modal-editar-subsubmenu #sermao").attr('data-validate', 'false');

        $("#modal-editar-subsubmenu #galerias_area").css('display', 'none');
        $("#modal-editar-subsubmenu #galeria").attr('data-validate', 'false');
        
        $("#modal-editar-subsubmenu #url_externa_area").css('display', 'none');
        $("#modal-editar-subsubmenu #url").attr('data-validate', 'false');

        op = $("#modal-editar-subsubmenu #link").val();
        if(op == 1){
            $("#modal-editar-subsubmenu #modulos_area").css('display', 'block');
            $("#modal-editar-subsubmenu #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-editar-subsubmenu #publicacoes_area").css('display', 'block');
            $("#modal-editar-subsubmenu #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-editar-subsubmenu #eventos_area").css('display', 'block');
            $("#modal-editar-subsubmenu #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-editar-subsubmenu #eventosfixos_area").css('display', 'block');
            $("#modal-editar-subsubmenu #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-editar-subsubmenu #noticias_area").css('display', 'block');
            $("#modal-editar-subsubmenu #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-editar-subsubmenu #sermoes_area").css('display', 'block');
            $("#modal-editar-subsubmenu #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-editar-subsubmenu #galerias_area").css('display', 'block');
            $("#modal-editar-subsubmenu #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-editar-subsubmenu #url_externa_area").css('display', 'block');
            $("#modal-editar-subsubmenu #url").attr('data-validate', 'true');
        }

        $('#adicionarSubSubMenuFormulario').validator('update');
        $('#adicionarSubSubMenuFormulario').validator('validate');
    });

    // PARA MENUS APLICATIVO ===========================================================================
    $("#modal-incluir-menu-aplicativo #publicacoes_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #publicacao").attr('data-validate', 'false');

    $("#modal-incluir-menu-aplicativo #eventos_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #evento").attr('data-validate', 'false');

    $("#modal-incluir-menu-aplicativo #eventosfixos_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #eventofixo").attr('data-validate', 'false');

    $("#modal-incluir-menu-aplicativo #noticias_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #noticia").attr('data-validate', 'false');

    $("#modal-incluir-menu-aplicativo #sermoes_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #sermao").attr('data-validate', 'false');

    $("#modal-incluir-menu-aplicativo #galerias_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #galeria").attr('data-validate', 'false');

    $("#modal-incluir-menu-aplicativo #url_externa_area").css('display', 'none');
    $("#modal-incluir-menu-aplicativo #url").attr('data-validate', 'false');

    $('#adicionarMenuAplicativoFormulario').validator('update');
    $('#adicionarMenuAplicativoFormulario').validator('validate');

    $('#modal-incluir-menu-aplicativo #link').on('change', function (event) {
        $("#modal-incluir-menu-aplicativo #modulos_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #modulo").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #publicacoes_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #publicacao").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #eventos_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #evento").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #eventosfixos_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #eventofixo").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #noticias_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #noticia").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #sermoes_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #sermao").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #galerias_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #galeria").attr('data-validate', 'false');

        $("#modal-incluir-menu-aplicativo #url_externa_area").css('display', 'none');
        $("#modal-incluir-menu-aplicativo #url").attr('data-validate', 'false');

        op = $("#modal-incluir-menu-aplicativo #link").val();
        if(op == 1){
            $("#modal-incluir-menu-aplicativo #modulos_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-incluir-menu-aplicativo #publicacoes_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-incluir-menu-aplicativo #eventos_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-incluir-menu-aplicativo #eventosfixos_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-incluir-menu-aplicativo #noticias_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-incluir-menu-aplicativo #sermoes_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-incluir-menu-aplicativo #galerias_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-incluir-menu-aplicativo #url_externa_area").css('display', 'block');
            $("#modal-incluir-menu-aplicativo #url").attr('data-validate', 'true');
        }

        $('#adicionarMenuAplicativoFormulario').validator('update');
        $('#adicionarMenuAplicativoFormulario').validator('validate');
    });

    $("#modal-editar-menu-aplicativo #publicacoes_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #publicacao").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #eventos_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #evento").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #eventosfixos_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #noticias_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #noticia").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #sermoes_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #sermao").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #galerias_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #galeria").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #url_externa_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #url").attr('data-validate', 'false');

    $('#modal-editar-menu-aplicativo #link').on('change', function (event) {
        $("#modal-editar-menu-aplicativo #modulos_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #modulo").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #publicacoes_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #publicacao").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #eventos_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #evento").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #eventosfixos_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #eventofixo").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #noticias_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #noticia").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #sermoes_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #sermao").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #galerias_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #galeria").attr('data-validate', 'false');

        $("#modal-editar-menu-aplicativo #url_externa_area").css('display', 'none');
        $("#modal-editar-menu-aplicativo #url").attr('data-validate', 'false');

        op = $("#modal-editar-menu-aplicativo #link").val();
        if(op == 1){
            $("#modal-editar-menu-aplicativo #modulos_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #modulo").attr('data-validate', 'true');
        }else if(op == 2){
            $("#modal-editar-menu-aplicativo #publicacoes_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #publicacao").attr('data-validate', 'true');
        }else if(op == 3){
            $("#modal-editar-menu-aplicativo #eventos_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #evento").attr('data-validate', 'true');
        }else if(op == 4){
            $("#modal-editar-menu-aplicativo #eventosfixos_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #eventofixo").attr('data-validate', 'true');
        }else if(op == 5){
            $("#modal-editar-menu-aplicativo #noticias_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #noticia").attr('data-validate', 'true');
        }else if(op == 6){
            $("#modal-editar-menu-aplicativo #sermoes_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #sermao").attr('data-validate', 'true');
        }else if(op == 7){
            $("#modal-editar-menu-aplicativo #galerias_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #galeria").attr('data-validate', 'true');
        }else if(op == 8){
            $("#modal-editar-menu-aplicativo #url_externa_area").css('display', 'block');
            $("#modal-editar-menu-aplicativo #url").attr('data-validate', 'true');
        }

        $('#editarMenuAplicativoFormulario').validator('update');
        $('#editarMenuAplicativoFormulario').validator('validate');
    });
    /////////////////////////////////////////////////////////////////////////////////////////
});

// MODAL INCLUIR SUB MENU ===================================================================
$('#modal-incluir-submenu').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('#id_menu').val(null);
});

$('#modal-incluir-submenu').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('idmenu');

    var modal = $(this);

    if(id != null) modal.find('#id_menu').val(id);
});
/////////////////////////////////////////////////////////////////////////////////////////////

// MODAL INCLUIR SUB SUB MENU ===================================================================
$('#modal-incluir-subsubmenu').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('#id_submenu').val(null);
});

$('#modal-incluir-subsubmenu').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('idsubmenu');

    var modal = $(this);

    if(id != null) modal.find('#id_submenu').val(id);
});
/////////////////////////////////////////////////////////////////////////////////////////////

// MODAL EDITAR MENU ===================================================================
$('#modal-editar-menu').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('#id').val(null);

    $("#modal-editar-menu #link").val(0);

    $("#modal-editar-menu #modulos_area").css('display', 'none');
    $("#modal-editar-menu #modulo").attr('data-validate', 'false');

    $("#modal-editar-menu #publicacoes_area").css('display', 'none');
    $("#modal-editar-menu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-menu #noticias_area").css('display', 'none');
    $("#modal-editar-menu #noticia").attr('data-validate', 'false');

    $("#modal-editar-menu #eventos_area").css('display', 'none');
    $("#modal-editar-menu #evento").attr('data-validate', 'false');

    $("#modal-editar-menu #eventosfixos_area").css('display', 'none');
    $("#modal-editar-menu #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-menu #publicacoes_area").css('display', 'none');
    $("#modal-editar-menu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-menu #sermoes_area").css('display', 'none');
    $("#modal-editar-menu #sermao").attr('data-validate', 'false');

    $("#modal-editar-menu #url_externa_area").css('display', 'none');
    $("#modal-editar-menu #url").attr('data-validate', 'false');
});

$('#modal-editar-menu').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('id');
    var nome = button.data('nome');
    var link = button.data('link');
    var ordem = button.data('ordem');

    var modal = $(this);

    if(id != null) modal.find('#id').val(id);
    if(nome != null) modal.find('#nome').val(nome);
    if(link != null) modal.find('#link_atual').val(link);
    if(ordem != null) modal.find('#ordem').val(ordem);

    $('#editarMenuFormulario').validator('update');
    $('#editarMenuFormulario').validator('validate');
});
/////////////////////////////////////////////////////////////////////////////////////////////

// MODAL EDITAR SUB MENU ===================================================================
$('#modal-editar-submenu').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('#id').val(null);
    modal.find('#link').val(0);
    modal.find('#nome').val(null);
    modal.find('#ordem').val(null);
    modal.find('#nome').val(null);

    $("#modal-editar-submenu #modulos_area").css('display', 'none');
    $("#modal-editar-submenu #modulo").attr('data-validate', 'false');

    $("#modal-editar-submenu #publicacoes_area").css('display', 'none');
    $("#modal-editar-submenu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-submenu #noticias_area").css('display', 'none');
    $("#modal-editar-submenu #noticia").attr('data-validate', 'false');

    $("#modal-editar-submenu #eventos_area").css('display', 'none');
    $("#modal-editar-submenu #evento").attr('data-validate', 'false');

    $("#modal-editar-submenu #eventosfixos_area").css('display', 'none');
    $("#modal-editar-submenu #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-submenu #galerias_area").css('display', 'none');
    $("#modal-editar-submenu #galeria").attr('data-validate', 'false');

    $("#modal-editar-submenu #sermoes_area").css('display', 'none');
    $("#modal-editar-submenu #sermao").attr('data-validate', 'false');

    $("#modal-editar-submenu #url_externa_area").css('display', 'none');
    $("#modal-editar-submenu #url").attr('data-validate', 'false');
});

$('#modal-editar-submenu').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('id');
    var nome = button.data('nome');
    var link = button.data('link');
    var ordem = button.data('ordem');
    var id_menu = button.data('idmenu');

    var modal = $(this);

    if(id != null) modal.find('#id').val(id);
    if(nome != null) modal.find('#nome').val(nome);
    if(link != null) modal.find('#link_atual').val(link);
    if(ordem != null) modal.find('#ordem').val(ordem);
    if(id_menu != null) modal.find('#id_menu').val(id_menu);

    $('#editarSubMenuFormulario').validator('update');
    $('#editarSubMenuFormulario').validator('validate');
});
/////////////////////////////////////////////////////////////////////////////////////////////

// MODAL EDITAR SUB SUB MENU ===================================================================
$('#modal-editar-subsubmenu').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('#id').val(null);
    modal.find('#link').val(1);
    modal.find('#nome').val(null);
    modal.find('#ordem').val(null);
    modal.find('#nome').val(null);

    $("#modal-editar-subsubmenu #modulos_area").css('display', 'none');
    $("#modal-editar-subsubmenu #modulo").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #publicacoes_area").css('display', 'none');
    $("#modal-editar-subsubmenu #publicacao").attr('data-validate', 'false');

    $("#modal-editar-subsubmenu #noticias_area").css('display', 'none');
    $("#modal-editar-subsubmenu #noticia").attr('data-validate', 'false');
    
    $("#modal-editar-subsubmenu #eventos_area").css('display', 'none');
    $("#modal-editar-subsubmenu #evento").attr('data-validate', 'false');
    
    $("#modal-editar-subsubmenu #eventosfixos_area").css('display', 'none');
    $("#modal-editar-subsubmenu #eventofixo").attr('data-validate', 'false');
    
    $("#modal-editar-subsubmenu #galerias_area").css('display', 'none');
    $("#modal-editar-subsubmenu #galeria").attr('data-validate', 'false');
    
    $("#modal-editar-subsubmenu #sermoes_area").css('display', 'none');
    $("#modal-editar-subsubmenu #sermao").attr('data-validate', 'false');
    
    $("#modal-editar-subsubmenu #url_externa_area").css('display', 'none');
    $("#modal-editar-subsubmenu #url").attr('data-validate', 'false');
});

$('#modal-editar-subsubmenu').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('id');
    var nome = button.data('nome');
    var link = button.data('link');
    var ordem = button.data('ordem');
    var id_submenu = button.data('idsubmenu');

    var modal = $(this);

    if(id != null) modal.find('#id').val(id);
    if(nome != null) modal.find('#nome').val(nome);
    if(link != null) modal.find('#link_atual').val(link);
    if(ordem != null) modal.find('#ordem').val(ordem);
    if(id_submenu != null) modal.find('#id_submenu').val(id_submenu);

    $('#editarSubSubMenuFormulario').validator('update');
    $('#editarSubSubMenuFormulario').validator('validate');
});
/////////////////////////////////////////////////////////////////////////////////////////////

// MODAL EDITAR MENU APLICATIVO ===================================================================
$('#modal-editar-menu-aplicativo').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('#id').val(null);

    $("#modal-editar-menu-aplicativo #link").val(1);

    $("#modal-editar-menu-aplicativo #modulos_area").css('display', 'block');
    $("#modal-editar-menu-aplicativo #modulo").attr('data-validate', 'true');

    $("#modal-editar-menu-aplicativo #publicacoes_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #publicacao").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #noticias_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #noticia").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #eventos_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #evento").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #eventosfixos_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #eventofixo").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #galerias_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #galeria").attr('data-validate', 'false');

    $("#modal-editar-menu-aplicativo #sermoes_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #sermao").attr('data-validate', 'false');
    
    $("#modal-editar-menu-aplicativo #url_externa_area").css('display', 'none');
    $("#modal-editar-menu-aplicativo #url").attr('data-validate', 'false');
});

$('#modal-editar-menu-aplicativo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('id');
    var nome = button.data('nome');
    var link = button.data('link');
    var ordem = button.data('ordem');

    var modal = $(this);

    if(id != null) modal.find('#id').val(id);
    if(nome != null) modal.find('#nome').val(nome);
    if(link != null) modal.find('#link_atual').val(link);
    if(ordem != null) modal.find('#ordem').val(ordem);

    $('#editarMenuAplicativoFormulario').validator('update');
    $('#editarMenuAplicativoFormulario').validator('validate');
});
/////////////////////////////////////////////////////////////////////////////////////////////

</script>

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Configuração do site da escola
    <!--<small>it all starts here</small>-->
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <form id="editarConfiguracoesIgrejaFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.salvarConfiguracoes')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$igreja->id_configuracao}}">
    <div class="box">
        <div class="box-body">

        <div class="row">
        <div class="col-md-12">
            <div class="form-group has-feedback">
                <label >Nome</label>
                <input name="nome" type="text" class="form-control" placeholder="Nome" value="{{$igreja->nome}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >CEP</label>
                <input id="cep" name="cep" type="text" class="form-control" placeholder="CEP" data-inputmask='"mask": "99.999-999"' value="{{$igreja->cep}}" data-mask required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >Estado</label>
                <input id="uf" name="estado" type="text" class="form-control" placeholder="Estado" value="{{$igreja->estado}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >Cidade</label>
                <input id="cidade" name="cidade" type="text" class="form-control" placeholder="Cidade" value="{{$igreja->cidade}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >Bairro</label>
                <input id="bairro" name="bairro" type="text" class="form-control" placeholder="Bairro" value="{{$igreja->bairro}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >Rua</label>
                <input id="rua" name="rua" type="text" class="form-control" placeholder="Rua" value="{{$igreja->rua}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label >Complemento</label>
                <input name="complemento" type="text" class="form-control" placeholder="Complemento" value="{{$igreja->complemento}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >Número</label>
                <input name="num" type="number" class="form-control" placeholder="Número" value="{{$igreja->num}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-feedback">
                <label >Telefone</label>
                <input name="telefone" type="text" class="form-control" placeholder="Telefone" data-inputmask='"mask": "(99) 99999-9999"' data-mask value="{{$igreja->telefone}}">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group has-feedback">
                <label >Email</label>
                <input name="email" type="text" class="form-control" placeholder="Email" value="{{$igreja->email}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        </div>
        
        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label >Logo</label>
                <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">
                <input name="logo" type="file" id="input_img" multiple>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url</label>
                <input name="url" type="text" class="form-control" placeholder="Url" value="{{$igreja->url}}" required disabled>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
            <div class="form-group has-feedback">
                <label >Template</label>
                <select id="id_template" name="id_template" class="form-control select2" style="width: 100%;" required>
                    <?php $templates = App\TblTemplates::orderBy('nome','ASC')->get(); ?>
                    @foreach ($templates as $template)
                    <option value="{{$template->id}}" {{($template->id == $igreja->id_template) ? 'selected' : ''}}>{{$template->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Cor</label>
                <input name="cor" type="text" class="form-control" placeholder="Cor" value="{{$igreja->cor}}" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Arquivo CSS personalizado:</label>
                <input type="file" name="custom_style">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Texto da congregação sobre suas missões e valores</label>
                <textarea name="texto_apresentativo" class="form-control" rows="10" required>{{$igreja->texto_apresentativo}}</textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
        </div>
    </div>

    </form>

    <div class="box">
        <div class="box-body">

            <div class="row">
            <div class="col-md-12">
                <h4>Termo de compromisso:</h4> <a href="/gerar_termo_compromisso/{{$igreja->id}}" class="btn btn-primary" target="_blank">Gerar</a>
            </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label >Hierarquia de menus</label>
                <div id="tree" class="tree">
                    <ul>
                        <li>
                            <div><span><i class="icon-folder-open"></i> Raíz</span>
                                <div class="pull-right">
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-incluir-menu"><i class="fa fa-plus"></i> Menu</a> 
                                </div>
                            </div>
                            <ul>
                                <?php foreach($menus as $menu){ ?>
                                    <li>
                                        <div><span><i class="icon-folder-open"></i> {{$menu->ordem}} - {{$menu->nome}}</span> 
                                            <?php echo ($menu->link != null) ? '<a target="_blank" href="/'.$igreja->url.'/'.$menu->link.'"><span class="bg-blue">Possui link</span></a>' : '<span class="bg-gray">Não possui link</span>' ?>
                                            <div class="pull-right">
                                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-incluir-submenu" data-idmenu="{{$menu->id}}"><i class="fa fa-plus"></i> Submenu</a>
                                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-editar-menu" data-id="{{$menu->id}}" data-nome="{{$menu->nome}}" data-link="{{$menu->link}}" data-ordem="{{$menu->ordem}}"><i class="fa fa-edit"></i> Menu</a>
                                                <a class="btn btn-danger btn-sm" href="/usuario/igrejas/excluirMenu/{{$menu->id}}"><i class="fa fa-trash"></i> Menu</a>
                                            </div>
                                        </div>
                                        <ul>
                                            <?php if(isset($submenus[$menu->id])) foreach($submenus[$menu->id] as $submenu){ ?>
                                                <li>
                                                    <div><span><i class="icon-minus-sign"></i> {{$submenu->ordem}} - {{$submenu->nome}}</span>
                                                        <?php echo ($submenu->link != null) ? '<a target="_blank" href="/'.$igreja->url.'/'.$submenu->link.'"><span class="bg-blue">Possui link</span></a>' : '<span class="bg-gray">Não possui link</span>' ?>
                                                        <div class="pull-right">
                                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-incluir-subsubmenu" data-idsubmenu="{{$submenu->id}}"><i class="fa fa-plus"></i> Sub-Submenu</a>
                                                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-editar-submenu" data-id="{{$submenu->id}}" data-nome="{{$submenu->nome}}" data-link="{{$submenu->link}}" data-ordem="{{$submenu->ordem}}" data-idmenu="{{$submenu->id_menu}}"><i class="fa fa-edit"></i> Submenu</a>
                                                            <a class="btn btn-danger btn-sm" href="/usuario/igrejas/excluirSubMenu/{{$submenu->id}}"><i class="fa fa-trash"></i> Submenu</a>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <?php if(isset($subsubmenus[$submenu->id])) foreach($subsubmenus[$submenu->id] as $subsubmenu){ ?>
                                                            <li>
                                                                <div><span><i class="icon-leaf"></i> {{$subsubmenu->ordem}} - {{$subsubmenu->nome}}</span> 
                                                                    <?php echo ($subsubmenu->link != null) ? '<a target="_blank" href="/'.$igreja->url.'/'.$subsubmenu->link.'"><span class="bg-blue">Possui link</span></a>' : '<span class="bg-gray">Não possui link</span>' ?>
                                                                    <div class="pull-right">
                                                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-editar-subsubmenu" data-id="{{$subsubmenu->id}}" data-nome="{{$subsubmenu->nome}}" data-link="{{$subsubmenu->link}}" data-ordem="{{$subsubmenu->ordem}}" data-idsubmenu="{{$subsubmenu->id_submenu}}"><i class="fa fa-edit"></i> Sub-Submenu</a> 
                                                                        <a class="btn btn-danger btn-sm" href="/usuario/igrejas/excluirSubSubMenu/{{$subsubmenu->id}}"><i class="fa fa-trash"></i> Sub-Submenu</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label >Hierarquia de menus do aplicativo</label>
                <div id="tree" class="tree">
                    <ul>
                        <li>
                            <div><span><i class="icon-folder-open"></i> Raíz</span>
                                <div class="pull-right">
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-incluir-menu-aplicativo"><i class="fa fa-plus"></i> Menu</a> 
                                </div>
                            </div>
                            <ul>
                                <?php foreach($menus_aplicativo as $menu){ ?>
                                    <li>
                                        <div><span><i class="icon-folder-open"></i> {{$menu->ordem}} - {{$menu->nome}}</span> 
                                            <?php 
                                                $pos = strpos($menu->link, "http");
                                                if($pos === false){
                                                    if(false !== strpos($menu->link, "modulo")){
                                                        echo ($menu->link != null) ? '<a target="_blank" href="/'.$igreja->url.'/'.str_replace("modulo-","",$menu->link).'"><span class="bg-blue">Possui link</span></a>' : '<span class="bg-gray">Não possui link</span>';
                                                    }else echo ($menu->link != null) ? '<a target="_blank" href="/'.$igreja->url.'/'.str_replace("-","/",$menu->link).'"><span class="bg-blue">Possui link</span></a>' : '<span class="bg-gray">Não possui link</span>';
                                                }else{
                                                    echo '<a target="_blank" href="'.$menu->link.'"><span class="bg-blue">Possui link</span></a>';
                                                } ?>
                                            <div class="pull-right">
                                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-editar-menu-aplicativo" data-id="{{$menu->id}}" data-nome="{{$menu->nome}}" data-link="{{$menu->link}}" data-ordem="{{$menu->ordem}}"><i class="fa fa-edit"></i> Menu</a>
                                                <a class="btn btn-danger btn-sm" href="/usuario/igrejas/excluirMenuAplicativo/{{$menu->id}}"><i class="fa fa-trash"></i> Menu</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modals -->
<!-- Adicionar Menu -->
<div class="modal fade" id="modal-incluir-menu">
<form id="adicionarMenuFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.adicionarMenu')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id_configuracao" value="{{$igreja->id_configuracao}}">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Novo menu</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="0" selected>Sem link</option>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícias</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- Adicionar Sub Menu -->
<div class="modal fade" id="modal-incluir-submenu">
<form id="adicionarSubMenuFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.adicionarSubMenu')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id_menu" id="id_menu">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Novo Submenu</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="0" selected>Sem link</option>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícias</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- Adicionar Sub Sub Menu -->
<div class="modal fade" id="modal-incluir-subsubmenu">
<form id="adicionarSubSubMenuFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.adicionarSubSubMenu')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id_submenu" id="id_submenu">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Novo Sub-Submenu</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="0" selected>Sem link</option>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícias</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- Editar Menu -->
<div class="modal fade" id="modal-editar-menu">
<form id="editarMenuFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.editarMenu')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar menu</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Link atual</label>
                <input id="link_atual" type="text" class="form-control" placeholder="Link atual" disabled>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="0" selected>Sem link</option>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícia</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- Editar Sub Menu -->
<div class="modal fade" id="modal-editar-submenu">
<form id="editarSubMenuFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.editarSubMenu')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Submenu</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Menu pertencente</label>
                <select id="id_menu" name="id_menu" class="form-control select2" style="width: 100%;" required>
                    @foreach ($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Link atual</label>
                <input id="link_atual" type="text" class="form-control" placeholder="Link atual" disabled>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="0" selected>Sem link</option>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícias</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- Editar Sub Sub Menu -->
<div class="modal fade" id="modal-editar-subsubmenu">
<form id="editarSubSubMenuFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.editarSubMenu')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Sub-Submenu</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Submenu pertencente</label>
                <select id="id_submenu" name="id_menu" class="form-control select2" style="width: 100%;" required>
                    <?php
                    $submenus = \DB::table('tbl_sub_menus')
                        ->select('tbl_sub_menus.*', 'tbl_menus.nome as menu')
                        ->leftJoin('tbl_menus', 'tbl_sub_menus.id_menu', '=', 'tbl_menus.id')
                        ->where('tbl_menus.id_configuracao','=',$igreja->id_configuracao)
                        ->orderBy('tbl_sub_menus.nome', 'ASC')
                        ->get();
                    ?>
                    @foreach ($submenus as $submenu)
                        <option value="{{$submenu->id}}">{{$submenu->nome}} - {{$submenu->menu}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Link atual</label>
                <input id="link_atual" type="text" class="form-control" placeholder="Link atual" disabled>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="0" selected>Sem link</option>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícias</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- MODAIS DOS MENUS DO APLICATIVO =========================================================== -->

<!-- modals -->
<!-- Adicionar Menu Aplicativo -->
<div class="modal fade" id="modal-incluir-menu-aplicativo">
<form id="adicionarMenuAplicativoFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.adicionarMenuAplicativo')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id_configuracao" value="{{$igreja->id_configuracao}}">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Novo menu no aplicativo</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícias</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- Editar Menu Aplicativo -->
<div class="modal fade" id="modal-editar-menu-aplicativo">
<form id="editarMenuAplicativoFormulario" data-toggle="validator" method="POST" role="form" action="{{route('igrejas.editarMenuAplicativo')}}" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar menu do aplicativo</h4>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Nome</label>
                <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                <label >Ordem</label>
                <input id="ordem" name="ordem" type="number" min="1" class="form-control" placeholder="Ordem" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label >Link atual</label>
                <input id="link_atual" type="text" class="form-control" placeholder="Link atual" disabled>
                </div>
            </div>
            <div id="link_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Tipo de link</label>
                <select id="link" name="link" class="form-control select2" style="width: 100%;" required>
                    <option value="1">Link para módulo do sistema</option>
                    <option value="2">Link para publicação</option>
                    <option value="3">Link para evento</option>
                    <option value="4">Link para evento fixo</option>
                    <option value="5">Link para notícia</option>
                    <option value="6">Link para sermão</option>
                    <option value="7">Link para galeria</option>
                    <option value="8">Link externo</option>
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="modulos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Módulos</label>
                <select id="modulo" name="modulo" class="form-control select2" style="width: 100%;" required>
                    @foreach ($modulos_igreja as $modulo)
                        @if (!$modulo->gerencial)
                            <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="publicacoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Publicações</label>
                <select id="publicacao" name="publicacao" class="form-control select2" style="width: 100%;" required>
                    <?php $publicacoes = App\TblPublicacoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{$publicacao->id}}">{{$publicacao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos</label>
                <select id="evento" name="evento" class="form-control select2" style="width: 100%;" required>
                    <?php $eventos = App\TblEventos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventos as $evento)
                        <option value="{{$evento->id}}">{{$evento->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="eventosfixos_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Eventos fixos</label>
                <select id="eventofixo" name="eventofixo" class="form-control select2" style="width: 100%;" required>
                    <?php $eventosfixos = App\TblEventosFixos::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($eventosfixos as $eventofixo)
                        <option value="{{$eventofixo->id}}">{{$eventofixo->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="noticias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Notícia</label>
                <select id="noticia" name="noticia" class="form-control select2" style="width: 100%;" required>
                    <?php $noticias = App\TblNoticias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($noticias as $noticia)
                        <option value="{{$noticia->id}}">{{$noticia->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="sermoes_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Sermões</label>
                <select id="sermao" name="sermao" class="form-control select2" style="width: 100%;" required>
                    <?php $sermoes = App\TblSermoes::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($sermoes as $sermao)
                        <option value="{{$sermao->id}}">{{$sermao->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="galerias_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Galerias</label>
                <select id="galeria" name="galeria" class="form-control select2" style="width: 100%;" required>
                    <?php $galerias = App\TblGalerias::where('id_igreja','=',$igreja->id)->orderBy('nome','ASC')->get(); ?>
                    @foreach ($galerias as $galeria)
                        <option value="{{$galeria->id}}">{{$galeria->nome}}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="url_externa_area" class="col-md-12">
                <div class="form-group has-feedback">
                <label >Url externa</label>
                <input id="url" name="url" type="text" class="form-control" placeholder="Url externa" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
        </div>
    </div>
    </div>
</form>
</div>

<!-- end modals -->
@endsection
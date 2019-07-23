<?php /* C:\xampp\htdocs\adm_eglise\resources\views\eglise\formulario.blade.php */ ?>
<?php $__env->startPush('script'); ?>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/select2/dist/css/select2.min.css')); ?>">
<!-- InputFilePTBR -->
<link rel="stylesheet" href="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.min.css')); ?>">
<!-- lightgallery -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('template_adm/plugins/lightgallery/css/lightGallery.css')); ?>" /> 

<!-- lightgallery -->
<script src="<?php echo e(asset('template_adm/plugins/lightgallery/js/lightgallery.min.js')); ?>"></script>
<!-- lightgallery zoom -->
<script src="<?php echo e(asset('template_adm/plugins/lightgallery/js/lg-zoom.js')); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".lightgallery").lightGallery(); 
    });
</script>

<style>
/* Latest compiled and minified CSS included as External Resource*/

/* Optional theme */

/*@import  url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/
#form_abas {
    margin-top:30px;
}
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
</style>

<!-- Select2 -->
<script src="<?php echo e(asset('template_adm/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- InputMask -->
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
<!-- InputFilePTBR -->
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/fileinput.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/input.file.js/locales/pt-BR.js')); ?>"></script>

<script>
$(document).ready(function () {

$('.select2').select2();

$('[data-mask]').inputmask();

$('input[type=file]').fileinput({
    language: "pt-BR",
    //minImageCount: 1,
    //maxImageCount: 1,
    //uploadUrl: "/file-upload-batch/2",
    allowedFileExtensions: ["jpg", "png", "gif"]
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

var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
    e.preventDefault();
    var $target = $($(this).attr('href')),
        $item = $(this);

    if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-success').addClass('btn-default');
        $item.addClass('btn-success');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
    }
});

allNextBtn.click(function () {
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input"),
        isValid = true;

    $(".form-group").removeClass("has-error");
    for (var i = 0; i < curInputs.length; i++) {
        if (!curInputs[i].validity.valid) {
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }

    if (isValid) nextStepWizard.removeClass('disabled').removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-success').trigger('click');

});
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<div class="container">
    <div class="stepwizard" id="form_abas">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Descrição do serviço</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle disabled" disabled="disabled">2</a>
                <p><small>Termos de contrato</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle disabled" disabled="disabled">3</a>
                <p><small>Dados da Igreja</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                    <a href="#step-4" type="button" class="btn btn-default btn-circle disabled" disabled="disabled">4</a>
                    <p><small>Escolher template</small></p>
                </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-5" type="button" class="btn btn-default btn-circle disabled" disabled="disabled">5</a>
                <p><small>Forma de pagamento</small></p>
            </div>
        </div>
    </div>
    
    <form id="cadastrarIgrejaForm" method="POST" role="form" action="<?php echo e(route('plataforma.incluirIgreja')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                <h3 class="panel-title">Descrição do serviço</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <p>Para aderir, basta informar alguns dados  sobre a igreja, realizar o pagamento e obter a visão do seu site. Caso queira ter um domínio (seu www) próprio, entre em contato com nossa equipe pelo tel (31) 3849-6771.
                    </p>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                <h3 class="panel-title">Termos de contrato</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <p>Sem termo de contrato no momento.
                    </p>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                <h3 class="panel-title">Dados da Igreja</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >CEP</label>
                        <input id="cep" name="cep" type="text" class="form-control" placeholder="CEP" data-inputmask='"mask": "99.999-999"' data-mask required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >Estado</label>
                        <input id="uf" name="estado" type="text" class="form-control" placeholder="Estado" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >Cidade</label>
                        <input id="cidade" name="cidade" type="text" class="form-control" placeholder="Cidade" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >Bairro</label>
                        <input id="bairro" name="bairro" type="text" class="form-control" placeholder="Bairro" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >Rua</label>
                        <input id="rua" name="rua" type="text" class="form-control" placeholder="Rua" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label >Complemento</label>
                        <input name="complemento" type="text" class="form-control" placeholder="Complemento">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >Número</label>
                        <input name="num" type="number" class="form-control" placeholder="Número" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label >Telefone</label>
                        <input name="telefone" type="text" class="form-control" placeholder="Telefone" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group has-feedback">
                        <label >Email</label>
                        <input name="email" type="text" class="form-control" placeholder="Email" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group has-feedback">
                        <label >URL da igreja (eglise.com.br/URL)</label>
                        <input maxlength="20" name="url" type="text" class="form-control" placeholder="URL" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label >Logo</label>
                        <input name="logo" type="file" id="input_img" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                </div>

                <?php /* ?><div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                    <label>Módulos do sistema</label>
                    <select name="modulos[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione os módulos"
                            style="width: 100%;" required>
                        <?php $modulos = App\TblModulo::orderBy('nome','ASC')->get(); ?>
                        @foreach ($modulos as $modulo)
                        <option value="{{$modulo->id}}">{{$modulo->nome}} - {{$modulo->sistema}} - {{($modulo->gerencial) ? 'Gerencial' : 'Apresentativo'}}</option>
                        @endforeach
                    </select>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                    </div>
                    <!-- /.form-group -->
                </div>
                </div>
                <?php */ ?>
                
                <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
            </div>
        </div>

        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                <h3 class="panel-title">Escolher template</h3>
            </div>
            <div class="panel-body">
                <p>Escolha um template para o site de sua congregação:</p>
                <?php
                Use App\TblTemplates;
                Use App\TblTemplateFotos;

                $templates = TblTemplates::all();

                
                foreach($templates as $template){
                    ?> 
                    <div class="row">
                    <center>
                    <h3><?php echo e($template->nome); ?></h3>
                    <div class="lightgallery" style="margin: 15px;">
                        <?php
                        $fotos_template = TblTemplateFotos::where('id_template','=',$template->id)->get();;
                        
                        foreach($fotos_template as $foto){
                            // /carrega_imagem/320,180,templates,
                            ?>
                            <a href="/storage/templates/<?php echo e($foto->foto); ?>">
                                <img src="/storage/templates/<?php echo e($foto->foto); ?>" class="mySlides-<?php echo e($template->id); ?>" style="border: #0c3d54 1px solid; width: 60%; height: 400px; display: none;" />
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <script>
                    var slideIndex_<?php echo e($template->id); ?> = 1;
                    showDivs_<?php echo e($template->id); ?>(slideIndex_<?php echo e($template->id); ?>, '<?php echo e('mySlides-'.$template->id); ?>');
                    
                    function plusDivs_<?php echo e($template->id); ?>(n, class_name) {
                        showDivs_<?php echo e($template->id); ?>(slideIndex_<?php echo e($template->id); ?> += n, class_name);
                    }
                    
                    function showDivs_<?php echo e($template->id); ?>(n, class_name) {
                        var i;
                        var x = document.getElementsByClassName(class_name);
                        if (n > x.length) {slideIndex_<?php echo e($template->id); ?> = 1}
                        if (n < 1) {slideIndex_<?php echo e($template->id); ?> = x.length}
                        for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";  
                        }
                        x[slideIndex_<?php echo e($template->id); ?>-1].style.display = "block";  
                    }
                    </script>
                    <div class="form-group has-feedback">
                        <div class="radio">
                            <label>
                                <input name="template" type="radio" value="<?php echo e($template->id); ?>" required>
                                Escolher esse template
                            </label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <a class="btn btn-primary btn-rcc" onclick="plusDivs_<?php echo e($template->id); ?>(-1, '<?php echo e('mySlides-'.$template->id); ?>')">&#10094;</a>
                    <a class="btn btn-primary btn-rcc" onclick="plusDivs_<?php echo e($template->id); ?>(1, '<?php echo e('mySlides-'.$template->id); ?>')">&#10095;</a>
                    <center>
                    </div> 
                    <?php
                }
                ?>
                <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-5">
            <div class="panel-heading">
                <h3 class="panel-title">Forma de pagamento</h3>
            </div>
            <div class="panel-body">
                <p>Escolha a forma de pagamento:
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <div class="radio">
                                <label>
                                    <input name="pagamento" type="radio" value="cartao">
                                    Cartão de crédito
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="pagamento" type="radio" value="boleto">
                                    Boleto
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="com-md-12">
                        <div class="pull-right">
                            <h2 style="color: darkgreen; margin-right: 15px;">R$ 0,00.</h2>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </form>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('eglise.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
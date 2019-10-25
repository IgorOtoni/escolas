<?php $__env->startPush('script'); ?>
<script>
$('#modal-noticia').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    modal.find('.modal-content #nome').html("");
    modal.find('.modal-content #descricao').html("");
    modal.find('.modal-content #dth_publicacao').html("");
    modal.find('.modal-content #dth_atualizacao').html("");
    modal.find('.modal-content #foto').show();
    modal.find('.modal-content #dth_atualizacao').show();
});

$('#modal-noticia').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var nome = button.data('nome');
    var descricao = button.data('descricao');
    var publicacao = button.data('publicacao');
    var atualizacao = button.data('atualizacao');
    var foto = button.data('foto');

    var modal = $(this);

    if(nome != null) modal.find('.modal-content #nome').append(nome);
    if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    if(publicacao != null) modal.find('.modal-content #dth_publicacao').append(' ' + publicacao);
    if(atualizacao != null && atualizacao != ''){
        modal.find('.modal-content #dth_atualizacao').append(' Atualizada ' + atualizacao);
    }else{
        modal.find('.modal-content #dth_atualizacao').hide();
    }
    if(foto != null && foto != ''){
        modal.find('.modal-content #foto').prop('src', '<?php echo e(asset('storage/noticias/')); ?>' + '/' + foto);
    }else{
        modal.find('.modal-content #foto').prop('src', '<?php echo e(asset('storage/')); ?>' + '/no-news.jpg');
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Blog Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Últimas notícias</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            <?php echo e($noticias->appends(request()->query())->links()); ?>

        </div>

        <div class="row">

            <?php foreach($noticias as $noticia){ ?>
                <!-- Single Blog Area -->
                <div class="col-12 col-lg-4">
                    <div class="single-blog-area mb-100">
                        <div class="blog-thumbnail">
                            <?php if($noticia->foto != null){ ?>
                                <img src="/storage/noticias/<?php echo e($noticia->foto); ?>" alt=""> 
                            <?php }else{ ?>
                                <img src="/storage/no-news.jpg" alt=""> 
                            <?php } ?>
                            <div class="post-date">
                                <?php /* ?>
                                <a data-publicacao="{{\Carbon\Carbon::parse($noticia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}" data-atualizacao="{{(($noticia->updated_at != null) ? \Carbon\Carbon::parse($noticia->updated_at)->diffForHumans() : '')}}" data-foto="{{$noticia->foto}}" data-nome="{{$noticia->nome}}" data-descricao="{{$noticia->descricao}}" data-toggle="modal" data-target="#modal-noticia" href="#"> Publicada {{\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()}}</a>
                                <?php */ ?>
                                <a href="#">Publicada <?php echo e(\Carbon\Carbon::parse($noticia->created_at)->diffForHumans()); ?></a>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="/<?php echo e($site->url); ?>/noticia/<?php echo e($noticia->id); ?>" class="blog-title"><?php echo e($noticia->nome); ?></a>
                            <p><?php echo e($noticia->descricao); ?></p>
                            <?php
                            if($noticia->updated_at != null && $noticia->updated_at != $noticia->created_at){
                                ?>
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> Atualizada <?php echo e(\Carbon\Carbon::parse($noticia->updated_at)->diffForHumans()); ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            <?php echo e($noticias->appends(request()->query())->links()); ?>

        </div>

    </div>
</div>
<!-- ##### Blog Area End ##### -->

<!-- modals -->
<div class="modal fade" id="modal-noticia">
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="nome"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
        <div class="box-body">
            <!--<article class="post-content">-->
            <div class="event-description"> <img id="foto" src="" class="img-responsive">
                <div class="spacer-20"></div>
                <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Detalhes da notícia</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="info-table">
                        <li><i class="fa fa-calendar" id="dth_publicacao"></i> </li>
                        <li><i class="fa fa-clock-o" id="dth_atualizacao"></i> </li>
                        <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    </div>
                </div>
                </div>
                <p id="descricao"></p>
            </div>
            <!--</article>-->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn crose-btn btn-2" data-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
    </div>
</div>
<!-- Modals end -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Programacao\usbwebserver_v8.6.2\root\Gratunos\resources\views/template3/noticias.blade.php ENDPATH**/ ?>
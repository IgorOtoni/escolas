<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template3\galeria.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<script>
$('#modal-galeria').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    //modal.find('.modal-content #nome').html("");
    //modal.find('.modal-content #descricao').html("");
    modal.find('.modal-content #foto').show();
});

$('#modal-galeria').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    //var nome = button.data('nome');
    //var descricao = button.data('descricao');
    var foto = button.data('foto');

    var modal = $(this);

    //if(nome != null) modal.find('.modal-content #nome').append(nome);
    //if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    modal.find('.modal-content #foto').prop('src', '<?php echo e(asset('storage/galerias/')); ?>' + '/' + foto);
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- ##### Donate Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Álbuns</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            <?php echo e($galerias->appends(request()->query())->links()); ?>

        </div>

        <div class="row">
            <?php foreach($galerias as $galeria){ ?>
                <h4><?php echo e($galeria->nome); ?></h4>
                <div class="col-12">
                    <div class="donate-slides owl-carousel">
                        <?php $fotos_ = $fotos[$galeria->id];
                            foreach($fotos_ as $foto){ ?>
                            <!-- Single Donate Slide Area -->
                            <a href="#" data-foto="<?php echo e($foto->foto); ?>" data-toggle="modal" data-target="#modal-galeria"><div class="single-donate-slide">
                                <img src="/carrega_imagem_/480,320,galerias,<?php echo e($foto->foto); ?>" alt="">
                            </div></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row d-flex justify-content-center section-padding-50-50">
            <?php echo e($galerias->appends(request()->query())->links()); ?>

        </div>

    </div>
</section>
<!-- ##### Donate Area End ##### -->

<!-- modals -->
<div class="modal fade" id="modal-galeria">
    <input type="hidden" name="id" id="id">
    <div class="modal-dialog">
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
                    <!--<div class="panel-heading">
                        <h3 class="panel-title">Detalhes da notícia</h3>
                    </div>-->
                    </div>
                </div>
                </div>
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
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* C:\xampp\htdocs\adm_eglise\resources\views\layouts\template3\publicacao.blade.php */ ?>
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
<!-- ##### Blog Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Publicação: <?php echo e($publicacao->nome); ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="html-append">
                <?php echo $publicacao->html; ?>
            </div>
        </div>

        <div class="row section-padding-0-100">
            <div class="col-12">
                <div class="donate-slides owl-carousel">
                    <?php foreach($galeria_publicacao as $foto){ ?>
                        <a href="#" data-foto="<?php echo e($foto->foto); ?>" data-toggle="modal" data-target="#modal-galeria"><div class="single-donate-slide">
                            <img src="/carrega_imagem/480,320,galerias-publicacoes,<?php echo e($foto->foto); ?>" alt="">
                        </div></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* C:\xampp\htdocs\adm_eglise\resources\views\usuario\editarcomunidade.blade.php */ ?>
<?php $__env->startPush('script'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset('template_adm/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('template_adm/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>

<script>

$(function(){
    $('#tbl_membros').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,

        "language": {            
        "sEmptyTable":   "Nenhum registro encontrado",
        "sProcessing":   "Carregando,aguarde...",
        "sLengthMenu":   "Mostrar _MENU_ registos",
        "sZeroRecords":  "A busca não retornou nehum registro",
        "sInfo":         "Mostrando de _START_ à _END_ de um total de _TOTAL_ registros",
        "sInfoEmpty":    "Mostrando de 0 à 0 de um total 0 registros",
        "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
        "sInfoPostFix":  "",
        "sSearch":       "Pesquisar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Próximo",
            "sLast":     "Último"
        },
        "oAria": {
            "sSortAscending":  ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
        },
        'processing': true,
        'autoWidth': false,
    });
});

</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar comunidade
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form id="editarComunidadeFormulario" data-toggle="validator" method="POST" role="form" action="<?php echo e(route('usuario.atualizarComunidade')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
            <input type="hidden" name="id" id="id" value="<?php echo e($comunidade->id); ?>">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label >Nome</label>
                            <input name="nome" type="text" class="form-control" placeholder="Nome" value="<?php echo e($comunidade->nome); ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label >Descrição</label>
                            <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição" required><?php echo e($comunidade->descricao); ?></textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    </div>

                    <label >Membros participantes</label>
                    <table id="tbl_membros" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Participa</th>
                        <th>Líder</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php Use App\TblMembros;
                        $membros = TblMembros::where('id_site','=',$site->id)->where('ativo','=',true)->get();
                        foreach($membros as $membro){
                            $pertence = "";
                            $lider = "";
    
                            foreach($membros_comunidade as $membro_comunidade){
                                if($membro_comunidade->id == $membro->id){
                                    $pertence = "checked";
                                    if($membro_comunidade->lider) $lider = "checked";
                                    break;
                                }
                            }
                            ?>
                            <tr>
                                <td><?php echo e($membro->id); ?></td>
                                <td><?php echo e($membro->nome); ?></td>
                                <td><input name="membros[]" value="<?php echo e($membro->id); ?>" type="checkbox" <?php echo e($pertence); ?>></td>
                                <td><input name="lideres[]" value="<?php echo e($membro->id); ?>" type="checkbox" <?php echo e($lider); ?>></td>
                            <?php
                        }
                        ?>
                    </tbody>
                    </table>

                </div>
                <div class="box-footer">
                    <a href="/usuario/comunidades" class="btn btn-warning pull-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
                </div>
            </div>
        </form>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.usuario.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
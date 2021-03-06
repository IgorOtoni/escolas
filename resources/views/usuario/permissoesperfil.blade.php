@extends('layouts.usuario.index')
@push('script')
<!--<link rel="stylesheet" href="{{asset('template_adm/plugins/iCheck/all.css')}}">
<script src="{{asset('template_adm//plugins/iCheck/icheck.min.js')}}"></script>-->
<script>
  $(document).ready(function() {
      $(".selecao").on("change", function () {
          if($(this).is(':checked')){
            $(this).closest('.row').find('[type=checkbox]').prop('checked', true);
          }else{
            $(this).closest('.row').find('[type=checkbox]').prop('checked', false);
          }
      });

      /*$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      });*/
  });
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permissões do perfil
        <!--<small>it all starts here</small>-->
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

            <form id="permissoesPerfilFormulario" data-toggle="validator" method="POST" role="form" action="{{route('usuario.atualizarPermissoesPerfil')}}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id_perfil" value="{{$perfil->id}}">
              <div class="box">
                <div class="box-body">
                
                @foreach ($modulos as $modulo)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                  <input type="checkbox" class="selecao" id="selecao_{{$modulo->id}}">
                                </label>
                                <label>{{$modulo->nome}}</label>
                                <div class="row">
                                  @foreach ($permissoes[$modulo->id]['todas'] as $permissao)
                                    <?php
                                    $marcacao = '';
                                    foreach($permissoes[$modulo->id]['ativas'] as $permissao_){
                                      if($permissao->id == $permissao_->id){
                                        $marcacao = 'checked';
                                        break;
                                      }
                                    }
                                    ?>
                                    <div class="col-md-3">
                                      <label>
                                        <input name="{{$modulo->id_perfis_sites_modulos}}[]" value="{{$permissao->id}}" type="checkbox" class="flat-red" {{$marcacao}}>
                                      </label>
                                      <label>{{$permissao->nome}}</label>
                                    </div>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
      
                </div>
                <div class="box-footer">
                  <a href="{{route('usuario.perfis')}}" class="btn btn-warning pull-left">Cancelar</a>
                  <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
                </div>
              </div>
      
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection
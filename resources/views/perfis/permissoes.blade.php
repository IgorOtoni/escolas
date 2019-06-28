@extends('layouts.admin_site.index')
@push('script')

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

            <form id="permissoesPerfilFormulario" data-toggle="validator" method="POST" role="form" action="{{route('perfis.atualizarPermissoes')}}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id_perfil" value="{{$perfil->id}}">
              <div class="box">
                <div class="box-body">
                
                @foreach ($modulos as $modulo)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >{{$modulo->nome}}</label>
                                <br>
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
                                  <input name="{{$modulo->id_perfis_igrejas_modulos}}[]" value="{{$permissao->id}}" type="checkbox" {{$marcacao}}> {{$permissao->nome}}
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
      
                </div>
                <div class="box-footer">
                  <a href="/admin/perfis" class="btn btn-warning pull-left">Cancelar</a>
                  <button type="submit" class="btn btn-primary pull-right">Salvar alteração</button>
                </div>
              </div>
      
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection
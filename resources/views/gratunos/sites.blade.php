@extends('layouts.gratunos')
@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">
<div class="container">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
    <h1>
        Congregações
    </h1>
    </section>-->

    <form id="filtrarSiteForm" method="GET" role="form" action="{{route('plataforma.filtrarSite')}}" enctype="multipart/form-data">
    @csrf
        <div class="box-body">
            <div class="row">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="nome" placeholder="Site">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Filtrar</button>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <div class="row"><center>{{ $sites_e_configuracoes->appends(request()->query())->links() }}</center></div>
    <!-- Main content -->
    <div class="row">
    <section class="content">
    @foreach ($sites_e_configuracoes as $site)
        <div class="col-md-6 col-xs-12">
        <!-- Attachment -->
        <div class="attachment-block clearfix">
        @if ($site->logo != null)
            <img class="attachment-img" src="{{'data:image;base64,'.base64_encode($site->logo)}}" alt="Attachment Image">
        @else
            <img class="attachment-img" src="storage/no-logo.jpg" alt="Attachment Image">
        @endif
        
        <div class="attachment-pushed" style="word-wrap: break-word; overflow-wrap: break-word;">
            <h4 class="attachment-heading">
                @if ($site->url != null && $site->status == true)
                    <a href="{{route('site.index', ['url' => $site->url])}}">
                        <?php echo $site->nome ?>
                    </a>
                @else
                    <?php echo $site->nome ?>
                @endif
            </h4>

            <div class="attachment-text">
            Cidade: {{$site->cidade}} - {{$site->estado}}<br/>
            Bairro: {{$site->bairro}}<br/>
            Rua: {{$site->rua}}, n°: {{$site->num}}<br/>
            @if ($site->complemento != null)
                Complemento: {{$site->complemento}}
            @else
                Complemento: <span class="label bg-red">Não informado</span>
            @endif
            <br/>
            @if ($site->telefone != null)
                Telefone: {{$site->telefone}}
            @else
                Telefone: <span class="label bg-red">Não informado</span>
            @endif
            <br />
            @if ($site->email != null)
                Email: {{$site->email}}
            @else
                Email: <span class="label bg-red">Não informado</span>
            @endif
            </div>
            <!-- /.attachment-text -->
        </div>
        <!-- /.attachment-pushed -->
        </div>
        <!-- /.attachment-block -->
        </div>
    @endforeach
    </section>
    </div>
    <!-- /.content -->
    <div class="row"><center>{{ $sites_e_configuracoes->appends(request()->query())->links() }}</center></div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
@endsection
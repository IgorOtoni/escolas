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

    <form id="filtrarIgrejaForm" method="GET" role="form" action="{{route('plataforma.filtrarIgreja')}}" enctype="multipart/form-data">
    @csrf
        <div class="box-body">
            <div class="row">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="nome" placeholder="Escola">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Filtrar</button>
                    </span>
                </div>
            </div>
        </div>
    </form>

    <div class="row"><center>{{ $igrejas_e_configuracoes->appends(request()->query())->links() }}</center></div>
    <!-- Main content -->
    <div class="row">
    <section class="content">
    @foreach ($igrejas_e_configuracoes as $igreja)
        <div class="col-md-6 col-xs-12">
        <!-- Attachment -->
        <div class="attachment-block clearfix">
        @if ($igreja->logo != null)
            <img class="attachment-img" src="{{'data:image;base64,'.base64_encode($igreja->logo)}}" alt="Attachment Image">
        @else
            <img class="attachment-img" src="storage/no-logo.jpg" alt="Attachment Image">
        @endif
        
        <div class="attachment-pushed" style="word-wrap: break-word; overflow-wrap: break-word;">
            <h4 class="attachment-heading">
                @if ($igreja->url != null && $igreja->status == true)
                    <a href="{{route('igreja.index', ['url' => $igreja->url])}}">
                        <?php echo $igreja->nome ?>
                    </a>
                @else
                    <?php echo $igreja->nome ?>
                @endif
            </h4>

            <div class="attachment-text">
            Cidade: {{$igreja->cidade}} - {{$igreja->estado}}<br/>
            Bairro: {{$igreja->bairro}}<br/>
            Rua: {{$igreja->rua}}, n°: {{$igreja->num}}<br/>
            @if ($igreja->complemento != null)
                Complemento: {{$igreja->complemento}}
            @else
                Complemento: <span class="label bg-red">Não informado</span>
            @endif
            <br/>
            @if ($igreja->telefone != null)
                Telefone: {{$igreja->telefone}}
            @else
                Telefone: <span class="label bg-red">Não informado</span>
            @endif
            <br />
            @if ($igreja->email != null)
                Email: {{$igreja->email}}
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
    <div class="row"><center>{{ $igrejas_e_configuracoes->appends(request()->query())->links() }}</center></div>
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
@endsection
@extends('layouts.template1')
@push('script')
<script src="{{asset('template_igreja/template-padrao/plugins/flexslider/js/jquery.flexslider.js')}}"></script> <!-- FlexSlider --> 
@endpush
@section('content')
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="/{{$igreja->url}}/">Home</a></li>
        <li class="active">Publicação</li>
        </ol>
    </div>
    </div>
</div>
</div>
<!-- End Nav Backed Header --> 
<!-- Start Page Header -->
<div class="page-header">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <h1>Publicação: {{$publicacao->nome}}</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <div class="row">
        <div class="col-md-12 sermon-archive" id="html-append">
            <?php echo $publicacao->html; ?>
        </div>
    </div>
    <div class="row">
        <ul class="isotope-grid" data-sort-id="gallery">
        <?php foreach($galeria_publicacao as $foto){ ?>
            <li class="col-md-3 col-sm-3 grid-item post format-image">
                <div class="grid-item-inner"> <a href="/storage/galerias-publicacoes/{{$foto->foto}}" data-rel="prettyPhoto" class="media-box"> <img src="/carrega_imagem/480,320,galerias-publicacoes,{{$foto->foto}}" alt=""> <!--<img src="/storage/galerias/{{$foto->foto}}" alt="">--> </a> </div>
            </li>
        <?php } ?>
        </ul>
    </div>
    </div>
</div>
</div>
@endsection
@extends('layouts.template2')
@push('script')
<script>

</script>
@endpush
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/{{$igreja->url}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Publicação</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<section class="blog-area section-padding-0-0">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Publicação: {{$publicacao->nome}}</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="blog-posts-area"><?php echo $publicacao->html; ?></div>
        </div>

        <div class="row justify-content-center">
            <?php foreach($galeria_publicacao as $foto){ ?>
                <!-- Single Gallery Area -->
                <div class="single-gallery-area">
                    <a href="/storage/galerias-publicacoes/{{$foto->foto}}" class="gallery-img" title="{{$foto->foto}}">
                        <img src="/carrega_imagem/480,320,galerias-publicacoes,{{$foto->foto}}" alt="">
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- ##### Blog Area End ##### -->
@endsection
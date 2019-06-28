@extends('layouts.template2')
@push('script')

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
                        <li class="breadcrumb-item active" aria-current="page">Galeria</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Gallery Area Start ##### -->
<section class="upcoming-events-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Álbuns</h2>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $galerias->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

        <?php foreach($galerias as $galeria){ ?>
            <h3>{{$galeria->nome}}</h3>
            <!-- ##### Gallery Area Start ##### -->
            <div class="gallery-area d-flex flex-wrap">
                <?php $fotos_ = $fotos[$galeria->id];
                foreach($fotos_ as $foto){ ?>
                    <!-- Single Gallery Area -->
                    <div class="single-gallery-area">
                        <a href="/storage/galerias/{{$foto->foto}}" class="gallery-img" title="{{$galeria->nome}}">
                            <img src="/carrega_imagem/480,320,galerias,{{$foto->foto}}" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $galerias->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

    </div>
</section>
<!-- ##### Gallery Area End ##### -->
@endsection
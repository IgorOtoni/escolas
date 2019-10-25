@extends('layouts.template1')
@push('script')
<script src="{{asset('template_site/template-padrao/plugins/flexslider/js/jquery.flexslider.js')}}"></script> <!-- FlexSlider --> 
@endpush
@section('content')
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="{{route('site.index',['url'=>$site->url])}}">Home</a></li>
        <li class="active">Álbuns</li>
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
        <h1>Álbuns</h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header --> 
<!-- Start Content -->
<div class="main" role="main">
<div id="content" class="content full">
    <div class="container">
    <center>
        {{ $galerias->appends(request()->query())->links() }}
    </center>
    <div class="row">
        <?php
        if($galerias != null && sizeof($galerias) > 0){
            foreach($galerias as $galeria){ 
                if(count($fotos[$galeria->id]) == 1){
                    $foto = $fotos[$galeria->id][0]; ?>
                    <div class="col-md-4 col-sm-4">
                        <h3><?php echo $galeria->nome ?></h3>
                        <h4>
                            <i class="fa fa-calendar"></i> 
                            {{\Carbon\Carbon::parse($galeria->data)->diffForHumans()}}
                        </h4>
                        <div class="grid-item-inner"> 
                            <a href="{{'data:image;base64,'.base64_encode($foto->foto)}}" data-rel="prettyPhoto" class="media-box">
                                <img width="480" height="320" src="{{'data:image;base64,'.base64_encode($foto->foto)}}"> <!--<img src="/storage/galerias/{{$foto->foto}}" alt="">-->
                            </a>
                        </div>
                        <p><?php echo $galeria->descricao ?></p>
                    </div>
                <?php }else{ ?>
                    <div class="col-md-4 col-sm-4">
                        <h3><?php echo $galeria->nome ?></h3>
                        <h4>
                            <i class="fa fa-calendar"></i> 
                            {{\Carbon\Carbon::parse($galeria->data)->diffForHumans()}}
                        </h4>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="flexslider" data-autoplay="yes" data-pagination="yes" data-arrows="yes" data-style="slide" data-pause="yes">
                                    <ul class="slides">
                                    <?php $fotos_ = $fotos[$galeria->id];
                                        foreach($fotos_ as $foto){ ?>
                                        <li>
                                            <a href="{{'data:image;base64,'.base64_encode($foto->foto)}}" data-rel="prettyPhoto">
                                                <img src="{{'data:image;base64,'.base64_encode($foto->foto)}}">
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <p><?php echo $galeria->descricao ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
            }
        }else{
            ?>
            <center>
                <span class="label label-warning">Nenhuma galeria para mostrar.</span>
            </center>
            <?php
        }
        ?>
    </div>
    <center>
        {{ $galerias->appends(request()->query())->links() }}
    </center>
    </div>
</div>
</div>
@endsection
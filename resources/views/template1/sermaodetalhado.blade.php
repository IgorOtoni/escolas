@extends('layouts.template1')
@push('script')
<script>

</script>
@endpush
@section('content')
<!-- End Site Header --> 
<!-- Start Nav Backed Header -->
<div class="nav-backed-header parallax">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
        <li><a href="{{route('site.index',['url'=>$site->url])}}">Home</a></li>
        <li><a href="{{route('site.midias',['url'=>$site->url])}}">Vídeos</a></li>
        <li class="active">Vídeo</li>
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
        <h1><?php echo $midia->nome ?></h1>
    </div>
    </div>
</div>
</div>
<!-- End Page Header -->
<!-- Start Content -->
<div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
            <div class="blog-posts-area">
                <!-- Post Details Area -->
                <div class="single-post-details-area">
                    <div class="post-content">
                        <p><?php echo $midia->descricao ?></p>
                        <ul class="info-table">
                        <li><i class="fa fa-calendar" id="dth_publicacao"></i> Publicado {{\Carbon\Carbon::parse($midia->created_at)->diffForHumans()}}</li>
                        <?php
                        if($midia->updated_at != null && $midia->updated_at != $midia->created_at){
                            ?>
                            <li><i class="fa fa-clock-o" id="dth_atualizacao"></i> Editado {{\Carbon\Carbon::parse($midia->updated_at)->diffForHumans()}}</li>
                            <?php
                        }
                        ?>
                        <!--<li><i class="fa fa-phone"></i> 1 800 321 4321</li>-->
                        </ul>
                    </div>
                    <div class="post-thumbnail mb-30">
                        <iframe frameborder="0" src="{{$midia->link}}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection
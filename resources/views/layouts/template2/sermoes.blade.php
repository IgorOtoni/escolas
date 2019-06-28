@extends('layouts.template2')
@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/{{$igreja->url}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vídeos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Latest Sermons Area Start ##### -->
<section class="latest-sermons-area">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12">
                <div class="section-heading">
                    <h2>Vídeos</h2>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $sermoes->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

        <div class="row">

            <?php foreach($sermoes as $sermao){ ?>
                <!-- Single Latest Sermons -->
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="single-latest-sermons mb-100">
                        <!--<div class="sermons-thumbnail">-->
                        <iframe frameborder="0" src="{{$sermao->link}}"></iframe>
                        <!--</div>-->
                        <div class="sermons-content">
                            <a href="/{{$igreja->url}}/sermao/{{$sermao->id}}"><h4>{{$sermao->nome}}</h4></a>
                            <div class="sermons-meta-data">
                                <p><i class="fa fa-tag" aria-hidden="true"></i> {{$sermao->descricao}}</p>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{\Carbon\Carbon::parse($sermao->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</p>
                                <p><a href="{{$sermao->link}}" class="btn crose-btn btn-2">Assistir sermão</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="row d-flex justify-content-center section-padding-0-100">
            <div class="pagination-area mt-70">
                <nav aria-label="Page navigation example">
                    {{ $sermoes->appends(request()->query())->links() }}
                </nav>
            </div>
        </div>

    </div>
</section>
<!-- ##### Latest Sermons Area End ##### -->
@endsection
@extends('layouts.template7')
@push('script')

@endpush
@section('content')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container">
    	<!-- <img src="images/bg-png/6.png" alt="bradcaump images">-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Vídeo detalhado</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<!-- Start Blog Grid Area -->
<div class="dcare__blog__list bg--white">
    <div class="container">
        <div class="row">
            <!-- Start BLog Details -->
            <div class="col-lg-12">
                <div class="page__blog__details">
                    <article class="dacre__blog__details">
                        <div class="blog__thumb">
                            <iframe width="839" height="600" frameborder="0" src="{{$sermao->link}}"></iframe>
                        </div>
                        <div class="blog__inner">
                            <h2>{{ $sermao->nome }}</h2>
                            <ul>
                                <li>Adicionado {{\Carbon\Carbon::parse($sermao->created_at)->diffForHumans()}}</li>
                            </ul>

                            <p>{{ $sermao->descricao }}</p>

                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
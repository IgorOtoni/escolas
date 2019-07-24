@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Vídeos</h1>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12 col-sm-12">
                    <ul class="sermons-list">
                    	<?php foreach($sermoes as $sermao){ ?>
	                    	<li class="sermon-item format-standard">
	                        	<div class="row">
	                            	<div class="col-md-5">
	                                	<a href="{{$sermao->link}}"><iframe frameborder="0" width="400" height="200" src="{{$sermao->link}}"></iframe></a>
	                                    <a href="/{{$igreja->url}}/sermao/{{$sermao->id}}" class="basic-link">Detalhes</a>
	                                </div>
	                                <div class="col-md-7">
	                                	<h3><a href="/{{$igreja->url}}/sermao/{{$sermao->id}}">{{ $sermao->nome }}</a></h3>
	                                    <span class="meta-data"><i class="fa fa-calendar"></i> Adicionado {{\Carbon\Carbon::parse($sermao->created_at)->diffForHumans()}}</span>
	                                    <p>{{ $sermao->descricao }}</p>
	                                </div>
	                            </div>
	                        </li>
                        <?php } ?>
                    </ul>
                </div>
                {{ $sermoes->appends(request()->query())->links() }}
            </div>
     	</div>
    </div>
</div>
<!-- End Body Content -->
@endsection
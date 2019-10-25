@extends('layouts.template6')
@push('script')

@endpush
@section('content')
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
    		<h1>Detalhes do sermão</h1>
  			<hr class="sm">
  			<h3>{{ $midia->nome }}</h3>
  			<hr class="sm">
            <div class="row">
            	<div class="col-md-12">
	        		<a href="{{$midia->link}}"><iframe frameborder="0" width="800" height="400" src="{{$midia->link}}"></iframe></a>
	                <p>
	                	{{ $midia->descricao }}<br/>
	        			<span class="meta-data"><i class="fa fa-calendar"></i> Adicionado {{\Carbon\Carbon::parse($midia->created_at)->diffForHumans()}}</span>
	        		</p>
        		</div>
        	</div>
    	</div>
	</div>
</div>
@endsection
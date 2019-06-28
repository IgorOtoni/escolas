@extends('layouts.usuario.index')
@push('script')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Home
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        @foreach ($quadros as $quadro)
            <a href="{{$quadro['link']}}">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-{{$quadro['color']}}"><i class="fa {{$quadro['icon']}}"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{$quadro['title']}}</span>
                        <span class="info-box-number">{{$quadro['info']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </a>
        @endforeach
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
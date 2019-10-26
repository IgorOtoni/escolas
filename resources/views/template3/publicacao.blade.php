@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3><?php echo htmlentities($publicacao->nome); ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="html-append">
                <?php echo htmlentities($publicacao->html); ?>
            </div>
        </div>

        <div class="row section-padding-0-100">
            <div class="col-12">
                <div class="donate-slides owl-carousel">
                    <?php foreach($galeria_publicacao as $foto){ ?>
                        <a href="#" data-foto="{{$foto->foto}}" data-toggle="modal" data-target="#modal-galeria"><div class="single-donate-slide">
                            <img width="480" height="320" src="{{'data:image;base64,'.base64_encode($foto->foto)}}" alt="">
                        </div></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
@endsection
@extends('layouts.template3')
@push('script')
<script>
$('#modal-galeria').on('hide.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;

    var modal = $(this);

    //modal.find('.modal-content #nome').html("");
    //modal.find('.modal-content #descricao').html("");
    modal.find('.modal-content #foto').show();
});

$('#modal-galeria').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    //var nome = button.data('nome');
    //var descricao = button.data('descricao');
    var foto = button.data('foto');

    var modal = $(this);

    //if(nome != null) modal.find('.modal-content #nome').append(nome);
    //if(descricao != null) modal.find('.modal-content #descricao').append(descricao);
    modal.find('.modal-content #foto').prop('src', '{{asset('storage/galerias/')}}' + '/' + foto);
});
</script>
@endpush
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="faith-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Publicação: {{$publicacao->nome}}</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="html-append">
                <?php echo $publicacao->html; ?>
            </div>
        </div>

        <div class="row section-padding-0-100">
            <div class="col-12">
                <div class="donate-slides owl-carousel">
                    <?php foreach($galeria_publicacao as $foto){ ?>
                        <a href="#" data-foto="{{$foto->foto}}" data-toggle="modal" data-target="#modal-galeria"><div class="single-donate-slide">
                            <img src="/carrega_imagem/480,320,galerias-publicacoes,{{$foto->foto}}" alt="">
                        </div></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
@endsection
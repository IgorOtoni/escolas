@extends('layouts.template3')
@push('script')

@endpush
@section('content')
<!-- ##### Church Activities Area Start ##### -->
<section class="church-activities-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto">
                    <h3>Vídeos</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $midias->appends(request()->query())->links() }}
        </div>

        <div class="row">

            <?php foreach($midias as $midia){ ?>
                <div class="col-12 col-lg-12">
                    <!-- Latest Sermons -->
                    <div class="latest-sermons mb-50">
                        <!-- Single Sermons Area -->
                        <div class="single-sermons">
                            <div class="sermons-content d-flex align-items-center">
                                <!-- Sermons Thumbnail -->
                                <iframe frameborder="0" src="{{$midia->link}}"></iframe>
                                <!-- Sermons Content -->
                                <div class="sermons-text">
                                    <a href="{{route('site.midia', ['url'=>$site->url,'id'=>$midia->id])}}">
                                        <h6><?php echo htmlentities($midia->nome); ?></h6>
                                    </a>
                                    <p><?php echo htmlentities($midia->descricao); ?></p>
                                    <p class="date">{{\Carbon\Carbon::parse($midia->created_at, 'UTC')->isoFormat('Do MMMM YYYY, h:mm:ss A')}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
            
        </div>

        <div class="row d-flex justify-content-center section-padding-0-50">
            {{ $midias->appends(request()->query())->links() }}
        </div>

    </div>
</section>
<!-- ##### Church Activities Area End ##### -->
@endsection
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
                        <h2 class="bradcaump-title">{{ $publicacao->nome }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

@endsection
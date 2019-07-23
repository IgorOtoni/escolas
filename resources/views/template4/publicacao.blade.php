@extends('layouts.template4')
@push('script')

@endpush
@section('content')
<div id="kids_middle_container">
	<div class="bg-level-2-full-width-container kids_bottom_content">
		<div class="bg-level-2-page-width-container l-page-width no-padding">
			<section class="kids_bottom_content_container">
				<div class="header_container">  
					<h1>{{$publicacao->nome}}</h1>
				</div>
				<div class="entry-container">
					<?php echo $publicacao->html; ?>

					<div class="divider-padding"></div>

					<div class="gl_col_4">
						<ul id="gallery">
							<?php foreach($galeria_publicacao as $foto){ ?>

                            <li data-categories="print" class="gallery-item">
                                
                                <div class="border-shadow">
                                    <figure>
                                        <a target="_blank" class="prettyPhoto kids_picture" href="/storage/galerias-publicacoes/{{$foto->foto}}">
                                            <img width="202" height="138" src="/storage/galerias-publicacoes/{{$foto->foto}}" alt="" />
                                        </a>										
                                    </figure>
                                </div>
                                
                            </li>

                        	<?php } ?>
						</ul>

						<div class="kids_clear"></div>
					</div>

				</div>
			</section>
		</div>
	</div>
</div>
@endsection
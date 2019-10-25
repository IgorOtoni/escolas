@extends('layouts.template8normal')
@push('script-x')
<script type="text/javascript">
(function($) {
    $(document).ready(function () {
	    $('.page-link').each(function(index) {
	    	if($(this).text() == '<'){
	    		$('nav .pagination_wrap .pagination_pages').append('<a class="page_prev"></a>');
			}else if($(this).text() == '>'){
				$('nav #pagination').append('<a class="page_next"></a>');
			}else{
				num = $(this).text();
				$('nav #pagination').append('<a class="page_next">' + num + '</a>');
			}
		});
	});
})(jQuery);
</script>
@endpush
@section('content-c')
<!-- Page title -->
<div class="page_top_wrap page_top_title page_top_breadcrumbs sc_pt_st1">
    <div class="content_wrap">
        <h1 class="page_title">Vídeos</h1>
    </div>
</div>
<!-- /Page title -->
<!-- Content without sidebar -->
<div class="page_content_wrap">
    <div class="content_wrap">
        <div class="content">
            <article class="post_item post_item_single page">
                <section class="post_content">
                	<?php for($x = 0; $x < sizeof($midias); $x += 2){
                		$midia_1 = $midias[$x];
                		$midia_2 = (isset($midias[$x + 1])) ? $midias[$x + 1] : null; ?>
						<div class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
							<div class="column-1_2 sc_column_item sc_column_item_1 odd first">
								<h4 class="sc_title sc_title_regular margin_top_0 margin_bottom_075em">{{ $midia_1->nome }}</h4>
								<div class="sc_video_player">
									<iframe alt="" width="515" height="290" src="{{ $midia_1->link }}"></iframe>
								</div>
							</div>
							<?php if($midia_2 != null) { ?>
								<div class="column-1_2 sc_column_item sc_column_item_2 even">
									<h4 class="sc_title sc_title_regular margin_top_0 margin_bottom_075em">{{ $midia_2->nome }}</h4>
									<div class="sc_video_player">
										<iframe alt="" width="515" height="290" src="{{ $midia_2->link }}"></iframe>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="sc_line sc_line_style_solid margin_top_3em"></div>
					<?php } ?>
					<nav id="pagination" class="pagination_wrap pagination_pages">
						<!--<a href="#" class="pager_first "></a>
						<a href="#" class="pager_prev "></a>
						<span class="pager_current active ">1</span>
						<a href="#" class="">2</a>
                        <a href="#" class="pager_next "></a>
                        <a href="#" class="pager_last "></a>-->
                    </nav>
					<center id="pagination_area">
				        {{ $midias->appends(request()->query())->links() }}
				    </center>
                </section>
            </article>
        </div>
    </div>
</div>
<!-- /Content without sidebar -->
@endsection
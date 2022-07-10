jQuery(function($) {
	$('.seosight-elem-info-boxes-wrap.layout-academy .crumina-info-box').matchHeight();
	$('.seosight-posts-block .post-item-grid').matchHeight();

	$('.portfolio-grid .portfolio-grid-terms-nav li').on('click', function(e){
		e.preventDefault();

		$('.portfolio-grid .portfolio-grid-terms-nav li').removeClass('active');
		$(this).addClass('active');
		var target = $(this).data('target');
		$(this).closest('.crumina-module').find('.portfolio-grid-posts-cont').removeClass('active');
		$(this).closest('.crumina-module').find('.portfolio-grid-posts-cont[data-nav="'+target+'"]').addClass('active');
	});
});
$(function() {
				$('#thumbs .thumb a').each(function(i) {
					$(this).addClass( 'itm'+i );
					$(this).click(function() {
						$('#images').trigger( 'slideTo', [i, 0, true] );
						return false;
					});
				});
				$('#thumbs a.itm0').addClass( 'selected' );
				
				$('#images').carouFredSel({
					direction: 'up',
					fx      : "crossfade",
					circular: false,
					infinite: false,
					items: 1,
					auto: false,
					scroll: {
						fx: 'crossfade',
						onBefore: function() {
							var pos = $(this).triggerHandler( 'currentPosition' );
							$('#thumbs a').removeClass( 'selected' );
							$('#thumbs a.itm'+pos).addClass( 'selected' );

							var page = Math.floor( pos / 3 );
							$('#thumbs').trigger( 'slideToPage', page );
						}
					}
				});
				$('#thumbs').carouFredSel({
					direction: 'top',
					circular: false,
					infinite: false,
					items: 5,
					align: false,
					auto: false,
					prev: '#prev',
					next: '#next'
				});
				
});
$(document).ready(function(){
  $(".toggle-btn").toggle(function(){
    $(".right-sec").animate({
		right:-181
	},300);
  },function(){
    $(".right-sec").animate({
		right:0
	},300);
  });
});
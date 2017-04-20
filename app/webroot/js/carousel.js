$(document).ready(function() {
	$('#home-carousel').carousel();
	$('#home-carousel').on('slid.bs.carousel', function () {
		var to_slide = $('.carousel-inner .item.active').attr('index');
		$('.carousel-indicators').children().removeClass('active');
		$('.carousel-indicators li[data-slide-to='+ to_slide +']').addClass('active');
	});
	$(".dotdotdot").dotdotdot({
		"watch": true,
		callback: function(isTruncated, origContent ) {
			//JqueryUI tooltip not working, sadly...
			/*if(isTruncated) {
				$(document).tooltip();
			}*/
		}
	});
});


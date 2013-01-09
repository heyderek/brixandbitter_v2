//Logo animation on a conditional: won't load on tablet and touch devices.
jQuery(document).ready(function($) {
	var winWidth = $(window).width();
	var position = $("#logo").position();
	var topPadding = 15;
	if ( winWidth >= 960 ) {
	    $(window).scroll(function() {
		if ($(window).scrollTop() > position.top) {
		    $("#logo").stop().animate({
			marginTop: $(window).scrollTop() - position.top + topPadding
		    },200);
		    } else {
		    $("#logo").stop().animate({
			marginTop: 0
		});
	    };
	});
	}
});
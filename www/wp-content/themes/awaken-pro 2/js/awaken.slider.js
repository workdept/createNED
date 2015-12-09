jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
		animation: "fade",
		direction: "horizontal",
		slideshowSpeed: 6000,
		animationSpeed: 600,
			start: function(slider){
				slider.removeClass('loading');
			}
	});
});

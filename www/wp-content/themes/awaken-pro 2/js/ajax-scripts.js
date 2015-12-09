jQuery(function($) {
    $('.awaken-block').on('click', '#awt-nav a:not(.ajax-vall)', function(e){
        e.preventDefault();
		
		var block_uid = $(this).closest('#awt-nav').data('blockuid');		
        var link = $(this).attr('href');
		
		var block_id = $(this).closest('#awt-nav').data('blockid');
		var loader = $(block_id).find('#block-loader');

		$(loader).fadeIn(500);
        $(block_uid).animate({opacity:0.3},500, function(){
        	$(this).load(link + ' ' + block_uid, function(){
        		$(this).animate({opacity:1}, 500);
        		$(loader).fadeOut(500);
        	});
        });
    });
});
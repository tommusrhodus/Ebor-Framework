jQuery(document).ready(function($){

	$('.ebor-likes').live('click',
	    function() {
    		var link = $(this);
    		if(link.hasClass('active')) return false;
		
    		var id = $(this).attr('id'),
    			postfix = link.find('.ebor-likes-postfix').text();
			
    		$.post(ebor_likes.ajaxurl, { action:'ebor-likes', likes_id:id, postfix:postfix }, function(data){
    			link.html(data).addClass('active').attr('title','You already like this');
    		});
		
    		return false;
	});
	
	if( $('body.ajax-ebor-likes').length ) {
        $('.ebor-likes').each(function(){
    		var id = $(this).attr('id');
    		$(this).load(ebor.ajaxurl, { action:'ebor-likes', post_id:id });
    	});
	}

});
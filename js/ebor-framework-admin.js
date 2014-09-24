function ebor_hide_metaboxes(){
	var format = jQuery('#post-formats-select input:checked').val();
	jQuery('div[id^="post_format_metabox_"]').hide();
	jQuery('div[id^="post_format_metabox_"][id*="' + format + '"]').show();
}

jQuery(document).ready(function($){

	/**
	 * Show & Hide Custom Metaboxes with the post_format_metabox_ prefix
	 */
	ebor_hide_metaboxes();
	
	$('#post-formats-select input').click(function(){
		ebor_hide_metaboxes();
	});

});
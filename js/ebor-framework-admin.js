function ebor_hide_metaboxes(){
	var format = jQuery('#post-formats-select input:checked').val();
	jQuery('div[id^="post_format_metabox_"]').hide();
	jQuery('div[id^="post_format_metabox_"][id*="' + format + '"]').show();
}
function printValue(name){
	var val = jQuery('input[type="range"][name="'+ name +'"]').val();
	jQuery('input[type="text"][name="'+ name +'"]').val(val);
}

jQuery(document).ready(function($){
	
	jQuery('input[type="range"]').trigger('change');
	
	/**
	 * Show & Hide Custom Metaboxes with the post_format_metabox_ prefix
	 */
	ebor_hide_metaboxes();
	
	$('#post-formats-select input').click(function(){
		ebor_hide_metaboxes();
	});

});
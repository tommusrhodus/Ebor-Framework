/*-----------------------------------------------------------------------------------*/
/*	CUSTOM FUNCTIONS
/*-----------------------------------------------------------------------------------*/
function ebor_hide_metaboxes(){
	var format = jQuery('#post-formats-select input:checked').val();
	jQuery('div[id^="post_format_metabox_"]').hide();
	jQuery('div[id^="post_format_metabox_"][id*="' + format + '"]').show();
}
function printValue(name){
	var val = jQuery('input[type="range"][name="'+ name +'"]').val();
	jQuery('input[type="text"][name="'+ name +'"]').val(val);
}
/*-----------------------------------------------------------------------------------*/
/*	BASIC ADMIN JS
/*-----------------------------------------------------------------------------------*/
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
/*-----------------------------------------------------------------------------------*/
/*	DEMO DATA IMPORT
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
	$('#demo-import').click(function(){
		
		activate = confirm('Have you installed all required plugins? Before installing demo data be sure to do a full backup incase anything goes wrong, or data is overwritten. Proceed if you have done this.')
		if(activate == false) return false;
		
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action: 'ebor_ajax_import_data'
			},
			beforeSend: function() {
				//show loader
				$('.btn').addClass('disabled').text('Loading, Please Wait.');
			},
			error: function() {
				//script error occured
				$('body').alert( 'Importing didnt work! <br/> You might want to try reloading the page and then try again' );
				$('.btn').removeClass('disabled');
				
			},
			success: function(response) {
				if(response.match('ebor_import')) {
					alert('Demo Data Imported. Have Fun and read the documentation.');
				}
				else {
					alert('Demo Data Not Imported! ' + response);
				}
			},
			complete: function(response) {	
				$('.btn').text('All Data Imported, Have Fun!');
			}
		});
				
		return false;
	});
});
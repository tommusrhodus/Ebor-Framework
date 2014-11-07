jQuery(document).ready(function($) {
	
	$('head').append('<style>.ebor-modal-content { max-height:'+ ( $(window).height() - 280 ) +'px !important; }</style>');
	/**
	 * Gallery Manager
	 */
	$('body').on('click', 'input[type="button"].manage', function(){
		
		var instance = $(this).parents('.ebor-page-builder-gallery'),
			val = $('input[type=hidden]', instance).val(),
			id_array = [];
			
		if(!( val ))
			val = ' ';
			
		var gallerysc = '[gallery ids="' + val + '"]';
			
		wp.media.gallery.edit(gallerysc).on('update', function(g) {
			$.each(g.models, function(id, img) { id_array.push(img.id); });
			$('input[type=hidden]', instance).val(id_array.join(","));
		});
		
	});
	$('body').on('click', 'input[type=button].ebor-gallery-remove', function(){
		var instance = $(this).parents('.ebor-page-builder-gallery');
		$('input[type=hidden]', instance).val('');
		alert('All Gallery Items Removed, Save Template to Update');
	});
	
	/**
	 * Icon Selector
	 */
	$('body').on('click', '.ebor-icon-modal-launcher', function(){
		$(this).parent().find('.icon-modal').show();
		return false;
	});
	$('body').on('click', '.icon-modal .ebor-modal-icon', function(){
		var icon = $(this).attr('data-ebor-icon');
		$(this).parents('.description').find('input').attr({ 'value' : icon });
		$(this).parents('.icon-modal').hide();
	});
	
	/**
	 * Launch the page builder modals
	 */
	$('body').on('click', '.ebor-modal-launcher', function(){
		if($(this).hasClass('section-launcher')){
			$(this).parents('.ebor-column-header').next('.ebor-column-content').slideDown().find('.ebor-modal').eq(0).show();
		} else {
			$(this).parent().find('.ebor-modal').show();
		}
		return false;
	});
	
	/**
	 * Close Modals
	 */
	$('body').on('click', '.ebor-modal-closer', function(){
		$(this).parents('.ebor-modal').hide();
		return false;
	});
	$('body').on('click', '.icon-modal-closer', function(){
		$(this).parents('.icon-modal').hide();
		return false;
	});
	
	/**
	 * Handle the WP WYSIWYG Editor
	 */
	$('body').on('click', '.ebor-editor-launch', function(){
		
		var href = $(this).attr('href'),
			$textarea = $(href),
			content = $textarea.val();
			
		$('.ebor-editor-closer').attr('data-target', href);
		
		$('.editor-wrap').show();
		
		if( typeof tinymce != "undefined" ) {
		    var editor = tinyMCE.activeEditor;
		    if( editor && editor instanceof tinymce.Editor ) {
		    	content = content.replace(/\n/ig,"<br />");
		        editor.setContent( content );
		        editor.save( { no_events: true } );
		    }
		    else {
		        jQuery('textarea#ebor-editor').val( content );
		    }
		}
		
		return false;
		
	});
	$('.ebor-editor-closer').click(function(){
		$(this).parent().parent().parent().hide();
		if( typeof tinymce != "undefined" ) {
		    var editor = tinyMCE.activeEditor;
		    if( editor && editor instanceof tinymce.Editor ) {
		        $($(this).attr('data-target')).val( editor.getContent() );
		    }
		    else {
		        $($(this).attr('data-target')).val( jQuery('textarea#ebor-editor').val( content ) );
		    }
		}
	});
	
	/**
	 * Slideup column content
	 */
	jQuery('.ebor-column-content').slideUp();
	
	/**
	 * Toggle Column Content
	 */
	jQuery('.column-close').click(function(){
		jQuery(this).parents('.ebor-column-header').next('.ebor-column-content').slideToggle();
		return false;
	});
	
	/**
	 * Sort page builder blocks by category
	 */
	$('a.isotope-filter').eq(0).addClass('active');
	$('a.isotope-filter').click(function(){
		var filter = $(this).attr('data-filter');
		$('a.isotope-filter').removeClass('active');
		$(this).addClass('active');
		$('#blocks-archive li').hide();
		$(filter).show();
		return false;
	});

});
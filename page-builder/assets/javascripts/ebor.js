jQuery(document).ready(function($) {
	
	/**
	 * Gallery Manager
	 */
	$('body').on('click', 'input[type="button"].manage', function(){
		var instance = $(this).parents('.ebor-page-builder-gallery');
		var gallerysc = '[gallery ids="' + $('input[type=hidden]', instance).val() + '"]';
		wp.media.gallery.edit(gallerysc).on('update', function(g) {
			var id_array = [];
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
	 * Quick fix for stopping nested page sections
	 */
	$( "ul.blocks" ).bind( "sortstop", function(event, ui) {
		if(ui.item.hasClass('block-container')) {
			$parent = ui.item.parent()
			if( $parent.hasClass('block-container') || $parent.hasClass("column-blocks") ) { 
				$(this).sortable('cancel');
				return false;
			}
		}
	});
	
	/**
	 * Icon Selector
	 */
	$('body').on('click', '.ebor-icon-modal-launcher', function(){
		$(this).parent().find('.icon-modal').show();
		return false;
	});
	$('body').on('click', '.icon-modal', function(){
		$(this).hide();
	});
	$('body').on('click', '.icon-modal .ebor-modal-icon', function(){
		var icon = $(this).attr('data-ebor-icon');
		$(this).parents('.description').find('input').attr({ 'value' : icon });
	});
	$('body').on('click', '.ebor-modal-launcher', function(){
		$(this).parent().find('.ebor-modal').show();
		return false;
	});
	$('body').on('click', '.ebor-modal-closer', function(){
		$(this).parent().parent().parent().hide();
		return false;
	});
	$('body').on('click', '.icon-modal-closer', function(){
		$(this).parents('.icon-modal').hide();
		return false;
	});
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

	jQuery('.ebor-column-content').slideUp();
	
	jQuery('.column-close').click(function(){
		jQuery(this).parent().next().slideToggle();
		return false;
	});
	
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
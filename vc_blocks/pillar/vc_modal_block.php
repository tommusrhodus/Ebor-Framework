<?php 

/**
 * The Shortcode
 */
function ebor_modal_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => false,
				'fullscreen' => 'no',
				'button_text' => '',
				'icon' => '',
				'delay' => false,
				'align' => 'text-center',
				'cookie' => false,
				'manual_id' => false,
				'video' => '',
				'width' => '60',
				'height' => '60'
			), $atts 
		) 
	);
	
	if( $delay ){
		$delay = 'data-autoshow="'. (int) $delay .'"';	
	}
	
	if( $video ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<div class="'. $align .'">
					<a class="btn modal-trigger" href="#">
						<span class="btn__text">
							&#9658; '. $button_text .'
						</span>
					</a>
				</div>
				<div class="modal-container" '. $delay .'>
					<div class="modal-content bg-dark" data-width="'. (int) $width .'%" data-height="'. (int) $height .'%">
						'. wp_oembed_get($video) .'
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
			
	} else {
	
		$output = '
			<div class="modal-instance">
				<div class="'. $align .'">
					<a class="btn modal-trigger" href="#">
						<span class="btn__text"><i class="'. $icon .'"></i> '. $button_text .'</span>
					</a>
				</div>
				<div class="modal-container" '. $delay .'>
		';
		
		if( $image ){
			
			$output .= '
					<div class="modal-content bg-white imagebg" data-width="'. (int) $width .'%" data-height="'. (int) $height .'%" data-overlay="5">
						<div class="background-image-holder">
							'. wp_get_attachment_image( $image, 'full' ) .'
						</div>
						<div class="pos-vertical-center clearfix">
							<div class="col-sm-6 col-sm-offset-1">
			';
			
		} else {
			
			$output .= '
				<div class="modal-content bg--white height--natural">
					<div class="form-subscribe-1 boxed boxed--lg bg--white box-shadow-wide">
							<div class="subscribe__title text-center">
			';
			
		}
			
		$output .= do_shortcode($content) .'
							</div>
						</div>
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
	
	}
	
	return $output;
}
add_shortcode( 'pillar_modal', 'ebor_modal_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'                    => esc_html__( 'Modal' , 'pillar' ),
		    'base'                    => 'pillar_modal',
		    'description'             => esc_html__( 'Create a modal popup', 'pillar' ),
		    'as_parent'               => array('except' => 'pillar_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'params' => array(
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => __("Button Icon, click to choose", 'pillar'),
		    		"param_name" => "icon",
		    		"value" => $icons,
		    		'description' => 'Type "none" or leave blank to hide icons.'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Button Text", 'pillar'),
		    		"param_name" => "button_text"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Button Alignment", 'pillar'),
		    		"param_name" => "align",
		    		"value" => array(
		    			'Center' => 'text-center',
		    			'Left' => 'text-left',
		    			'Right' => 'text-right'
		    		)
		    	),
		    	array(
		    		"type" => "attach_image",
		    		"heading" => esc_html__("Modal background image?", 'pillar'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Video URL", 'pillar'),
		    		"param_name" => "video",
		    		'description' => 'Youtube or Vimeo URL, if added this becomes a video only modal'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Delay Timer", 'pillar'),
		    		"param_name" => "delay",
		    		'description' => 'Leave blank for infinite delay (manual trigger only) enter milliseconds for automatic popup on timer, e.g: 2000'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Cookie Name", 'pillar'),
		    		"param_name" => "cookie",
		    		'description' => 'Set a plain text cookie name here to stop the delay popup if someone has already closed it.'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Modal Width", 'pillar'),
		    		"param_name" => "width",
		    		'description' => 'Video & Image Modal only. Numeric only, value in %, for 50% width type only: 50',
		    		'value' => '60'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Modal Height", 'pillar'),
		    		"param_name" => "height",
		    		'description' => 'Video & Image Modal only. Numeric only, value in %, for 50% height type only: 50<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=hj9K-gGwG_c">Video Tutorial</a></div>',
		    		'value' => '60'
		    	),
		    )
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_modal_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pillar_modal extends WPBakeryShortCodesContainer {

    }
}
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
				'video' => ''
			), $atts 
		) 
	);
	
	if( $video ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<a class="btn modal-trigger" href="#">
					<span class="btn__text">
						&#9658; '. $button_text .'
					</span>
				</a>
				<div class="modal-container">
					<div class="modal-content bg-dark" data-width="60%" data-height="60%">
						'. wp_oembed_get($video) .'
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
			
	} else {
	
		$output = '
			<div class="modal-instance">
				<a class="btn modal-trigger" href="#">
					<span class="btn__text">'. $button_text .'</span>
				</a>
				<div class="modal-container">
		';
		
		if( $image ){
			
			$output .= '
					<div class="modal-content bg-white imagebg" data-width="50%" data-height="50%" data-overlay="5">
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
	
	$icons = ebor_get_icons();
	
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
		    		"type" => "textfield",
		    		"heading" => esc_html__("Button Text", 'pillar'),
		    		"param_name" => "button_text"
		    	),
		    	array(
		    		"type" => "attach_image",
		    		"heading" => esc_html__("Modal background image?", 'pillar'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Video URL", 'pillar'),
		    		"param_name" => "video"
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
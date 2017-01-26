<?php 

/**
 * The Shortcode
 */
function ebor_modal_shortcode( $atts, $content = null ) {
	
	global $partner_modal_content;
	
	extract( 
		shortcode_atts( 
			array(
				'image' => false,
				'button_text' => '',
				'layout' => 'iframe',
				'autoshow' => ''
			), $atts 
		) 
	);
	
	$autoshowHTML = ($autoshow) ? 'data-autoshow="'. (int) $autoshow .'"' : false;
	
	$output = false;
	
	if( $button_text ){
		$output = '
			<div class="modal-instance">
				<a class="btn modal-trigger" href="#">
					<span class="btn__text">'. $button_text .'</span>
				</a>
		';
	}
	
	if( 'iframe' == $layout ){
		
		$output .= '
				<div class="modal-container" '. $autoshowHTML .'>
					<div class="modal-content bg--dark" data-width="80%" data-height="60%">
						'. do_shortcode($content) .'
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
		';
	
	} elseif( 'gradient' == $layout ) {
		
		$output .= '
			<div class="modal-container" '. $autoshowHTML .'>
				<div class="modal-content bg--primary" data-width="40%" data-height="50%">
					<div class="pos-vertical-center clearfix">
						<div class="col-md-8 col-md-offset-1 col-sm-12">
							'. do_shortcode($content) .'
						</div>
					</div>
				</div><!--end of modal-content-->
			</div><!--end of modal-container-->
		';
		
	} elseif( 'standard' == $layout ) {
		
		$output .= '
			<div class="modal-container" '. $autoshowHTML .'>
				<div class="modal-content bg-dark" data-width="40%" data-height="40%">
					'. do_shortcode($content) .'
				</div><!--end of modal-content-->
			</div><!--end of modal-container-->
		';
		
	} else {
		
		$output .= '
				<div class="modal-container" '. $autoshowHTML .'>
					<div class="modal-content bg--dark imagebg" data-width="45%" data-height="40%" data-overlay="4">
						<div class="background-image-holder">
							'. wp_get_attachment_image( $image, 'full' ) .'
						</div>
						<div class="pos-vertical-center clearfix">
							<div class="col-md-8 col-md-offset-1 col-sm-12">
								'. do_shortcode($content) .'
							</div>
						</div>
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
		';
		
	}
	
	if( $button_text ){
		$output .= '</div><!--end of modal instance-->';
	}
	
	return $output;
}
add_shortcode( 'partner_modal', 'ebor_modal_shortcode' );

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
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Modal' , 'partner' ),
		    'base'                    => 'partner_modal',
		    'description'             => esc_html__( 'Create a modal popup', 'partner' ),
		    'as_parent'               => array('except' => 'partner_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params' => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Autoshow Delay Timer", 'partner'),
		    		"param_name" => "autoshow",
		    		'description' => 'Leave blank for no autoshow. Add in timer in milliseconds (numeric only) for autoshow, i.e: 5000'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Button Text", 'partner'),
		    		"param_name" => "button_text"
		    	),
		    	array(
		    		"type" => "attach_image",
		    		"heading" => esc_html__("Modal background image?", 'partner'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Modal Layout", 'partner'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Suitable for "Video Player" block' => 'iframe',
		    			'Standard text modal, image background' => 'image',
		    			'Standard text modal' => 'standard',
		    			'Gradient Background modal, suitable for text' => 'gradient'
		    		)
		    	),
		    )
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_modal_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_modal extends WPBakeryShortCodesContainer {}
}
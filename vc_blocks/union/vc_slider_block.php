<?php 

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'slides' => ''
			), $atts 
		) 
	);

	$slides = explode(',', $slides);
	$output = '<div class="image-slider"><ul class="slides">';
	
	if( is_array($slides) ){
		foreach( $slides as $ID ){
			$output .= '<li>'. wp_get_attachment_image( $ID, 'full' ) .'</li>';	
		}
	}
	
	$output .= '</ul></div>';
	
	return $output;
}
add_shortcode( 'union_slider', 'ebor_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'union-vc-block',
			"name" => __("Image Slider", 'union'),
			"base" => "union_slider",
			"category" => __('Union WP Theme', 'union'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'union'),
					"param_name" => "slides",
					"value" => '',
					"description" => __('Add images to show in the slider', 'union')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );
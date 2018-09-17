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
	
	$output = '<div class="flexslider"><figure class="images"><ul class="slides">';
	
	if( is_array($slides) ){

		foreach( $slides as $ID ){
			$output .= '<li>'. wp_get_attachment_image( $ID, 'full' ) .'</li>';	
		}
		
	}
	
	$output .= '</ul></figure></div>';
	
	return $output;
}
add_shortcode( 'huntington_slider', 'ebor_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'huntington-vc-block',
			"name" => esc_html__("Image Slider", 'huntington'),
			"base" => "huntington_slider",
			"category" => esc_html__('Huntington WP Theme', 'huntington'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__("Slider Images", 'huntington'),
					"param_name" => "slides",
					"value" => '',
					"description" => esc_html__('Add images to show in the slider', 'huntington')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );
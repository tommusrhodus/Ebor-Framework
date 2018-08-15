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
	
	if( is_array($slides) ) :
	
	$output = '<div class="image-slider image-gallery"><ul class="slides">';

		foreach( $slides as $ID ){
			$output .= '<li>'. wp_get_attachment_image( $ID, 'full' ) .'</li>';	
		}

	$output .= '</ul></div>';
	
	else :
	
		$output = '';
		
	endif;
	
	return $output;
}
add_shortcode( 'pivot_slider', 'ebor_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Slider", 'pivot'),
			"base" => "pivot_slider",
			"category" => __('Pivot - Misc', 'pivot'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'pivot'),
					"param_name" => "slides",
					"value" => '',
					"description" => __('Add images to show in the slider', 'pivot')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );
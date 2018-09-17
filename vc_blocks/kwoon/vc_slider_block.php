<?php 

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'slides' => '',
				'layout' => 'slider'
			), $atts 
		) 
	);

	$slides = explode(',', $slides);
	
	if( 'slider' == $layout ){
		$output = '<div class="basic-slider">';
		if( is_array($slides) ){
			foreach( $slides as $ID ){
				$output .= '<div class="item">'. wp_get_attachment_image( $ID, 'full' ) .'</div>';	
			}
		}
		$output .= '</div>';
	} else {
		$output = '<div class="basic-carousel">';
		if( is_array($slides) ){
			$i = 0;
			foreach( $slides as $ID ){
				$i++;
				$output .= '<div class="item wow fadeIn" data-wow-duration="0.5s" data-wow-delay="'. (0.3 * $i) .'s">'. wp_get_attachment_image( $ID, 'full' ) .'</div>';	
			}
		}
		$output .= '</div>';
	}
	
	return $output;
}
add_shortcode( 'kwoon_slider', 'ebor_slider_shortcode' );

/**
 * The VC Functions
 */
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Basic Image Slider", 'kwoon'),
			"base" => "kwoon_slider",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'kwoon'),
					"param_name" => "slides",
					"value" => '',
					"description" => __('Add images to show in the slider', 'kwoon')
				),
				array(
					"type" => "dropdown",
					"heading" => __("Slider Layout", 'kwoon'),
					"param_name" => "layout",
					"value" => array(
						'Slider (1 image per slide)' => 'slider',
						'Carousel (3 images per slide)' => 'carousel'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );
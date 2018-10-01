<?php 

/**
 * The Shortcode
 */
function ebor_button_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'link' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="btn-wrap">
	    			<a class="btn btn-uber btn-uber-color" href="'. esc_url($link) .'">'. htmlspecialchars_decode($title) .'</a>
			   </div>';
	return $output;
}
add_shortcode( 'uber_button', 'ebor_button_shortcode' );

/**
 * The VC Functions
 */
function ebor_button_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Big Button", 'uber'),
			'description' => __('Adds a chunky button to the page', 'uber'),
			"base" => "uber_button",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'uber'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button URL", 'uber'),
					"param_name" => "link"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_button_shortcode_vc' );
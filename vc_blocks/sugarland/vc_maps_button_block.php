<?php 

/**
 * The Shortcode
 */
function ebor_map_button_shortcode( $atts, $content = null ) {
	
	extract( 
		shortcode_atts( 
			array(
				'url'   => 'http://maps.google.com',
				'title' => 'Google Maps'
			), $atts 
		) 
	);
	
	$output = '
		<div class="text-center google-maps-button">
			<a href="'. esc_url($url) .'" class="round-button" target="_blank">
				<i class="fa fa-map-marker"></i>
				<div class="circle-anim"></div>
			</a>
			<p class="small below-button">
				<i class="fa fa-external-link"></i> 
				'. $title .'
			</p>
		</div>
	';
	
	return $output;
	
}
add_shortcode( 'sugarland_map_button', 'ebor_map_button_shortcode' );

/**
 * The VC Functions
 */
function ebor_map_button_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'sugarland-vc-block',
			"name" => esc_html__("Google Maps Button", 'sugarland'),
			"base" => "sugarland_map_button",
			"category" => esc_html__('sugarland WP Theme', 'sugarland'),
			'description' => 'Google maps button with animated hover',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'sugarland'),
					"param_name" => "url",
					'value' => 'http://maps.google.com'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'sugarland'),
					"param_name" => "title",
					'value' => 'Google Maps',
					'holder' => 'div'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_map_button_shortcode_vc' );
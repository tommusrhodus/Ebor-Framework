<?php 

/**
 * The Shortcode
 */
function ebor_counter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'to' => '1000'
			), $atts 
		) 
	);
	
	$output = '<span class="counter">'. $to .'</span>'. wpautop(do_shortcode(htmlspecialchars_decode($content)));
	
	return $output;
}
add_shortcode( 'foundry_counter', 'ebor_counter_shortcode' );

/**
 * The VC Functions
 */
function ebor_counter_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Fact Counter", 'foundry'),
			"base" => "foundry_counter",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("To Value", 'foundry'),
					"param_name" => "to",
					'value' => '1000'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_counter_shortcode_vc' );
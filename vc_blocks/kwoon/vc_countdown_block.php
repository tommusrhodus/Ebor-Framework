<?php 

/**
 * The Shortcode
 */
function ebor_countdown_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'amount' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="countdown" data-date="'. $amount .'" style=""></div>';
	return $output;
}
add_shortcode( 'kwoon_countdown_block', 'ebor_countdown_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_countdown_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Countdown Timer", 'kwoon'),
			"base" => "kwoon_countdown_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'A Date Countdown.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Countdown Date", 'kwoon'),
					"param_name" => "amount",
					'description' => 'Format as: 2017-01-01 00:00:00',
					'value' => '2017-01-01 00:00:00'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_countdown_block_shortcode_vc' );
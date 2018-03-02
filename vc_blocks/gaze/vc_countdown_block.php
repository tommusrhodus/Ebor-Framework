<?php 

/**
 * The Shortcode
 */
function ebor_countdown_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '2019/01/01',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<div id="countdown" data-end-date="'. $title .'" class="mb-60 mt-50 text-center '. $custom_css_class .'"></div>';

	return $output;
}
add_shortcode( 'gaze_countdown_block', 'ebor_countdown_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_countdown_block_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Countdown", 'gaze' ),
			"base"        => "gaze_countdown_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Countdown timer to a specific day',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div',
					'value'      => '2019/01/01',
					'description'=> 'Enter a year/month/day value only, e.g: 2019/12/25'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_countdown_block_shortcode_vc' );
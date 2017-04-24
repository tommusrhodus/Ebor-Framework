<?php 

/**
 * The Shortcode
 */
function ebor_countdown_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro' => '03/13/2018',
				'text' => 'Timer Done',
				'custom_css_class' => '',
				'size' => 'h3',
				'days' => 'days'
			), $atts 
		) 
	);
	
	$output = '<span class="'. $size .' countdown '. esc_attr($custom_css_class) .'" data-days-text="'. esc_attr($days) .'" data-date="'. $intro .'" data-date-fallback="'. $text .'"></span>';
	return $output;
}
add_shortcode( 'stack_countdown', 'ebor_countdown_shortcode' );

/**
 * The VC Functions
 */
function ebor_countdown_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Countdown Timer", 'stackwordpresstheme'),
			"base" => "stack_countdown",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Date", 'stackwordpresstheme'),
					"param_name" => "intro",
					"description" => 'Date to count to, formatted /MM/DD/YYYY',
					'value' => '03/13/2018'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'days' text", 'stackwordpresstheme'),
					"param_name" => "days",
					"description" => '"Days" text for your countdown.',
					'value' => 'days'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Fallback text", 'stackwordpresstheme'),
					"param_name" => "text",
					"description" => 'Fallback text, for when countdown is finished.',
					'value' => 'Timer Done'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Heading Size", 'stackwordpresstheme'),
					"param_name" => "size",
					"description" => 'Heading size, h1 (biggest) to h6 (smallest) e.g: h2',
					'value' => 'h3'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_countdown_shortcode_vc' );
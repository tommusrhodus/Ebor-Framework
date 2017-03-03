<?php 

/**
 * The Shortcode
 */
function ebor_instagram_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'username' => '',
				'amount' => '3',
				'grid' => '3',
				'layout' => 'gaps',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="instafeed '. $layout.' '. esc_attr($custom_css_class) .'" data-user-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'" data-grid="'. esc_attr($grid) .'"></div>';
	

	return $output;
}
add_shortcode( 'stack_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Instagram Feed", 'stackwordpresstheme'),
			"base" => "stack_instagram",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram Username", 'stackwordpresstheme'),
					"param_name" => "username",
					"description" => "Plain text, do not use @",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Margin Grid' => 'gaps',
						'Gapless Grid' => 'instafeed--gapless'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Load how many images? Numeric Only.", 'stackwordpresstheme'),
					"param_name" => "amount",
					'value' => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Images Per Row. Numeric Only", 'stackwordpresstheme'),
					"param_name" => "grid",
					'value' => '3',
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
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );
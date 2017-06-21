<?php 

/**
 * The Shortcode
 */
function ebor_service_column_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'colour' => 'light'
			), $atts 
		) 
	);
	
	$output = '
		<div class="service-alt '. esc_attr($colour) .'">
			<div class="inner">
				<i class="'. esc_attr($icon) .'"></i>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'waves_service_column', 'ebor_service_column_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_column_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'waves-vc-block',
			"name" => esc_html__("Service Column", 'waves'),
			"base" => "waves_service_column",
			"category" => esc_html__('waves WP Theme', 'waves'),
			'description' => 'Add a service column with icon',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'waves'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'waves'),
					"param_name" => "icon",
					"value" => array_keys(ebor_get_icons())
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Class", 'waves'),
					"param_name" => "colour",
					'value' => 'light',
					'description' => 'Add light for white background, dark for black background, can be used for custom classes if desired.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_column_shortcode_vc' );
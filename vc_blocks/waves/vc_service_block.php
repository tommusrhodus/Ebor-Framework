<?php 

/**
 * The Shortcode
 */
function ebor_service_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="service-3">
			<i class="'. esc_attr($icon) .'"></i>
			<div class="service-3-text">
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'waves_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'waves-vc-block',
			"name" => esc_html__("Service", 'waves'),
			"base" => "waves_service",
			"category" => esc_html__('waves WP Theme', 'waves'),
			'description' => 'Add a service block of text with a side icon,',
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
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc' );
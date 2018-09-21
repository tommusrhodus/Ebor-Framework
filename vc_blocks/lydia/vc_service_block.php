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
		<div class="feature">
			<div class="icon"> 
				<i class="'. esc_attr($icon) .' icn"></i> 
			</div>
			'. do_shortcode(htmlspecialchars_decode($content)) .'
		</div>
	';
	
	return $output;
}
add_shortcode( 'lydia_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Service Box", 'lydia'),
			"base" => "lydia_service",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'Add a service block of text with a side icon,',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'lydia'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'lydia'),
					"param_name" => "icon",
					"value" => array_keys(ebor_get_icons())
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc' );
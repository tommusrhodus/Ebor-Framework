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
				<i class="'. esc_attr($icon) .'"></i> 
			</div>
			'. do_shortcode(htmlspecialchars_decode($content)) .'
		</div>
	';
	
	return $output;
}
add_shortcode( 'malory_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	
	$icons = array_keys(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'malory-vc-block',
			"name" => esc_html__("Service Box", 'malory'),
			"base" => "malory_service",
			"category" => esc_html__('malory WP Theme', 'malory'),
			'description' => 'Add a service block of text with a side icon,',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'malory'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'malory'),
					"param_name" => "icon",
					"value" => $icons
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc' );
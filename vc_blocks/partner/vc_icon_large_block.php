<?php 

/**
 * The Shortcode
 */
function ebor_icon_large_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<h2 class="text-center">
			<i class="icon--lg '. esc_attr($icon) .'"></i>
		</h2>
	';
	
	return $output;
}
add_shortcode( 'partner_icon_large', 'ebor_icon_large_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_large_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Icon Large", 'partner'),
			"base" => "partner_icon_large",
			"category" => esc_html__('partner WP Theme', 'partner'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Click an Icon to choose", 'partner'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_large_shortcode_vc' );
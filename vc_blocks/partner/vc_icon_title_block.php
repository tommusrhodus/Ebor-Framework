<?php 

/**
 * The Shortcode
 */
function ebor_icon_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'title2' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="icon-title">
			<span class="h6">'. htmlspecialchars_decode($title) .'</span>
			<i class="'. esc_attr($icon) .' icon--partner"></i>
			<span class="h6">'. htmlspecialchars_decode($title2) .'</span>
		</div>
	';
	
	return $output;
}
add_shortcode( 'partner_icon_title', 'ebor_icon_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_title_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Icon Title", 'partner'),
			"base" => "partner_icon_title",
			"category" => esc_html__('partner WP Theme', 'partner'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Click an Icon to choose", 'partner'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title (1st half)", 'partner'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title (2nd half)", 'partner'),
					"param_name" => "title2",
					'holder' => 'div',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_title_shortcode_vc' );
<?php 

/**
 * The Shortcode
 */
function ebor_icon_small_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="boxed-holder section-snippet-benefits">
			<div class="boxed boxed--border text-center">
				<i class="icon--partner icon--sm '. esc_attr($icon) .'"></i>
				<span>'. $title .'</span>
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'partner_icon_small', 'ebor_icon_small_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_small_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Icon Small", 'partner'),
			"base" => "partner_icon_small",
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
					"heading" => esc_html__("Title", 'partner'),
					"param_name" => "title",
					'holder' => 'div'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_small_shortcode_vc' );
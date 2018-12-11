<?php 

/**
 * The Shortcode
 */
function ebor_side_icon_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output ='<div class="pricing-5 feature">
				<i class="icon icon-'. str_replace('icon-', '', $icon) .'"></i>
				<div class="inner">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			  </div>';
	
	return $output;
}
add_shortcode( 'launchkit_side_icon', 'ebor_side_icon_shortcode' );

/**
 * The VC Functions
 */
function ebor_side_icon_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Side Icon", 'launchkit'),
			'description' => 'Block with text and icon on left.',
			"base" => "launchkit_side_icon",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Click an Icon to choose", 'launchkit'),
					"param_name" => "icon",
					"value" => array_values(ebor_get_icons()),
					'holder' => 'div',
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'launchkit'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_side_icon_shortcode_vc' );
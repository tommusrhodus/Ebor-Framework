<?php 

/**
 * The Shortcode
 */
function ebor_colour_feature_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'layout' => 'big-icon'
			), $atts 
		) 
	);
	
	$output = '
		<div class="features features-15">
			<div class="text-center feature">
				<i class="icon-'. str_replace('icon-', '', $icon) .'"></i>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'launchkit_colour_feature', 'ebor_colour_feature_shortcode' );

/**
 * The VC Functions
 */
function ebor_colour_feature_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Feature Block", 'launchkit'),
			"base" => "launchkit_colour_feature",
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
					"value" => '',
					'holder' => 'div'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_colour_feature_shortcode_vc' );
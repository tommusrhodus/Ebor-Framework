<?php 

/**
 * The Shortcode
 */
function ebor_icon_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'layout' => 'small'
			), $atts 
		) 
	);
	
	if( 'small' == $layout ){
		
		$output = '<div class="features-6"><div class="feature text-center"><i class="icon icon-'. str_replace('icon-', '', $icon) .'"></i>'. do_shortcode(htmlspecialchars_decode($content)) .'</div></div>';
	
	} else {
	
		$output = '<div class="features features-3">
			<div class="text-center feature">
				<i class="icon icon-'. str_replace('icon-', '', $icon) .'"></i>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div>';
	
	}
	
	
	return $output;
}
add_shortcode( 'launchkit_icon', 'ebor_icon_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Icon & Text", 'launchkit'),
			"base" => "launchkit_icon",
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
				array(
					"type" => "dropdown",
					"heading" => __("Icon Layout", 'launchkit'),
					"param_name" => "layout",
					"value" => array_flip(array(
						'small' => 'Small',
						'large' => 'Large'
					))
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_shortcode_vc' );
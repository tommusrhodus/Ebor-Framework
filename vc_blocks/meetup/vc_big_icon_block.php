<?php 

/**
 * The Shortcode
 */
function ebor_big_icon_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
			), $atts 
		) 
	);
		
	if($icon == 'none')
		$icon = false;
	
	$output = '<div class="subscribe-2">';
	
	if( $icon )
		$output .= '<i class="icon '. $icon .'"></i>';
		
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'meetup_big_icon', 'ebor_big_icon_shortcode' );

/**
 * The VC Functions
 */
function ebor_big_icon_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Big Icon", 'meetup'),
			"base" => "meetup_big_icon",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Show an Icon?", 'meetup'),
					"param_name" => "icon",
					"value" => array_values(ebor_get_icons()),
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_big_icon_shortcode_vc' );
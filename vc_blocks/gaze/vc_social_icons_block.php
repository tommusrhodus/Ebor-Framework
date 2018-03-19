<?php 

/**
 * The Shortcode
 * 
 */
function ebor_footer_social_icons_shortcode( $atts ) {
	
	$output = '<div class="social-icons rounded transparent large mt-20">';
	
		for( $i = 1; $i < 6; $i++ ){
			if( $url = get_option("footer_social_url_$i") ) {
				$output .= '<a href="' . esc_url( $url ) . '" target="_blank"><i class="fa ' . esc_attr( get_option( "footer_social_icon_$i" ) ) . '"></i></a>';
			}
		} 

	$output .= '</div>';
	
	return $output;
	
}
add_shortcode( 'gaze_footer_social_icons', 'ebor_footer_social_icons_shortcode' );

/**
 * The VC Functions
 */
function ebor_footer_social_icons_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'gaze-vc-block',
			"name" => esc_html__("Social Icons", 'gaze'),
			"base" => "gaze_footer_social_icons",
			"category" => esc_html__('Gaze WP Theme', 'gaze'),
			'description' => 'Show the social icons set by your footer settings',
			"params" => array(
				array(
					"type" => "",
					"heading" => esc_html__("Notice", 'gaze'),
					"param_name" => "custom_css_class",
					"description" => 'This blocks uses the social icons settings in "appearance => customise => footer settings" to populate itself.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_footer_social_icons_shortcode_vc');

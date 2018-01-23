<?php 

/**
 * The Shortcode
 */
function ebor_footer_social_icons_shortcode( $atts ) {
	
	ob_start();
	
	get_template_part( 'inc/content-footer', 'social-icons' );
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
	
}
add_shortcode( 'creatink_footer_social_icons', 'ebor_footer_social_icons_shortcode' );

/**
 * The VC Functions
 */
function ebor_footer_social_icons_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Social Icons", 'creatink'),
			"base" => "creatink_footer_social_icons",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'Show the social icons set by your footer settings',
			"params" => array(
				array(
					"type" => "",
					"heading" => esc_html__("Notice", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => 'This blocks uses the social icons settings in "apperance => customise => footer settings" to populate itself.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_footer_social_icons_shortcode_vc');

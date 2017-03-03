<?php 

/**
 * The Shortcode
 */
function ebor_section_navigator_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<section class="'. $custom_css_class .' page-navigator"><ul></ul></section>';

	return $output;
}
add_shortcode( 'stack_section_navigator', 'ebor_section_navigator_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_navigator_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Section Navigator", 'stackwordpresstheme'),
			"base" => "stack_section_navigator",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_navigator_shortcode_vc' );
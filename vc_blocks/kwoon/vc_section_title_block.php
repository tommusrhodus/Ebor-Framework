<?php 

/**
 * The Shortcode
 */
function ebor_section_title_shortcode( $atts, $content = null ) {
	$output = '<h3 class="main-title text-center">'. wp_kses(htmlspecialchars_decode($content), ebor_allowed_tags()) .'</h3>';
	return $output;
}
add_shortcode( 'kwoon_section_title', 'ebor_section_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Section Title", 'kwoon'),
			"base" => "kwoon_section_title",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Title", 'kwoon'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_shortcode_vc' );
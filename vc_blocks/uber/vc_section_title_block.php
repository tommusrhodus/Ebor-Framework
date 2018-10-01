<?php 

/**
 * The Shortcode
 */
function ebor_section_title_shortcode( $atts, $content = null ) {	
	$output = '<p class="minimal-caps font4 black add-top-quarter text-center">'. htmlspecialchars_decode(trim(strip_tags($content))) .'</p><div class="inner-spacer color-bg ebor-add-bottom"></div>';
	return $output;
}
add_shortcode( 'uber_section_title', 'ebor_section_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Section Title", 'uber'),
			'description' => __('Adds a section title of formatted text', 'uber'),
			"base" => "uber_section_title",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'uber'),
					"param_name" => "content",
					'holder' => 'div'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_shortcode_vc' );
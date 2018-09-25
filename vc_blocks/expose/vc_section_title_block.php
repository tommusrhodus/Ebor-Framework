<?php 

/**
 * The Shortcode
 */
function ebor_section_title_shortcode( $atts, $content = null ) {
	
	extract( 
		shortcode_atts( 
			array(
				'colour' => false
			), $atts 
		) 
	);
	
	$output = '<div class="col-sm-10 col-sm-offset-1 text-center">';
	$output .= '<h1 class="super-heading grey font2"><span style="color: '. esc_attr($colour) .' !important">'. trim(strip_tags(htmlspecialchars_decode($content))) .'</span></h1>';
	$output .= '<div class="separator"><img alt="expose-seperator" src="'. EBOR_THEME_DIRECTORY .'style/images/separator/01-white.png"/></div></div><div class="clearfix"></div>';
	return $output;
}
add_shortcode( 'expose_section_title', 'ebor_section_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Section Title", 'expose'),
			"base" => "expose_section_title",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Heading Colour", 'expose'),
					"param_name" => "colour",
					"value" => ''
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_shortcode_vc' );
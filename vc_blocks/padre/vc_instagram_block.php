<?php 

/**
 * The Shortcode
 */
function ebor_instagram_shortcode( $atts, $content = null ) {
	$output = '<div class="instafeed grid-gallery" data-user-name="'. esc_attr(trim(strip_tags($content))) . '"><ul></ul></div>';
	return $output;
}
add_shortcode( 'padre_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'padre-vc-block',
			"name" => esc_html__("Instagram Feed", 'padre'),
			"base" => "padre_instagram",
			"category" => esc_html__('padre WP Theme', 'padre'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram Username", 'padre'),
					"param_name" => "content",
					"description" => 'e.g: walkdontruncafe'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );
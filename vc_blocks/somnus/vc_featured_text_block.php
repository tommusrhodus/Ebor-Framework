<?php 

/**
 * The Shortcode
 */
function somnus_featured_text_shortcode( $atts, $content = null ) {
	$output = '<div class="feature bg-secondary pt64 pb64 pt-xs-32 pb-xs-32 mb0 clearfix">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>';
	return $output;
}
add_shortcode( 'somnus_featured_text', 'somnus_featured_text_shortcode' );

/**
 * The VC Functions
 */
function somnus_featured_text_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Featured Text", 'somnus'),
			"base" => "somnus_featured_text",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'somnus'),
					"param_name" => "content",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'somnus_featured_text_shortcode_vc' );
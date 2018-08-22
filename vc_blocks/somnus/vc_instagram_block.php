<?php 

/**
 * The Shortcode
 */
function somnus_instagram_shortcode( $atts, $content = null ) {

	$output = '
		<div class="instafeed grid-gallery" data-user-name="'. esc_attr(trim(strip_tags($content))). '">
		    <ul></ul>
		</div>
	';
	
	return $output;
}
add_shortcode( 'somnus_instagram', 'somnus_instagram_shortcode' );

/**
 * The VC Functions
 */
function somnus_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'somnus-vc-block',
			"name" => esc_html__("Instagram Feed", 'somnus'),
			"base" => "somnus_instagram",
			"category" => esc_html__('Somnus WP Theme', 'somnus'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram Username", 'somnus'),
					"param_name" => "content",
					"description" => 'e.g: lornajaneactive'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'somnus_instagram_shortcode_vc' );
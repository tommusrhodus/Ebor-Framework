<?php 

/**
 * The Shortcode
 */
function ebor_call_to_action_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'button_text' => '',
				'button_link' => ''
			), $atts 
		) 
	);

	$output = '<article class="text-center call-to-action">';
	
	if($title)
		$output .= '<h6 class="dark font3">'. htmlspecialchars_decode($title) .'</h6>' . ebor_expose_seperator(1);
		
	if($subtitle)
		$output .= '<h2 class="dark font2">'. htmlspecialchars_decode($subtitle) .'</h2>';
					
	if($button_text || $button_link)
		$output .= '<div class="add-bottom-quarter"><a class="btn-expose btn-expose-dark" href="'. esc_url($button_link) .'">'. htmlspecialchars_decode($button_text) .'</a></div>';
		
	$output .= '</article>';
	
	return $output;
}
add_shortcode( 'expose_call_to_action', 'ebor_call_to_action_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Call To Action", 'expose'),
			"base" => "expose_call_to_action",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'expose'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'expose'),
					"param_name" => "subtitle",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'expose'),
					"param_name" => "button_text",
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link", 'expose'),
					"param_name" => "button_link",
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_shortcode_vc' );
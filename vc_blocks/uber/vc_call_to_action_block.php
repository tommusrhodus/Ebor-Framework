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

	$output = '<div class="row"><article class="col-md-10 col-md-offset-1 text-center">';
	
	if($title)
		$output .= '<h1 class="minimal-caps white font4thin">'. htmlspecialchars_decode($title) .'</h1>';
					
	if($button_text || $button_link)
		$output .= '<div class="button-wrap"><a class="btn btn-uber btn-uber-color" href="'. esc_url($button_link) .'">'. htmlspecialchars_decode($button_text) .'</a></div>';
		
	$output .= '</article></div>';
	
	return $output;
}
add_shortcode( 'uber_call_to_action', 'ebor_call_to_action_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("Call To Action", 'uber'),
			'description' => __('Adds a call to action section to the page', 'uber'),
			"base" => "uber_call_to_action",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'uber'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'uber'),
					"param_name" => "button_text",
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link", 'uber'),
					"param_name" => "button_link",
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_shortcode_vc' );
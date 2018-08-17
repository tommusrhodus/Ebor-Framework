<?php 

/**
 * The Shortcode
 */
function ebor_text_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
			), $atts 
		) 
	);
		
	if($icon == 'none')
		$icon = false;
	
	$output = '<div class="topic">';
	
	if( $icon )
		$output .= '<i class="'. $icon .'"></i>';
		
	$output .= wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
	
	return $output;
}
add_shortcode( 'meetup_text', 'ebor_text_shortcode' );

/**
 * The VC Functions
 */
function ebor_text_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Text & Icon", 'meetup'),
			"base" => "meetup_text",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Show an Icon?", 'meetup'),
					"param_name" => "icon",
					"value" => array_values(ebor_get_icons()),
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'meetup'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_text_shortcode_vc' );
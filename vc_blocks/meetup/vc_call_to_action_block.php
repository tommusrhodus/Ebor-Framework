<?php 

/**
 * The Shortcode
 */
function ebor_call_to_action_shortcode( $atts, $content = null ) {
	$output = '<div class="text-center call-to-action">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	return $output;
}
add_shortcode( 'meetup_call_to_action', 'ebor_call_to_action_shortcode' );

/**
 * The VC Functions
 */
function ebor_call_to_action_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Call To Action", 'meetup'),
			"base" => "meetup_call_to_action",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'meetup'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_call_to_action_shortcode_vc' );
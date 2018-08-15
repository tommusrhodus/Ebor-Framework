<?php 

/**
 * The Shortcode
 */
function ebor_twitter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'user' => '',
			), $atts 
		) 
	);
	
	$output = '<div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
					<i class="icon icon-jumbo social_twitter"></i>
					<div id="tweets" data-widget-id="'. $title .'" data-user-name="'. esc_attr($user) .'"></div>
					'. wpautop(do_shortcode(wp_specialchars_decode($content, ENT_QUOTES))) .'
				</div>
			</div>';
	
	return $output;
}
add_shortcode( 'pivot_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Twitter Feed", 'pivot'),
			"base" => "pivot_twitter",
			"category" => __('Pivot - Social', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Twitter Username", 'pivot'),
					"param_name" => "user",
					"description" => "e.g: tommusrhodus <code>Do not use @, plain text username only!</code>",
				),
				array(
					"type" => "textfield",
					"heading" => __("Twitter User ID (Not Required)", 'pivot'),
					"param_name" => "title",
					"description" => "DEPRECATED: Will continue to work for existing users, new users please use the username field above.",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content Under Feed", 'pivot'),
					"param_name" => "content",
					"value" => '',
					"description" => '',
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_twitter_shortcode_vc' );
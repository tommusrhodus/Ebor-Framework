<?php 

/**
 * The Shortcode
 */
function ebor_twitter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'username' => '',
				'layout' => 'carousel',
				'amount' => '3',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'carousel' == $layout ){
		
		$output = '<div class="tweets-feed slider text-center '. esc_attr($custom_css_class) .'" data-feed-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'" data-paging="true"></div>';
		
	} elseif( 'minimal' == $layout ) {
		
		$output = '<div class="'. esc_attr($custom_css_class) .' tweets-feed tweets-feed-2" data-feed-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'"></div>';
		
	} else {
		
		$output = '<div class="tweets-feed tweets-feed-1 bg--secondary '. esc_attr($custom_css_class) .'" data-feed-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'"></div>';
			
	}
	
	return $output;
}
add_shortcode( 'stack_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Twitter Feed", 'stackwordpresstheme'),
			"base" => "stack_twitter",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter Username", 'stackwordpresstheme'),
					"param_name" => "username",
					"description" => "Plain text, do not use @",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Twitter Slider' => 'carousel',
						'Tweets List' => 'list',
						'Tweets List Minimal' => 'minimal'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Load how many tweets? Numeric Only.", 'stackwordpresstheme'),
					"param_name" => "amount",
					'value' => '3',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_twitter_shortcode_vc' );
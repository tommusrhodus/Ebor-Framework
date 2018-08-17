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
		<div class="col-md-12">
			<div class="twitter-feed">
				<i class="icon social_twitter text-white"></i>
				<div class="tweets-feed" data-widget-id="'. esc_attr($title) .'"  data-user-name="'. esc_attr($user) .'">=</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</div>
	</div>';
	
	return $output;
}
add_shortcode( 'meetup_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
			"name" => __("Twitter Feed", 'meetup'),
			"base" => "meetup_twitter",
			"category" => __('Meetup - WP Theme', 'meetup'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Twitter Username", 'meetup'),
					"param_name" => "user",
					"description" => "e.g: tommusrhodus <code>Do not use @, plain text username only!</code>",
				),
				array(
					"type" => "textfield",
					"heading" => __("Twitter User ID (Not Required)", 'meetup'),
					"param_name" => "title",
					"description" => "DEPRECATED: Will continue to work for existing users, new users please use the username field above.",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content Under Feed", 'meetup'),
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
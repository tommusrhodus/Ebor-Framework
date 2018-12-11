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
	
	$output = '<div class="social social-2">
			<div class="row">
				<div class="col-sm-12 text-center">
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1 col-sm-12 text-center">
					<div class="twitter-feed">
						<div class="tweets-feed tweets-slider" data-widget-id="'. esc_attr($title) .'" data-user-name="'. esc_attr($user) .'">
					
						</div>
					</div>
				</div>
			</div>
		</div>';
	
	return $output;
}
add_shortcode( 'launchkit_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Twitter Feed", 'launchkit'),
			"base" => "launchkit_twitter",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Twitter Username", 'launchkit'),
					"param_name" => "user",
					"description" => "e.g: tommusrhodus <code>Do not use @, plain text username only!</code>",
				),
				array(
					"type" => "textfield",
					"heading" => __("Twitter User ID (Not Required)", 'launchkit'),
					"param_name" => "title",
					"description" => "DEPRECATED: Will continue to work for existing users, new users please use the username field above.",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content Above Feed", 'launchkit'),
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
<?php 

/**
 * The Shortcode
 */
function ebor_twitter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'  => '',
				'layout' => 'carousel',
				'amount' => '3',
				'user'   => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="row twitter-slider">
			<div class="col-md-4 col-md-offset-4 text-center mb-40">
				<i class="fa fa-twitter twitter-icon"></i>
			</div>
			<div id="tweets" data-user-name="'. $user .'" data-max-tweets="'. $amount .'" class="col-md-12"></div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'gaze_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon"     => 'gaze-vc-block',
			"name"     => esc_html__("Twitter Feed", 'gaze'),
			"base"     => "gaze_twitter",
			"category" => esc_html__('Gaze WP Theme', 'gaze'),
			"params"   => array(
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Twitter Username", 'gaze'),
					"param_name"  => "user",
					"description" => "e.g: tommusrhodus <code>Do not use @, plain text username only!</code>",
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Load how many tweets? Numeric Only.", 'gaze'),
					"param_name" => "amount",
					'value'      => '3',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_twitter_shortcode_vc' );
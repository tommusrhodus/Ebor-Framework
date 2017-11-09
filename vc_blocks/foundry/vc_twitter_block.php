<?php 

/**
 * The Shortcode
 */
function ebor_twitter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'layout' => 'carousel',
				'amount' => '5',
				'user' => ''
			), $atts 
		) 
	);
	
	if( 'carousel' == $layout ){
		
		$output = '
			<div class="text-center">
			    <i class="ti-twitter-alt icon icon-lg color-primary mb40 mb-xs-24"></i>
			    <div class="twitter-feed tweets-slider large">
			        <div class="tweets-feed" data-widget-id="'. esc_attr($title) .'" data-amount="'. esc_attr($amount) .'" data-user-name="'. esc_attr($user) .'">
			        </div>
			    </div>
			</div>
		';
		
	} else {
		
		$output = '
			<div class="row">
				<div class="twitter-feed thirds">
				    <div class="tweets-feed" data-widget-id="'. esc_attr($title) .'" data-amount="'. esc_attr($amount) .'"  data-user-name="'. esc_attr($user) .'">
				    </div>
				</div>
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'foundry_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Twitter Feed", 'foundry'),
			"base" => "foundry_twitter",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Twitter Username", 'foundry'),
					"param_name" => "user",
					"description" => "e.g: tommusrhodus <code>Do not use @, plain text username only!</code>",
				),
				array(
					"type" => "textfield",
					"heading" => __("Twitter User ID (Not Required)", 'foundry'),
					"param_name" => "title",
					"description" => "DEPRECATED: Will continue to work for existing users, new users please use the username field above.",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Twitter Carousel' => 'carousel',
						'Tweets Grid' => 'grid'
					)
				),
				array(
					"type" => "textfield",
					"heading" => __("Load how many tweets? Numeric Only.", 'foundry'),
					"param_name" => "amount",
					'value' => '5',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_twitter_shortcode_vc' );
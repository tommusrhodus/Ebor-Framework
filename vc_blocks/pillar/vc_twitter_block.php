<?php 

/**
 * The Shortcode
 */
function ebor_twitter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'username' => '',
				'layout' => 'carousel',
				'amount' => '5'
			), $atts 
		) 
	);
	
	if( 'carousel' == $layout ){
		
		$output = '
			<div class="twitter-feed twitter-feed-1 twitter-feed--slider text-center">
				<div class="tweets-feed" data-widget-id="'. esc_attr($title) .'" data-user-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'"></div>
			</div>
		';
		
	} elseif( 'carousel-box' == $layout ){
		
		$output = '
			<div class="boxed boxed--lg bg--white text-center">
				<i class="icon icon--sm color--dark socicon-twitter"></i>
				<div class="twitter-feed twitter-feed--slider">
					<div class="tweets-feed" data-widget-id="'. esc_attr($title) .'" data-user-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'"></div>
				</div>
			</div>
		';
		
	} else {
		
		$output = '
			<div class="text-center">
				<i class="icon icon--sm color--dark socicon-twitter"></i>
				<div class="twitter-feed twitter-feed-2">
					<div class="tweets-feed" data-widget-id="'. esc_attr($title) .'" data-user-name="'. esc_attr($username) .'" data-amount="'. esc_attr($amount) .'"></div>
				</div>
			</div>
		';
			
	}
	
	return $output;
}
add_shortcode( 'pillar_twitter', 'ebor_twitter_shortcode' );

/**
 * The VC Functions
 */
function ebor_twitter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
			"name" => esc_html__("Twitter Feed", 'pillar'),
			"base" => "pillar_twitter",
			"category" => esc_html__('pillar WP Theme', 'pillar'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter Username", 'pillar'),
					"param_name" => "username",
					"description" => "Plain text, do not use @",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter User ID", 'pillar'),
					"param_name" => "title",
					"description" => "Not Required: Legacy users only.",
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'pillar'),
					"param_name" => "layout",
					"value" => array(
						'Twitter Carousel' => 'carousel',
						'Twitter Carousel Box' => 'carousel-box',
						'Tweets List' => 'list'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Load how many tweets? Numeric Only.", 'pillar'),
					"param_name" => "amount",
					'value' => '5',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_twitter_shortcode_vc' );
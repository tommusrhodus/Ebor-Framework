<?php 

/**
 * The Shortcode
 */
function ebor_social_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'twitter_text' => 'Follow On Twitter',
				'facebook_text' => 'Follow On Facebook',
				'dribbble_text' => 'Follow On Dribbble',
				'tumblr_text' => 'Follow On Tumblr',
				'twitter_url' => '',
				'facebook_url' => '',
				'dribbble_url' => '',
				'tumblr_url' => ''
			), $atts 
		) 
	);
	
	$text = array(
		'twitter' => $twitter_text,
		'facebook' => $facebook_text,
		'dribbble' => $dribbble_text,
		'tumblr' => $tumblr_text,
	);
	
	$urls = array(
		'twitter' => $twitter_url,
		'facebook' => $facebook_url,
		'dribbble' => $dribbble_url,
		'tumblr' => $tumblr_url,
	);
	
	$urls = array_filter(array_map(NULL, $urls));
	$amount = count($urls);
	
	if(!( 0 == $amount )) :
	$count = 12 / $amount;
	
	$output = '<div class="social-bar">';
	
	foreach( $urls as $key => $url ){
		$output .= '<div class="col-sm-'. $count .' no-pad">
					<a href="'. esc_url($url) .'" target="_blank">
						<div class="link bg-'. $key .'">
							<div class="initial">
								<i class="icon social_'. $key .'"></i>
							</div>
						
							<div class="hover-state">
								<span class="text-white">'. $text[$key] .'</span>
							</div>
						</div>
					</a>
				</div>';
	}
	
	$output .= '</div>';
	
	else : 
		$output = false;
	endif;
	
	return $output;
}
add_shortcode( 'pivot_social', 'ebor_social_shortcode' );

/**
 * The VC Functions
 */
function ebor_social_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Big Social", 'pivot'),
			"base" => "pivot_social",
			"category" => __('Pivot - Social', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Twitter Text", 'pivot'),
					"param_name" => "twitter_text",
					"value" => 'Follow On Twitter',
				),
				array(
					"type" => "textfield",
					"heading" => __("Twitter URL", 'pivot'),
					"param_name" => "twitter_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Facebook Text", 'pivot'),
					"param_name" => "facebook_text",
					"value" => 'Follow On Facebook',
				),
				array(
					"type" => "textfield",
					"heading" => __("Facebook URL", 'pivot'),
					"param_name" => "facebook_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Dribbble Text", 'pivot'),
					"param_name" => "dribbble_text",
					"value" => 'Follow On Dribbble',
				),
				array(
					"type" => "textfield",
					"heading" => __("Dribbble URL", 'pivot'),
					"param_name" => "dribbble_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Tumblr Text", 'pivot'),
					"param_name" => "tumblr_text",
					"value" => 'Follow On Tumblr',
				),
				array(
					"type" => "textfield",
					"heading" => __("Tumblr URL", 'pivot'),
					"param_name" => "tumblr_url",
					"value" => '',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_social_shortcode_vc' );
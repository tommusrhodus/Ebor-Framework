<?php 

/**
 * The Shortcode
 */
function ebor_instagram_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'layout' => 'standard',
				'method' => 'getUserFeed',
				'max' => '12'
			), $atts 
		) 
	);
	
	if( 'standard' == $layout ){
		$output = '<div class="instafeed grid-gallery" data-max="'. esc_attr($max) .'" data-user-name="'. esc_attr($title) .'" data-method="getUserFeed"><ul></ul></div>';
	} elseif( 'full' == $layout ) {
		$output = '<div class="instafeed grid-gallery gapless" data-max="'. esc_attr($max) .'" data-user-name="'. esc_attr($title) .'" data-method="getUserFeed"><ul class="fade-on-hover"></ul></div>';
	} else {
		$output = '
			<div class="row">
			    <div class="col-sm-6">
			        <div class="instafeed grid-gallery mt80 mt-xs-0 col-md-push-2 relative" data-max="'. esc_attr($max) .'" data-user-name="'. esc_attr($title) .'" data-method="getUserFeed">
			            <ul></ul>
			        </div>
			    </div>
			    <div class="col-sm-6">
			        <div class="feature bordered text-center">
			        	'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			        </div>
			    </div>
			</div>
		';
	}
	
	return $output;
}
add_shortcode( 'foundry_instagram', 'ebor_instagram_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Instagram Feed", 'foundry'),
			"base" => "foundry_instagram",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Instagram Username", 'foundry'),
					"param_name" => "title",
					"description" => 'e.g: funsizeco<br /><code>Please note: Due to the Instagram API change, we can no longer serve images from a hashtag, only a user. Please configure your Instagram settings in "appearance => customise"</code>',
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content (Restaurant Layout Only)", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Layout Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Standard Grid' => 'standard',
						'Restaurant Grid' => 'restaurant',
						'FullWidth' => 'full'
					)
				),
				array(
					"type" => "textfield",
					"heading" => __("Load how many images? Numeric Only.", 'foundry'),
					"param_name" => "max",
					'value' => '12',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_shortcode_vc' );
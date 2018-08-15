<?php 

/**
 * The Shortcode
 */
function ebor_video_embed_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'link' => '',
				'webm' => '',
				'mpfour' => '',
				'ogv' => '',
			), $atts 
		) 
	);
	
	if( $link ){
		
		$output =  wp_oembed_get( esc_url( $link ) );
		
	} else {
		
		$output = '<div class="inline-video-wrapper">
						<video controls="">
							<source src="'. $webm .'" type="video/webm">
							<source src="'. $mpfour .'" type="video/mp4">
							<source src="'. $ogv .'" type="video/ogg">
						</video>
					</div>';
	}
	
	return $output;
}
add_shortcode( 'pivot_video_embed', 'ebor_video_embed_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_embed_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Video Embed", 'pivot'),
			"base" => "pivot_video_embed",
			"category" => __('Pivot - Misc', 'pivot'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Video Embed Link", 'pivot'),
					"param_name" => "link",
					"value" => '',
					"description" => __('<a href="http://codex.wordpress.org/Embeds" target="_blank">List of Acceptable Services Here</a>', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video, .webm extension", 'pivot'),
					"param_name" => "webm",
					"value" => '',
					"description" => __('Please fill all extensions', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video, .mp4 extension", 'pivot'),
					"param_name" => "mpfour",
					"value" => '',
					"description" => __('Please fill all extensions', 'pivot')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video, .ogv extension", 'pivot'),
					"param_name" => "ogv",
					"value" => '',
					"description" => __('Please fill all extensions', 'pivot')
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_embed_shortcode_vc' );
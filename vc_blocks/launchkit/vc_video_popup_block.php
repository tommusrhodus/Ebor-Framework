<?php 

/**
 * The Shortcode
 */
function ebor_video_popup_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'video' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') );
	
	$output = '<div class="local-video-container">';
	
	if($image)
		$output .= '<div class="background-image-holder">'. $image .'</div>';
		
	$output .= '<video controls="">
			<source src="'. esc_url($webm) .'" type="video/webm">
			<source src="'. esc_url($mpfour) .'" type="video/mp4">
			<source src="'. esc_url($ogv) .'" type="video/ogg">	
		</video>
		<div class="play-button"></div>
	</div>';	
	
	return $output;
}
add_shortcode( 'launchkit_video_popup', 'ebor_video_popup_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_popup_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Video Popup", 'launchkit'),
			"base" => "launchkit_video_popup",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Video Placeholder Image", 'launchkit'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .webm extension", 'launchkit'),
					"param_name" => "webm",
					"value" => '',
					"description" => __('Please fill all extensions', 'launchkit')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .mp4 extension", 'launchkit'),
					"param_name" => "mpfour",
					"value" => '',
					"description" => __('Please fill all extensions', 'launchkit')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .ogv extension", 'launchkit'),
					"param_name" => "ogv",
					"value" => '',
					"description" => __('Please fill all extensions', 'launchkit')
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_popup_shortcode_vc' );
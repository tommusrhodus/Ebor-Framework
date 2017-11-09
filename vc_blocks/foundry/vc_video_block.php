<?php 

/**
 * The Shortcode
 */
function ebor_video_popup_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'local',
				'image' => '',
				'video' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
				'embed' => ''
			), $atts 
		) 
	);
	
	if( 'local' == $layout ){
		$output = '
			<div class="local-video-container">
			    <div class="background-image-holder">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			    </div>
			    <video controls="">
			        <source src="'. esc_url($webm) .'" type="video/webm">
			        <source src="'. esc_url($mpfour) .'" type="video/mp4">
			        <source src="'. esc_url($ogv) .'" type="video/ogg">	
			    </video>
			    <div class="play-button"></div>
			</div>
		';
	} elseif( 'embed' == $layout ){
		$output = '
			<div class="embed-video-container embed-responsive embed-responsive-16by9">
				'. wp_oembed_get($embed, array('class' => 'embed-responsive-item')) .'
			</div>
		';
	} elseif( 'local-popup' == $layout ){
		$output = '
			<div class="modal-video-container mb16 text-center">
			    <div class="play-button large dark inline"></div>
			    <div class="modal-video">
			        <i class="ti-close close-iframe"></i>
			        <video controls="">
			            <source src="'. esc_url($webm) .'" type="video/webm">
			            <source src="'. esc_url($mpfour) .'" type="video/mp4">
			            <source src="'. esc_url($ogv) .'" type="video/ogg">	
			        </video>
			    </div>
			</div>
		';
	} elseif( 'embed-popup' == $layout ){
		$output = '
			<div class="modal-video-container mb16 text-center">
			    <div class="play-button large dark inline"></div>
			    <div class="modal-video">
			        <i class="ti-close close-iframe"></i>
			        '. wp_oembed_get($embed) .'
			    </div>
			</div>
		';
	}
	
	return $output;
}
add_shortcode( 'foundry_video_popup', 'ebor_video_popup_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_popup_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Video Embeds", 'foundry'),
			"base" => "foundry_video_popup",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Video Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Local Video' => 'local',
						'Embedded Video (Youtube etc.)' => 'embed',
						'Local Video Popup' => 'local-popup',
						'Embedded Video Popup' => 'embed-popup'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => __("Video Placeholder Image", 'foundry'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .webm extension", 'foundry'),
					"param_name" => "webm",
					"description" => __('Please fill all extensions', 'foundry')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .mp4 extension", 'foundry'),
					"param_name" => "mpfour",
					"description" => __('Please fill all extensions', 'foundry')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video .ogv extension", 'foundry'),
					"param_name" => "ogv",
					"description" => __('Please fill all extensions', 'foundry')
				),
				array(
					"type" => "textfield",
					"heading" => __("Video Embed", 'foundry'),
					"param_name" => "embed",
					'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_popup_shortcode_vc' );
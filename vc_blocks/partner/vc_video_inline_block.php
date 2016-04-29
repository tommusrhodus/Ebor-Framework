<?php 

/**
 * The Shortcode
 */
function ebor_video_popup_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'embed' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="video-cover">
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'full' ) .'
			</div>
			<div class="video-play-icon"></div>
			'. wp_oembed_get($embed) .'
		</div>
	';
	
	return $output;
}
add_shortcode( 'partner_video_popup', 'ebor_video_popup_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_popup_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Video Embeds", 'partner'),
			"base" => "partner_video_popup",
			"category" => esc_html__('partner WP Theme', 'partner'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Video Placeholder Image", 'partner'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Video Embed", 'partner'),
					"param_name" => "embed",
					'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_popup_shortcode_vc' );
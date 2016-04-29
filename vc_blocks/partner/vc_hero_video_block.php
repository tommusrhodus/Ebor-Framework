<?php 

/**
 * The Shortcode
 */
function ebor_hero_video_popup_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'embed' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="cta-video imagebg space--lg" data-overlay="4">
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'full' ) .'
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 text-center">
						<div class="modal-instance">
							<div class="video-play-icon modal-trigger"></div>
							<div class="modal-container">
								<div class="modal-content bg--dark" data-width="70%" data-height="70%">
									'. wp_oembed_get($embed) .'
								</div><!--end of modal-content-->
							</div><!--end of modal-container-->
						</div><!--end of modal instance-->
						<div class="wpb_text_column">
						'. do_shortcode(htmlspecialchars_decode($content)) .'
						</div>
					</div>
				</div><!--end of row-->
			</div><!--end of container-->
		</div>
	';
	
	return $output;
}
add_shortcode( 'partner_hero_video_popup', 'ebor_hero_video_popup_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_video_popup_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Hero Video", 'partner'),
			"base" => "partner_hero_video_popup",
			"category" => esc_html__('partner WP Theme', 'partner'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Video Placeholder Image", 'partner'),
					"param_name" => "image"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Hero Text Content", 'partner'),
					"param_name" => "content",
					'holder' => 'div'
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
add_action( 'vc_before_init', 'ebor_hero_video_popup_shortcode_vc' );
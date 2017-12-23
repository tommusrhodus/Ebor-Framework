<?php 

/**
 * The Shortcode
 */
function ebor_video_modal_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'local-large',
				'colour' => 'video-play-icon--dark',
				'text' => '',
				'video' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
				'embed' => ''
			), $atts 
		) 
	);
	
	if( 'local-large' == $layout ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<div class="video-play-icon '. esc_attr($colour) .' modal-trigger"></div>
				<span class="h6">'. $text .'</span>
				<div class="modal-container">
					<div class="modal-content bg-white" data-width="50%" data-height="50%">
						<video controls>
							<source src="'. esc_url($webm) .'" type="video/webm">
							<source src="'. esc_url($mpfour) .'" type="video/mp4">
							<source src="'. esc_url($ogv) .'" type="video/ogg">	
						</video>
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	} elseif( 'local-small' == $layout ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<div class="video-play-icon video-play-icon--sm '. esc_attr($colour) .' modal-trigger"></div>
				<span class="h6">'. $text .'</span>
				<div class="modal-container">
					<div class="modal-content bg-white" data-width="50%" data-height="50%">
						<video controls>
							<source src="'. esc_url($webm) .'" type="video/webm">
							<source src="'. esc_url($mpfour) .'" type="video/mp4">
							<source src="'. esc_url($ogv) .'" type="video/ogg">	
						</video>
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	} elseif( 'local-lozenge' == $layout ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<a class="btn modal-trigger" href="#">
					<span class="btn__text">
						&#9658; '. $text .'
					</span>
				</a>
				<div class="modal-container">
					<div class="modal-content bg-white" data-width="50%" data-height="50%">
						<video controls>
							<source src="'. esc_url($webm) .'" type="video/webm">
							<source src="'. esc_url($mpfour) .'" type="video/mp4">
							<source src="'. esc_url($ogv) .'" type="video/ogg">	
						</video>
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	} elseif( 'embed-large' == $layout ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<div class="video-play-icon '. esc_attr($colour) .' modal-trigger"></div>
				<span class="h6">'. $text .'</span>
				<div class="modal-container">
					<div class="modal-content bg-dark" data-width="60%" data-height="60%">
						'. wp_oembed_get($embed, array('height' => '400')) .'
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	} elseif( 'embed-small' == $layout ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<div class="video-play-icon video-play-icon--sm '. esc_attr($colour) .' modal-trigger"></div>
				<span class="h6">'. $text .'</span>
				<div class="modal-container">
					<div class="modal-content bg-dark" data-width="60%" data-height="60%">
						'. wp_oembed_get($embed, array('height' => '400')) .'
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	} elseif( 'embed-lozenge' == $layout ){
		
		$output = '
			<div class="modal-instance modal-video-1">
				<a class="btn btn--primary modal-trigger" href="#">
					<span class="btn__text">
						&#9658; '. $text .'
					</span>
				</a>
				<div class="modal-container">
					<div class="modal-content bg-dark" data-width="60%" data-height="60%">
						'. wp_oembed_get($embed, array('height' => '400')) .'
					</div><!--end of modal-content-->
				</div><!--end of modal-container-->
			</div><!--end of modal instance-->
		';
		
	}
	
	return $output;
}
add_shortcode( 'pillar_video_modal', 'ebor_video_modal_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_modal_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
			"name" => esc_html__("Video Modal Embeds", 'pillar'),
			"base" => "pillar_video_modal",
			"category" => esc_html__('pillar WP Theme', 'pillar'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Video Display Type", 'pillar'),
					"param_name" => "layout",
					"value" => array(
						'Local Video Large Button' => 'local-large',
						'Local Video Small Button' => 'local-small',
						'Local Video Lozenge Button' => 'local-lozenge',
						'Embedded Video (Youtube etc.) Large Button' => 'embed-large',
						'Embedded Video (Youtube etc.) Small Button' => 'embed-small',
						'Embedded Video (Youtube etc.) Lozenge Button' => 'embed-lozenge',
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Icon Color", 'pillar'),
					"param_name" => "colour",
					"value" => array(
						'Dark Icon' => 'video-play-icon--dark',
						'Light Icon' => 'video-play-icon--light'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'pillar'),
					"param_name" => "text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Self Hosted Video .webm extension", 'pillar'),
					"param_name" => "webm",
					"description" => esc_html__('Please fill all extensions', 'pillar')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Self Hosted Video .mp4 extension", 'pillar'),
					"param_name" => "mpfour",
					"description" => esc_html__('Please fill all extensions', 'pillar')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Self Hosted Video .ogv extension", 'pillar'),
					"param_name" => "ogv",
					"description" => esc_html__('Please fill all extensions', 'pillar')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Video Embed", 'pillar'),
					"param_name" => "embed",
					'description' => 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_modal_shortcode_vc' );
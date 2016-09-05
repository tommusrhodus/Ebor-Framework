<?php 

/**
 * The Shortcode
 */
function ebor_video_background_shortcode( $atts, $content = null ) {
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
			<section class="imagebg videobg height-100" data-overlay="4">
				<video autoplay loop muted>
					<source src="'. esc_url($webm) .'" type="video/webm">
					<source src="'. esc_url($mpfour) .'" type="video/mp4">
					<source src="'. esc_url($ogv) .'" type="video/ogg">	
				</video>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container pos-vertical-center">
					<div class="row">
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
				</div>
			</section>
		';
		
	} elseif( 'embed' == $layout ){
		
		$output = '
			<section class="imagebg videobg height-100" data-overlay="4">
				<div class="youtube-background" data-video-url="'. esc_attr($embed) .'" data-start-at="0"></div>
				<div class="background-image-holder">
					'. wp_get_attachment_image( $image, 'full' ) .'
				</div>
				<div class="container pos-vertical-center">
					<div class="row">
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
				</div>
			</section>
		';
		
	}
	
	return $output;
}
add_shortcode( 'pillar_video_background', 'ebor_video_background_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_background_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
			"name" => esc_html__("Video Background", 'pillar'),
			"base" => "pillar_video_background",
			"category" => esc_html__('pillar WP Theme', 'pillar'),
			'as_parent'               => array('except' => 'pillar_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Video Display Type", 'pillar'),
					"param_name" => "layout",
					"value" => array(
						'Local Video' => 'local',
						'Embedded Video (Youtube)' => 'embed'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Video Placeholder Image", 'pillar'),
					"param_name" => "image"
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
					"heading" => esc_html__("Youtube Embed", 'pillar'),
					"param_name" => "embed",
					'description' => 'Enter ID of YouTube video, e.g: 9d8wWcJLnFI'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_background_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pillar_video_background extends WPBakeryShortCodesContainer {}
}
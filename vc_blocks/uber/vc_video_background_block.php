<?php 

/**
 * The Shortcode
 */
function ebor_video_background_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'youtube' => '',
				'vimeo' => '',
				'fallback' => ''
			), $atts 
		) 
	);
	
	$img = wp_get_attachment_image_src($fallback, 'full');
	
	if(!( isset($img[0]) ))
		$img[0] = false;
	
	$output = '<style type="text/css">
					.poster-img {
						background: url('. esc_url($img[0]) .') center center no-repeat !important;
						background-size: cover !important;
					}
			  </style>';
	
	if( $youtube ){
		$output .= '<script type="text/javascript">
						/*-----------------------------------------------------------------------------------*/
						/*	BG YOUTUBE INIT
						/*-----------------------------------------------------------------------------------*/ 
						jQuery(document).ready(function() {
						"use strict";
							
							if( !device.tablet() && !device.mobile() ) {
								jQuery(".player").mb_YTPlayer();	
							} else {
								jQuery("body").addClass("poster-img");
							}
								
						});
				   </script>';
		$output .= "<a id=\"bgndVideo\" class=\"player\" data-property=\"{videoURL:'". esc_js(esc_url($youtube)) ."',containment:'body',autoPlay:true, mute:true, startAt:0, opacity:1}\"></a>";
	} elseif( $vimeo ){
		$output .= '<script type="text/javascript">
						/*-----------------------------------------------------------------------------------*/
						/*	BG VIMEO INIT
						/*-----------------------------------------------------------------------------------*/ 
						jQuery(document).ready(function() {
						"use strict";
						
							if( !device.tablet() && !device.mobile() ) {
								jQuery.okvideo({ source: "'. esc_js($vimeo) .'",
						            autoplay:true,
						            loop: true,
						            highdef:true,
						            hd:true, 
						            adproof: true,
						            volume: 0
						         });		
							} else {
								jQuery("body").addClass("poster-img");
							}
						
						});
				   </script>';
	}
	
	
	$output .= '<div id="intro" class="intro showcase-06 fullheight text-center">
					<div class="valign">
						<h3 class="text-rotator black font4 fashion-caps">
							<span class="rotate">'. $title .'</span>
						</h3>
					</div>
				</div>';
	
	return $output;
}
add_shortcode( 'uber_video_background', 'ebor_video_background_shortcode' );

/**
 * The VC Functions
 */
function ebor_video_background_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
			"name" => __("video Background", 'uber'),
			'description' => __('Adds a fullscreen background video', 'uber'),
			"base" => "uber_video_background",
			"category" => __('Uber - WP Theme', 'uber'),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => __("Title", 'uber'),
					"param_name" => "title",
					'description' => 'Comma separate lines for fade in / fade out text rotator.',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Youtube URL", 'uber'),
					"param_name" => "youtube"
				),
				array(
					"type" => "textfield",
					"heading" => __("Vimeo ID", 'uber'),
					"param_name" => "vimeo"
				),
				array(
					"type" => "attach_image",
					"heading" => __("Fallback static image for mobile devices", 'uber'),
					"param_name" => "fallback",
					'description' => __('Note: Mobile devices have background video disabled from a device level, use this input to display a static image instead (REQUIRED)', 'uber')
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_background_shortcode_vc' );